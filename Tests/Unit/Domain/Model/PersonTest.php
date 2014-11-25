<?php

namespace JWeiland\Hfwupersonal\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stefan Froemken <sfroemken@jweiland.net>, jweiland.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \JWeiland\Hfwupersonal\Domain\Model\Person.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Stefan Froemken <sfroemken@jweiland.net>
 */
class PersonTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Person
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \JWeiland\Hfwupersonal\Domain\Model\Person();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() {
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() {
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageCommentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getImageComment()
		);
	}

	/**
	 * @test
	 */
	public function setImageCommentForStringSetsImageComment() {
		$this->subject->setImageComment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'imageComment',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLinksReturnsInitialValueForLink() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getLinks()
		);
	}

	/**
	 * @test
	 */
	public function setLinksForObjectStorageContainingLinkSetsLinks() {
		$link = new \JWeiland\Hfwupersonal\Domain\Model\Link();
		$objectStorageHoldingExactlyOneLinks = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneLinks->attach($link);
		$this->subject->setLinks($objectStorageHoldingExactlyOneLinks);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneLinks,
			'links',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addLinkToObjectStorageHoldingLinks() {
		$link = new \JWeiland\Hfwupersonal\Domain\Model\Link();
		$linksObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$linksObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($link));
		$this->inject($this->subject, 'links', $linksObjectStorageMock);

		$this->subject->addLink($link);
	}

	/**
	 * @test
	 */
	public function removeLinkFromObjectStorageHoldingLinks() {
		$link = new \JWeiland\Hfwupersonal\Domain\Model\Link();
		$linksObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$linksObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($link));
		$this->inject($this->subject, 'links', $linksObjectStorageMock);

		$this->subject->removeLink($link);

	}

	/**
	 * @test
	 */
	public function getFrontendGroupReturnsInitialValueForFeGroup() {
		$this->assertEquals(
			NULL,
			$this->subject->getFrontendGroup()
		);
	}

	/**
	 * @test
	 */
	public function setFrontendGroupForFeGroupSetsFrontendGroup() {
		$frontendGroupFixture = new \JWeiland\Hfwupersonal\Domain\Model\FeGroup();
		$this->subject->setFrontendGroup($frontendGroupFixture);

		$this->assertAttributeEquals(
			$frontendGroupFixture,
			'frontendGroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBackendGroupReturnsInitialValueForBeGroup() {
		$this->assertEquals(
			NULL,
			$this->subject->getBackendGroup()
		);
	}

	/**
	 * @test
	 */
	public function setBackendGroupForBeGroupSetsBackendGroup() {
		$backendGroupFixture = new \JWeiland\Hfwupersonal\Domain\Model\BeGroup();
		$this->subject->setBackendGroup($backendGroupFixture);

		$this->assertAttributeEquals(
			$backendGroupFixture,
			'backendGroup',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForAddress() {
		$this->assertEquals(
			NULL,
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForAddressSetsAddress() {
		$addressFixture = new \JWeiland\Hfwupersonal\Domain\Model\Address();
		$this->subject->setAddress($addressFixture);

		$this->assertAttributeEquals(
			$addressFixture,
			'address',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForLocation() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForObjectStorageContainingLocationSetsLocation() {
		$location = new \JWeiland\Hfwupersonal\Domain\Model\Location();
		$objectStorageHoldingExactlyOneLocation = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneLocation->attach($location);
		$this->subject->setLocation($objectStorageHoldingExactlyOneLocation);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneLocation,
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addLocationToObjectStorageHoldingLocation() {
		$location = new \JWeiland\Hfwupersonal\Domain\Model\Location();
		$locationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$locationObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($location));
		$this->inject($this->subject, 'location', $locationObjectStorageMock);

		$this->subject->addLocation($location);
	}

	/**
	 * @test
	 */
	public function removeLocationFromObjectStorageHoldingLocation() {
		$location = new \JWeiland\Hfwupersonal\Domain\Model\Location();
		$locationObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$locationObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($location));
		$this->inject($this->subject, 'location', $locationObjectStorageMock);

		$this->subject->removeLocation($location);

	}

	/**
	 * @test
	 */
	public function getFunctionReturnsInitialValueForFunction() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPositions()
		);
	}

	/**
	 * @test
	 */
	public function setFunctionForObjectStorageContainingFunctionSetsFunction() {
		$function = new \JWeiland\Hfwupersonal\Domain\Model\Position();
		$objectStorageHoldingExactlyOneFunction = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneFunction->attach($function);
		$this->subject->setPositions($objectStorageHoldingExactlyOneFunction);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneFunction,
			'function',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addFunctionToObjectStorageHoldingFunction() {
		$function = new \JWeiland\Hfwupersonal\Domain\Model\Position();
		$functionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$functionObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($function));
		$this->inject($this->subject, 'function', $functionObjectStorageMock);

		$this->subject->addPosition($function);
	}

	/**
	 * @test
	 */
	public function removeFunctionFromObjectStorageHoldingFunction() {
		$function = new \JWeiland\Hfwupersonal\Domain\Model\Position();
		$functionObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$functionObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($function));
		$this->inject($this->subject, 'function', $functionObjectStorageMock);

		$this->subject->removePosition($function);

	}

	/**
	 * @test
	 */
	public function getActivityReturnsInitialValueForActivity() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getActivities()
		);
	}

	/**
	 * @test
	 */
	public function setActivityForObjectStorageContainingActivitySetsActivity() {
		$activity = new \JWeiland\Hfwupersonal\Domain\Model\Activity();
		$objectStorageHoldingExactlyOneActivity = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneActivity->attach($activity);
		$this->subject->setActivities($objectStorageHoldingExactlyOneActivity);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneActivity,
			'activity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addActivityToObjectStorageHoldingActivity() {
		$activity = new \JWeiland\Hfwupersonal\Domain\Model\Activity();
		$activityObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$activityObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($activity));
		$this->inject($this->subject, 'activity', $activityObjectStorageMock);

		$this->subject->addActivity($activity);
	}

	/**
	 * @test
	 */
	public function removeActivityFromObjectStorageHoldingActivity() {
		$activity = new \JWeiland\Hfwupersonal\Domain\Model\Activity();
		$activityObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$activityObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($activity));
		$this->inject($this->subject, 'activity', $activityObjectStorageMock);

		$this->subject->removeActivity($activity);

	}
}
