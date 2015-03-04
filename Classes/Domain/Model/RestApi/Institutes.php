<?php
namespace JWeiland\Hfwupersonal\Domain\Model\RestApi;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Stefan Froemken <sfroemken@jweiland.net>, jweiland.net
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

/**
 * User
 */
class Institutes {

	/**
	 * instituteId
	 *
	 * @var string
	 */
	protected $instituteId = '';

	/**
	 * facultyAddress
	 *
	 * @var string
	 */
	protected $facultyAddress = NULL;

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
	 * Returns the facultyAddress
	 *
	 * @return string $facultyAddress
	 */
	public function getFacultyAddress() {
		return $this->facultyAddress;
	}

	/**
	 * Sets the facultyAddress
	 *
	 * @param string $facultyAddress
	 * @return void
	 */
	public function setFacultyAddress($facultyAddress) {
		$this->facultyAddress = $facultyAddress;
	}


}