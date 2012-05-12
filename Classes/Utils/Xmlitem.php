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


class Tx_Questionrating_Utils_Xmlitem {

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $questiontext;

	/**
	 * @var string
	 */
	protected $author;

	/**
	 * @var string
	 */
	protected $status;

	/**
	 * @var array
	 */
	protected $answers;

	/**
	 * @var integer
	 */
	protected $inDb;

	/**
	 * @var integer
	 */
	protected $rating = NULL;

	/**
	 * @var SimpleXMLElement
	 */
	protected $xml;

	/**
	 * @var string
	 */
	protected $filename;

	/**
	 * @var string
	 */
	protected $path;

	/**
	 * @param string $filename
	 */
	public function loadXml($path, $filename) {
		$this->filename = $filename;
		$this->path = $path;
		$this->xml = simplexml_load_file($path . $filename);

			// break if xml can't be read
			// should never happen :-)
		if (!is_object($this->xml)) {
			echo 'error reading XML File';
			var_dump($this);
			die();
		}

		$this->id = (string)$this->xml['id'];
		$this->questiontext = $this->getTextandCode($this->xml->question);
		$this->author = (string)$this->xml['author'];
		$this->status = (string)$this->xml['status'];
		$this->answers = array();
		foreach ($this->xml->answers->option as $answer) {
			$currentAnswer = array();
			$currentAnswer['text'] = $this->getTextandCode($answer);
			$currentAnswer['correct'] = ((string) $answer['correct'] === 'true');
			$this->answers[] = $currentAnswer;
		}
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 *
	 */
	public function updateByQuestion(Tx_Questionrating_Domain_Model_Question $question) {
		$this->setQuestiontext($question->getQuestiontext());
		unset($this->xml->answers->option);
		$correctanswer = $question->getCorrectanswer();
		if (empty($correctanswer[0])) {
			$tempQuestion = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Question');
			$tempQuestion->importXmlitem($this);
			$correctanswer = $tempQuestion->getCorrectanswer();
		}
		$this->answers = array();
		foreach ($question->getAnswers() as $id => $answer) {
			$currentAnswer = array();
			$currentAnswer['text'] = $answer;
			$option = $this->xml->answers->addChild('option');
			if (in_array($id, $correctanswer)) {
				$option->addAttribute('correct', 'true');
				$currentAnswer['correct'] = TRUE;
			} else {
				$option->addAttribute('correct', 'false');
				$currentAnswer['correct'] = FALSE;
			}
			$this->setTextandCode($option, $answer);
			$this->answers[] = $currentAnswer;
		}
	}

	/**
	 * @param SimpleXMLElement $xml
	 * @return string
	 */
	protected function getTextandCode(SimpleXMLElement $xml) {
		$returnValue = (string)$xml;
		foreach ($xml->code as $code) {
			$returnValue .= '<code>' . (string)$code . '</code>';
		}

		return $returnValue;
	}

	/**
	 * @param SimpleXMLElement $xml
	 * @param string $text
	 */
	protected function setTextandCode(SimpleXMLElement $xml, $text) {
		preg_match_all('/<code>(.*)<\/code>/iUs', $text, $codeTextArray);
		$xml[0] = preg_replace('/<code>(.*)<\/code>/iUs', '', $text);
		if (!empty($codeTextArray)) {
			foreach ($codeTextArray[1] as $codeText) {
				$this->addCData($xml->addChild('code'), $codeText);
			}
		}
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
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
		$this->setTextandCode($this->xml->question, $questiontext);
	}

	/**
	 * @return string
	 */
	public function getAuthor() {
		return $this->author;
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
		$this->xml['status'] = $status;
	}

	/**
	 * @return array
	 */
	public function getAnswers() {
		return $this->answers;
	}

	/**
	 * @return string
	 */
	public function getRating() {
		return $this->rating;
	}

	/**
	 * @param string $rating
	 * @return void
	 */
	public function setRating($rating) {
		$this->rating = $rating;
		$this->xml['rating'] = $rating;
	}

	/**
	 * @return string
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @param string $rating
	 * @return void
	 */
	public function setPath($path) {
		$this->path = $path;
	}


	/**
	 * @return string
	 */
	public function getPathFilename() {
		return $this->path . $this->filename;
	}


	/**
	 * @return SimpleXMLElement
	 */
	public function getXml() {
		return $this->xml;
	}

	/**
	 * @return integer
	 */
	public function getInDb() {
		return $this->inDb;
	}

	/**
	 * @param integer $inDb
	 * @return void
	 */
	public function setInDb($inDb) {
		$this->inDb = $inDb;
	}

	private function addCData($xml, $text) {
		$node= dom_import_simplexml($xml);
		$no = $node->ownerDocument;
		$node->appendChild($no->createCDATASection($text));
	}

}