<?php
defined('TYPO3') || die();

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function(string $extensionKey) {
    // make PageTsConfig selectable
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/AllPage.tsconfig',
        'hh_tt_address_places - Places / Companies'
    );

    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/OnlyPeople.tsconfig',
        'hh_tt_address_places - Allow only people (for storage location)'
    );

    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/OnlyPlaces.tsconfig',
        'hh_tt_address_places - Allow only Places / Companies (for storage location)'
    );
}, 'hh_tt_address_places');
