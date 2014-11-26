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

/**
 * Activities
 */
class Activity extends AbstractEntity {

	/**
	 * faculty
	 *
	 * @var string
	 */
	protected $faculty = '';

	/**
	 * courseOfStudies
	 *
	 * @var string
	 */
	protected $courseOfStudies = '';

	/**
	 * research
	 *
	 * @var string
	 */
	protected $research = '';

	/**
	 * employment
	 *
	 * @var string
	 */
	protected $employment = '';

	/**
	 * specialField
	 *
	 * @var string
	 */
	protected $specialField = '';

	/**
	 * Returns the faculty
	 *
	 * @return string $faculty
	 */
	public function getFaculty() {
		return $this->faculty;
	}

	/**
	 * Sets the faculty
	 *
	 * @param string $faculty
	 * @return void
	 */
	public function setFaculty($faculty) {
		$this->faculty = $faculty;
	}

	/**
	 * Returns the courseOfStudies
	 *
	 * @return string $courseOfStudies
	 */
	public function getCourseOfStudies() {
		return $this->courseOfStudies;
	}

	/**
	 * Sets the courseOfStudies
	 *
	 * @param string $courseOfStudies
	 * @return void
	 */
	public function setCourseOfStudies($courseOfStudies) {
		$this->courseOfStudies = $courseOfStudies;
	}

	/**
	 * Returns the research
	 *
	 * @return string $research
	 */
	public function getResearch() {
		return $this->research;
	}

	/**
	 * Sets the research
	 *
	 * @param string $research
	 * @return void
	 */
	public function setResearch($research) {
		$this->research = $research;
	}

	/**
	 * Returns the employment
	 *
	 * @return string $employment
	 */
	public function getEmployment() {
		return $this->employment;
	}

	/**
	 * Sets the employment
	 *
	 * @param string $employment
	 * @return void
	 */
	public function setEmployment($employment) {
		$this->employment = $employment;
	}

	/**
	 * Returns the specialField
	 *
	 * @return string $specialField
	 */
	public function getSpecialField() {
		return $this->specialField;
	}

	/**
	 * Sets the specialField
	 *
	 * @param string $specialField
	 * @return void
	 */
	public function setSpecialField($specialField) {
		$this->specialField = $specialField;
	}

}