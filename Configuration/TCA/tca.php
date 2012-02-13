<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_questionrating_domain_model_question'] = array (
	'ctrl' => $TCA['tx_questionrating_domain_model_question']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,xml_id,status,active,questiontext,answer1text,answer2text,answer3text,answer4text,answer5text,answer6text,answer7text,answer8text,answer9text,answer10text,correctanswer,ratings,discussions'
	),
	'feInterface' => $TCA['tx_questionrating_domain_model_question']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'xml_id' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.xml_id',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'status' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.status',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.status.I.0', 'open'),
					array('LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.status.I.1', 'discuss'),
					array('LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.status.I.2', 'final'),
				),
				'size' => 1,
				'maxitems' => 1,
			)
		),
		'active' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.active',
			'config' => array (
				'type' => 'check',
				'default' => 1,
			)
		),
		'questiontext' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.questiontext',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer1text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer1text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer2text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer2text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer3text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer3text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer4text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer4text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer5text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer5text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer6text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer6text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer7text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer7text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer8text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer8text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer9text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer9text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'answer10text' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.answer10text',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'correctanswer' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.correctanswer',
			'config' => array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'ratings' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.ratings',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_questionrating_domain_model_rating',
				'foreign_field' => 'question',
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			)
		),
		'discussions' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_question.discussions',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_questionrating_domain_model_discussion',
				'foreign_field' => 'question',
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 1,
					'expandSingle' => 1,
				),
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, xml_id, status, active, questiontext, answer1text, answer2text, answer3text, answer4text, answer5text, answer6text, answer7text, answer8text, answer9text, answer10text, correctanswer,ratings,discussions')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

$TCA['tx_questionrating_domain_model_rating'] = array (
	'ctrl' => $TCA['tx_questionrating_domain_model_rating']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,user,question,rating_value,final_rating,final_rating_value'
	),
	'feInterface' => $TCA['tx_questionrating_rating']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'user' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating.user',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'maxitems' => 1,
			)
		),
		'question' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating.question',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_questionrating_domain_model_question',
				'maxitems' => 1,
			)
		),
		'rating_value' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating.rating',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'final_rating' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating.final_rating',
			'config' => array (
				'type' => 'check',
			)
		),
		'final_rating_value' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_rating.final_rating_value',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, user, question, rating_value, final_rating, final_rating_value')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

$TCA['tx_questionrating_domain_model_discussion'] = array (
	'ctrl' => $TCA['tx_questionrating_domain_model_discussion']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,from_user,from_leader,to_user,to_leader,question,message'
	),
	'feInterface' => $TCA['tx_questionrating_domain_model_discussion']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'from_user' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.from_user',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'maxitems' => 1,
			)
		),
		'from_leader' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.from_leader',
			'config' => array (
				'type' => 'check',
			)
		),
		'to_user' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.to_user',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'maxitems' => 1,
			)
		),
		'to_leader' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.to_leader',
			'config' => array (
				'type' => 'check',
			)
		),
		'question' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.question',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'tx_questionrating_domain_model_question',
				'maxitems' => 1,
			)
		),
		'message' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_discussion.message',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
	'crdate' => array (
		'exclude' => 1,
		'label' => 'Creation date',
		'config' => array (
			'type' => 'none',
			'format' => 'date',
			'eval' => 'date',

		)
			),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, from_user, from_leader, to_user,from_leader question, message')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

$TCA['tx_questionrating_domain_model_review'] = array (
	'ctrl' => $TCA['tx_questionrating_domain_model_review']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,xml_id,headline,status,votes,reviewcomments'
	),
	'feInterface' => $TCA['tx_questionrating_domain_model_review']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'xml_id' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review.xml_id',
			'config' => array (
				'type' => 'input',
				'size' => '30',
			)
		),
		'headline' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review.headline',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'status' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review.status',
			'config' => array (
				'type' => 'input',
				'size' => '30',
			)
		),
		'votes' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review.votes',
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'reviewcomments' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_review.reviewcomments',
						'config' => array(
							'type' => 'inline',
							'foreign_table' => 'tx_questionrating_domain_model_reviewcomment',
							'foreign_field' => 'review',
							'appearance' => array(
								'newRecordLinkPosition' => 'bottom',
								'collapseAll' => 1,
								'expandSingle' => 1,
							),
						)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, xml_id, headline, status, votes, reviewcomments')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_questionrating_domain_model_reviewcomment'] = array (
	'ctrl' => $TCA['tx_questionrating_domain_model_reviewcomment']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,message,review,user'
	),
	'feInterface' => $TCA['tx_questionrating_domain_model_reviewcomment']['feInterface'],
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'message' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_reviewcomment.message',
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'review' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_reviewcomment.review',
						'config' => array (
							'type' => 'select',
							'foreign_table' => 'tx_questionrating_domain_model_review',
							'maxitems' => 1,
						)
		),
		'user' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:questionrating/Resources/Private/Language/locallang_db.xml:tx_questionrating_domain_model_reviewcomment.user',
						'config' => array (
							'type' => 'select',
							'foreign_table' => 'fe_users',
							'maxitems' => 1,
						)
		),
		'crdate' => array (
			'exclude' => 1,
			'label' => 'Creation date',
			'config' => array (
				'type' => 'none',
				'format' => 'date',
				'eval' => 'date',

			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, message, review, user')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

?>