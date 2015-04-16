<?php
namespace JWeiland\Hfwupersonal\ViewHelpers;

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
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;

/**
 * @author Stefan Froemken <projects@jweiland.net>
 */
class SortViewHelper extends AbstractViewHelper {

	/**
	 * Initialize arguments
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerArgument('subject', 'QueryResultInterface', 'The QueryResult object to sort', FALSE, NULL);
		$this->registerArgument('sortBy', 'string', 'Which property to sort by', TRUE);
		$this->registerArgument('direction', 'string', 'ASC or DESC', FALSE, 'ASC');
	}

	/**
	 * "Render" method - sorts a target list-type target. Either $array or
	 * $objectStorage must be specified. If both are, ObjectStorage takes precedence.
	 *
	 * Returns the same type as $subject. Ignores NULL values which would be
	 * OK to use in an f:for (empty loop as result)
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function render() {
		if (empty($this->arguments['subject'])) {
			$subject = $this->renderChildren();
		} else {
			$subject = $this->arguments['subject'];
		}
		$sorted = array();
		if ($subject instanceof QueryResultInterface) {
			/** @var QueryResultInterface $subject */
			/** @var QueryInterface $query */
			$query = $subject->getQuery();
			$query->setOrderings(array(
				$this->arguments['sortBy'] => $this->arguments['direction']
			));
			$sorted = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\QueryResultInterface', $query);
		} elseif (is_array($subject)) {
			reset($subject);
			$firstElement = current($subject);
			if (is_object($firstElement)) {
				usort($subject, array($this, 'sortObject'));
			} elseif (is_array($firstElement)) {
				usort($subject, array($this, 'sortArray'));
			}
			$sorted = $subject;
		}
		return $sorted;
	}

	/**
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $a
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $b
	 * @return int
	 */
	public function sortObject($a, $b) {
		$getter = 'get' . ucfirst($this->arguments['sortBy']);
		$varA = $a->$getter();
		$varB = $b->$getter();
		if ($varA > $varB) {
			return $this->arguments['direction'] === 'ASC' ? 1 : -1;
		} elseif ($varA < $varB) {
			return $this->arguments['direction'] === 'ASC' ? -1 : 1;
		} else {
			return 0;
		}
	}

	/**
	 * @param array $a
	 * @param array $b
	 * @return int
	 */
	public function sortArray($a, $b) {
		$varA = $a[$this->arguments['sortBy']];
		$varB = $b[$this->arguments['sortBy']];
		if ($varA > $varB) {
			return $this->arguments['direction'] === 'ASC' ? 1 : -1;
		} elseif ($varA < $varB) {
			return $this->arguments['direction'] === 'ASC' ? -1 : 1;
		} else {
			return 0;
		}
	}
}