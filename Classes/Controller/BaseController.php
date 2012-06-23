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
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


class Tx_Questionrating_Controller_BaseController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		$this->userRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserRepository');
		$this->groupRepository = t3lib_div::makeInstance('Tx_Extbase_Domain_Repository_FrontendUserGroupRepository');
		if ($GLOBALS['TSFE']->fe_user->user['uid'] != NULL) {
			$this->currentUser = $this->userRepository->findByUid((int) $GLOBALS['TSFE']->fe_user->user['uid']);
			$view->assign('currentUser', $this->currentUser);
			if ($this->settings['leaderGroupUid'] != NULL) {
				$this->leaderGroup = $this->groupRepository->findByUid(intval($this->settings['leaderGroupUid']));
			} else {
				throw new Tx_Extbase_Exception('leaderGroupUid must be set');
			}
			$view->assign('leaderGroup', $this->leaderGroup);

			if ($this->settings['technicalReviewGroupUid'] != NULL) {
				$this->technicalReviewGroup = $this->groupRepository->findByUid(intval($this->settings['technicalReviewGroupUid']));
				$view->assign('technicalReviewGroup', $this->technicalReviewGroup);
			}
			if ($this->settings['translationReviewGroupUid'] != NULL) {
				$this->translationReviewGroup = $this->groupRepository->findByUid(intval($this->settings['translationReviewGroupUid']));
				$view->assign('translationReviewGroup', $this->translationReviewGroup);
			}

			$groups = $this->currentUser->getUsergroup();
			$this->isLeader = 0;
			$this->isReview = 0;
			$this->isTechnicalReview = 0;
			$this->isTranslationReview = 0;
			foreach ($groups as $group) {
				$currentGroupUid = $group->getUid();
				if ($currentGroupUid == $this->leaderGroup->getUid()) {
					$this->isLeader = 1;
				}
				if ($currentGroupUid == $this->technicalReviewGroup->getUid()) {
					$this->isTechnicalReview = 1;
				}
				if ($currentGroupUid == $this->translationReviewGroup->getUid()) {
					$this->isTranslationReview = 1;
				}
			}
			if ($this->isTechnicalReview || $this->isTranslationReview) {
				$this->isReview = 1;
			}
			$view->assign('isLeader', $this->isLeader);
			$view->assign('isReview', $this->isReview);
			$view->assign('isTechnicalReview', $this->isTechnicalReview);
			$view->assign('isTranslationReview', $this->isTranslationReview);
		} else {
			throw new Tx_Extbase_Exception('you are not logged in');
		}
		parent::initializeView($view);
	}
}
