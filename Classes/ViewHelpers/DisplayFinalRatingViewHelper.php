<?php

class Tx_Questionrating_ViewHelpers_DisplayFinalRatingViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {


	/**
	 * @param Tx_Questionrating_Domain_Model_Question $question
	 * @param Tx_Extbase_Domain_Model_FrontendUser $currentUser
	 * @return boolean
	 */
	public function render($question, $currentUser) {
		$displayFinalRating = TRUE;
		foreach($question->getRatings() as $rating) {
			if($rating->getUser() == $currentUser && !$rating->getFinalRating()) {
				$displayFinalRating = FALSE;
			}
		}
		return $displayFinalRating;
	}
}