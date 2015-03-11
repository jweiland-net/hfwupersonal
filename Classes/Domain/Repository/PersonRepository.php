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
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;

/**
 * The repository for Persons
 */
class PersonRepository extends Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'priority.priority' => QueryInterface::ORDER_ASCENDING,
		'lastName' => QueryInterface::ORDER_ASCENDING,
		'firstName' => QueryInterface::ORDER_ASCENDING
	);

	/**
	 * find persons by filter settings (FlexForm)
	 *
	 * @param string $filterAnd
	 * @param string $filterOr
	 * @param string $filterNot
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
	 */
	public function findByFilters($filterAnd, $filterOr, $filterNot) {
		if (empty($filterAnd) && empty($filterOr) && empty($filterNot)) {
			return $this->findAll();
		}

		$query = $this->createQuery();
		$constraint = array();
		$constraintAnd = array();
		$constraintOr = array();
		$constraintNot = array();

		// add $filterAnd
		if (!empty($filterAnd)) {
			$filterAnd = ArrayUtility::integerExplode(',', $filterAnd);
			foreach ($filterAnd as $filter) {
				$constraintAnd[] = $query->contains('categories', $filter);
			}
		}

		// add $filterOr
		if (!empty($filterOr)) {
			$filterOr = ArrayUtility::integerExplode(',', $filterOr);
			foreach ($filterOr as $filter) {
				$constraintOr[] = $query->contains('categories', $filter);
			}
		}

		// add $filterNot
		if (!empty($filterNot)) {
			$filterNot = ArrayUtility::integerExplode(',', $filterNot);
			foreach ($filterNot as $filter) {
				/** @var \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface $logicalNot */
				$logicalNot = $query->contains('categories', $filter);
				$constraintNot[] = $query->logicalNot($logicalNot);
			}
		}

		// add AND constraints
		if (!empty($constraintAnd)) {
			$constraint[] = $query->logicalAnd($constraintAnd);
		}

		// add OR constraints
		if (!empty($constraintOr)) {
			$constraint[] = $query->logicalOr($constraintOr);
		}

		// add NOT constraints
		if (!empty($constraintNot)) {
			$constraint[] = $query->logicalAnd($constraintNot);
		}

		return $query->matching($query->logicalAnd($constraint))->execute();
	}

	/**
	 * find by search
	 *
	 * @param string $search
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
	 */
	public function findBySearch($search) {
		$query = $this->createQuery();
		if (strlen($search) > 0 && strlen($search) <= 2) {
			$search = $search . '%';
		} else {
			$search = '%' . $search . '%';
		}
		$constraint = array();
		// ToDo: add escapeForLike
		$constraint[] = $query->like('firstName', $search);
		$constraint[] = $query->like('lastName', $search);
		$constraint[] = $query->like('email', $search);
		return $query->matching($query->logicalOr($constraint))->execute();
	}

}