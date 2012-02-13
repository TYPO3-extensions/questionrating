<?php

/*
 * 
 * <f:if condition="{dw:inArray(needle:'{inquiryObj.name}' array:'{testarray}')}">
 * <f:then>
 * JA
 * </f:then>
 * <f:else>
 * NEIN
 * </f:else>
 * </f:if>
 */


class Tx_Questionrating_ViewHelpers_InArrayViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	* @param mixed $needle The searched value
	* @param mixed $array The array
	* @param boolean
	*/
	public function render($needle, $array) {
		if (is_object($array)) {
			if (!$array instanceof Traversable) {
				throw new Tx_Fluid_Core_ViewHelper_Exception('InArrayViewHelper only supports arrays and objects implementing Traversable interface' , 1248728393);
			}
			$array = $this->convertToArray($array);
		}
		return in_array($needle, $array);
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
			$array[$keyValue] = $singleElement;
		}
		return $array;
	}
}
