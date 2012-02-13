<?php

########################################################################
# Extension Manager/Repository config file for ext "questionrating".
#
# Auto generated 17-06-2011 14:12
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Questionrating',
	'description' => '',
	'category' => 'plugin',
	'author' => '',
	'author_email' => '',
	'shy' => '',
	'dependencies' => 'extbase,fluid,mvc_extjs',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'php' => '5.2.0-0.0.0',
			'typo3' => '4.5.0-0.0.0',
			'extbase' => '0.0.0-0.0.0',
			'fluid' => '0.0.0-0.0.0',
			'mvc_extjs' => '0.0.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:67:{s:17:"ext_localconf.php";s:4:"4641";s:14:"ext_tables.php";s:4:"e254";s:14:"ext_tables.sql";s:4:"138d";s:37:"Classes/Controller/AjaxController.php";s:4:"9fca";s:37:"Classes/Controller/BaseController.php";s:4:"a0de";s:41:"Classes/Controller/ImporterController.php";s:4:"d815";s:41:"Classes/Controller/QuestionController.php";s:4:"2904";s:39:"Classes/Controller/RatingController.php";s:4:"2f92";s:39:"Classes/Controller/ReviewController.php";s:4:"32fa";s:35:"Classes/Domain/Model/Discussion.php";s:4:"16f6";s:33:"Classes/Domain/Model/Question.php";s:4:"700d";s:31:"Classes/Domain/Model/Rating.php";s:4:"3272";s:31:"Classes/Domain/Model/Review.php";s:4:"179c";s:38:"Classes/Domain/Model/Reviewcomment.php";s:4:"4afa";s:50:"Classes/Domain/Repository/DiscussionRepository.php";s:4:"b094";s:48:"Classes/Domain/Repository/QuestionRepository.php";s:4:"2cda";s:46:"Classes/Domain/Repository/RatingRepository.php";s:4:"b841";s:46:"Classes/Domain/Repository/ReviewRepository.php";s:4:"49f0";s:53:"Classes/Domain/Repository/ReviewcommentRepository.php";s:4:"34e6";s:25:"Classes/Utils/Session.php";s:4:"df3a";s:25:"Classes/Utils/Xmlitem.php";s:4:"0fae";s:46:"Classes/Utils/Repository/XmlitemRepository.php";s:4:"5b52";s:52:"Classes/ViewHelpers/DisplayFinalRatingViewHelper.php";s:4:"097b";s:52:"Classes/ViewHelpers/DisplayTextAndCodeViewHelper.php";s:4:"3bde";s:37:"Classes/ViewHelpers/ForViewHelper.php";s:4:"5d3a";s:41:"Classes/ViewHelpers/ForeachViewHelper.php";s:4:"cf33";s:41:"Classes/ViewHelpers/ImplodeViewHelper.php";s:4:"20ba";s:41:"Classes/ViewHelpers/InArrayViewHelper.php";s:4:"a0bf";s:41:"Configuration/FlexForms/flexform_list.xml";s:4:"afd8";s:25:"Configuration/TCA/tca.php";s:4:"b620";s:34:"Configuration/TypoScript/setup.txt";s:4:"b290";s:40:"Resources/Private/Language/locallang.xml";s:4:"c0a6";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"ebc3";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"851c";s:39:"Resources/Private/Layouts/standard.html";s:4:"9675";s:42:"Resources/Private/Partials/discussion.html";s:4:"095a";s:49:"Resources/Private/Partials/discussionMessage.html";s:4:"3afe";s:46:"Resources/Private/Partials/questionDetail.html";s:4:"4316";s:48:"Resources/Private/Partials/questionOverview.html";s:4:"ec02";s:38:"Resources/Private/Partials/rating.html";s:4:"fa32";s:52:"Resources/Private/Partials/ratingFinalRatingBox.html";s:4:"d78a";s:50:"Resources/Private/Partials/ratingFinalViewBox.html";s:4:"408b";s:49:"Resources/Private/Partials/ratingOverviewBox.html";s:4:"467a";s:46:"Resources/Private/Partials/reviewOverview.html";s:4:"6d2e";s:43:"Resources/Private/Templates/Ajax/index.html";s:4:"9a41";s:47:"Resources/Private/Templates/Importer/index.html";s:4:"0c24";s:47:"Resources/Private/Templates/Question/index.html";s:4:"559d";s:46:"Resources/Private/Templates/Question/info.html";s:4:"86d0";s:51:"Resources/Private/Templates/Question/showstep1.html";s:4:"4631";s:51:"Resources/Private/Templates/Question/showstep2.html";s:4:"bf27";s:51:"Resources/Private/Templates/Question/showstep3.html";s:4:"0989";s:51:"Resources/Private/Templates/Question/showstep4.html";s:4:"d44b";s:52:"Resources/Private/Templates/Review/editquestion.html";s:4:"2342";s:45:"Resources/Private/Templates/Review/index.html";s:4:"7cd6";s:44:"Resources/Private/Templates/Review/show.html";s:4:"168f";s:53:"Resources/Public/CSS/tx_t3certquestionrating_main.css";s:4:"ea13";s:66:"Resources/Public/Icons/icon_tx_t3certquestionrating_discussion.gif";s:4:"475a";s:64:"Resources/Public/Icons/icon_tx_t3certquestionrating_question.gif";s:4:"475a";s:62:"Resources/Public/Icons/icon_tx_t3certquestionrating_rating.gif";s:4:"475a";s:62:"Resources/Public/Icons/icon_tx_t3certquestionrating_review.gif";s:4:"475a";s:69:"Resources/Public/Icons/icon_tx_t3certquestionrating_reviewcomment.gif";s:4:"475a";s:32:"Resources/Public/Images/logo.gif";s:4:"946e";s:39:"Resources/Public/Images/pfeil-close.gif";s:4:"bbf3";s:33:"Resources/Public/Images/pfeil.gif";s:4:"1171";s:37:"Resources/Public/Images/rating_bg.gif";s:4:"daf3";s:47:"Resources/Public/JavaScript/extjs_discussion.js";s:4:"500d";s:59:"Resources/Public/JavaScript/tx_t3certquestionrating_main.js";s:4:"6632";}',
);

?>