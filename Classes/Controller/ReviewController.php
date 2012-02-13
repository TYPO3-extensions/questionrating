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


class Tx_Questionrating_Controller_ReviewController extends Tx_Questionrating_Controller_BaseController {


	/**
	 * @var Tx_Questionrating_Domain_Repository_ReviewRepository
	 */
	protected $reviewRepository;

	/**
	 * @var Tx_Questionrating_Domain_Repository_ReviewcommentRepository
	 */
	protected $reviewcommentRepository;


	/**
	 * @var Tx_Questionrating_Utils_Repository_XmlitemRepository
	 */
	protected $xmlitemRepository;

	/**
	 * @var integer
	 */
	protected $technicalVotesNeeded;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->reviewRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_ReviewRepository');
		$this->reviewcommentRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_ReviewcommentRepository');
		$this->xmlitemRepository = t3lib_div::makeInstance('Tx_Questionrating_Utils_Repository_XmlitemRepository');
		$this->xmlitemRepository->setUploadFolder('review/');
		$this->xmlitemRepository->setOutputFolder('import/');
		$this->technicalVotesNeeded = empty($this->settings['technicalReviewVotes']) 
			? 2 
			: intval($this->settings['technicalReviewVotes']);
	}

	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		parent::initializeView($view);
		if (!$this->isReview && !$this->isLeader) {
			throw new Tx_Extbase_Exception('forbidden');
		}
	}

	/**
	 * Index action for this controller.
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->xmlitemRepository->setUploadFolder('');
		$this->xmlitemRepository->setOutputFolder('review/');
		$xmlitemArray = $this->xmlitemRepository->findByStatus('experts');
		// $xmlitemArray = $this->xmlitemRepository->findByStatus('rating');
		foreach ($xmlitemArray as $xmlitem) {
			$review = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Review');
			$review->setXmlId($xmlitem->getId());
			$review->setHeadline($xmlitem->getQuestiontext());
			$review->setStatus('technical');
			$this->reviewRepository->add($review);
			$this->xmlitemRepository->moveToOutputDir($xmlitem);
		}
		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();
		if ($this->isTechnicalReview || $this->isLeader) {
			$technicalReviews = $this->reviewRepository->findByStatus('technical');
			$this->view->assign('technicalReviews', $technicalReviews);
		}

		if ($this->isTranslationReview || $this->isLeader) {
			$translationReviews = $this->reviewRepository->findByStatus('translation');
			$this->view->assign('translationReviews', $translationReviews);
		}

	}

	/**
	 * Show action for this controller.
	 *
	 * @param Tx_Questionrating_Domain_Model_Review $review
	 * @param Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment
	 * @param string $vote
	 * @return void
	 *
	 * @dontvalidate $reviewcomment
	 * @dontvalidate $vote
	 */
	public function showAction(Tx_Questionrating_Domain_Model_Review $review, Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment = NULL, $vote = 0) {
		$status = $review->getStatus();
		if ($status == 'technical') {
			$xmlitem = $this->xmlitemRepository->findById($review->getXmlid());
			$question = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Question');
			$question->importXmlitem($xmlitem);
			$this->view->assign('review', $review);
			$this->view->assign('vote', $vote);
			$this->view->assign('question', $question);
			$this->view->assign('reviewcomment', $reviewcomment);
		} elseif ($status == 'translation') {
			$this->redirect('editQuestion', 'Review', NULL, array('review'=>$review));
		} else {
			$this->redirect('index');
		}
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Review $review
	 * @param Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment
	 * @param string $vote
	 * @return void
	 */
	public function saveCommentAction(Tx_Questionrating_Domain_Model_Review $review, Tx_Questionrating_Domain_Model_Reviewcomment $reviewcomment, $vote = 0) {
		$message = $reviewcomment->getMessage();
		if ($vote) {
			$votes = $review->getVotes()+1;
			$review->setVotes($votes);
			$message .= "\n Autocomment: Review ok";

			if ($votes >= $this->technicalVotesNeeded) {
				$review->setStatus('translation');
			}
		}

		$message = trim($message);

		if (!empty($message)) {
			$reviewcomment->setMessage($message);
			$reviewcomment->setUser($this->currentUser);
			$reviewcomment->setReview($review);
			$review->addReviewcomment($reviewcomment);
			$this->reviewcommentRepository->add($reviewcomment);
		}

		// $this->redirect('show', 'Review', NULL, array('review'=>$review));
		$this->redirect('index');
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Review $review
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return string The rendered view
	 *
	 * @dontvalidate $question
	 * @dontverifyrequesthash
	 */
	public function editQuestionAction(Tx_Questionrating_Domain_Model_Review $review, Tx_Questionrating_Domain_Model_Question $question = NULL) {
		if ($question === NULL) {
			$xmlitem = $this->xmlitemRepository->findById($review->getXmlid());
			$question = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Question');
			$question->importXmlitem($xmlitem);
		}
		$status = $review->getStatus();
		if ($status == 'technical') {
			$setCorrectAnswer = 1;
		} else {
			$setCorrectAnswer = 0;
		}
		$this->view->assign('setCorrectAnswer', $setCorrectAnswer);
		$this->view->assign('review', $review);
		$this->view->assign('question', $question);
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Review $review
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param array $correctanswer
	 * @return void
	 *
	 * @dontverifyrequesthash
	 *
	 */
	public function saveQuestionAction(Tx_Questionrating_Domain_Model_Review $review, Tx_Questionrating_Domain_Model_Question $question, $correctanswer = NULL) {
		$moveXmlitemToOutputDir = FALSE;
		$status = $review->getStatus();
		$review->setHeadline($question->getQuestionTitle());
		if ($status == 'technical') {
			$question->setCorrectanswer($correctanswer);
			$review->setVotes(0);
			$reviewcomment = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Reviewcomment');
			$reviewcomment->setMessage('Autocomment: Question updated');
			$reviewcomment->setUser($this->currentUser);
			$reviewcomment->setReview($review);
			$review->addReviewcomment($reviewcomment);
			$this->reviewcommentRepository->add($reviewcomment);
		} elseif ($status == 'translation') {
			$review->setStatus('close');
			$moveXmlitemToOutputDir = TRUE;
		}
		$xmlitem = $this->xmlitemRepository->findById($review->getXmlid());
		$xmlitem->updateByQuestion($question);
		$this->xmlitemRepository->update($xmlitem);
		$this->reviewRepository->update($review);

		if ($moveXmlitemToOutputDir) {
			$this->xmlitemRepository->moveToOutputDir($xmlitem);
		}

		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();
		// $this->redirect('editQuestion', 'Review', NULL, array('review'=>$review));
		$this->redirect('show', 'Review', NULL, array('review' => $review));
	}

}
