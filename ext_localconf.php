<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'JWeiland.' . $_EXTKEY,
	'Personal',
	array(
		'Person' => 'list, show',
	),
	// non-cacheable actions
	array(
		'Person' => '',
	)
);
