<?php
namespace Flowpack\SingleSignOn\DemoInstance\Command;

/*                                                                                         *
 * This script belongs to the Flow Framework package "Flowpack.SingleSignOn.DemoInstance". *
 *                                                                                         */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Utility\Files;

/**
 * Command controller for setting up a demo instance
 *
 * @Flow\Scope("singleton")
 */
class DemoCommandController extends CommandController {

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Security\Cryptography\RsaWalletServiceInterface
	 */
	protected $rsaWalletService;

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Configuration\Source\YamlSource
	 */
	protected $yamlSource;

	/**
	 * Set up the SSO demo instance
	 *
	 * This commands sets a up a single sign-on demo instance with some initial
	 * fixture data. It overwrites existing data in the database.
	 *
	 * ONLY FOR DEMO PURPOSES - DO NOT USE IN PRODUCTION!
	 */
	public function setupCommand() {
		$serverPublicKeyString = Files::getFileContents('resource://Flowpack.SingleSignOn.DemoInstance/Private/Fixtures/DemoServer.pub', FILE_TEXT);
		if ($serverPublicKeyString === FALSE) {
			$this->outputLine('Could not open resource://Flowpack.SingleSignOn.DemoInstance/Private/Fixtures/DemoServer.pub, exiting.');
			$this->quit(1);
		}

		$serverPublicKeyFingerprint = $this->rsaWalletService->registerPublicKeyFromString($serverPublicKeyString);
		$this->outputLine('Registered sso demo server public key');

		$clientPrivateKeyString = Files::getFileContents('resource://Flowpack.SingleSignOn.DemoInstance/Private/Fixtures/DemoClient.key', FILE_TEXT);
		if ($clientPrivateKeyString === FALSE) {
			$this->outputLine('Could not open resource://Flowpack.SingleSignOn.DemoInstance/Private/Fixtures/DemoClient.key, exiting.');
			$this->quit(2);
		}

		$clientPublicKeyFingerprint = $this->rsaWalletService->registerKeyPairFromPrivateKeyString($clientPrivateKeyString);
		$this->outputLine('Registered demo client key pair');

		$globalSettings = $this->yamlSource->load(FLOW_PATH_CONFIGURATION . '/Settings');
		$globalSettings['Flowpack']['SingleSignOn']['Client']['client']['publicKeyFingerprint'] = $clientPublicKeyFingerprint;
		$globalSettings['Flowpack']['SingleSignOn']['Client']['server']['DemoServer']['publicKeyFingerprint'] = $serverPublicKeyFingerprint;
		$this->yamlSource->save(FLOW_PATH_CONFIGURATION . '/Settings', $globalSettings);
		$this->outputLine('Updated settings');
	}


}
