<?php

namespace Drupal\test;

use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

class WeatherReport {
	public function __construct(ConfigFactory $config, Client $client) {
		$this->configFactory = $config;
		$this->client = $client;
	}
	public function dummy() {
		kint ( $this->configFactory );
		kint ( $this->client );
	}
	public function getGuzzle() {
		$res = $this->client->request ( 'GET', 'http://api.openweathermap.org/data/2.5/weather?q=London,uk&APPID=c523aeb6fd4360f211a9e50dd169a5e7' );
		$body = $res->getBody ();
		$body = $body->getContents ();
		return $body;
	}
	public function pullData($cityname) {
		$appID = $this->configFactory->get ( 'test.test_weather_config' )->get ( 'appid' );
		// kint ( $appID );
		$res = $this->client->get ( 'http://api.openweathermap.org/data/2.5/weather', [
				'query' => [
						'q' => $cityname,
						'appid' => $appID
				]
		] );
		// q=London,uk&APPID=c523aeb6fd4360f211a9e50dd169a5e7
		return Json::decode ( $res->getBody ()->getContents () );
	}
}