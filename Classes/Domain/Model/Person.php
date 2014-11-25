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
 * Persons
 */
class Person extends AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * firstName
	 *
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * lastName
	 *
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image = NULL;

	/**
	 * imageComment
	 *
	 * @var string
	 */
	protected $imageComment = '';

	/**
	 * Categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\SysCategory>
	 */
	protected $categories = NULL;

	/**
	 * Links
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\Link>
	 * @cascade remove
	 */
	protected $links = NULL;

	/**
	 * FeGroup
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup
	 */
	protected $frontendUserGroup = NULL;

	/**
	 * BeGroup
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Model\BackendUserGroup
	 */
	protected $backendUserGroup = NULL;

	/**
	 * Address
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Address
	 */
	protected $address = NULL;

	/**
	 * Location
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\Location>
	 * @cascade remove
	 */
	protected $locations = NULL;

	/**
	 * Function
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\Function>
	 * @cascade remove
	 */
	protected $positions = NULL;

	/**
	 * Activities
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\JWeiland\Hfwupersonal\Domain\Model\Activity>
	 * @cascade remove
	 */
	protected $activities = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->categories = new ObjectStorage();
		$this->links = new ObjectStorage();
		$this->locations = new ObjectStorage();
		$this->positions = new ObjectStorage();
		$this->activities = new ObjectStorage();
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
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 * Returns the imageComment
	 *
	 * @return string $imageComment
	 */
	public function getImageComment() {
		return $this->imageComment;
	}

	/**
	 * Sets the imageComment
	 *
	 * @param string $imageComment
	 * @return void
	 */
	public function setImageComment($imageComment) {
		$this->imageComment = $imageComment;
	}

	/**
	 * Adds a SysCategory
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\SysCategory $category
	 * @return void
	 */
	public function addCategory(\JWeiland\Hfwupersonal\Domain\Model\SysCategory $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a SysCategory
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\SysCategory $categoryToRemove The SysCategory to be removed
	 * @return void
	 */
	public function removeCategory(\JWeiland\Hfwupersonal\Domain\Model\SysCategory $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}

	/**
	 * Adds a Link
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Link $link
	 * @return void
	 */
	public function addLink(\JWeiland\Hfwupersonal\Domain\Model\Link $link) {
		$this->links->attach($link);
	}

	/**
	 * Removes a Link
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Link $linkToRemove The Link to be removed
	 * @return void
	 */
	public function removeLink(\JWeiland\Hfwupersonal\Domain\Model\Link $linkToRemove) {
		$this->links->detach($linkToRemove);
	}

	/**
	 * Returns the links
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $links
	 */
	public function getLinks() {
		return $this->links;
	}

	/**
	 * Sets the links
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $links
	 * @return void
	 */
	public function setLinks(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $links) {
		$this->links = $links;
	}

	/**
	 * Returns the frontendUserGroup
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $frontendUserGroup
	 */
	public function getFrontendUserGroup() {
		return $this->frontendUserGroup;
	}

	/**
	 * Sets the frontendUserGroup
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $frontendUserGroup
	 * @return void
	 */
	public function setFrontendGroup(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $frontendUserGroup) {
		$this->frontendUserGroup = $frontendUserGroup;
	}

	/**
	 * Returns the backendUserGroup
	 *
	 * @return \JWeiland\Hfwupersonal\Domain\Model\BackendUserGroup $backendUserGroup
	 */
	public function getBackendUserGroup() {
		return $this->backendUserGroup;
	}

	/**
	 * Sets the backendUserGroup
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\BackendUserGroup $backendUserGroup
	 * @return void
	 */
	public function setBackendGroup(\JWeiland\Hfwupersonal\Domain\Model\BackendUserGroup $backendUserGroup) {
		$this->backendUserGroup = $backendUserGroup;
	}

	/**
	 * Returns the address
	 *
	 * @return \JWeiland\Hfwupersonal\Domain\Model\Address $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Address $address
	 * @return void
	 */
	public function setAddress(\JWeiland\Hfwupersonal\Domain\Model\Address $address) {
		$this->address = $address;
	}

	/**
	 * Adds a Location
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Location $location
	 * @return void
	 */
	public function addLocation(\JWeiland\Hfwupersonal\Domain\Model\Location $location) {
		$this->locations->attach($location);
	}

	/**
	 * Removes a Location
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Location $location The Location to be removed
	 * @return void
	 */
	public function removeLocation(\JWeiland\Hfwupersonal\Domain\Model\Location $location) {
		$this->locations->detach($location);
	}

	/**
	 * Returns the locations
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * Sets the locations
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations
	 * @return void
	 */
	public function setLocations(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $locations) {
		$this->locations = $locations;
	}

	/**
	 * Adds a Position
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Position $position
	 * @return void
	 */
	public function addPosition(\JWeiland\Hfwupersonal\Domain\Model\Position $position) {
		$this->positions->attach($position);
	}

	/**
	 * Removes a Position
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Position $position
	 * @return void
	 */
	public function removePosition(\JWeiland\Hfwupersonal\Domain\Model\Position $position) {
		$this->positions->detach($position);
	}

	/**
	 * Returns the positions
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $positions
	 */
	public function getPositions() {
		return $this->positions;
	}

	/**
	 * Sets the positions
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $positions
	 * @return void
	 */
	public function setPositions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $positions) {
		$this->positions = $positions;
	}

	/**
	 * Adds a Activity
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Activity $activity
	 * @return void
	 */
	public function addActivity(\JWeiland\Hfwupersonal\Domain\Model\Activity $activity) {
		$this->activities->attach($activity);
	}

	/**
	 * Removes a Activity
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Activity $activityToRemove The Activity to be removed
	 * @return void
	 */
	public function removeActivity(\JWeiland\Hfwupersonal\Domain\Model\Activity $activityToRemove) {
		$this->activities->detach($activityToRemove);
	}

	/**
	 * Returns the activities
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $activities
	 */
	public function getActivities() {
		return $this->activities;
	}

	/**
	 * Sets the activities
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $activities
	 * @return void
	 */
	public function setActivities(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $activities) {
		$this->activities = $activities;
	}

}