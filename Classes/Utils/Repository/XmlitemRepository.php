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


class Tx_Questionrating_Utils_Repository_XmlitemRepository {

	/**
	 * @var string
	 */
	protected $uploadFolder;

	/**
	 * @var array
	 */
	protected $findAllResultCache = NULL;

	public function __construct() {
		$this->setUploadFolder('import/');
		$this->setOutputFolder('rated/');
	}

	public function findByStatus($status) {
		$result = array();
		$findAllResult = $this->findAll();
		foreach ($findAllResult as $current) {
			if ($current->getStatus() == $status) {
				$result[] = $current;
			}
		}
		return $result;
	}

	public function findById($id) {
		$result = array();
		$findAllResult = $this->findAll();
		foreach ($findAllResult as $current) {
			if ($current->getId() == $id) {
				$result[] = $current;
			}
		}
		return count($result) == 1 ? $result[0] : NULL;
	}


	public function findAll() {
		if ($this->findAllResultCache === NULL)  {
			$questionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_QuestionRepository');
			$xmlFiles = $this->getXmlFiles();
			$result = array();
			foreach ($xmlFiles as $currentFile) {
				$xmlitem = t3lib_div::makeInstance('Tx_Questionrating_Utils_Xmlitem');
				$xmlitem->loadXml($this->uploadFolder, $currentFile);
				$question = $questionRepository->findByXmlId($xmlitem->getId());
				if (count($question) > 0) {
					$xmlitem->setInDb(1);
				} else {
					$xmlitem->setInDb(0);
				}
				$result[] = $xmlitem;
			}
			$this->findAllResultCache = $result;
		} else {
			$result = $this->findAllResultCache;
		}
		return $result;
	}

	public function update(Tx_Questionrating_Utils_Xmlitem $xmlitem) {
		file_put_contents($xmlitem->getPathFilename(), $xmlitem->getXml()->asXML());
	}

	public function moveToOutputDir(Tx_Questionrating_Utils_Xmlitem $xmlitem) {
		rename($xmlitem->getPathFilename(), $this->outputFolder . $xmlitem->getFilename());
		$xmlitem->setPath($this->outputFolder);
	}

	protected function getXmlFiles() {
		$xmlFiles = array();
		$filesInUploaddir = scandir($this->uploadFolder);
		foreach ($filesInUploaddir as $currentFile) {
			if (strtolower(pathinfo($currentFile, PATHINFO_EXTENSION)) === 'xml') {
				$xmlFiles[] = $currentFile;
			}
		}
		return $xmlFiles;
	}

	public function setUploadFolder($folder) {
		$this->uploadFolder = t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT') . '/uploads/tx_questionrating/' . $folder;
		$this->createDir($this->uploadFolder);
	}

	public function setOutputFolder($folder) {
		$this->outputFolder = t3lib_div::getIndpEnv('TYPO3_DOCUMENT_ROOT') . '/uploads/tx_questionrating/' . $folder;
		$this->createDir($this->outputFolder);
	}

	protected function createDir($dir) {
		if (!is_dir($dir))
			t3lib_div::mkdir($dir);
	}

}
