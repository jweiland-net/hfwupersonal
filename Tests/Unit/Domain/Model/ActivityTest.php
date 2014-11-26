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
 * Test case for class \JWeiland\Hfwupersonal\Domain\Model\Activity.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Stefan Froemken <sfroemken@jweiland.net>
 */
class ActivityTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Activity
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \JWeiland\Hfwupersonal\Domain\Model\Activity();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFacultyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFaculty()
		);
	}

	/**
	 * @test
	 */
	public function setFacultyForStringSetsFaculty() {
		$this->subject->setFaculty('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'faculty',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCourseOfStudiesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCourseOfStudies()
		);
	}

	/**
	 * @test
	 */
	public function setCurseOfStudiesForStringSetsCurseOfStudies() {
		$this->subject->setCourseOfStudies('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'curseOfStudies',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getResearchReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getResearch()
		);
	}

	/**
	 * @test
	 */
	public function setResearchForStringSetsResearch() {
		$this->subject->setResearch('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'research',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmploymentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmployment()
		);
	}

	/**
	 * @test
	 */
	public function setEmploymentForStringSetsEmployment() {
		$this->subject->setEmployment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'employment',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSpecialFieldReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSpecialField()
		);
	}

	/**
	 * @test
	 */
	public function setSpecialFieldForStringSetsSpecialField() {
		$this->subject->setSpecialField('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'specialField',
			$this->subject
		);
	}
}
