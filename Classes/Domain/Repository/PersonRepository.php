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
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The repository for Persons
 */
class PersonRepository extends Repository {

	/**
	 * filter persons by given categories from FlexForm
	 *
	 * @param string $categories
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
	 */
	public function findByCategories($categories) {
		$query = $this->createQuery();
		$categories = GeneralUtility::trimExplode(',', $categories, TRUE);
		$constraint = array();
		foreach ($categories as $category) {
			$constraint[] = $query->contains('categories', $category);
		}
		if (empty($constraint)) {
			// ToDo: log this condition, because this will normally not executed
			return $query->execute();
		} else {
			return $query->matching($query->logicalOr($constraint))->execute();
		}
	}

}