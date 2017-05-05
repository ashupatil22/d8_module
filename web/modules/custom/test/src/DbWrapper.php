<?php

namespace Drupal\test;

use Drupal\Core\Database\Connection;

class DbWrapper {
	public function __construct(Connection $connection) {
		$this->connection = $connection;
	}
	public function getData() {
		$res = $this->connection->select ( 'dic_data', 'n' )->fields ( 'n' )->orderBy ( 'id', 'DESC' )->range ( 0, 1 )->execute ();
		return $res->fetchAssoc ();
	}
	public function setData($fname, $lname) {
		$res = $this->connection->insert ( 'dic_data' )->fields ( array (
				'fname' => $fname,
				'lname' => $lname
		) )->execute ();
	}
}