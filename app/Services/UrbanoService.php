<?php

namespace App\Services;

use GuzzleHttp\Client;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;

class UrbanoService
{
	private $url;
	private $user;
	private $password;
	private $line;
	private $contract_id;

	public function __construct()
	{
		$this->url = config('services.urbano.url');
		$this->user = config('services.urbano.user');
		$this->password = config('services.urbano.password');
		$this->line = config('services.urbano.line');
		$this->contract_id = config('services.urbano.contract_id');
	}

	public function createOrder($data)
	{

		\Log::info('URBANO createOrder');
		\Log::info($data);
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$credentials = [
			'id_contrato' => $this->contract_id,
			'linea' => $this->line,
		];

		$json = [
			'json' => json_encode(array_merge($credentials, $data)),
		];

		// $postdata = http_build_query($json);
		// dd($json);

		$params = [
			'form_params' => $json,
			'headers' => [
				'Content-type' => 'application/x-www-form-urlencoded',
				// 'Accept' => 'application/json',
				'user' => $this->user,
				'pass' => $this->password,
			],
		];

		// dd(json_encode($params));

		try {
			$shipping_order = $client->post('ge', $params);
		} catch (ClientException $th) {
			// dd($th->getResponse()->getBody()->getContents());
			return [
				'error' => $th->getResponse()->getBody()->getContents(),
			];
		} catch (ServerException $th) {
			// dd($th->getResponse()->getBody()->getContents());
			return [
				'error' => $th->getResponse()->getBody()->getContents(),
			];
		}

		if ($shipping_order->getStatusCode() != 200) {
			return [
				'error' => $shipping_order->getReasonPhrase(),
			];
		}
		Log::info('RESPUESTA URBANO');
		Log::info((string) $shipping_order->getBody());

		$body = json_decode((string) $shipping_order->getBody());
		if (is_array($body) && isset($body[0]->sql_error)) {
			return [
				'error' => $body->msg_error ?? json_encode($body),
			];
			\Log::error($body);
		};

		if (($body->error != 1)) { // 1 es NO ERROR por alguna razon
			return [
				'error' => $body->mensaje,
			];
		};

		$body = collect($body)->toArray();

		unset($body['error']); // Quitar ERROR para que no pase como error en Order
		return $body;
	}

	public function track($guia)
	{

		$client = new Client([
			'base_uri' => $this->url,
		]);

		$guia = [
			'guia' => $guia,
			'docref' => '',
			'vp_linea' => 3,
		];

		$json = [
			'json' => json_encode($guia),
		];

		$getdata = http_build_query($json);
		// dd($client->getConfig());

		try {
			$shipping_order = $client->get('tracking?' . $getdata, [
				// 'form_params' => $json,
				'headers' => [
					'Content-type' => 'application/x-www-form-urlencoded',
					// 'Accept' => 'application/json',
					'user' => $this->user,
					'pass' => $this->password,
				],
			]);
		} catch (ClientException $th) {
			// dd($th->getResponse()->getBody()->getContents());
			return [
				'error' => $th->getResponse()->getBody()->getContents(),
			];
			// dd($shipping_order);
		}


		if ($shipping_order->getStatusCode() != 200) {
			return [
				'error' => $shipping_order->getReasonPhrase(),
			];
		}

		\Log::info('Respuesta tracking urbano');
		\Log::info((string) $shipping_order->getBody());

		if (is_array($shipping_order->getBody())) {
			$body = json_decode((string) $shipping_order->getBody())[0];
		} else {
			$body = json_decode((string) $shipping_order->getBody());
		}

		if (isset($body->sql_error) && $body->sql_error == -1) {
			return [
				'error' => $body->msg_error ?? json_encode($body),
			];
			\Log::error($body);
		};

		if (isset($body->error) && $body->error == -1) { // 1 es NO ERROR por alguna razon
			return [
				'error' => $body->mensaje,
			];
			\Log::error($body);
		};

		return $body;
	}
}