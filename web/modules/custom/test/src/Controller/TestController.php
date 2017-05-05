<?php

namespace Drupal\test\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TestController implements ContainerInjectionInterface {
	private $account;
	public function __construct(AccountProxy $account) {
		$this->account = $account;
	}
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
		// $account = \Drupal::service ( 'current_user' );
		if ($node->getOwnerId () === $this->account->id ()) {
			return AccessResult::allowed ();
		} else {
			return AccessResult::forbidden ();
		}
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'current_user' ) );
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