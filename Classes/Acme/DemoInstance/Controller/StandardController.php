<?php
namespace Acme\DemoInstance\Controller;

/*                                                                        *
 * This script belongs to the Flow package "MyCompany.SingleSignOnDemo". *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Standard controller for the SSO DemoInstance package
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

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
		$account = $this->securityContext->getAccount();
		$this->view->assign('account', $account);

	}

}

?>