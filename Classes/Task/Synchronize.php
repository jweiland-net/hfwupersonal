<?php
namespace JWeiland\Hfwupersonal\Task;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Stefan Froemken <sfroemken@jweiland.net>, jweiland.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use JWeiland\Hfwupersonal\Domain\Model\Person;
use TYPO3\CMS\Scheduler\Task\AbstractTask;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Synchronize
 *
 * The synchronizing process needs round about 9-13 MB extra RAM. In total (with TYPO3): 29-34MB
 */
class Synchronize extends AbstractTask {

	/**
	 * This pid will be set by AdditionalFieldProvider
	 *
	 * @var int
	 */
	public $pid = 0;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var \Jweiland\Hfwupersonal\Domain\Repository\NeoRepository
	 */
	protected $neoRepository = NULL;

	/**
	 * @var \Jweiland\Hfwupersonal\Domain\Repository\PersonRepository
	 */
	protected $personRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager = NULL;

	/**
	 * initialize neoRepository
	 *
	 * @return void
	 */
	public function initialize() {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->neoRepository = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Repository\\NeoRepository');
		$this->personRepository = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Repository\\PersonRepository');
		$this->persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\PersistenceManagerInterface');
	}

	/**
	 * This is the main method that is called when a task is executed
	 * It MUST be implemented by all classes inheriting from this one
	 * Note that there is no error handling, errors and failures are expected
	 * to be handled and logged by the client implementations.
	 * Should return TRUE on successful execution, FALSE on error.
	 *
	 * @return boolean Returns TRUE on successful execution, FALSE on error
	 */
	public function execute() {
		$this->initialize();
		$this->synchronize();

		return TRUE;
	}

	/**
	 * synchronize data
	 *
	 * @return void
	 */
	protected function synchronize() {
		$users = $this->neoRepository->findAll();
		if (!empty($users)) {
			/** @var \JWeiland\Hfwupersonal\Domain\Model\RestApi\User $user */
			foreach ($users as $user) {
				$person = $this->personRepository->findByStudIp($user->getUserId());
				if (!$person instanceof Person) {
					// add new person
					/** @var \Jweiland\Hfwupersonal\Domain\Model\Person $person */
					$person = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Model\\Person');
					$person->setPid($this->pid);
					$person->setFirstName($user->getVorname());
					$person->setLastName($user->getNachname());
					$person->setEmail($user->getEmail());
					$person->setStudIp($user->getUserId());
					$this->personRepository->add($person);
				} else {
					// update person
					$person->setPid($this->pid);
					$person->setFirstName($user->getVorname());
					$person->setLastName($user->getNachname());
					$person->setEmail($user->getEmail());
					$this->personRepository->update($person);
				}
			}
			$this->persistenceManager->persistAll();
		}
	}

	/**
	 * synchronize position of person
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $person
	 * @return void
	 */
	protected function synchronizePosition(Person $person) {
		$person->getPositions()->count();
	}

}