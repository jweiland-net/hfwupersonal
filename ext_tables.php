<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'JWeiland.' . $_EXTKEY,
	'Personal',
	'Personal'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'HFWU Personal');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_address', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_address.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_address');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_person', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_person.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_person');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_position', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_position.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_position');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_location', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_location.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_location');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_link', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_link.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_link');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_activity', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_activity.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_activity');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_building', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_building.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_building');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_hfwupersonal_domain_model_room', 'EXT:hfwupersonal/Resources/Private/Language/locallang_csh_tx_hfwupersonal_domain_model_room.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_hfwupersonal_domain_model_room');
