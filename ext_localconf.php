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