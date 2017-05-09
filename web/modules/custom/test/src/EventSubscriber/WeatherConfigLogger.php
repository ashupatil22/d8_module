<?php

namespace Drupal\test\EventSubscriber;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \Drupal\test\Event\WeatherConfigEvent;
use Drupal\Core\Logger\LoggerChannelFactory;

class WeatherConfigLogger implements EventSubscriberInterface {
	protected $logger;
	public function __construct(LoggerChannelFactory $logger) {
		$this->logger = $logger;
	}

	/**
	 * Returns an array of event names this subscriber wants to listen to.
	 *
	 * The array keys are event names and the value can be:
	 *
	 * * The method name to call (priority defaults to 0)
	 * * An array composed of the method name to call and the priority
	 * * An array of arrays composed of the method names to call and respective
	 * priorities, or 0 if unset
	 *
	 * For instance:
	 *
	 * * array('eventName' => 'methodName')
	 * * array('eventName' => array('methodName', $priority))
	 * * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
	 *
	 * @return array The event names to listen to
	 */
	public static function getSubscribedEvents() {
		$events [WeatherConfigEvent::WEATHER_CONFIG_UPDATE] [] = array (
				'onWeatherConfigUpdate'
		);

		return $events;
	}
	public function onWeatherConfigUpdate(WeatherConfigEvent $event) {
		$this->logger->get ( 'test' )->info ( 'It has saved: ' . $event->getAppid () );
	}
}