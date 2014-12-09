<?php
namespace JWeiland\Hfwupersonal\Ajax\SearchPersons;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stefan Froemken <projects@jweiland.net>, jweiland.net
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
use JWeiland\Events2\Ajax\AbstractAjaxRequest;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Core\Bootstrap;

/**
 * @package hfwupersonal
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Ajax extends AbstractAjaxRequest {

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;

	/**
	 * initialize this object with help of ObjectManager
	 *
	 * @return void
	 */
	public function initializeObject() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];
	}

	/**
	 * getter for database connection
	 * Needed for UnitTests
	 *
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	public function getDatabaseConnection() {
		return $this->databaseConnection;
	}

	/**
	 * process ajax request
	 *
	 * @param array $arguments Arguments to process
	 * @return string
	 */
	public function processAjaxRequest(array $arguments) {
		// cast arguments
		$search = (string)trim(htmlspecialchars(strip_tags($arguments['search'])));
		if (!empty($search)) {
			$persons = $this->findPersons($search);
			return json_encode($persons);
		} else {
			return json_encode('');
		}
	}

	/**
	 * find persons by search
	 *
	 * @param string $search
	 * @return array
	 */
	protected function findPersons($search) {
		if (strlen($search) > 0 && strlen($search) <= 2) {
			$persons = $this->databaseConnection->exec_SELECTgetRows(
				'uid, first_name, last_name',
				'tx_hfwupersonal_domain_model_person',
				'first_name LIKE "' . $this->databaseConnection->escapeStrForLike($search, 'tx_hfwupersonal_domain_model_person') . '%"' .
				' OR last_name LIKE "' . $this->databaseConnection->escapeStrForLike($search, 'tx_hfwupersonal_domain_model_person') . '%"' .
				BackendUtility::BEenableFields('tx_hfwupersonal_domain_model_person') .
				BackendUtility::deleteClause('tx_hfwupersonal_domain_model_person'),
				'', 'last_name, first_name', ''
			);
		} elseif (strlen($search) > 2) {
			$persons = $this->databaseConnection->exec_SELECTgetRows(
				'uid, first_name, last_name',
				'tx_hfwupersonal_domain_model_person',
				'first_name LIKE "%' . $this->databaseConnection->escapeStrForLike($search, 'tx_hfwupersonal_domain_model_person') . '%"' .
				' OR last_name LIKE "%' . $this->databaseConnection->escapeStrForLike($search, 'tx_hfwupersonal_domain_model_person') . '%"' .
				BackendUtility::BEenableFields('tx_hfwupersonal_domain_model_person') .
				BackendUtility::deleteClause('tx_hfwupersonal_domain_model_person'),
				'', 'last_name, first_name', ''
			);
		} else {
			$persons = array();
		}
		return $persons;
	}

}