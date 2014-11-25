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
 * Room
 */
class Room extends AbstractEntity {

	/**
	 * number
	 *
	 * @var string
	 */
	protected $number = '';

	/**
	 * floor
	 *
	 * @var string
	 */
	protected $floor = '';

	/**
	 * Room
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Building
	 */
	protected $building = NULL;

	/**
	 * Returns the number
	 *
	 * @return string $number
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * Sets the number
	 *
	 * @param string $number
	 * @return void
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * Returns the floor
	 *
	 * @return string $floor
	 */
	public function getFloor() {
		return $this->floor;
	}

	/**
	 * Sets the floor
	 *
	 * @param string $floor
	 * @return void
	 */
	public function setFloor($floor) {
		$this->floor = $floor;
	}

	/**
	 * Returns the building
	 *
	 * @return \JWeiland\Hfwupersonal\Domain\Model\Building $building
	 */
	public function getBuilding() {
		return $this->building;
	}

	/**
	 * Sets the building
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Building $building
	 * @return void
	 */
	public function setBuilding(\JWeiland\Hfwupersonal\Domain\Model\Building $building) {
		$this->building = $building;
	}

}