<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use function GuzzleHttp\json_encode;
use Rinvex\Subscriptions\Models\Plan;

class PerseoService
{
	private $url;
	private $user;
	private $password;
	private $db;

	public function __construct()
	{
		$this->url = config('services.perseo.url');
		$this->user = config('services.perseo.user');
		$this->password = config('services.perseo.password');
		$this->db = config('services.perseo.db');
	}

	public function generateBill($data)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		$detalles = [];
		foreach ($data['detalles'] as $key => $perseoProduct) {
			$detalles[] = [
				"centros_costosid" => 1,
				"almacenesid" => 1,
				"productosid" => $perseoProduct['productosid'],
				"medidasid" => 1,
				"cantidaddigitada" => $perseoProduct['order_item']['quantity'],
				"cantidadfactor" => 1,
				"cantidad" => $perseoProduct['order_item']['quantity'],
				"precio" => round($perseoProduct['order_item']['unit_price_final'] / 1.12, 2), // Precio unitario
				"preciovisible" => $perseoProduct['order_item']['unit_price_final'], // Precio unitario
				"precioiva" => $perseoProduct['order_item']['unit_price_final'], // Precio unitario
				"descuento" => 0,
				"costo" => 0,
				"iva" => 2,
				"descuentovalor" => $perseoProduct['order_item']['coupon_discount'], // * Coupon calculated value,
				"servicio" => true,
				"descripcion" => ""
			];
		}

		// "centros_costosid":1, // Default 1 porque es de la cabecera
		//                     "almacenesid":1, // Mismo de cabecera
		//                     "productosid":2, // ID de producto Perseo creado en productos_crear
		//                     "descripcion":"Producto sin IVA",
		//                     "medidasid":1, // Dejar 1
		//                     "cantidaddigitada":1, // Unidades vendidas
		//                     "cantidadfactor":1, // Dejar 1
		//                     "cantidad":1, // cantidad * factor
		//                     "precio":40, // Sin IVA
		//                     "preciovisible":40, // Precio
		//                     "precioiva":40, // Precio + IVA
		//                     "descuento":0, // Dejar 0
		//                     "costo":1.54, // Dejar 0
		//                     "iva":2, // Poner 2 = ID de IVA
		//                     "descuentovalor":0, // Dejar 0
		//                     "servicio":true, // true
		//                     "anulado":false, // dejar
		//                     "entrega":false, // dejar
		//                     "informaciondetalle":"", // dejar
		//                     "informacion":""// dejar
		//                 }

		$json = [
			'registro' => [
				[
					'facturas' => [
						'concepto' => 'Compra en Armario Móvil',
						"facturasid" => null,
						"secuenciasid" => 1,
						"sri_documentoscodigo" => "01",
						"forma_pago_empresaid" => 1,
						"forma_pago_sri_codigo" => "01",
						"cajasid" => 1,
						"bancosid" => 0,
						"centros_costosid" => 1,
						"almacenesid" => 1,
						"facturadoresid" => 1,
						"vendedoresid" => 3,
						"clientesid" => $data['clientesid'],
						"clientes_sucursalesid" => 0,
						"tarifasid" => 1,
						"establecimiento" => "001",
						"puntoemision" => "001",
						"secuencial" => "000000011",
						"emision" => Carbon::now()->format('Ymd'),
						"fechacreacion" => Carbon::now()->format('Ymd'),
						"vence" => Carbon::now()->format('Ymd'),
						"subtotal" => $data['subtotal'],
						"total_descuento" => $data['coupon_discount'],
						"subtotalconiva" => 0,
						"subtotalsiniva" => $data['subtotal'],
						"subtotalneto" => $data['subtotal'],
						"total_ice" => 0,
						"total_iva" => $data['vat_price'],
						"propina" => 0,
						"total" => $data['amount'],
						"totalneto" => $data['amount'],
						"totalretenidoiva" => 0,
						"totalretenidorenta" => 0,
						"puntoemisionretencion" => "",
						"establecimientoretencion" => "",
						"emisionretencion" => "",
						"secuenciaretencion" => "",
						"detalles" => $detalles,
						"movimiento" => [[
							"forma_pago_empresaid" => 1,
							"cajasid" => 1,
							"documentoorigen" => "000000011",
							"importe" => $data['amount'],
							"bancotarjetaid" => 0,
							"fechamovimiento" => Carbon::now()->format('Ymd'),
							"fechavence" => Carbon::now()->format('Ymd'),
							"comprobante" => "RC00000006",
							"numerochequevoucher" => "RC00000006"
						]],
					],
				],
			],
		];

		Log::info(json_encode($json));

		try {
			//code...
			$response = $client->post('facturas_crear', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => $th->getResponse()->getBody()->getContents(),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}


		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}


		$body = json_decode((string) $response->getBody());

		if (!isset($body->facturas) || empty($body->facturas)) {
			return [
				'error' => $body,
			];
		}

		\Log::info('Factura PERSEO creada:');
		\Log::info(json_encode($body->facturas));

		return ($body->facturas[0]->facturas_secuencia);
	}

	public function createClient(Address $billingAddress)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'clientes' => [
				[
					'clientes' => [
						// "codigocontable" => "1.1.02.05.01",
						"razonsocial" => $billingAddress->full_name,
						// "nombrecomercial" => "",
						"direccion" => $billingAddress->street,
						'identificacion' => $billingAddress->document_number,
						"tipoidentificacion" => "C",
						"email" => auth()->user()->email,
						"telefono1" => auth()->user()->phone,
						// "telefono2" => "",
						// "telefono3" => "",
						"personanatural" => true,
					],
				],
			],
		];

		try {
			//code...
			$response = $client->post('clientes_crear', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());
		if (!isset($body->clientes)) {
			return [
				'error' => $body,
			];
		}

		return ($body->clientes[0]->clientesid_nuevo);
	}

	public function getClient($document)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		Log::info('PerseoService getClient: ' . $document);

		$json = [
			'clientes' => [
				[
					'clientes' => [
						'identificacion' => $document,
						'clienteid' => '',
						'clientescodigo' => '',
						'contenido' => '',
					],
				],
			],
		];

		try {
			$response = $client->post('clientes_consulta', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			// Log::error('Client error' . $th->getResponse()->getBody(true));
			$response = json_decode($th->getResponse()->getBody()->getContents());
			Log::error(json_encode($response));
			return [
				'error' => ($response->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		if (!isset($body->clientes)) {
			return [
				'error' => $body,
			];
		}

		return ($body->clientes[0]->clientesid);
	}










	/**
	 * PRODUCTOS
	 */

	public function createProduct(Product $product)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						"productosid" => $product->id, // Mandar ID interno, sera ignorado
						"productocodigo" => $product->uuid, // Se genera si no se manda, USAR ESTE PARA BUSCAR LUEGO
						"descripcion" => $product->name,
						"sri_codigo_impuestos" => "312", // Dejar 312
						"barras" => "0", // OPCIONAL
						"sri_tipos_ivas_codigo" => "2", // Dejar 2
						"productos_lineasid" => 1, // Dejar 1
						"productos_categoriasid" => 1, // Dejar 1
						"productos_subcategoriasid" => 1, // Dejar 1
						"productos_subgruposid" => 1, // Dejar 1
						"estado" => true, // Activo
						"venta" => true, // En venta
						"existenciastotales" => 0, // Se puede mandar
						"controlnegativos" => true, // Dejar
						"controlprecios" => true, // Dejar
						"servicio" => true, // Dejar
						"bien" => false, // Dejar
						"series" => false, // Dejar
						"vehiculos" => false, // Dejar
						"cuentacontable_inventarios" => "1.1.03.01.02", // Dejar
						"cuentacontable_ventas" => "4.1.01.02", // Dejar
						"cuentacontable_costo" => "5.1.01.01.02", // Dejar
						"fichatecnica" => "", // Dejar
						"costoactual" => 0, // Costo
						"costoestandar" => 0, // Costo o 0
						"costoultimacompra" => 0, // Dejar 0
						"fechaultimacompra" => "", // Dejar
						"observaciones" => "", // Dejar
						"unidadinterna" => 1, // Dejar
						"unidadsuperior" => 0, // Dejar
						"unidadinferior" => 0, // Dejar
						"unidadcompra" => 1, // Dejar
						"unidadventa" => 1, // Dejar
						"proveedoresid_asignado" => 0, // Dejar
						"proveedoresid_ultimo" => 0, // Dejar
						"factorsuperior" => 0, // Dejar
						"factorinferior" => 0, // Dejar
						"subsidio" => 0, // Dejar
						"tonelaje" => 0, // Dejar
						"pasajeros" => 0, // Dejar
						"cilindraje" => 0, // Dejar
						"marca" => "", // Dejar
						"modelo" => "", // Dejar
						"origen" => "", // Dejar
						"lado" => "", // Dejar
						"medidas" => "", // Dejar
						"materiaprima" => false, // Dejar
						"fechacreacion" => "20190319120049", // Fecha actual
						"usuariocreacion" => "IMOVIL",
						"usuariomodificacion" => "IMOVIL"
					],
					"tarifas" =>
					[
						[
							"tarifasid" => 1,
							"medidasid" => 1,
							"medidas" => "Unidad",
							"precioiva" => $product->final_price, // Precio + IVA
							"precio" => round($product->final_price - ($product->final_price / 1.12), 2), // Precio sin IVA
							"margen" => 0, // Dejar 0
							"utilidad" => 0, // Dejar 0
							"descuento" => 0, // Dejar 0
							"factor" => 1, // Dejar 1
							"escala" => 0 // Deajr 0
						],
					]

				],
			]
		];

		try {
			//code...
			$response = $client->post('productos_crear', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());
		if (!isset($body->producto)) {
			return [
				'error' => $body,
			];
		}

		Log::info('PerseoService CreatePrduct response');
		Log::info(json_encode($body));

		return ($body->producto[0]->productosid_nuevo);
	}


	public function getProduct(Product $product)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						'productocodigo' => $product->uuid, // Buscar este porque el otro (productosid) lo cambia el API
					],
				],
			],
		];

		try {
			//code...
			$response = $client->post('productos_consulta', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		if (!isset($body->productos)) {
			return [
				'error' => $body,
			];
		}

		return ($body->productos[0]->productosid);
	}





	public function createPlanAsProduct(Plan $plan)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						"productosid" => $plan->id, // Mandar ID interno, sera ignorado
						"productocodigo" => 'plan_' . $plan->id, // Se genera si no se manda, USAR ESTE PARA BUSCAR LUEGO
						"descripcion" => $plan->name,
						"sri_codigo_impuestos" => "312", // Dejar 312
						"barras" => "0", // OPCIONAL
						"sri_tipos_ivas_codigo" => "2", // Dejar 2
						"productos_lineasid" => 1, // Dejar 1
						"productos_categoriasid" => 1, // Dejar 1
						"productos_subcategoriasid" => 1, // Dejar 1
						"productos_subgruposid" => 1, // Dejar 1
						"estado" => true, // Activo
						"venta" => true, // En venta
						"existenciastotales" => 0, // Se puede mandar
						"controlnegativos" => true, // Dejar
						"controlprecios" => true, // Dejar
						"servicio" => true, // Dejar
						"bien" => false, // Dejar
						"series" => false, // Dejar
						"vehiculos" => false, // Dejar
						"cuentacontable_inventarios" => "1.1.03.01.02", // Dejar
						"cuentacontable_ventas" => "4.1.01.02", // Dejar
						"cuentacontable_costo" => "5.1.01.01.02", // Dejar
						"fichatecnica" => "", // Dejar
						"costoactual" => 0, // Costo
						"costoestandar" => 0, // Costo o 0
						"costoultimacompra" => 0, // Dejar 0
						"fechaultimacompra" => "", // Dejar
						"observaciones" => "", // Dejar
						"unidadinterna" => 1, // Dejar
						"unidadsuperior" => 0, // Dejar
						"unidadinferior" => 0, // Dejar
						"unidadcompra" => 1, // Dejar
						"unidadventa" => 1, // Dejar
						"proveedoresid_asignado" => 0, // Dejar
						"proveedoresid_ultimo" => 0, // Dejar
						"factorsuperior" => 0, // Dejar
						"factorinferior" => 0, // Dejar
						"subsidio" => 0, // Dejar
						"tonelaje" => 0, // Dejar
						"pasajeros" => 0, // Dejar
						"cilindraje" => 0, // Dejar
						"marca" => "", // Dejar
						"modelo" => "", // Dejar
						"origen" => "", // Dejar
						"lado" => "", // Dejar
						"medidas" => "", // Dejar
						"materiaprima" => false, // Dejar
						"fechacreacion" => "20190319120049", // Fecha actual
						"usuariocreacion" => "IMOVIL",
						"usuariomodificacion" => "IMOVIL"
					],
					"tarifas" =>
					[
						[
							"tarifasid" => 1,
							"medidasid" => 1,
							"medidas" => "Unidad",
							"precioiva" => $plan->price, // Precio + IVA
							"precio" => round($plan->price - ($plan->price / 1.12), 2), // Precio sin IVA
							"margen" => 0, // Dejar 0
							"utilidad" => 0, // Dejar 0
							"descuento" => 0, // Dejar 0
							"factor" => 1, // Dejar 1
							"escala" => 0 // Deajr 0
						],
					]

				],
			]
		];

		try {
			//code...
			$response = $client->post('productos_crear', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			\Log::error($response->getBody());
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		if (!isset($body->producto)) {
			return [
				'error' => $body,
			];
		}

		Log::info('PerseoService CreatePrduct response');
		Log::info(json_encode($body));

		return ($body->producto[0]->productosid_nuevo);
	}

	public function getPlanAsProduct(Plan $plan)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						'productocodigo' => 'plan_' . $plan->id, // Buscar este porque el otro (productosid) lo cambia el API
					],
				],
			],
		];

		try {
			//code...
			$response = $client->post('productos_consulta', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		if (!isset($body->productos)) {
			return [
				'error' => $body,
			];
		}

		return ($body->productos[0]->productosid);
	}


	public function createShippingAsProduct($type, $amount)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						"productosid" => 'shipping_' . $type, // Mandar ID interno, sera ignorado
						"productocodigo" => 'shipping_' . $type, // Se genera si no se manda, USAR ESTE PARA BUSCAR LUEGO
						"descripcion" => 'Envío ' . ($type == 'national' ? 'nacional vía Urbano' : 'local vía Glovo'),
						"sri_codigo_impuestos" => "312", // Dejar 312
						"barras" => "0", // OPCIONAL
						"sri_tipos_ivas_codigo" => "2", // Dejar 2
						"productos_lineasid" => 1, // Dejar 1
						"productos_categoriasid" => 1, // Dejar 1
						"productos_subcategoriasid" => 1, // Dejar 1
						"productos_subgruposid" => 1, // Dejar 1
						"estado" => true, // Activo
						"venta" => true, // En venta
						"existenciastotales" => 0, // Se puede mandar
						"controlnegativos" => true, // Dejar
						"controlprecios" => true, // Dejar
						"servicio" => true, // Dejar
						"bien" => false, // Dejar
						"series" => false, // Dejar
						"vehiculos" => false, // Dejar
						"cuentacontable_inventarios" => "1.1.03.01.02", // Dejar
						"cuentacontable_ventas" => "4.1.01.02", // Dejar
						"cuentacontable_costo" => "5.1.01.01.02", // Dejar
						"fichatecnica" => "", // Dejar
						"costoactual" => 0, // Costo
						"costoestandar" => 0, // Costo o 0
						"costoultimacompra" => 0, // Dejar 0
						"fechaultimacompra" => "", // Dejar
						"observaciones" => "", // Dejar
						"unidadinterna" => 1, // Dejar
						"unidadsuperior" => 0, // Dejar
						"unidadinferior" => 0, // Dejar
						"unidadcompra" => 1, // Dejar
						"unidadventa" => 1, // Dejar
						"proveedoresid_asignado" => 0, // Dejar
						"proveedoresid_ultimo" => 0, // Dejar
						"factorsuperior" => 0, // Dejar
						"factorinferior" => 0, // Dejar
						"subsidio" => 0, // Dejar
						"tonelaje" => 0, // Dejar
						"pasajeros" => 0, // Dejar
						"cilindraje" => 0, // Dejar
						"marca" => "", // Dejar
						"modelo" => "", // Dejar
						"origen" => "", // Dejar
						"lado" => "", // Dejar
						"medidas" => "", // Dejar
						"materiaprima" => false, // Dejar
						"fechacreacion" => "20190319120049", // Fecha actual
						"usuariocreacion" => "IMOVIL",
						"usuariomodificacion" => "IMOVIL"
					],
					"tarifas" =>
					[
						[
							"tarifasid" => 1,
							"medidasid" => 1,
							"medidas" => "Unidad",
							"precioiva" => $amount, // Precio + IVA
							"precio" => round($amount - ($amount / 1.12), 2), // Precio sin IVA
							"margen" => 0, // Dejar 0
							"utilidad" => 0, // Dejar 0
							"descuento" => 0, // Dejar 0
							"factor" => 1, // Dejar 1
							"escala" => 0 // Deajr 0
						],
					]

				],
			]
		];

		try {
			//code...
			$response = $client->post('productos_crear', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());
		if (!isset($body->producto)) {
			return [
				'error' => $body,
			];
		}

		Log::info('PerseoService CreatePrduct response');
		Log::info(json_encode($body));

		return ($body->producto[0]->productosid_nuevo);
	}

	public function getShippingAsProduct($type)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'productos' => [
				[
					'productos' => [
						'productocodigo' => 'shipping_' . $type, // Buscar este porque el otro (productosid) lo cambia el API
					],
				],
			],
		];

		try {
			//code...
			$response = $client->post('productos_consulta', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		if (!isset($body->productos)) {
			return [
				'error' => $body,
			];
		}

		return ($body->productos[0]->productosid);
	}


	public function authorizeBill($perseoFacturasId)
	{
		$client = new Client([
			'base_uri' => $this->url,
		]);

		$headers = [
			'Usuario' => $this->user,
			'Clave' => $this->password,
			'DBDatos' => $this->db,
			'Content-Type' => 'application/json',
			// 'Accept' => 'text/plain',
		];

		// dd($document);

		$json = [
			'registro' => [
				[
					'facturas' => [
						'facturasid' => $perseoFacturasId,
						'enviomail' => true,
					],
				],
			],
		];

		try {
			//code...
			$response = $client->post('facturas_autorizar', [
				'json' => $json,
				'headers' => $headers,
			]);
		} catch (ClientException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())->fault->faultstring),
			];
		} catch (ServerException $th) {
			return [
				'error' => (json_decode($th->getResponse()->getBody()->getContents())),
			];
		}

		if ($response->getStatusCode() != 200) {
			return [
				'error' => $response->getReasonPhrase(),
			];
		}

		$body = json_decode((string) $response->getBody());

		// if (!isset($body->autorizado) || !$body->autorizado) {
		// 	return [
		// 		'error' => $body,
		// 	];
		// }

		return ($body);
	}
}




// {
//     "facturas":
//     [
//         {
//             "facturas":
//             {
//                 "facturasid":1, // ID interno se transforma en ID Perseo (OPCIONAL)
//                 "secuenciasid":1, // Se manejan desde dashboard web
//                 "sri_documentoscodigo":"01", // 01 = facturas
//                 "forma_pago_empresaid":1, // Efectivo o credito, hacer consulta API formapagoempresa_consulta
//                 "forma_pago_sri_codigo":"01",  // Denominacion SRI, hacer consulta API formapagosri_consulta
//                 "cajasid":1, // En donde se guarda el $, hacer consulta API cajas_consulta, defecto 1
//                 "bancosid":0, // En caso de deposito se guarda en bancos, API bancos_consulta, si es DEPOSITO o NOTA es OBLIGATORIO, default 0 si no hay
//                 "centros_costosid":1, // Distinguir origen de ventas, API centrocostos_consulta, defecto 1
//                 "almacenesid":1, // ID de almacen donde esta stock, Dejar 1
//                 "facturadoresid":1, // Usuario de Perseo para emitir factura, default 1
//                 "vendedoresid":3, // El mismo facturador
//                 "clientesid":4, // Cliente Perseo
//                 "clientes_sucursalesid":0, // Mandar 0 porque no hay
//                 "tarifasid":1, // Dejar 1
//                 "establecimiento":"001", // Columna se encuentra en Secuencias debe coincidir con secuenciasid
//                 "puntoemision":"001", // Columna se encuentra en Secuencias debe coincidir con secuenciasid
//                 "secuencial":"000000028", // No Factura en sistema Armario, si ya existe hace autoincremento
//                 "emision":"20190409",
//                 "vence":"20190409", // Igual a emisión
//                 "concepto":"Venta M\u00f3vil: 001-001-000000028 Con el Total de: 40",
//                 "subtotal":40, // total sin iva
//                 "total_descuento":0, // Si no hay mandar 0
//                 "subtotalconiva":0, // Solo productos que aplican iva
//                 "subtotalsiniva":0, // Solo productos que NO aplican iva
//                 "subtotalnoobjetoiva":0, // Solo productos que NO son objeto de iva
//                 "subtotalexentoiva":0, // Solo productos exentos de iva
//                 "subtotalneto":40, // Subtotal - descuento, si no hay descuento es subtotal
//                 "total_ice":0, // Dejar 0
//                 "total_iva":0, // Valor calculado
//                 "propina":0, // Dejar 0
//                 "total":40,
//                 "totalneto":40, // Total - retencion, dejar el total
//                 "totalretenidoiva":0, // Dejar 0
//                 "totalretenidorenta":0, // Dejar 0
//                 "puntoemisionretencion":"", // Dejar vacio
//                 "establecimientoretencion":"", // Dejar vacio
//                 "emisionretencion":"", // Dejar vacio
//                 "secuenciaretencion":"", // Dejar vacio
//                 "relacionsecuencia":"", // Dejar vacio
//                 "relacionestablecimiento":"", // Dejar vacio
//                 "relacionpuntoemision":"", // Dejar vacio
//                 "numeroautorizacion":"", // Dejar vacio
//                 "autorizacionfecha":"0000-00-00T00:00:00.000", // Dejar default
//                 "claveacceso":"",  // Dejar default
//                 "autorizacionintentos":0,   // Dejar default
//                 "de_enviado":false,  // Dejar default
//                 "mensajeerror":"",  // Dejar default
//                 "asientocontable":0,  // Dejar default
//                 "asientocosto":0,  // Dejar default
//                 "saldo":0,  // Dejar default
//                 "tipoplazo":0,  // Dejar default
//                 "plazo":0,  // Dejar default
//                 "plazodias":0,  // Dejar default
//                 "numeropagos":0,  // Dejar default
//                 "interes":0,  // Dejar default
//                 "valorcuota":0,  // Dejar default
//                 "totalacobrar":0,  // Dejar default
//                 "tipocredito":0,  // Dejar default
//                 "cambio":0,  // Dejar default
//                 "anulado":false,  // Dejar default
//                 "usuariocreacion":"IMOVIL",  // Dejar default
//                 "fechacreacion":"20190409174600"// Enviar fecha
//             },
//             "detalles":
//             [
//                 {
//                     "centros_costosid":1, // Default 1 porque es de la cabecera
//                     "almacenesid":1, // Mismo de cabecera
//                     "productosid":2, // ID de producto Perseo creado en productos_crear
//                     "descripcion":"Producto sin IVA",
//                     "medidasid":1, // Dejar 1
//                     "cantidaddigitada":1, // Unidades vendidas
//                     "cantidadfactor":1, // Dejar 1
//                     "cantidad":1, // cantidad * factor
//                     "precio":40, // Sin IVA
//                     "preciovisible":40, // Precio
//                     "precioiva":40, // Precio + IVA
//                     "descuento":0, // Dejar 0
//                     "costo":1.54, // Dejar 0
//                     "iva":2, // Poner 2 = ID de IVA
//                     "descuentovalor":0, // Dejar 0
//                     "servicio":true, // true
//                     "anulado":false, // dejar
//                     "entrega":false, // dejar
//                     "informaciondetalle":"", // dejar
//                     "informacion":""// dejar
//                 }
//             ],
//             "cuentaporcobrar": // Info de cancelación
//             [
//                 {
//                     "clientesid":4,
//                     "documentosid":1,
//                     "forma_pago_empresaid":0,
//                     "forma_pago_sri_codigo":"01",
//                     "cajasid":1,
//                     "bancosid":1,
//                     "tipo":"FC",
//                     "importe":40,
//                     "numerochequedeposito":"",
//                     "centros_costosid":1,
//                     "origen":"MOVIL",
//                     "emision":"20190409",
//                     "recepcion":"20190409",
//                     "vence":"20190409",
//                     "vendedoresid":3,
//                     "cobradoresid":3,
//                     "cobrosid":0,
//                     "relaciondocumentoid":0,
//                     "secuencial":"000000028",
//                     "capital":0,
//                     "interes":0,
//                     "concepto":"Venta M\u00f3vil: 001-001-000000028 con el total de: 40",
//                     "asientocontable":0,
//                     "reciboindividual":"",
//                     "reciboagrupado":"",
//                     "usuariocreacion":"IMOVIL",
//                     "fechacreacion":"20190409174600",
//                     "fechamodificacion":"0000-00-00T00:00:00.000"
//                 },
//                 {
//                     "clientesid":4,
//                     "documentosid":1,
//                     "forma_pago_empresaid":1,
//                     "forma_pago_sri_codigo":"01",
//                     "cajasid":1,
//                     "bancosid":0,
//                     "tipo":"AB",
//                     "importe":-40,
//                     "numerochequedeposito":"",
//                     "centros_costosid":1,
//                     "origen":"MOVIL",
//                     "emision":"20190409",
//                     "recepcion":"20190409",
//                     "vence":"20190409",
//                     "vendedoresid":3,
//                     "cobradoresid":3,
//                     "cobrosid":0,
//                     "relaciondocumentoid":0,
//                     "secuencial":"000000028",
//                     "capital":0,
//                     "interes":0,
//                     "concepto":"Venta M\u00f3vil: 001-001-000000028 con el total de: 40",
//                     "asientocontable":0,
//                     "reciboindividual":"",
//                     "reciboagrupado":"",
//                     "usuariocreacion":"IMOVIL",
//                     "fechacreacion":"20190409174600",
//                     "fechamodificacion":"0000-00-00T00:00:00.000"
//                 }
//             ],
//             "movimiento":
//             [
//                 {
//                     "forma_pago_empresaid":1,
//                     "documentosid":1,
//                     "centros_costosid":1,
//                     "bancoid":0,
//                     "cajasid":1,
//                     "documentoorigen":"000000028",
//                     "origen":"MOVIL",
//                     "importe":40,
//                     "tipo":"AB",
//                     "movimientos_conceptosid":1,
//                     "bancotarjetaid":0,
//                     "fechamovimiento":"20190409",
//                     "fechavence":"20190409",
//                     "concepto":"Venta M\u00f3vil: 001-001-000000028 con el total de: 40",
//                     "comprobante":"RC00000015",
//                     "numerochequevoucher":"RC00000015",
//                     "beneficiario":"ACOSTA CHIRIBOGA MARIA PAULINA",
//                     "usuariocreacion":"IMOVIL",
//                     "fechacreacion":"20190409174600",
//                     "usuariomodificacion":"IMOVIL",
//                     "fechamodificacion":"20190409174600"
//                 }
//             ]
//         }
//     ]
// }

// {
//     "productos":
//     [
//         {
//             "productos":
//             {
//                 "productosid":3, // Mandar ID interno
//                 "productocodigo":"P000000003", // Se genera si no se manda, OPCIONAL
//                 "descripcion":"Producto de prueba m\u00f3vil",
//                 "sri_codigo_impuestos":"312", // Dejar 312
//                 "barras":"3191200447898", // OPCIONAL
//                 "sri_tipos_ivas_codigo":"2", // Dejar 2
//                 "productos_lineasid": 1, // Dejar 1
//                 "productos_categoriasid": 1, // Dejar 1
//                 "productos_subcategoriasid":1, // Dejar 1
//                 "productos_subgruposid":1, // Dejar 1
//                 "estado":true, // Activo
//                 "venta":true, // En venta
//                 "existenciastotales":0, // Se puede mandar
//                 "controlnegativos":true, // Dejar
//                 "controlprecios":true, // Dejar
//                 "servicio":true, // Dejar
//                 "bien":false, // Dejar
//                 "series":false, // Dejar
//                 "vehiculos":false, // Dejar
//                 "cuentacontable_inventarios":"1.1.03.01.02", // Dejar
//                 "cuentacontable_ventas":"4.1.01.02", // Dejar
//                 "cuentacontable_costo":"5.1.01.01.02", // Dejar
//                 "fichatecnica":"", // Dejar
//                 "costoactual":0, // Costo
//                 "costoestandar":0, // Costo o 0
//                 "costoultimacompra":0, // Dejar 0
//                 "fechaultimacompra":"", // Dejar
//                 "observaciones":"", // Dejar
//                 "unidadinterna":1, // Dejar
//                 "unidadsuperior":0, // Dejar
//                 "unidadinferior":0, // Dejar
//                 "unidadcompra":1, // Dejar
//                 "unidadventa":1, // Dejar
//                 "proveedoresid_asignado":0, // Dejar
//                 "proveedoresid_ultimo":0, // Dejar
//                 "factorsuperior":0, // Dejar
//                 "factorinferior":0, // Dejar
//                 "subsidio":0, // Dejar
//                 "tonelaje":0, // Dejar
//                 "pasajeros":0, // Dejar
//                 "cilindraje":0, // Dejar
//                 "marca":"", // Dejar
//                 "modelo":"", // Dejar
//                 "origen":"", // Dejar
//                 "lado":"", // Dejar
//                 "medidas":"", // Dejar
//                 "materiaprima":false, // Dejar
//                 "fechacreacion":"20190319120049", // Fecha actual
//                 "usuariocreacion":"IMOVIL",
//                 "usuariomodificacion":"IMOVIL"
//             },
//             "tarifas":
//             [
//                 {
//                     "tarifasid":1,
//                     "medidasid":1,
//                     "medidas":"Unidad",
//                     "precioiva":0, // Precio + IVA
//                     "precio":0, // Precio sin IVA
//                     "margen":0, // Dejar 0
//                     "utilidad":0, // Dejar 0
//                     "descuento":0, // Dejar 0
//                     "factor":1, // Dejar 1
//                     "escala":0 // Deajr 0
//                 },
//             ]
//         }
//     ]
// }
