<?php

class Tx_Questionrating_ViewHelpers_DisplayTextAndCodeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {


	/**
	 * @return string
	 */
	public function render() {
		$output = '';
		$content = $this->renderChildren();
		$codeOpenTags = explode('&lt;code&gt;', $content);
		$output .= $this->normalText($codeOpenTags[0]);
		unset($codeOpenTags[0]);
		foreach ($codeOpenTags as $codeOpenTag) {
			$parts = explode('&lt;/code&gt;', $codeOpenTag);
			if (count($parts) == 1) {
				$output .= $this->normalText($parts[0]);
			} else {
				$output .= $this->codeText($parts[0]);
				$output .= $this->normalText($parts[1]);
			}
		}
		return $output;
	}

	/**
	 * @param string $text
	 * @return string
	 */
	protected function normalText($text) {
		return nl2br($text);
	}

	/**
	 * @param string $text
	 * @return string
	 */
	protected function codeText($text) {
		return '<pre>' . $text . '</pre>';
	}

}