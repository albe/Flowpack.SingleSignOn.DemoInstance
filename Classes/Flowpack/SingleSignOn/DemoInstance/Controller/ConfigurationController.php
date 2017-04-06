<?php
namespace Flowpack\SingleSignOn\DemoInstance\Controller;

/*                                                                                         *
 * This script belongs to the Flow Framework package "Flowpack.SingleSignOn.DemoInstance". *
 *                                                                                         */

use Neos\Flow\Annotations as Flow;

/**
 * SSO server configuration controller
 *
 * @Flow\Scope("singleton")
 */
class ConfigurationController extends \Neos\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\SingleSignOn\Client\Domain\Repository\SsoServerRepository
	 */
	protected $ssoClientRepository;

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Configuration\ConfigurationManager
	 */
	protected $configurationManager;

	/**
	 * Display configuration of client
	 */
	public function indexAction() {
		$clientSettings = $this->configurationManager->getConfiguration(\Neos\Flow\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Flowpack.SingleSignOn.Client');
		$clientSettingsYaml = \Symfony\Component\Yaml\Yaml::dump($clientSettings, 99, 2);
		$this->view->assign('clientSettings', $clientSettingsYaml);

		$authenticationSettings = $this->configurationManager->getConfiguration(\Neos\Flow\Configuration\ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Neos.Flow.security.authentication');
		$authenticationSettingsYaml = \Symfony\Component\Yaml\Yaml::dump($authenticationSettings, 99, 2);
		$this->view->assign('authenticationSettings', $authenticationSettingsYaml);
	}

}

