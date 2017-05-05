<?php

namespace Drupal\test\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;

class TestController {
	public function staticContent() {
		return [

				'#theme' => 'item_list',
				'#items' => [
						'abc',
						'acv'
				]
		];
	}
	public function dynamicContent($arg) {
		if ($arg) {
			return [
					'#markup' => 'Argument is :' . $arg
			];
		}
	}
	public function upcastedContent(NodeInterface $node) {
		// print_r();
		if ($node) {
			return [
					'#markup' => 'Node is :' . $node->getTitle ()
			];
		}
	}
	public function nodeCreatorCheck(NodeInterface $node) {
		$account = \Drupal::service ( 'current_user' );
		if ($node->getOwnerId () === $account->id ()) {
			return AccessResult::allowed ();
		} else {
			return AccessResult::forbidden ();
		}
	}

	/*
	 * public function upcastedContent(NodeInterface $arg1, NodeInterface $arg2) {
	 * // print_r();
	 * return [
	 * '#theme' => 'item_list',
	 * '#items' => [
	 * 'Arg1 ' . $arg1->getTitle (),
	 * 'Arg2 ' . $arg2->getTitle ()
	 * ]
	 * ];
	 * }
	 */
}