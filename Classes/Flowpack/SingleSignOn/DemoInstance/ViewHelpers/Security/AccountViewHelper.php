<?php
namespace Flowpack\SingleSignOn\DemoInstance\ViewHelpers\Security;

/*                                                                                         *
 * This script belongs to the Flow Framework package "Flowpack.SingleSignOn.DemoInstance". *
 *                                                                                         */

use Neos\Flow\Annotations as Flow;

/**
 * Security account view helper
 */
class AccountViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Security\Context
	 */
	protected $securityContext;

	protected $escapeOutput = FALSE;

	/**
	 * Assign the authenticated account to a template variable
	 *
	 * @param string $as Variable name for the account
	 * @return mixed
	 */
	public function render($as) {
		$this->templateVariableContainer->add($as, $this->securityContext->getAccount());
		$result = $this->renderChildren();
		$this->templateVariableContainer->remove($as);
		return $result;
	}

}

