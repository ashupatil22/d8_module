<?php

namespace Drupal\test;

use Drupal\Core\State;

class TestWrapper {
	private $state;
	public function __construct(state $state) {
		$this->state = $state;
	}
}
