<?php
namespace MyCompany\SingleSignOnDemo\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "MyCompany.SingleSignOnDemo". *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Standard controller for the MyCompany.SingleSignOnDemo package
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

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
	 */
	public function secureAction() {

	}

}

?>