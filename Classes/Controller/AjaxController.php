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


class Tx_Questionrating_Controller_AjaxController extends Tx_Questionrating_Controller_BaseController {


	/**
	 * @var Tx_Questionrating_Domain_Repository_RatingRepository
	 */
	protected $ratingRepository;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->ratingRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_RatingRepository');
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param string $filter
	 * @return void
	 */
	public function indexAction(Tx_Questionrating_Domain_Model_Question $question, $filter) {
		$discussionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_DiscussionRepository');
		$filterArray = explode(',', $filter);
		$route = $filterArray[0];
		$getLeader = 0;
		unset($filterArray[0]);
		if (count($filterArray) > 0) {
			if($key = array_search('-1', $filterArray)) {
				$getLeader = 1;
			}
			$discussions = $discussionRepository->findByQuestionAndFilter($question, $route, $filterArray, $getLeader);
		}
		else {
			$discussions = $question->getDiscussions();
		}
		$allowDiscussion = 0;
		$rating = $this->ratingRepository->findByQuestionAndUser($question, $this->currentUser);
		if ((!empty($rating) || $this->isLeader) && ($question->getStatus() == 'discuss')) {
			$allowDiscussion = 1;
		}
		$this->view->assign('allowDiscussion', $allowDiscussion);
		$this->view->assign('discussions', $discussions);
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param string $toUser
	 * @param string $message
	 * @param string $filter
	 * @return void
	 */
	public function sendAction(Tx_Questionrating_Domain_Model_Question $question, $toUser, $message, $filter) {
		$rating = $this->ratingRepository->findByQuestionAndUser($question, $this->currentUser);
		if ($question->getStatus() == 'discuss' && (!empty($rating) || $this->isLeader)) {
			$message = $GLOBALS['TSFE']->csConvObj->conv($message, 'utf-8', $GLOBALS['TSFE']->renderCharset);
			if (!empty($message) && (($currentUser->uid != $toUser) || ($this->isLeader && $toUser != -1 ))) {
				$newDiscussion = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Discussion');
				$newDiscussion->setMessage($message);
				$newDiscussion->setFromUser($this->currentUser);
				$newDiscussion->setFromLeader($this->isLeader);
				if ($toUser > 0) {
					$user = $this->userRepository->findByUid((int)$toUser);
					$newDiscussion->setToUser($user);
				} elseif($toUser < 0) {
					$newDiscussion->setToLeader(1);
				}
				$newDiscussion->setQuestion($question);
				$question->addDiscussion($newDiscussion);
			}
			// $persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
			// $persistenceManager->persistAll();
		}
		$this->uriBuilder->setTargetPageType(1268404925);
		$this->uriBuilder->setFormat('html');
		$ajaxGetMessageUrl = $this->uriBuilder->uriFor('index', array('question' => $question, 'filter' => $filter), 'Ajax');
		$this->redirectToURI($ajaxGetMessageUrl);
	}

}