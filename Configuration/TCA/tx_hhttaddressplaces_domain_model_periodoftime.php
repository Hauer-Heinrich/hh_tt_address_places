<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime',
        'label' => 'title',
        'descriptionColumn' => 'description',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'hideTable' => 1,
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => '',
        'iconfile' => 'EXT:hh_tt_address_places/Resources/Public/Icons/tx_hhttaddressplaces_domain_model_periodoftime.gif',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => null,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_hhttaddressplaces_domain_model_periodoftime',
                'foreign_table_where' => 'AND {#tx_hhttaddressplaces_domain_model_periodoftime}.{#pid}=###CURRENT_PID### AND {#tx_hhttaddressplaces_domain_model_periodoftime}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],

        'closed_from_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.closed_from_date',
            'displayCond' => 'FIELD:closed:=:1',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],
        'closed_to_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.closed_to_date',
            'displayCond' => 'FIELD:closed:=:1',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ],
        ],

        'closed' => [
            'exclude' => true,
            'label' => 'closed',
            'onChange' => 'reload',
            'description' => 'Check if your company is closed at the specified time (e. g. holiday).',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [
                    [
                        'label' => '',
                        'labelChecked' => 'Open',
                        'labelUnchecked' => 'Closed',
                        'invertStateDisplay' => true,
                    ],
                ],
                'default' => 1
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.title',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.title.description',
            'config' => [
                'type' => 'input',
                'eval' => 'trim'
            ],
        ],

        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.description',
            'description' => '',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 2,
            ],
        ],

        'valid_for' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.valid_for',
            'description' => '',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Wintertime', 1],
                    ['Summertime', 2],
                ],
            ],
        ],

        'place' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'open_monday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_monday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_monday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_monday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_monday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_tuesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_tuesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_tuesday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_tuesday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_tuesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_wednesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_wednesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_wednesday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_wednesday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_wednesday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_thursday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_thursday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_thursday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_thursday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_thursday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_friday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_friday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_friday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_friday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_friday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_saturday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_saturday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_saturday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_saturday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_saturday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'open_sunday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_sunday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'open_sunday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.open',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'close_sunday2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.close',
            'displayCond' => 'FIELD:closed:=:0',
            'config' => [
                'type' => 'datetime',
                'dbType' => 'time',
                'format' => 'time',
                'default' => 0,
            ]
        ],
        'appointment_sunday' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_periodoftime.appointment.description',
            'config' => [
                'type' => 'check',
                'items' => [
                    [ 'label' => 'appointment', ],
                ],
            ],
        ],

        'periodoftime' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
    'palettes' => [
        'dates' => [
            'showitem' => 'closed, closed_from_date, closed_to_date',
        ],
        'openclose_monday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.monday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.monday.description',
            'showitem' => 'open_monday, close_monday, open_monday2, close_monday2, --linebreak--, appointment_monday'
        ],
        'openclose_tuesday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.tuesday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.tuesday.description',
            'showitem' => 'open_tuesday, close_tuesday, open_tuesday2, close_tuesday2, --linebreak--, appointment_tuesday'
        ],
        'openclose_wednesday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.wednesday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.wednesday.description',
            'showitem' => 'open_wednesday, close_wednesday, open_wednesday2, close_wednesday2, --linebreak--, appointment_wednesday'
        ],
        'openclose_thursday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.thursday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.thursday.description',
            'showitem' => 'open_thursday, close_thursday, open_thursday2, close_thursday2, --linebreak--, appointment_thursday'
        ],
        'openclose_friday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.friday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.friday.description',
            'showitem' => 'open_friday, close_friday, open_friday2, close_friday2, --linebreak--, appointment_friday'
        ],
        'openclose_saturday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.saturday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.saturday.description',
            'showitem' => 'open_saturday, close_saturday, open_saturday2, close_saturday2, --linebreak--, appointment_saturday'
        ],
        'openclose_sunday' => [
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.sunday',
            'description' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:day.sunday.description',
            'showitem' => 'open_sunday, close_sunday, open_sunday2, close_sunday2, --linebreak--, appointment_sunday'
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
                title,
                description,
                --palette--;;dates,
                valid_for,
                --palette--;;openclose_monday,
                --palette--;;openclose_tuesday,
                --palette--;;openclose_wednesday,
                --palette--;;openclose_thursday,
                --palette--;;openclose_friday,
                --palette--;;openclose_saturday,
                --palette--;;openclose_sunday,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    sys_language_uid,
                    l10n_parent,
                    l10n_diffsource,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden,
            '
        ],
    ],
];
