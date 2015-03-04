<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person',
		'label' => 'last_name',
		'label_alt' => 'first_name',
		'label_alt_force' => TRUE,
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
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, priority, first_name, last_name, email, stud_ip, image, image_comment, category, contacts, profile_page, links, frontend_user_group, backend_user_groups, address, locations, positions, activities',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, priority, first_name, last_name, email, stud_ip, image, image_comment, category, contacts, profile_page, links, frontend_user_group, backend_user_groups, address, locations, positions, activities, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
		'priority' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.priority',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hfwupersonal_domain_model_priority',
				'items' => array(
					array('', '')
				),
				'size' => 1,
				'maxitems' => 1,
				'minitems' => 1,
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
		'stud_ip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.stud_ip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image')
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
		'contacts' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.contacts',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_contact',
				'MM' => 'tx_hfwupersonal_person_contact_mm',
				'minitems' => 0,
				'maxitems' => 99,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'profile_page' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.profile_page',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_link',
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
		'links' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.links',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_link',
				'MM' => 'tx_hfwupersonal_person_link_mm',
				'maxitems' => 99,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'frontend_user_group' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.frontend_user_group',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_groups',
				'foreign_table_where' => 'ORDER BY fe_groups.title ASC',
				'items' => array(
					array('', '')
				),
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'backend_user_groups' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.backend_user_groups',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'be_groups',
				'foreign_table_where' => 'ORDER BY be_groups.title ASC',
				'MM' => 'tx_hfwupersonal_person_begroups_mm',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 99,
				'enableMultiSelectFilterTextfield' => TRUE
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.address',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_hfwupersonal_domain_model_address',
				'foreign_table' => 'tx_hfwupersonal_domain_model_address',
				'MM' => 'tx_hfwupersonal_person_address_mm',
				'size' => 5,
				'maxitems' => 1,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'default' => array(
							'minimumCharacters' => 3,
							'searchWholePhrase' => TRUE
						)
					)
				)
			),
		),
		'locations' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.locations',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hfwupersonal_domain_model_location',
				'foreign_field' => 'person',
				'MM' => 'tx_hfwupersonal_person_location_mm',
				'size' => 5,
				'autoSizeMax' => 10,
				'maxitems' => 99,
				'enableMultiSelectFilterTextfield' => TRUE
			),
		),
		'positions' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.positions',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hfwupersonal_domain_model_position',
				'foreign_field' => 'person',
				'maxitems' => 99,
				'minitems' => 0,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'activities' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:hfwupersonal/Resources/Private/Language/locallang_db.xlf:tx_hfwupersonal_domain_model_person.activities',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hfwupersonal_domain_model_activity',
				'foreign_field' => 'person',
				'MM' => 'tx_hfwupersonal_person_activity_mm',
				'size' => 5,
				'autoSizeMax' => 10,
				'maxitems' => 99,
				'enableMultiSelectFilterTextfield' => TRUE
			),
		),
	),
);
