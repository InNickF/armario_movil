<?php

namespace App\Services;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class GacelaService
{
    private $url;
    private $store_email;
    private $store_password;
    private $company_email;
    private $company_password;

    public function __construct()
    {
        $this->url = config('services.gacela.url');
        $this->store_email = config('services.gacela.store_email');
        $this->store_password = config('services.gacela.store_password');
        $this->company_email = config('services.gacela.company_email');;
        $this->company_password = config('services.gacela.company_password');;
    }


    public function loginCompany()
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        $data = [
            'json' => [
                'email' => $this->company_email,
                'password' => $this->company_password,
            ],
            'headers' => [
                'Accept'     => 'application/json',
            ]
        ];

        // dd($data);

        try {
            $token = $client->post('login', $data);
        } catch (ClientException $th) {
            // dd($th->getResponse()->getBody()->getContents());
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        }


        if ($token->getStatusCode() != 200) {
            return [
                'error' => $token->getReasonPhrase()
            ];
        }

        $body = $token->getBody();

        return collect(json_decode((string) $body))['results'];
    }



    public function loginStore()
    {
        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $token = $client->post('login', [
                'json' => [
                    'email' => $this->store_email,
                    'password' => $this->store_password,
                ],
                'headers' => [
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


        if ($token->getStatusCode() != 200) {
            return $token->getReasonPhrase();
        }

        $body = $token->getBody();

        return collect(json_decode((string) $body))['results'];
    }


    public function validateCoverage($data)
    {
        $company = $this->loginCompany();
        if (!isset($company->api_token) || empty($company->api_token)) {
            return [
                'error' =>  'No se pudo obtener ID de compañía'
            ];
        }

        $client = new Client([
            'base_uri' => $this->url
        ]);



        \Log::info('Gacela data cobertura');
        \Log::info($this->url);
        \Log::info($data);


        try {
            $response = $client->post('orders/routes/coverage', [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $company->api_token,
                ]
            ]);
        } catch (ClientException $th) {
            \Log::error('Gacela error cobertura ClientException');
            \Log::error($th->getResponse()->getBody()->getContents());
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        } catch (ServerException $th) {
            \Log::error('Gacela error cobertura ServerException');
            \Log::error($th->getResponse()->getBody()->getContents());
            return [
                'error' => $th->getResponse()->getBody()->getContents()
            ];
        }


        if ($response->getStatusCode() != 200) {
            return [
                'error' => 'Zona fuera de cobertura'
            ];
        }

        $body = $response->getBody();

        \Log::info('Gacela respuesta cobertura');
        \Log::info($body);

        return collect(json_decode((string) $body))['status'];
    }



    public function createOrder($data)
    {
        $company = $this->loginCompany();
        // dd(($company->api_token));
        if (!isset($company->api_token) || empty($company->api_token)) {
            return [
                'error' =>  'No se pudo obtener ID de compañía'
            ];
        }
        // dd(($company->api_token));

        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $response = $client->post('orders/routes/set', [
                'json' => $data,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $company->api_token,
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

        if ($response->getStatusCode() != 201) {
            return [
                'error' => $response->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body))['results'];
    }






    public function track($token)
    {
        $company = $this->loginCompany();
        if (!isset($company->api_token) || empty($company->api_token)) {
            return 'No se pudo obtener ID de compañía';
        }

        $client = new Client([
            'base_uri' => $this->url
        ]);

        try {
            $response = $client->get('tracking/' . $token, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $company->api_token,
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
                'error' => $response->getReasonPhrase()
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body))['results'];
    }



    public function getIframeUrl($token)
    {
        return $this->url . 'tracking/' . $token;
    }
}
