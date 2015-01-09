<?php
namespace JWeiland\Hfwupersonal\Controller;

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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * PersonController
 */
class PersonController extends ActionController {

	/**
	 * personRepository
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Repository\PersonRepository
	 */
	protected $personRepository = NULL;

	/**
	 * inject personRepository
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Repository\PersonRepository $personRepository
	 * @return void
	 */
	public function injectPersonRepository(\JWeiland\Hfwupersonal\Domain\Repository\PersonRepository $personRepository) {
		$this->personRepository = $personRepository;
	}

	/**
	 * add some variables to fluid template
	 *
	 * @return void
	 */
	public function initializeView() {
		$this->view->assign('siteUrl', GeneralUtility::getIndpEnv('TYPO3_SITE_URL'));
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if (!empty($this->settings['filterByCategories'])) {
			$persons = $this->personRepository->findByCategories($this->settings['filterByCategories']);
		} else {
			$persons = $this->personRepository->findAll();
		}
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
		$this->view->assign('persons', $persons);
	}

	/**
	 * action show
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $person
	 * @return void
	 */
	public function showAction(\JWeiland\Hfwupersonal\Domain\Model\Person $person) {
		$this->view->assign('person', $person);
	}

	public function initializeSearchAction() {
		if ($this->request->hasArgument('search')) {
			$this->request->setArgument('search', trim(htmlspecialchars(strip_tags($this->request->getArgument('search')))));
		}
	}

	/**
	 * action search
	 *
	 * @param string $search
	 * @return void
	 */
	public function searchAction($search) {
		if (empty($search)) {
			$persons = $this->personRepository->findAll();
		} else {
			$persons = $this->personRepository->findBySearch($search);
		}
		$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
		$this->view->assign('search', $search);
		$this->view->assign('persons', $persons);
	}

}