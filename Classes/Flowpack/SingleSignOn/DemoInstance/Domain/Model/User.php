<?php
namespace Flowpack\SingleSignOn\DemoInstance\Domain\Model;

/*                                                                                         *
 * This script belongs to the Flow Framework package "Flowpack.SingleSignOn.DemoInstance". *
 *                                                                                         */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * User domain model (transient)
 *
 * @Flow\Entity
 */
class User extends \TYPO3\Party\Domain\Model\AbstractParty {

	/**
	 * The username of the user
	 *
	 * @var string
	 */
	protected $username;

	/**
	 * @var string
	 */
	protected $firstname = '';

	/**
	 * @var string
	 */
	protected $lastname = '';

	/**
	 * @var string
	 */
	protected $company = '';

	/**
	 * @var string
	 */
	protected $role = '';

	/**
	 * @return string
	 */
	public function getFullname() {
		return $this->firstname . ' ' . $this->lastname;
	}

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @param string $company
	 */
	public function setCompany($company) {
		$this->company = $company;
	}

	/**
	 * @return string
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @param string $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @param string $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @param string $role
	 */
	public function setRole($role) {
		$this->role = $role;
	}

	/**
	 * @return string
	 */
	public function getRole() {
		return $this->role;
	}

}

