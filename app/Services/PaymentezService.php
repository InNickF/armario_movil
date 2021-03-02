<?php

namespace App\Services;

use DateTime;
use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class PaymentezService
{
    private $url;
    private $server_app_code;
    private $server_app_key;


    public function __construct()
    {
        $this->url = config('services.paymentez.card_url');
        $this->server_app_code = config('services.paymentez.server_app_code');
        $this->server_app_key = config('services.paymentez.server_app_key');
    }


    public function getNewToken()
    {
        $paymentez_server_application_code =  $this->server_app_code;
        $paymentez_server_app_key = $this->server_app_key;
        $date = new DateTime();
        $unix_timestamp = $date->getTimestamp();
        // $unix_timestamp = "1546543146";
        $uniq_token_string = $paymentez_server_app_key . $unix_timestamp;
        $uniq_token_hash = hash('sha256', $uniq_token_string);
        $auth_token = base64_encode($paymentez_server_application_code . ";" . $unix_timestamp . ";" . $uniq_token_hash);

        return $auth_token;
    }



    public function getLoggedUserCards($userId)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        $response = $client->get('card/list?uid=' . $userId, [
            // 'json' => [
            //     'uid' => '',
            // ],
            'headers' => [
                'Auth-Token' => $this->getNewToken(),
                'Accept'     => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            return $response->getReasonPhrase();
        }

        $body = $response->getBody();

        return json_decode((string) $body);
    }



    public function debitWithToken($user, $token, array $data)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        // dd($data);

        $json = [
            'card' => [
                'token' => $token
            ],
            'order' => [
                'amount' => $data['amount'],
                'description' => $data['description'],
                'dev_reference' => (string) $data['dev_reference'],
                'vat' => $data['vat'],
            ],
            'user' => [
                'id' => (string) $user->id,
                'email' => $user->email,
            ],
        ];

        // dd(json_encode($json));

        try {
            //code...
            $response = $client->post('transaction/debit', [
                'json' => $json,
                'headers' => [
                    'Auth-Token' => $this->getNewToken(),
                    'Accept'     => 'application/json',
                ]
            ]);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        }


        if ($response->getStatusCode() != 200) {
            return [
                'error' => $th->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }



    public function refund($transactionId)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        $json = [
            'transaction' => [
                'id' => $transactionId
            ],
        ];

        try {
            $response = $client->post('transaction/refund', [
                'json' => $json,
                'headers' => [
                    'Auth-Token' => $this->getNewToken(),
                    'Accept'     => 'application/json',
                ]
            ]);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        }


        if ($response->getStatusCode() != 200) {
            return [
                'error' => $th->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }
    // public function createSubscription($token, $data)
    // {
    //     $client = new Client([
    //         'base_uri' => $this->url
    //     ]);

    //     // dd(round(($plan->price / 100) * config('armario.taxes.iva'), 2));
    //     $json = [
    //         'card' => [
    //             'token' => $token
    //         ],
    //         'order' => [
    //             'amount' => $data['amount'],
    //             'description' => $data['description'],
    //             'dev_reference' => (string)$data['dev_reference'],
    //             'vat' => $data['vat'],
    //         ],
    //         'user' => [
    //             'id' => (string)auth()->user()->id,
    //             'email' => auth()->user()->email,
    //         ],
    //     ];

    //     // dd(json_encode($json));

    //     try {
    //         //code...
    //         $response = $client->post('transaction/debit', [
    //             'json' => $json,
    //             'headers' => [
    //                 'Auth-Token' => $this->getNewToken(),
    //                 'Accept'     => 'application/json',
    //             ]
    //         ]);
    //     } catch (ClientException $th) {
    //         //    dd($th->getResponse()->getBody()->getContents());
    //         return [
    //             'error' => $th->getResponse()->getBody()->getContents()
    //         ];
    //     }

    //     if ($response->getStatusCode() != 200) {
    //         return [
    //             'error' => $th->getReasonPhrase()
    //         ];
    //     }

    //     $body = $response->getBody();

    //     return collect(json_decode((string)$body));
    // }


    public function addCard($card)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        // dd($card);

        try {

            $response = $client->post('card/add', [
                'json' => [
                    'user' => [
                        'id' => (string) auth()->user()->id,
                        'email' => auth()->user()->email,
                    ],
                    'card' => [
                        'number' => $card['number'],
                        'holder_name' => $card['holder_name'],
                        'expiry_month' => (int) $card['expiry_month'],
                        'expiry_year' => (int) $card['expiry_year'],
                        'cvc' => $card['cvc'],
                    ]
                ],
                'headers' => [
                    'Auth-Token' => $this->getNewToken(),
                    'Accept'     => 'application/json',
                ]
            ]);
        } catch (ClientException $th) {
            //    dd($th->getResponse()->getBody()->getContents());
            return [
                'error' => json_decode($th->getResponse()->getBody()->getContents())->error
            ];
        } catch (ServerException $th) {
            // dd($th->getResponse()->getBody()->getContents());
            return [
                'error' => json_decode($th->getResponse()->getBody()->getContents())->error
            ];
        }


        if ($response->getStatusCode() != 200) {
            return [
                'error' => $response->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return json_decode((string) $body);
    }


    public function removeCard($token)
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        if (!auth()->check()) {
            return [
                'error' => 'No se ha encontrado al usuario'
            ];
        }


        try {
            $response = $client->post('card/delete', [
                'json' => [
                    'user' => [
                        'id' => (string) auth()->user()->id,
                    ],
                    'card' => [
                        'token' => (string) $token
                    ],
                ],
                'headers' => [
                    'Auth-Token' => $this->getNewToken(),
                    'Accept'     => 'application/json',
                ]
            ]);
        } catch (ClientException $th) {
            //    dd($th->getResponse()->getBody()->getContents());
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        }



        if ($response->getStatusCode() != 200) {
            return [
                'error' => $response->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return json_decode((string) $body);
    }


}
