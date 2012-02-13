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
class Tx_Questionrating_Domain_Model_Rating extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $user;
	
	/**
	 * @var Tx_Questionrating_Domain_Model_Question
	 * @lazy
	 */
	protected $question;	

	/**
	 * @var integer
	 * @validate NumberRange(startRange = 0, endRange = 99)
	 * @validate Integer
	 */
	protected $ratingValue;

	/**
	 * @var boolean
	 */
	protected $finalRating;

	/**
	 * @var integer
	 * @validate NumberRange(startRange = 0, endRange = 99)
	 * @validate Integer
	 */
	protected $finalRatingValue;

	/**
	* @return void
	*/
	public function __construct() {
		$this->ratingValue = NULL;	
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
	
	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question 
	 * @return void
	 */
	public function setQuestion(Tx_Questionrating_Domain_Model_Question $question) {
		$this->question = $question;
	}

	/**
	 * @return Tx_Questionrating_Domain_Model_Question
	 */
	public function getQuestion() {
		return $this->question;
	}
	

	/**
	 * @return integer
	 */
	public function getRatingValue() {
		return $this->ratingValue;
	}

	/**
	 * @param integer $ratingValue
	 * @return void
	 */
	public function setRatingValue($ratingValue) {
		$this->ratingValue = $ratingValue;
	}

	/**
	 * @return boolean
	 */
	public function getFinalRating() {
		return $this->finalRating;
	}

	/**
	 * @param boolean $finalRating
	 * @return void
	 */
	public function setFinalRating($finalRating) {
		$this->finalRating = $finalRating;
	}
	
	/**
	 * @return integer
	 * 
	 */
	public function getFinalRatingValue() {
		return $this->finalRatingValue;
	}

	/**
	 * @param integer $finalRatingValue
	 * @return void
	 */
	public function setFinalRatingValue($finalRatingValue) {
		$this->finalRatingValue = $finalRatingValue;
	}
		

}