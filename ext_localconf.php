<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'JWeiland.' . $_EXTKEY,
	'Personal',
	array(
		'Person' => 'list, show, search',
	),
	// non-cacheable actions
	array(
		'Person' => 'search',
	)
);

// register eID scripts
$TYPO3_CONF_VARS['FE']['eID_include']['hfwuPersonalSearchPersons'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('hfwupersonal') . 'Classes/Ajax/SearchPersons.php';

if (TYPO3_MODE === 'BE') {
	// HOOK: Override rootUid in TCA for category trees
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tceforms.php']['getSingleFieldClass'][] = 'JWeiland\\Hfwupersonal\\Hooks\\ModifyTcaOfCategoryTrees';

	// create scheduler to synchronize data from RestApi with local DB
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['JWeiland\\Hfwupersonal\\Task\\Synchronize'] = array(
		'extension' => $_EXTKEY,
		'title' => 'Synchronize with RestApi',
		'description' => 'Synchronize data from RestApi with local DB',
		'additionalFields' => 'JWeiland\\Hfwupersonal\\Task\\AdditionalFieldProvider'
	);
}