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
class Tx_Questionrating_Domain_Model_Question extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 */
	protected $xmlId;

	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @var boolean
	 */
	protected $active;

	/**
	 * @var string
	 * @validate notEmpty;
	 *
	 */
	protected $questiontext;

	/**
	 * @var string
	 */
	protected $answer1text;

	/**
	 * @var string
	 */
	protected $answer2text;

	/**
	 * @var string
	 */
	protected $answer3text;

	/**
	 * @var string
	 */
	protected $answer4text;

	/**
	 * @var string
	 */
	protected $answer5text;

	/**
	 * @var string
	 */
	protected $answer6text;

	/**
	 * @var string
	 */
	protected $answer7text;

	/**
	 * @var string
	 */
	protected $answer8text;

	/**
	 * @var string
	 */
	protected $answer9text;

	/**
	 * @var string
	 */
	protected $answer10text;

	/**
	 * @var string
	 */
	protected $correctanswer;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Questionrating_Domain_Model_Rating>
	 * @lazy
	 */
	protected $ratings;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Questionrating_Domain_Model_Discussion>
	 * @lazy
	 */
	protected $discussions;

	/**
	* @return
	*/
	public function __construct() {
		$this->ratings = new Tx_Extbase_Persistence_ObjectStorage();
		$this->discussions = new Tx_Extbase_Persistence_ObjectStorage();
		$this->status = 'open';
		$this->active = TRUE;
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
	 * @return boolean
	 */
	public function getActive() {
		return $this->active;
	}

	/**
	 * @param boolean $active
	 * @return void
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return string
	 */
	public function getQuestiontext() {
		return $this->questiontext;
	}

	/**
	 * @param string $questiontext
	 * @return void
	 */
	public function setQuestiontext($questiontext) {
		$this->questiontext = $questiontext;
	}

	/**
	 * @return string
	 */
	public function getAnswer1text() {
		return $this->answer1text;
	}

	/**
	 * @param string $answer1text
	 * @return void
	 */
	public function setAnswer1text($answer1text) {
		$this->answer1text = $answer1text;
	}

	/**
	 * @return string
	 */
	public function getAnswer2text() {
		return $this->answer2text;
	}

	/**
	 * @param string $answer2text
	 * @return void
	 */
	public function setAnswer2text($answer2text) {
		$this->answer2text = $answer2text;
	}

	/**
	 * @return string
	 */
	public function getAnswer3text() {
		return $this->answer3text;
	}

	/**
	 * @param string $answer3text
	 * @return void
	 */
	public function setAnswer3text($answer3text) {
		$this->answer3text = $answer3text;
	}

	/**
	 * @return string
	 */
	public function getAnswer4text() {
		return $this->answer4text;
	}

	/**
	 * @param string $answer4text
	 * @return void
	 */
	public function setAnswer4text($answer4text) {
		$this->answer4text = $answer4text;
	}

	/**
	 * @return string
	 */
	public function getAnswer5text() {
		return $this->answer5text;
	}

	/**
	 * @param string $answer5text
	 * @return void
	 */
	public function setAnswer5text($answer5text) {
		$this->answer5text = $answer5text;
	}

	/**
	 * @return string
	 */
	public function getAnswer6text() {
		return $this->answer6text;
	}

	/**
	 * @param string $answer6text
	 * @return void
	 */
	public function setAnswer6text($answer6text) {
		$this->answer6text = $answer6text;
	}

	/**
	 * @return string
	 */
	public function getAnswer7text() {
		return $this->answer7text;
	}

	/**
	 * @param string $answer7text
	 * @return void
	 */
	public function setAnswer7text($answer7text) {
		$this->answer7text = $answer7text;
	}

	/**
	 * @return string
	 */
	public function getAnswer8text() {
		return $this->answer8text;
	}

	/**
	 * @param string $answer8text
	 * @return void
	 */
	public function setAnswer8text($answer8text) {
		$this->answer8text = $answer8text;
	}

	/**
	 * @return string
	 */
	public function getAnswer9text() {
		return $this->answer9text;
	}

	/**
	 * @param string $answer9text
	 * @return void
	 */
	public function setAnswer9text($answer9text) {
		$this->answer9text = $answer9text;
	}

	/**
	 * @return string
	 */
	public function getAnswer10text() {
		return $this->answer10text;
	}

	/**
	 * @param string $answer10text
	 * @return void
	 */
	public function setAnswer10text($answer10text) {
		$this->answer10text = $answer10text;
	}

	/**
	 * @return array
	 */
	public function getAnswers() {
		$answers = array();
		for ($i = 1; $i <= 10; $i++) {
			$currentAnswer = 'answer' . $i . 'text';
			if (!empty($this->$currentAnswer)) {
				$answers[$i] = $this->$currentAnswer;
			}
		}
		return $answers;
	}

	public function getAllAnswers() {
		$answers = array();
		for ($i = 1; $i <= 10; $i++) {
			$currentAnswer = 'answer' . $i . 'text';
			$answers[$i] = $this->$currentAnswer;
		}
		return $answers;
	}

		/**
	 * @return array
	 */
	public function getCorrectanswer() {
		return explode(',', $this->correctanswer);
	}

	/**
	 * @param array $correctanswer
	 * @return void
	 */
	public function setCorrectanswer($correctanswer) {
		$newValues = array();
		foreach ($correctanswer as $value) {
			$newValues[] = (int)$value;
		}
		$this->correctanswer = implode(',', $newValues);
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getRatings() {
		return $this->ratings;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Rating $rating
	 * @return void
	 */
	public function addRating(Tx_Questionrating_Domain_Model_Rating $rating) {
		$this->ratings->attach($rating);
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage $ratings
	 * @return void
	 */
	public function setRatings(Tx_Extbase_Persistence_ObjectStorage $ratings) {
		$this->ratings = $ratings;
	}


	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getDiscussions() {
		return $this->discussions;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Discussion $rating
	 * @return void
	 */
	public function addDiscussion(Tx_Questionrating_Domain_Model_Discussion $discussion) {
		$this->discussions->attach($discussion);
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage $discussions
	 * @return void
	 */
	public function setDiscussions(Tx_Extbase_Persistence_ObjectStorage $discussions) {
		$this->discussions = $discussions;
	}

	/**
	 * @return string
	 */
	public function getQuestionTitle() {
		$title = strpos($this->questiontext, "<br") > 0 ? substr($this->questiontext, 0, strpos($this->questiontext, "<br")) : $this->questiontext;
		// if (strlen($title) > 30)
		// $title = substr($title, 0, 30) . '...';
		return $title;
	}

	/**
	 * @param Tx_Questionrating_Utils_Xmlitem $xmlitem
	 *
	 */
	public function importXmlitem(Tx_Questionrating_Utils_Xmlitem $xmlitem) {
		$this->xmlId = $xmlitem->getId();
		$this->questiontext = $xmlitem->getQuestiontext();
		$answerCount = 1;
		$correctanswer = array();
		foreach ($xmlitem->getAnswers() as $answers) {
			$currentAnswerVar = 'answer' . $answerCount . 'text';
			$this->$currentAnswerVar = $answers['text'];
			if ($answers['correct']) {
				$correctanswer[] = $answerCount;
			}
			$answerCount++;
		}
		$this->setCorrectanswer($correctanswer);

	}
}