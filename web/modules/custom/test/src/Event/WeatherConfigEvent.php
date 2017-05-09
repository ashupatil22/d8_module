<?php

namespace Drupal\test\Event;

use Symfony\Component\EventDispatcher\Event;

class WeatherConfigEvent extends Event {
	const WEATHER_CONFIG_UPDATE = 'weather.config.update';
	protected $appid;
	public function __construct($appid) {
		$this->appid = $appid;
	}
	public function getAppid() {
		return $this->appid;
	}
}