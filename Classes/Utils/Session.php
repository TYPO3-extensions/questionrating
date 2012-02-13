<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 <>
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


class Tx_Questionrating_Utils_Session {

	/**
	 * @var string
	 */
	protected $sessionPrefix = 'Questionrating';

	/**
	 * @var array
	 */
	protected $sessionData = 'Questionrating';	

	/**
	 * @return void
	 */
	public function __construct() {
		$this->sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', $this->sessionPrefix);
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function set($key,$value) {
		$this->sessionData[$key] = $value;
		$GLOBALS['TSFE']->fe_user->setKey('ses', $this->sessionPrefix, $this->sessionData);
		$GLOBALS['TSFE']->storeSessionData();
	}

	/**
	 * @param string $key
	 * @return array session-data entry
	 */
	public function get($key) {
		return $this->sessionData[$key];
	}

}