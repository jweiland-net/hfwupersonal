<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity',
		'label' => 'faculty',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'faculty,course_of_studies,research,employment,special_field',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('hfwupersonal') . 'Resources/Public/Icons/tx_hfwupersonal_domain_model_activity.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, faculty, curse_of_studies, research, employment, special_field',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, faculty, course_of_studies, research, employment, special_field, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_hfwupersonal_domain_model_activity',
				'foreign_table_where' => 'AND tx_hfwupersonal_domain_model_activity.pid=###CURRENT_PID### AND tx_hfwupersonal_domain_model_activity.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'faculty' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity.faculty',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'curse_of_studies' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity.curse_of_studies',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'research' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity.research',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'employment' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity.employment',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'special_field' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_activity.special_field',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
		'person' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
