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
use JWeiland\Hfwupersonal\Domain\Model\Position;
use JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute;
use TYPO3\CMS\Extbase\Reflection\PropertyReflection;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Scheduler\ProgressProviderInterface;
use TYPO3\CMS\Scheduler\Task\AbstractTask;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Synchronize
 *
 * The synchronizing process needs round about 9-13 MB extra RAM. In total (with TYPO3): 29-34MB
 */
class Synchronize extends AbstractTask implements ProgressProviderInterface {

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
	 * @var \Jweiland\Hfwupersonal\Domain\Repository\InstituteRepository
	 */
	protected $instituteRepository = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager
	 */
	protected $backendConfigurationManager = NULL;

	/**
	 * @var \TYPO3\CMS\Core\Registry
	 */
	protected $registry = NULL;

	/**
	 * initialize neoRepository
	 *
	 * @return void
	 */
	public function initialize() {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->neoRepository = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Repository\\NeoRepository');
		$this->instituteRepository = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Repository\\InstituteRepository');
		$this->persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\PersistenceManagerInterface');
		$this->backendConfigurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\BackendConfigurationManager');
		if ($this->registry === NULL) {
			// maybe it was set by getProgress already
			$this->registry = $this->objectManager->get('TYPO3\\CMS\\Core\\Registry');
		}

		// tell our person repository where to find records
		// we have no PID here so we have to do that manually
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
		$querySettings->setStoragePageIds(array(0 => $this->pid));
		$this->personRepository = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Repository\\PersonRepository');
		$this->personRepository->setDefaultQuerySettings($querySettings);

		// following is really ugly. We don't have a TypoScript configuration to tell the script to use referenceIndex
		// so we have to inject our own little TypoScript configuration directly into the cache of the BackendConfigurationManager

		// set minimal configuration
		$configuration = array(
			'_' => array(
				'persistence' => array(
					'updateReferenceIndex' => '1',
					'classes' => array(
						'TYPO3\\CMS\\Extbase\\Domain\\Model\\FileReference' => array(
							'mapping' => array(
								'tableName' => 'sys_file_reference'
							)
						),
						'TYPO3\\CMS\\Extbase\\Domain\\Model\\File' => array(
							'mapping' => array(
								'tableName' => 'sys_file'
							)
						),
						'TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup' => array(
							'mapping' => array(
								'tableName' => 'fe_groups'
							)
						),
						'TYPO3\CMS\Extbase\Domain\Model\BackendUserGroup' => array(
							'mapping' => array(
								'tableName' => 'be_groups'
							)
						),
						'TYPO3\\CMS\\Extbase\\Domain\\Model\\Category' => array(
							'mapping' => array(
								'tableName' => 'sys_category'
							)
						)
					)
				)
			)
		);
		// transport our minimal configuration into configurationManager 1st-level Cache
		if (property_exists(get_class($this->backendConfigurationManager), 'configurationCache')) {
			$propertyReflection = new PropertyReflection(get_class($this->backendConfigurationManager), 'configurationCache');
			$propertyReflection->setAccessible(TRUE);
			$propertyReflection->setValue($this->backendConfigurationManager, $configuration);
		}
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
		$this->registry->removeAllByNamespace('hfwu');
		$this->registry->set('hfwu', 'totalUsers', 0);
		$this->synchronize();
		$this->registry->removeAllByNamespace('hfwu');

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
			$this->registry->set('hfwu', 'totalUsers', count($users));
			$counter = 1;
			/** @var \JWeiland\Hfwupersonal\Domain\Model\RestApi\User $user */
			foreach ($users as $user) {
				$this->registry->set('hfwu', 'processedUsers', $counter);
				$this->registry->set('hfwu', 'currentUserId', $user->getUserId());
				$person = $this->personRepository->findOneByStudIp($user->getUserId());
				if (empty($person)) {
					// add new person
					/** @var \Jweiland\Hfwupersonal\Domain\Model\Person $person */
					$person = $this->objectManager->get('Jweiland\\Hfwupersonal\\Domain\\Model\\Person');
					$person->setPid($this->pid);
					$person->setFirstName($user->getVorname());
					$person->setLastName($user->getNachname());
					$person->setEmail($user->getEmail());
					$person->setStudIp($user->getUserId());

					// add position
					$this->synchronizePosition($person);

					// save person to DB
					$this->personRepository->add($person);
				} else {
					// update person
					/** @var \Jweiland\Hfwupersonal\Domain\Model\Person $person */
					$person->setFirstName($user->getVorname());
					$person->setLastName($user->getNachname());
					$person->setEmail($user->getEmail());

					// add position
					$this->synchronizePosition($person);

					// save person to DB
					$this->personRepository->update($person);
				}
				$counter++;
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
		// we need a counter to generate a dynamic title like "Function 3"
		$counter = 1;
		$institutes = $this->getInstitutesByPerson($person);

		if ($person->getPositions()->count() === 0) {
			// insert new positions
			/** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $positions */
			$positions = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
			/** @var \JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute $institute */
			foreach ($institutes as $institute) {
				if (!$this->isValidInstitute($institute)) {
					continue;
				}
				/** @var \JWeiland\Hfwupersonal\Domain\Model\Position $position */
				$position = $this->objectManager->get('JWeiland\\Hfwupersonal\\Domain\\Model\\Position');
				$position->setPid($this->pid);
				$position->setTitle(LocalizationUtility::translate('tx_hfwupersonal_domain_model_position', 'Hfwupersonal') . ' ' . $counter);
				$position->setInstituteId($institute->getInstituteId());
				$position->setResponseTimes($institute->getConsultation());
				$position->setContacts($this->getContacts($institute));
				$positions->attach($position);
			}
			$person->setPositions($positions);
		} else {
			// update existing positions
			/** @var \JWeiland\Hfwupersonal\Domain\Model\Position $position */
			foreach ($person->getPositions() as $position) {
				/** @var \JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute $institute */
				foreach ($institutes as $institute) {
					if (!$this->isValidInstitute($institute)) {
						continue;
					}
					if ($position->getInstituteId() === $institute->getInstituteId()) {
						// we don't update the title!!!
						$position->setResponseTimes($institute->getConsultation());
						$this->synchronizeContacts($position, $institute);
					}
				}
			}
		}
	}

	/**
	 * synchronize contacts (UPDATE)
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Position $position
	 * @param \JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute $institute
	 * @return void
	 */
	protected function synchronizeContacts(Position $position, Institute $institute) {
		if ($position->getContacts()->count() === 0) {
			// create complete new contacts
			$position->setContacts($this->getContacts($institute));
		} else {
			/** @var \JWeiland\Hfwupersonal\Domain\Model\Contact $contact */
			foreach ($position->getContacts() as $contact) {
				if ($contact->getType() === 'telephone') {
					$telephone = $contact;
				}
				if ($contact->getType() === 'fax') {
					$fax = $contact;
				}
			}
			// if a phone is set in institute
			if (trim($institute->getPhone())) {
				// but person hs no telephone -> create a new contact
				if (empty($telephone)) {
					/** @var \JWeiland\Hfwupersonal\Domain\Model\Contact $contact */
					$contact = $this->objectManager->get('JWeiland\\Hfwupersonal\\Domain\\Model\\Contact');
					$contact->setPid($this->pid);
					$contact->setType('telephone');
					$contact->setContact($institute->getPhone());
					$position->getContacts()->attach($contact);
				} else {
					// update telephone number
					$telephone->setContact($institute->getPhone());
				}
			}
			// if a fax is set in institute
			if (trim($institute->getFax())) {
				// but person hs no fax -> create a new contact
				if (empty($fax)) {
					/** @var \JWeiland\Hfwupersonal\Domain\Model\Contact $contact */
					$contact = $this->objectManager->get('JWeiland\\Hfwupersonal\\Domain\\Model\\Contact');
					$contact->setPid($this->pid);
					$contact->setType('fax');
					$contact->setContact($institute->getFax());
					$position->getContacts()->attach($contact);
				} else {
					// update fax number
					$fax->setContact($institute->getFax());
				}
			}
		}
	}

	/**
	 * check, if we have a valid institute
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute $institute
	 * @return bool
	 */
	protected function isValidInstitute(Institute $institute) {
		$telephone = $institute->getPhone();
		$fax = $institute->getFax();
		$consultation = $institute->getConsultation();
		$room = $institute->getRoom();
		if (empty($telephone) && empty($fax) && empty($consultation) && empty($room)) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * check if user has valid userId
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $person
	 * @return bool
	 */
	protected function personHasValidUserId(Person $person) {
		$userId = $person->getStudIp();
		return !empty($userId);
	}

	/**
	 * Get institutes with help of RestApi defined in Repository
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $person
	 * @return array
	 */
	protected function getInstitutesByPerson(Person $person) {
		$institutes = array();
		if ($this->personHasValidUserId($person)) {
			$institutes = $this->instituteRepository->findByUserId($person->getStudIp());
			if (empty($institutes)) {
				$institutes = array();
			}
		}
		return $institutes;
	}

	/**
	 * create new contact object for new persons
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\RestApi\Institute $institute
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	protected function getContacts(Institute $institute) {
		/** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts */
		$contacts = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');
		if (trim($institute->getPhone())) {
			/** @var \JWeiland\Hfwupersonal\Domain\Model\Contact $contact */
			$contact = $this->objectManager->get('JWeiland\\Hfwupersonal\\Domain\\Model\\Contact');
			$contact->setPid($this->pid);
			$contact->setType('telephone');
			$contact->setContact($institute->getPhone());
			$contacts->attach($contact);
		}
		if (trim($institute->getFax())) {
			/** @var \JWeiland\Hfwupersonal\Domain\Model\Contact $contact */
			$contact = $this->objectManager->get('JWeiland\\Hfwupersonal\\Domain\\Model\\Contact');
			$contact->setPid($this->pid);
			$contact->setType('fax');
			$contact->setContact($institute->getFax());
			$contacts->attach($contact);
		}
		return $contacts;
	}

	/**
	 * This method is designed to return some additional information about the task,
	 * that may help to set it apart from other tasks from the same class
	 * This additional information is used - for example - in the Scheduler's BE module
	 * This method should be implemented in most task classes
	 *
	 * @return string Information to display
	 */
	public function getAdditionalInformation() {
		if ($this->registry === NULL) {
			// maybe it was set by initialize already
			$this->registry = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Registry');
		}
		$userId = $this->registry->get('hfwu', 'currentUserId', '');
		if (empty($userId)) {
			return '';
		} else {
			return 'Just syncing User-Id: ' . $userId;
		}
	}

	/**
	 * Gets the progress of a task.
	 *
	 * @return float Progress of the task as a two decimal precision float. f.e. 44.87
	 */
	public function getProgress() {
		if ($this->registry === NULL) {
			// maybe it was set by initialize already
			$this->registry = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Registry');
		}
		$totalUsers = $this->registry->get('hfwu', 'totalUsers');
		if (empty($totalUsers)) {
			return 0.00;
		} else {
			$processedUsers = $this->registry->get('hfwu', 'processedUsers');
			return round(100 / $totalUsers * $processedUsers, 2);
		}
	}

}