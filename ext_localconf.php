<?php
defined('TYPO3') || die();

use \TYPO3\CMS\Core\Utility\GeneralUtility;

(static function() {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class] = [
        'className' => \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class,
    ];
    // GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class)
    //     ->registerImplementation(\FriendsOfTYPO3\TtAddress\Domain\Model\Address::class, \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class);
})();
