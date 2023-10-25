<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hh_tt_address_places".
 *
 * Auto generated 25-10-2023 09:38
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF['hh_tt_address_places'] = [
    'title' => 'Address places',
    'description' => 'Simply adds places / companies TCA for EXT:tt_address.',
    'category' => 'plugin',
    'version' => '2.2.0',
    'state' => 'beta',
    'uploadfolder' => false,
    'clearcacheonload' => false,
    'author' => 'Christian Hackl',
    'author_email' => 'web@hauer-heinrich.de',
    'author_company' => NULL,
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99',
            'tt_address' => '',
        ],
        'conflicts' => [
        ],
        'suggests' => [
            'hh_seo' => ''
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'HauerHeinrich\\HhTtAddressPlaces\\' => 'Classes'
        ],
    ],
];
