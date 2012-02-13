<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 <>
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
 *
 * @scope prototype
 * @entity
 */
class Tx_Questionrating_Domain_Model_Reviewcomment extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var DateTime
	 */
	protected $crdate;

	/**
	 * @var string
	 */
	protected $message;

	/**
	 * @var Tx_Questionrating_Domain_Model_Review
	 * @lazy
	 */
	protected $review;

	/**
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $user;

	public function __construct() {
		$this->crdate = $GLOBALS['EXEC_TIME'];
	}

	/**
	 * @param DateTime $crdate
	 * @return void
	 */
	public function setCrdate(DateTime $crdate) {
		$this->crdate = $crdate;
	}

	/**
	 * @return DateTime
	 */
	public function getCrdate() {
		return $this->crdate;
	}


	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 * @return void
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Review $review
	 * @return void
	 */
	public function setReview(Tx_Questionrating_Domain_Model_Review $review) {
		$this->review = $review;
	}

	/**
	 * @return Tx_Questionrating_Domain_Model_Review
	 */
	public function getReview() {
		return $this->review;
	}

	/**
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return void
	 */
	public function setUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		$this->user = $user;
	}

	/**
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	public function getUser() {
		return $this->user;
	}

}