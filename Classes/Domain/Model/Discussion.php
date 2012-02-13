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
class Tx_Questionrating_Domain_Model_Discussion extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var DateTime
	 */
	protected $crdate;

	/**
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $fromUser;

	/**
	 * @var integer
	 */
	protected $fromLeader;

	/**
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $toUser;

	/**
	 * @var integer
	 */
	protected $toLeader;


	/**
	 * @var Tx_Questionrating_Domain_Model_Question
	 * @lazy
	 */
	protected $question;

	/**
	 * @var string
	 */
	protected $message;

	/**
	* @return
	*/
	public function __construct() {
		$this->crdate = $GLOBALS['EXEC_TIME'];
		$this->toUser = 0;
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
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return void
	 */
	public function setFromUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		$this->fromUser = $user;
	}

	/**
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	public function getFromUser() {
		return $this->fromUser;
	}

	/**
	 * @return integer
	 */
	public function getFromLeader() {
		return $this->fromLeader;
	}

	/**
	 * @param integer $fromLeader
	 * @return void
	 */
	public function setFromLeader($fromLeader) {
		$this->fromLeader = $fromLeader;
	}

	/**
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return void
	 */
	public function setToUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		$this->toUser = $user;
	}

	/**
	 * @return Tx_Extbase_Domain_Model_FrontendUser
	 */
	public function getToUser() {
		return $this->toUser;
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
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param integer $message
	 * @return void
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * @return integer
	 */
	public function getToLeader() {
		return $this->toLeader;
	}

	/**
	 * @param integer $toLeader
	 * @return void
	 */
	public function setToLeader($toLeader) {
		$this->toLeader = $toLeader;
	}

}