<?php

namespace Drupal\test\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;

class NodeCreatorCheck implements AccessInterface {
	private $account;
	public function __construct(AccountProxy $account) {
		$this->account = $account;
	}
	public function access(NodeInterface $node) {
		if ($node->getOwnerId () === $this->account->id ()) {
			return AccessResult::allowed ();
		} else {
			return AccessResult::forbidden ();
		}
	}
}