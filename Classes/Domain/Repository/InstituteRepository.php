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
class InstituteRepository {

	/**
	 * @var string
	 */
	protected $restApiUrl = 'https://neotowebseite:s8e25o@neotest.hfwu.de/plugins.php/restipplugin/api/user/|/institutes';

	/**
	 * Contains all institutes
	 *
	 * @var array
	 */
	protected $cachedInstitutes = array();

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
	 * find all users
	 *
	 * @param string $userId
	 * @return array
	 */
	public function findByUserId($userId) {
		$url = str_replace('|', $userId, $this->restApiUrl);
		$database = json_decode(GeneralUtility::getUrl($url));
		$institutes = array();
		if ($database instanceof \stdClass) {
			// in normal cases only work OR study should be filled
			// add work institutes
			$this->addInstitutes($database->institutes->work, $institutes);
			// add study institutes
			$this->addInstitutes($database->institutes->study, $institutes);
		}
		return $institutes;
	}

	/**
	 * add multiple institutes to global array
	 *
	 * @param array $requestedInstitutes
	 * @param array $userInstitutes
	 * @return void
	 */
	protected function addInstitutes(array $requestedInstitutes, array &$userInstitutes) {
		if (!empty($requestedInstitutes)) {
			foreach ($requestedInstitutes as $institute) {
				if (!array_key_exists($institute->institute_id, $this->cachedInstitutes)) {
					$this->cachedInstitutes[$institute->institute_id] = $this->dataMapUtility->mapSingleRow('JWeiland\\Hfwupersonal\\Domain\\Model\\RestApi\\Institute', $institute);
				}
				$userInstitutes[$institute->institute_id] = $this->cachedInstitutes[$institute->institute_id];
			}
		}
	}

}