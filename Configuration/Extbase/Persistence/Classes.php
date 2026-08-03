<?php
declare(strict_types=1);

return [
    \FriendsOfTYPO3\TtAddress\Domain\Model\Address::class => [
        'recordType' => 'default',
        'subclasses' => [
            'place' => \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class,
        ],
    ],
    \HauerHeinrich\HhTtAddressPlaces\Domain\Model\Place::class => [
        'tableName' => 'tt_address',
        'recordType' => 'place',
    ],
];
