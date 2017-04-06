<?php
namespace Flowpack\SingleSignOn\DemoInstance\Controller;

/*                                                                                         *
 * This script belongs to the Flow Framework package "Flowpack.SingleSignOn.DemoInstance". *
 *                                                                                         */

use Neos\Flow\Annotations as Flow;

/**
 * Standard controller for the SSO DemoInstance package
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends \Neos\Flow\Mvc\Controller\ActionController {

	/**
	 * Index action (unprotected)
	 *
	 * @return void
	 */
	public function indexAction() {

	}

	/**
	 * Secure action (protected)
	 *
	 * @return void
	 * @Flow\SkipCsrfProtection
	 */
	public function secureAction() {

	}

}

