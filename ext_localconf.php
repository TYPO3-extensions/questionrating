<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
Tx_Extbase_Utility_Extension::configurePlugin($_EXTKEY, 'Pi1',
	array(
		'Question' => 'index,showStep1,showStep2,closeDiscussion,showStep3,showStep4,testAjax,toggleShowall,info',
		'Rating' => 'ratingStep1,ratingStep3,closeReview',
		'Ajax' => 'index,send',
		'Importer' => 'index,import'
	),
	array(
		'Question' => 'index,showStep1,closeDiscussion,toggleShowall',
		'Rating' => 'ratingStep1,ratingStep3,closeReview',
		'Ajax' => 'index,send',
		'Importer' => 'index,import'
	)
);

Tx_Extbase_Utility_Extension::configurePlugin($_EXTKEY, 'Pi2',
	array(
		'Review' => 'index,show,saveComment,editQuestion,saveQuestion',
		'Importer' => 'index,import'
	),
	array(
		'Review' => 'index,show,saveComment,editQuestion,saveQuestion',
		'Importer' => 'index,import'
	)
);