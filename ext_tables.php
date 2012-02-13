<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Pi1', 'Question');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Pi2', 'Review');

	// Disable the display of layout, select_key and page fields
$TCA['tt_content']['types']['list']['subtypes_excludelist']['questionrating_pi1'] = 'layout,select_key,pages';
$TCA['tt_content']['types']['list']['subtypes_excludelist']['questionrating_pi2'] = 'layout,select_key,pages';

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'questionrating');

$TCA['tx_questionrating_domain_model_question'] = array (
	'ctrl' => array (
		'title'          => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question',
		'label'          => 'uid',
		'tstamp'         => 'tstamp',
		'crdate'         => 'crdate',
		'cruser_id'      => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete'         => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_questionrating_question.gif',
	),
);

$TCA['tx_questionrating_domain_model_rating'] = array (
	'ctrl' => array (
		'title'          => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating',
		'label'          => 'uid',
		'tstamp'         => 'tstamp',
		'crdate'         => 'crdate',
		'cruser_id'      => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete'         => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_questionrating_rating.gif',
	),
);

$TCA['tx_questionrating_domain_model_discussion'] = array (
	'ctrl' => array (
		'title'          => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion',
		'label'          => 'uid',
		'tstamp'         => 'tstamp',
		'crdate'         => 'crdate',
		'cruser_id'      => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete'         => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_questionrating_discussion.gif',
	),
);

$TCA['tx_questionrating_domain_model_review'] = array (
	'ctrl' => array (
		'title'          => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review',
		'label'          => 'uid',
		'tstamp'         => 'tstamp',
		'crdate'         => 'crdate',
		'cruser_id'      => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete'         => 'deleted',
		'enablecolumns'  => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_questionrating_review.gif',
	),
);

$TCA['tx_questionrating_domain_model_reviewcomment'] = array (
	'ctrl' => array (
		'title'          => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_reviewcomment',
		'label'          => 'uid',
		'tstamp'         => 'tstamp',
		'crdate'         => 'crdate',
		'cruser_id'      => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete'         => 'deleted',
		'enablecolumns'  => array (
			'disabled'   => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/icon_tx_questionrating_reviewcomment.gif',
	),
);


$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');