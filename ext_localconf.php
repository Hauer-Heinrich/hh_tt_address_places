<?php
defined('TYPO3') || die();

(static function() {
    // Register UpdateWizards
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['hhttaddressplaces_parentIdMigrationWizard']
        = \HauerHeinrich\HhTtAddressPlaces\Upgrades\ParentIdMigrationWizard::class;
})();
