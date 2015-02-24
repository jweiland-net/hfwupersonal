<?php
namespace JWeiland\Hfwupersonal\Hooks;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Froemken <projects@jweiland.net>, jweiland.net
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
 * @package hfwupersonal
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ModifyTcaOfCategoryTrees {

	/**
	 * @var \JWeiland\Hfwupersonal\Configuration\ExtConf
	 */
	protected $extConf;

	/**
	 * inject extConf
	 * It will not be auto-loaded as in extbase, but it is good to have this method for testing
	 *
	 * @param \JWeiland\Hfwupersonal\Configuration\ExtConf $extConf
	 * @return void
	 */
	public function injectExtConf(\JWeiland\Hfwupersonal\Configuration\ExtConf $extConf) {
		$this->extConf = $extConf;
	}

	/**
	 * constructor of this class
	 */
	public function __construct() {
		$this->extConf = GeneralUtility::makeInstance('JWeiland\\Hfwupersonal\\Configuration\\ExtConf');
	}

	/**
	 * change rootUid to a root category defined in EXT_CONF
	 *
	 * @param string $table
	 * @param string $field
	 * @param array $row
	 * @param array $PA
	 * @return void
	 */
	public function getSingleField_beforeRender($table, $field, $row, &$PA) {
		// check if a FlexForm was rendered
		if ($table === 'tt_content' && $field === 'pi_flexform' && GeneralUtility::isFirstPartOfStr($row['list_type'], 'hfwupersonal')) {
			// check, if TCA configuration exists
			if (isset($PA['fieldConf']) && is_array($PA['fieldConf']) && isset($PA['fieldConf']['config']) && is_array($PA['fieldConf']['config'])) {
				// check, if we have TCA-type "select" defined and it is configured as "tree"
				if (isset($PA['fieldConf']['config']['type']) && $PA['fieldConf']['config']['type'] === 'select' && isset($PA['fieldConf']['config']['foreign_table']) && $PA['fieldConf']['config']['foreign_table'] === 'sys_category') {
					$PA['fieldConf']['config']['foreign_table_where'] = 'AND parent=' . (int)$this->extConf->getRootCategoryForFilter();
				}
			}
		}
	}

}