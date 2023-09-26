<?php

$EM_CONF['hh_tt_address_places'] = [
    'title' => 'Address places',
    'description' => 'Simply adds places / companies TCA for EXT:tt_address.',
    'category' => 'plugin',
    'author' => 'Christian Hackl',
    'author_email' => 'web@hauer-heinrich.de',
    'state' => 'beta',
    'clearCacheOnLoad' => 0,
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99',
            'tt_address' => '',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
