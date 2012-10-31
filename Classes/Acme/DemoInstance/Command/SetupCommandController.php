<?php
namespace Acme\DemoInstance\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Acme.DemoInstance".     *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Setup command controller
 *
 * @Flow\Scope("singleton")
 */
class SetupCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Cryptography\RsaWalletServiceInterface
	 */
	protected $rsaWalletService;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Configuration\Source\YamlSource
	 */
	protected $yamlSource;

	/**
	 * Sets up a demo instance installation with fixture data
	 *
	 * DO NOT USE IT FOR PRODUCTION!
	 */
	public function setupCommand() {
		$serverPublicKeyString = \TYPO3\Flow\Utility\Files::getFileContents('resource://Acme.DemoInstance/Private/Fixtures/DemoServer.pub', FILE_TEXT);
		if ($serverPublicKeyString === FALSE) {
			$this->outputLine('Could not open DemoServer.pub, aborting.');
			return;
		}
		$serverPublicKeyUuid = $this->rsaWalletService->registerPublicKeyFromString($serverPublicKeyString);
		$this->outputLine('Registered demo server public key');

		$clientPrivateKeyString = \TYPO3\Flow\Utility\Files::getFileContents('resource://Acme.DemoInstance/Private/Fixtures/DemoClient.key', FILE_TEXT);
		if ($clientPrivateKeyString === FALSE) {
			$this->outputLine('Could not open DemoClient.key, aborting.');
			return;
		}
		$clientKeyPairUuid = $this->rsaWalletService->registerKeyPairFromPrivateKeyString($clientPrivateKeyString);
		$this->outputLine('Registered demo client key pair');

		$globalSettings = $this->yamlSource->load(FLOW_PATH_CONFIGURATION . '/Settings');
		$globalSettings['TYPO3']['SingleSignOn']['Client']['client']['identifier'] = 'demoinstance';
		$globalSettings['TYPO3']['SingleSignOn']['Client']['client']['keyPairUuid'] = $clientKeyPairUuid;
		$globalSettings['TYPO3']['SingleSignOn']['Client']['server']['DemoServer']['publicKeyUuid'] = $serverPublicKeyUuid;
		$this->yamlSource->save(FLOW_PATH_CONFIGURATION . '/Settings', $globalSettings);
		$this->outputLine('Updated settings');
	}

}
?>