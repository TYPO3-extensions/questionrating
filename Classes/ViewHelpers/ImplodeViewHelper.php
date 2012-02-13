<?php

class Tx_Questionrating_ViewHelpers_ImplodeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {


	/**
	 * @param array $array
	 * @param string $glue
	 * @return string
	 */
	public function render($array, $glue = ',') {
		return implode($glue, $array);
	}
}