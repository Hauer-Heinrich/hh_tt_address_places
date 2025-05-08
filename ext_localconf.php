<?php
defined('TYPO3') || die();

(static function() {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class] = [
        'className' => \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class,
    ];

    // Register UpdateWizards
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['hhttaddressplaces_parentIdMigrationWizard']
        = \HauerHeinrich\HhTtAddressPlaces\Upgrades\ParentIdMigrationWizard::class;
})();
