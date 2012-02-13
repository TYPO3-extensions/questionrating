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


class Tx_Questionrating_Controller_ImporterController extends Tx_Questionrating_Controller_BaseController {

	/**
	 * @var Tx_Questionrating_Domain_Repository_QuestionRepository
	 */
	protected $questionRepository;

	/**
	 * @var Tx_Questionrating_Utils_Repository_XmlitemRepository
	 */
	protected $xmlitemRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->questionRepository = t3lib_div::makeInstance('Tx_Questionrating_Domain_Repository_QuestionRepository');
		$this->xmlitemRepository = t3lib_div::makeInstance('Tx_Questionrating_Utils_Repository_XmlitemRepository');
	}

	/**
	 * Initializes the current view
	 *
	 * @return void
	 */
	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		parent::initializeView($view);
		if (!$this->isLeader) {
			$this->redirect('index', 'Question');
		}
	}

	/**
	 * Index action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function indexAction() {
		$xmlitemArray = $this->xmlitemRepository->findByStatus('experts');
		$this->view->assign('xmlitemArray', $xmlitemArray);
	}

	/**
	 * Import a question from XML-file to DB
	 *
	 * @param array $importIds
	 * @return void
	 */
	public function importAction($importIds) {
		$importXmlitems = array();
		foreach ($importIds as $id) {
			$xmlitem = $this->xmlitemRepository->findById($id);
			if ($xmlitem->getInDb()) {
				$questions = $this->questionRepository->findByXmlId($xmlitem->getId());
				foreach ($questions as $question) {
					$question->setActive(FALSE);
					$this->questionRepository->update($question);
				}
			}
			$question = t3lib_div::makeInstance('Tx_Questionrating_Domain_Model_Question');
			$question->importXmlitem($xmlitem);
			$this->questionRepository->add($question);
			$xmlitem->setStatus('rating');
			$this->xmlitemRepository->update($xmlitem);
		}
		$this->redirect('index', 'Question');
	}

}