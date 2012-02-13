<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010
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


class Tx_Questionrating_Controller_RatingController extends Tx_Questionrating_Controller_BaseController {

	/**
	 * @var Tx_Questionrating_Domain_Repository_RatingRepository
	 */
	 protected $ratingRepository;

	/**
	 * @var Tx_Questionrating_Domain_Repository_QuestionRepository
	 */
	protected $questionRepository;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->questionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_QuestionRepository');
		$this->ratingRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_RatingRepository');
	}

	/**
	 * Override getErrorFlashMessage to present nice flash error messages.
	 *
	 * @return string
	 */
	protected function getErrorFlashMessage() {
		$errorMessage = false;

		switch ($this->actionMethodName) {
	                case 'ratingStep1Action':
				$errorMessage = 'Unable to save the rating';
				break;
			default :
				$errorMessage = parent::getErrorFlashMessage();
		}

		return $errorMessage;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Questionrating_Domain_Model_Rating $rating
	 * @param string $message
	 * @return void
	 */
	public function ratingStep1Action(Tx_Questionrating_Domain_Model_Question $question, Tx_Questionrating_Domain_Model_Rating $rating, $message = '') {
		if (!empty($message) && $rating->getRatingValue() >= 0) {
			$newDiscussion = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Discussion');
			$newDiscussion->setMessage($message);
			$newDiscussion->setFromUser($this->currentUser);
			$newDiscussion->setFromLeader($this->isLeader);
			$newDiscussion->setQuestion($question);
			$question->addDiscussion($newDiscussion);
		}
		$rating->setFinalRatingValue($rating->getRatingValue());
		$this->ratingRepository->update($rating);
		// $this->flashMessages->add('Your rating was updated.');
		$this->redirect('index', 'Question');
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Questionrating_Domain_Model_Rating $rating
	 * @return void
	 */
	public function ratingStep3Action(Tx_Questionrating_Domain_Model_Question $question, Tx_Questionrating_Domain_Model_Rating $rating) {
		$rating->setFinalRating(1);
		$this->ratingRepository->update($rating);
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();

		$countFinalRating = $this->ratingRepository->countFinalRatingByQuestion($question);
		if ($countFinalRating >= 6) {
			$question->setStatus('review');
			$this->questionRepository->update($question);
		}
		$this->redirect('index', 'Question');
	}


	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param array $finalRatingValueArray
	 * @return void
	 * @todo validate using Extbase/Fluid if possible (see commentblock at end of this file)
	 */
	public function closeReviewAction(Tx_Questionrating_Domain_Model_Question $question, $finalRatingValueArray) {
		if ($this->isLeader) {
			$ratingOverall = 0;
			foreach ($question->getRatings() as $rating) {
				if (in_array($rating->getUid(),array_keys($finalRatingValueArray))) {
					$finalRatingValue = $finalRatingValueArray[$rating->getUid()];
						// @todo Extbase validator
					if ($finalRatingValue <= 100 && $finalRatingValue >= 0) {
						$rating->setFinalRatingValue($finalRatingValue);
					}
				}
				$ratingOverall += $rating->getFinalRatingValue();
			}
			$xmlitemRepository = t3lib_div::makeInstance('Tx_Questionrating_Utils_Repository_XmlitemRepository');
			$xmlitem = $xmlitemRepository->findById($question->getXmlId());
			$xmlitem->setStatus('rated');
			$xmlitem->setRating(round($ratingOverall / 6));
			$xmlitemRepository->update($xmlitem);
			$xmlitemRepository->moveToOutputDir($xmlitem);
			$question->setStatus('close');
			$this->questionRepository->update($question);
		}
		$this->redirect('index', 'Question');
	}

	/**
	 * @dontverifyrequesthash
	 *
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param array $ratings
	 * @return void
	 */
	/*
	 * temporary solution works but data is not validated
	 * http://lists.typo3.org/pipermail/typo3-project-typo3v4mvc/2010-January/002618.html
	 * mapAndValidate (bzw $targetObjectValidator->isValid) erwartet Tx_Extbase_MVC_Controller_Arguments und nicht wie in Doku steht object

<f:form method="post" controller="Rating" action="closeReview" name="question" object="{question}"  >
  <f:for each="{question.ratings}" as="rating">
    <div class="smallform smallform-sub rating">
      <p>
        <f:form.textbox name="ratings[{rating.uid}][finalRatingValue]" size="3" value="{rating.finalRatingValue}" />
        <f:form.hidden name="ratings[{rating.uid}][__identity]"  value="{rating.uid}"/>
      </p><br/>
    </div>
  </f:for>
</f:form>

	public function closeReviewAction(Tx_Questionrating_Domain_Model_Question $question, $ratings) {
		var_dump($question->getUid());
		//var_dump($this->propertyMapper->map(array('ratings'), array('ratings' => $ratings), $question));
		var_dump($this->propertyMapper->mapAndValidate(array('ratings'), array('ratings' => $ratings), $question,array(),t3lib_div::makeInstance('Tx_Extbase_MVC_Controller_ArgumentsValidator')));

	}
	*/
}
