<?php
namespace JWeiland\Hfwupersonal\Configuration;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Stefan Froemken <projects@jweiland.net>, jweiland.net
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

/**
 * @package hfwupersonal
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class ExtConf implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * root category for filter
	 *
	 * @var int
	 */
	protected $rootCategoryForFilter;

	/**
	 * constructor of this class
	 * This method reads the global configuration and calls the setter methods
	 */
	public function __construct() {
		// get global configuration
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hfwupersonal']);
		if (is_array($extConf) && count($extConf)) {
			// call setter method foreach configuration entry
			foreach($extConf as $key => $value) {
				$methodName = 'set' . ucfirst($key);
				if (method_exists($this, $methodName)) {
					$this->$methodName($value);
				}
			}
		}
	}

	/**
	 * getter for root category
	 *
	 * @return int
	 */
	public function getRootCategoryForFilter() {
		if (empty($this->rootCategoryForFilter)) {
			return 0;
		} else {
			return $this->rootCategoryForFilter;
		}
	}

	/**
	 * setter for root category
	 *
	 * @param int $rootCategoryForFilter
	 * @return void
	 */
	public function setRootCategoryForFilter($rootCategoryForFilter) {
		$this->rootCategoryForFilter = (int)$rootCategoryForFilter;
	}

}