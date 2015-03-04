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
class Institute {

	/**
	 * instituteId
	 *
	 * @var string
	 */
	protected $instituteId = '';

	/**
	 * room
	 *
	 * @var string
	 */
	protected $room = '';

	/**
	 * phone
	 *
	 * @var string
	 */
	protected $phone = '';

	/**
	 * fax
	 *
	 * @var string
	 */
	protected $fax = '';

	/**
	 * consultation
	 *
	 * @var string
	 */
	protected $consultation = '';

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
	 * Returns the room
	 *
	 * @return string $room
	 */
	public function getRoom() {
		return $this->room;
	}

	/**
	 * Sets the room
	 *
	 * @param string $room
	 * @return void
	 */
	public function setRoom($room) {
		$this->room = $room;
	}

	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the fax
	 *
	 * @return string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param string $fax
	 * @return void
	 */
	public function setFax($fax) {
		$this->fax = $fax;
	}

	/**
	 * Returns the consultation
	 *
	 * @return string $consultation
	 */
	public function getConsultation() {
		return $this->consultation;
	}

	/**
	 * Sets the consultation
	 *
	 * @param string $consultation
	 * @return void
	 */
	public function setConsultation($consultation) {
		$this->consultation = $consultation;
	}

}