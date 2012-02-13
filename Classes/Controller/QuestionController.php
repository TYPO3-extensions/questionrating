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


class Tx_Questionrating_Controller_QuestionController extends Tx_Questionrating_Controller_BaseController {

	/**
	 * @var Tx_Questionrating_Domain_Repository_QuestionRepository
	 */
	protected $questionRepository;

	/**
	 * @var Tx_Questionrating_Domain_Repository_RatingRepository
	 */
	protected $ratingRepository;

	/**
	 * @var Tx_Questionrating_Domain_Repository_DiscussionRepository
	 */
	protected $discussionRepository;

	/**
	 * @var Tx_Questionrating_Utils_Session
	 */
	protected $session;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->session = t3lib_div::makeInstance('Tx_Questionrating_Utils_Session');
		$this->questionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_QuestionRepository');
		$this->ratingRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_RatingRepository');
		$this->discussionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_DiscussionRepository');
	}

	/**
	 * Index action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
		$this->view->assign('showall', $this->session->get('showall'));
		$this->view->assign('openQuestions', $this->questionRepository->findByStatusAndIsActive('open'));

		if ($this->session->get('showall') || $this->isLeader) {
			$discussQuestions = $this->questionRepository->findByStatusAndIsActive('discuss');
			$finalQuestions = $this->questionRepository->findByStatusFinalOrReview();
			$closeQuestions = $this->questionRepository->findByStatusAndIsActive('close');
		} else {
			$discussQuestions = $this->questionRepository->findByStatusAndUser('discuss', $this->currentUser);
			$finalQuestions = $this->questionRepository->findByStatusFinalOrReviewAndUser($this->currentUser);
			$closeQuestions = $this->questionRepository->findByStatusAndUser('close', $this->currentUser);
		}
		$this->view->assign('discussQuestions', $discussQuestions);
		$this->view->assign('finalQuestions', $finalQuestions);
		$this->view->assign('closeQuestions', $closeQuestions);
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Questionrating_Domain_Model_Rating $rating
	 * @param string $message
	 * @return void
	 *
	 * @dontvalidate $rating
	 */
	public function showStep1Action(Tx_Questionrating_Domain_Model_Question $question, Tx_Questionrating_Domain_Model_Rating $rating = NULL, $message = '') {
		$allowEdit = 1;
		if ($rating == NULL) {
			if (!$this->isLeader) {
				$rating = $this->ratingRepository->findByQuestionAndUser($question, $this->currentUser);
				if (empty($rating)) {
					$rating = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Rating');
					$rating->setUser($this->currentUser);
					$rating->setQuestion($question);
					$this->ratingRepository->add($rating);
					$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
					$persistenceManager->persistAll();
				} elseif ($rating->getRatingValue() !== NULL) {
					$discussions = $this->discussionRepository->findByQuestionAndFromUser($question, $this->currentUser);
					if (!empty($discussions) && is_object($discussions[0])) {
						$message = $discussions[0]->getMessage();
					}
					if ($rating->getRatingValue() > 0) {
						$allowEdit = 0;
					}
				}
			}
			$allRatings = $this->ratingRepository->findByQuestion($question);
			if (count($allRatings) >= 6) {
				$question->setStatus('discuss');
				$this->questionRepository->update($question);
			}
		}
		$this->view->assign('question', $question);
		$this->view->assign('rating', $rating);
		$this->view->assign('message', $message);
		$this->view->assign('allowEdit', $allowEdit);
	}


	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return void
	 */
	public function showStep2Action(Tx_Questionrating_Domain_Model_Question $question) {
		$this->assignRatingArray($question);
		$allowDiscussion = 0;
		$rating = $this->ratingRepository->findByQuestionAndUser($question, $this->currentUser);
		if (!empty($rating) || $this->isLeader)
			$allowDiscussion = 1;
		$this->view->assign('question', $question);
		$this->view->assign('allowDiscussion', $allowDiscussion);
		$this->generateDiscussionJsCode($question, $allowDiscussion);
	}


	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return void
	 */
	public function closeDiscussionAction(Tx_Questionrating_Domain_Model_Question $question) {
		if ($this->isLeader) {
			$question->setStatus('final');
			$this->questionRepository->update($question);
		}
		$this->redirect('index');
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Questionrating_Domain_Model_Rating $rating
	 * @return void
	 *
	 * @dontvalidate $rating
	 */
	public function showStep3Action(Tx_Questionrating_Domain_Model_Question $question, Tx_Questionrating_Domain_Model_Rating $rating = NULL) {
		$renderFinalRatingBox = FALSE;
		$renderFinalRatingReviewBox = FALSE;
		if (!$this->isLeader) {
			$finalRating = $this->ratingRepository->findByQuestionAndUser($question, $this->currentUser);
			if (!empty($finalRating) && !$finalRating->getFinalRating()) {
				$renderFinalRatingBox = TRUE;
				if ($rating != NULL) {
					$finalRating = $rating;
				}
				$this->view->assign('finalRating', $finalRating);
			}
		} elseif ($question->getStatus() == 'review') {
			$renderFinalRatingReviewBox = TRUE;
		}

		$this->view->assign('renderFinalRatingBox', $renderFinalRatingBox);
		$this->view->assign('renderFinalViewBox', !$renderFinalRatingBox);
		$this->view->assign('renderFinalRatingReviewBox', $renderFinalRatingReviewBox);
		$this->assignRatingArray($question);
		$this->view->assign('question', $question);
		$this->generateDiscussionJsCode($question, 0);
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return void
	 */
	public function showStep4Action(Tx_Questionrating_Domain_Model_Question $question) {
		if ($this->isLeader) {
			$ratingOverall = 0;
			foreach ($question->getRatings() as $rating) {
				$ratingOverall += $rating->getFinalRatingValue();
			}
			$this->view->assign('ratingOverall', round($ratingOverall/6));
			$allowDiscussion = 0;
			$this->assignRatingArray($question);
			$this->view->assign('question', $question);
			$this->view->assign('allowDiscussion', $allowDiscussion);
			$this->generateDiscussionJsCode($question, $allowDiscussion);
		} else {
			$this->redirect('index');
		}
	}

	/**
	 * @return void
	 */
	public function toggleShowallAction() {
		$showall = $this->session->get('showall');
		$showall = $showall ? FALSE : TRUE;

		$this->session->set('showall', $showall);
		$this->redirect('index');
	}

	/**
	 * Info action for this controller.
	 *
	 * @return void
	 */
	public function infoAction() {
		$this->view->assign('infoText', $this->settings['infoText']);
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param integer $allowDiscussion
	 * @return void
	 */
	protected function generateDiscussionJsCode(Tx_Questionrating_Domain_Model_Question $question, $allowDiscussion) {
		$this->initializeExtJSAction();
		$this->uriBuilder->setTargetPageType(1268404925);
		$this->uriBuilder->setFormat('html');
		$ajaxUrl = $this->uriBuilder->uriFor('index', array(), 'Ajax');
		$ajaxGetMessageUrl = $this->uriBuilder->uriFor('index', array('question'=>$question), 'Ajax');
		$ajaxSendMessageUrl = $this->uriBuilder->uriFor('send', array('question'=>$question), 'Ajax');
		$this->addJsFile('extjs_discussion.js');

			// variables
		$this->addJsInlineCode('
			this.allowDiscussion = ' . $allowDiscussion . ';
			Questionrating.Question.include.init(this);
			this.params = {};
			this.ajaxGetMessageUrl = "' . $ajaxGetMessageUrl . '";
			this.ajaxSendMessageUrl = "' . $ajaxSendMessageUrl . '";
			this.extKey = "tx_questionrating_pi1";
			this.messageBodyUpdater = new Ext.Updater("messageBody");
			this.currentUserId = ' . $this->currentUser->getUid() . ';

			this.params[this.extKey+"[filter]"] = "both";
			this.messageBodyUpdater.showLoadIndicator = null;
			this.messageBodyUpdater.startAutoRefresh(100,this.ajaxGetMessageUrl,this.params);
		');

		$this->outputJsCode();
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return void
	 */
	protected function assignRatingArray(Tx_Questionrating_Domain_Model_Question $question) {
		$ratingArray = array();
		$allowPost = $this->isLeader ? TRUE : FALSE;
		foreach ($question->getRatings() as $currentRating) {
			$ratingInfos = array();
			$ratingInfos['rating'] = $currentRating;
			$fromUserResult = $this->discussionRepository->findByQuestionAndFromUser($question, $currentRating->getUser());
			$ratingInfos['sendcount'] = empty($fromUserResult) ? 0 : count($fromUserResult);
			$toUserResult = $this->discussionRepository->findByQuestionAndToUser($question, $currentRating->getUser());
			$ratingInfos['receivecount'] = empty($toUserResult) ? 0 : count($toUserResult);
			$ratingArray[] = $ratingInfos;
			if ($currentRating->getUser() == $this->currentUser) {
				$allowPost = TRUE;
			}
		}
		$this->view->assign('allowPost', $allowPost);
		$this->view->assign('ratingArray', $ratingArray);
	}

}
