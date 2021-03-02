<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use function GuzzleHttp\json_decode;

class GlovoService
{
    private $url;
    private $key;
    private $secret;

    public function __construct()
    {
        $this->url = config('services.glovo.url');
        $this->credential = config('services.glovo.credential');
    }

    public function estimateOrderPrice($pickupLat, $pickupLng, $deliveryLat, $deliveryLng)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);

        $data = [
            'json' => [
                'description' => 'Verificación de cobertura',
                'addresses' => [
                    [
                        'type' => 'PICKUP',
                        'lat' => $pickupLat,
                        'lon' => $pickupLng,
                        'label' => 'Punto de retiro para calcular cobertura',
                    ],
                    [
                        'type' => 'DELIVERY',
                        'lat' => $deliveryLat,
                        'lon' => $deliveryLng,
                        'label' => 'Punto de entrega para calcular cobertura',
                    ],
                ],
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$this->credential,
            ],
        ];

        try {
            $response = $client->post('orders/estimate', $data);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        }

        if (200 != $response->getStatusCode()) {
            return [
                'error' => $response->getReasonPhrase(),
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }

    public function isInWorkingArea($pickupLat, $pickupLng, $deliveryLat, $deliveryLng)
    {
        $estimate = $this->estimateOrderPrice($pickupLat, $pickupLng, $deliveryLat, $deliveryLng);
        \Log::info(json_encode($estimate));

        if (is_array($estimate) && isset($estimate['error'])) {
            return false;
        }

        return true;
    }

    public function createOrder($data)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);

        $postData = [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$this->credential,
            ],
        ];

        \Log::info($postData);

        try {
            $response = $client->post('orders', $postData);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        }

        if (200 != $response->getStatusCode()) {
            return [
                'error' => $response->getReasonPhrase(),
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }

    public function track($id)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);

        $data = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$this->credential,
            ],
        ];

        try {
            $response = $client->get('orders/'.$id.'/tracking', $data);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        }

        if (200 != $response->getStatusCode()) {
            return [
                'error' => $response->getReasonPhrase(),
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }

    public function cancel($id)
    {
        $client = new Client([
            'base_uri' => $this->url,
        ]);

        $postData = [
            // 'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$this->credential,
            ],
        ];

        try {
            $response = $client->post('orders'.$id.'/cancel', $postData);
        } catch (ClientException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        } catch (ServerException $th) {
            return [
                'error' => $th->getResponse()->getBody()->getContents(),
            ];
        }

        if (200 != $response->getStatusCode()) {
            return [
                'error' => $response->getReasonPhrase(),
            ];
        }

        $body = $response->getBody();

        return collect(json_decode((string) $body));
    }
}