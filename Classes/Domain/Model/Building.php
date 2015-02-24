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
 * Buildings
 */
class Building extends AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * Address
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Address
	 */
	protected $address = NULL;

	/**
	 * Links
	 *
	 * @var \JWeiland\Hfwupersonal\Domain\Model\Link
	 * @cascade remove
	 */
	protected $link = NULL;

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
	 * Returns the link
	 *
	 * @return \JWeiland\Hfwupersonal\Domain\Model\Link $link
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Sets the link
	 *
	 * @param \JWeiland\Hfwupersonal\Domain\Model\Link $link
	 * @return void
	 */
	public function setLink(\JWeiland\Hfwupersonal\Domain\Model\Link $link) {
		$this->link = $link;
	}

}