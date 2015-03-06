<?php
namespace JWeiland\Hfwupersonal\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Stefan Froemken <sfroemken@jweiland.net>, jweiland.net
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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The repository for Persons
 */
class NeoRepository {

	/**
	 * @var string
	 */
	protected $restApiUrl = 'https://neotowebseite:s8e25o@neo.hfwu.de/plugins.php/restipplugin/api/getallusers?onlyEmployee=1';
	//protected $restApiUrl = 'https://neotowebseite:s8e25o@neotest.hfwu.de/plugins.php/restipplugin/api/getallusers?userslike=beck';

	/**
	 * @var array
	 */
	protected $users = array();

	/**
	 * @var \JWeiland\Hfwupersonal\Utility\DataMapUtility
	 */
	protected $dataMapUtility = NULL;

	/**
	 * inject dataMapUtility
	 *
	 * @param \JWeiland\Hfwupersonal\Utility\DataMapUtility $dataMapUtility
	 * @return void
	 */
	public function injectDataMapUtility(\JWeiland\Hfwupersonal\Utility\DataMapUtility $dataMapUtility) {
		$this->dataMapUtility = $dataMapUtility;
	}

	/**
	 * fill users array with data from RestApi
	 *
	 * @return void
	 */
	public function initializeObject() {
		$database = json_decode(GeneralUtility::getUrl($this->restApiUrl));
		if ($database instanceof \stdClass) {
			if (!empty($database->users)) {
				$users = array();
				foreach ($database->users as $user) {
					$users[$user->user_id] = $this->dataMapUtility->mapSingleRow('JWeiland\\Hfwupersonal\\Domain\\Model\\RestApi\\User', $user);
				}
				$this->users = $users;
			}
		}
		unset($database);
	}

	/**
	 * find all users
	 *
	 * @return array
	 */
	public function findAll() {
		return $this->users;
	}

	/**
	 * Find user by identifier
	 *
	 * @param string $identifier
	 * @return \stdClass|NULL
	 */
	public function findByIdentifier($identifier) {
		if (array_key_exists($identifier, $this->users)) {
			return $this->users[$identifier];
		} else {
			return NULL;
		}
	}

}