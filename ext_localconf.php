<?php
defined('TYPO3') || die();

(static function() {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class] = [
        'className' => \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class,
    ];
})();
