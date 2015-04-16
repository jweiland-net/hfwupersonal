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
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
	 * preprocessing of all actions
	 *
	 * @return void
	 */
	public function initializeAction() {
		// if this value was not set, then it will be filled with 0
		// but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
		if (empty($this->settings['pidOfDetailPage'])) {
			$this->settings['pidOfDetailPage'] = NULL;
		}
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
		// if a person is set in FlexForm we redirect to show action immediately
		if (!empty($this->settings['person'])) {
			$this->forward('show', 'Person', NULL, array('person' => $this->settings['person']));
		} else {
			$persons = $this->personRepository->findByFilters(
				$this->settings['filterAnd'],
				$this->settings['filterOr'],
				$this->settings['filterNot'],
				(bool)$this->settings['fastMode']
			);
			$this->view->assign('pageUid', $GLOBALS['TSFE']->id);
			$this->view->assign('persons', $persons);
		}
	}

	/**
	 * action show
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Person $person
	 * @return void
	 */
	public function showAction(\JWeiland\Hfwupersonal\Domain\Model\Person $person) {
		$profilePage = 0;

		if ($person->getProfilePage() !== NULL) {
			$profilePage = $person->getProfilePage()->getLink();
		}

		// redirect to profile page if set AND we are NOT already on profile page
		if (!empty($profilePage) && MathUtility::canBeInterpretedAsInteger($profilePage) && $GLOBALS['TSFE']->id != $profilePage) {
			$this->redirectToUri($this->uriBuilder->reset()->setTargetPageUid($profilePage)->build());
		} else {
			$this->view->assign('person', $person);
		}
	}

	/**
	 * sanitize search string
	 * remove not allowed parts
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
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