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
 * A repository for Question
 */
class Tx_Questionrating_Domain_Repository_QuestionRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * @return mixed
	 */
	public function findByStatusFinalOrReview() {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->logicalOr(
						$query->equals('status', 'final'),
						$query->equals('status', 'review')
					),
					$query->equals('active', '1')
				)
			)->execute();
		return $result;
	}

	/**
	 * @param string $status
	 * @return mixed
	 */
	public function findByStatusAndIsActive($status) {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->equals('status', $status),
					$query->equals('active', '1')
				)
			)->execute();
		return $result;
	}

	/**
	 * @param string $status
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 */
	public function findByStatusAndUser($status, Tx_Extbase_Domain_Model_FrontendUser $user) {
		$query = $this->createQuery();
		$result = $query->statement('SELECT question.* FROM ' .
											'tx_questionrating_domain_model_question as question, ' .
											'tx_questionrating_domain_model_rating as rating ' .
											'WHERE ' .
											'question.status = "' . $status . '" AND ' .
											'question.active = 1 AND ' .
											'question.uid = rating.question AND ' .
											'rating.user = ' . $user->getUid()
									)->execute();
		return $result;
	}

	/**
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 */
	public function findByStatusFinalOrReviewAndUser(Tx_Extbase_Domain_Model_FrontendUser $user) {
		$query = $this->createQuery();
		$result = $query->statement('SELECT question.* FROM ' .
											'tx_questionrating_domain_model_question as question, ' .
											'tx_questionrating_domain_model_rating as rating ' .
											'WHERE ' .
											'(question.status = "final" OR ' .
											'question.status = "review") AND ' .
											'question.active = 1 AND ' .
											'question.uid = rating.question AND ' .
											'rating.user = ' . $user->getUid()
									)->execute();
		return $result;
	}

}