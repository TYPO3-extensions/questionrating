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
class Tx_Questionrating_Domain_Model_Review extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 */
	protected $xmlId;

	/**
	 * @var string
	 */
	protected $headline;

	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $votes;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Questionrating_Domain_Model_Reviewcomment>
	 * @lazy
	 */
	protected $reviewcomments;

	/**
	* @return
	*/
	public function __construct() {
		$this->reviewcomments = new Tx_Extbase_Persistence_ObjectStorage();
		$this->votes = 0;
		// $this->status = 'technical';
	}

	/**
	 * @return string
	 */
	public function getXmlId() {
		return $this->xmlId;
	}

	/**
	 * @param string $xml_id
	 * @return void
	 */
	public function setXmlId($xml_id) {
		$this->xmlId = $xml_id;
	}

	/**
	 * @return string
	 */
	public function getHeadline() {
		return $this->headline;
	}

	/**
	 * @param string $headline
	 * @return void
	 */
	public function setHeadline($headline) {
		$this->headline = $headline;
	}

	/**
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return integer
	 */
	public function getVotes() {
		return $this->votes;
	}

	/**
	 * @param integer $votes
	 * @return void
	 */
	public function setVotes($votes) {
		$this->votes = $votes;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getReviewcomments() {
		return $this->reviewcomments;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment
	 * @return void
	 */
	public function addReviewcomment(Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment) {
		$this->reviewcomments->attach($reviewcomment);
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage $reviewcomments
	 * @return void
	 */
	public function setReviewcomments(Tx_Extbase_Persistence_ObjectStorage $reviewcomments) {
		$this->reviewcomments = $reviewcomments;
	}


}