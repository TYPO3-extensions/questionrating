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

/**
 * A repository for Discussion
 */
class Tx_Questionrating_Domain_Repository_DiscussionRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return mixed Tx_Questionrating_Domain_Model_Discussion
	 */
	public function findByQuestionAndFromUser(Tx_Questionrating_Domain_Model_Question $question, Tx_Extbase_Domain_Model_FrontendUser $user) {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->equals('question', $question),
					$query->equals('from_user', $user)
				)
			)->execute();
		return $result;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return mixed Tx_Questionrating_Domain_Model_Discussion
	 */
	public function findByQuestionAndToUser(Tx_Questionrating_Domain_Model_Question $question, Tx_Extbase_Domain_Model_FrontendUser $user) {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->equals('question', $question),
					$query->equals('to_user', $user)
				)
			)->execute();
		return $result;
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param string $route
	 * @param array $userUidArray
	 * @param integer $getLeader
	 * @return mixed Tx_Questionrating_Domain_Model_Discussion
	 */
	public function findByQuestionAndFilter(Tx_Questionrating_Domain_Model_Question $question, $route, $userUidArray, $getLeader = 0) {
		$query = $this->createQuery();
		$userQuery = NULL;

			// @todo find a cleaner solution
		switch($route) {
			case 'to':
				if($getLeader) {
					$userQuery = $query->logicalOr(
						$query->equals('to_user', $userUidArray),
						$query->equals('to_leader', $getLeader)
					);
				}
				else {
					$userQuery = $query->logicalAnd(
						$query->equals('to_user', $userUidArray),
						$query->equals('to_leader', $getLeader)
					);
				}
				break;
			case 'from':
				if($getLeader) {
					$userQuery = $query->logicalOr(
						$query->equals('from_user', $userUidArray),
						$query->equals('from_leader', $getLeader)
					);
				}
				else {
					$userQuery = $query->logicalAnd(
						$query->equals('from_user', $userUidArray),
						$query->equals('from_leader', $getLeader)
					);
				}
				break;
			default :
				$userQuery = $query->logicalOr(
					$query->equals('to_user', $userUidArray),
					$query->equals('from_user', $userUidArray)
				);

				if($getLeader) {
					$leaderQuery = $query->logicalOr(
						$query->equals('to_leader', $getLeader),
						$query->equals('from_leader', $getLeader)
					);
					$userQuery = $query->logicalOr($userQuery, $leaderQuery);
				}
				else {
					// form_user = 0 OR to_user = 0 AND (to_user = 0 AND to_leader = 0 OR from_user = 0 AND from_leader = 0)
					$toleaderQuery = $query->logicalAnd(
						$query->equals('to_user', $userUidArray),
						$query->equals('to_leader', $getLeader)
					);
					$fromleaderQuery = $query->logicalAnd(
						$query->equals('from_user', $userUidArray),
						$query->equals('from_leader', $getLeader)
					);
					$leaderQuery = $query->logicalOr($toleaderQuery, $fromleaderQuery);
					$userQuery = $query->logicalAnd($userQuery, $leaderQuery);
				}
				break;
		}

		$result = $query->matching(
			$query->logicalAnd(
				$userQuery,
				$query->equals('question', $question)
			)
		)->execute();

		return $result;
	}
}
