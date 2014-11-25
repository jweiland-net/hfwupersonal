<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person',
		'label' => 'title',
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
		'searchFields' => 'title,first_name,last_name,email,image_comment',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('hfwupersonal') . 'Resources/Public/Icons/tx_hfwupersonal_domain_model_person.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, first_name, last_name, email, image, image_comment, category, links, frontend_group, backend_group, address, location, position, activity',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, first_name, last_name, email, image, image_comment, category, links, frontend_group, backend_group, address, location, position, activity, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_hfwupersonal_domain_model_person',
				'foreign_table_where' => 'AND tx_hfwupersonal_domain_model_person.pid=###CURRENT_PID### AND tx_hfwupersonal_domain_model_person.sys_language_uid IN (-1,0)',
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

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'first_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image',
				array('maxitems' => 1),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		),
		'image_comment' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.image_comment',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.category',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hfwupersonal_domain_model_syscategory',
				'MM' => 'tx_hfwupersonal_person_syscategory_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_hfwupersonal_domain_model_syscategory',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
		'links' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.links',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_link',
				'foreign_field' => 'person',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'frontend_group' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.frontend_group',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_fegroup',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'backend_group' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.backend_group',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_begroup',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.address',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_address',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'location' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.location',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_location',
				'foreign_field' => 'person',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'position' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.position',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_position',
				'foreign_field' => 'person',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'activity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.activity',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_activity',
				'foreign_field' => 'person',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		
	),
);
