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
 * A repository for Rating
 */
 
class Tx_Questionrating_Domain_Repository_RatingRepository extends Tx_Extbase_Persistence_Repository {
	
	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Extbase_Domain_Model_FrontendUser $user
	 * @return mixed Tx_Questionrating_Domain_Model_Rating
	 */
	public function findByQuestionAndUser(Tx_Questionrating_Domain_Model_Question $question, 
		Tx_Extbase_Domain_Model_FrontendUser $user) {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->equals('question', $question),
					$query->equals('user', $user)
				)
			)->execute();
		return $result[0];
	}

	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @return integer
	 */	
	public function countFinalRatingByQuestion(Tx_Questionrating_Domain_Model_Question $question) {
		$query = $this->createQuery();
		$result = $query->matching(
				$query->logicalAnd(
					$query->equals('question',$question),
					$query->equals('final_rating', '1')
				)
			)->execute();
		return count($result);
	}
}