<?php

class Tx_Questionrating_ViewHelpers_ForViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	* @param integer $start The searched value
	* @param integer $until The array
	* @param string $as
	* @param array $array
	* @param string $arrayValue
	*
	* @return string
	*/
	public function render($start, $until, $as = null, $array = null, $arrayValue = null) {
		$returnValue = '';
		if (is_object($array)) {
			if (!$array instanceof Traversable) {
				throw new Tx_Fluid_Core_ViewHelper_Exception('ForViewHelper only supports arrays and objects implementing Traversable interface' , 1248728393);
			}
			$array = $this->convertToArray($array);
		}
		for($i = (int)$start; $i<(int)$until; $i++) {
			if ($array !== null && $arrayValue !== null && count($array) > $i) {
				$this->templateVariableContainer->add($arrayValue, $array[$i]);
			} elseif($arrayValue !== null) {
				$this->templateVariableContainer->add($arrayValue, null);
			}
			if($as !== null) {
				$this->templateVariableContainer->add($as, $i);
			}

			$returnValue .= $this->renderChildren();

			if ($arrayValue !== null) {
				$this->templateVariableContainer->remove($arrayValue);
			}
			if ($as !== null) {
				$this->templateVariableContainer->remove($as);
			}
		}
		return $returnValue;
	}


	 /**
	 * copied from class Tx_Fluid_ViewHelpers_ForViewHelper
	 *
	 * Turns the given object into an array.
	 * The object has to implement the Traversable interface
	 *
	 * @param Traversable $object The object to be turned into an array. If the object implements Iterator the key will be preserved.
	 * @return array The resulting array
	 * @author Bastian Waidelich <bastian@typo3.org>
	 */
	protected function convertToArray(Traversable $object) {
		$array = array();
		foreach ($object as $keyValue => $singleElement) {
			// $array[$keyValue] = $singleElement;
			$array[] = $singleElement;
		}
		return $array;
	}

}