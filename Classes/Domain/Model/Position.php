<?php
namespace JWeiland\Hfwupersonal\Domain\Model;

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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Position
 */
class Position extends AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * instituteId
	 *
	 * @var string
	 */
	protected $instituteId = '';

	/**
	 * responseTimes
	 *
	 * @var string
	 */
	protected $responseTimes = '';

	/**
	 * Contacts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\Contact>
	 * @cascade remove
	 */
	protected $contacts = NULL;

	/**
	 * category
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\Category
	 */
	protected $category = NULL;

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->contacts = new ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the instituteId
	 *
	 * @return string $instituteId
	 */
	public function getInstituteId() {
		return $this->instituteId;
	}

	/**
	 * Sets the instituteId
	 *
	 * @param string $instituteId
	 * @return void
	 */
	public function setInstituteId($instituteId) {
		$this->instituteId = $instituteId;
	}

	/**
	 * Returns the responseTimes
	 *
	 * @return string $responseTimes
	 */
	public function getResponseTimes() {
		return $this->responseTimes;
	}

	/**
	 * Sets the responseTimes
	 *
	 * @param string $responseTimes
	 * @return void
	 */
	public function setResponseTimes($responseTimes) {
		$this->responseTimes = $responseTimes;
	}

	/**
	 * Adds a Contact
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Contact $contact
	 * @return void
	 */
	public function addContact(\JWeiland\Hfwupersonal\Domain\Model\Contact $contact) {
		$this->contacts->attach($contact);
	}

	/**
	 * Removes a Contact
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Contact $contact
	 * @return void
	 */
	public function removeContact(\JWeiland\Hfwupersonal\Domain\Model\Contact $contact) {
		$this->contacts->detach($contact);
	}

	/**
	 * Returns the contacts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts
	 */
	public function getContacts() {
		return $this->contacts;
	}

	/**
	 * Sets the contacts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts
	 * @return void
	 */
	public function setContacts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts) {
		$this->contacts = $contacts;
	}

	/**
	 * Returns the category
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
		$this->category = $category;
	}

}