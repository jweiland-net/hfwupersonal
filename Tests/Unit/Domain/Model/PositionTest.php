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
 * Test case for class \JWeiland\Hfwupersonal\Domain\Model\Function.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Stefan Froemken <sfroemken@jweiland.net>
 */
class PositionTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Position
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \JWeiland\Hfwupersonal\Domain\Model\Position();
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
	public function getTelephoneReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTelephone()
		);
	}

	/**
	 * @test
	 */
	public function setTelephoneForStringSetsTelephone() {
		$this->subject->setTelephone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'telephone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFaxReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFax()
		);
	}

	/**
	 * @test
	 */
	public function setFaxForStringSetsFax() {
		$this->subject->setFax('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'fax',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getResponseTimesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getResponseTimes()
		);
	}

	/**
	 * @test
	 */
	public function setResponseTimesForStringSetsResponseTimes() {
		$this->subject->setResponseTimes('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'responseTimes',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForSysCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

}
