<?php
defined('TYPO3') || die();

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use \HauerHeinrich\HhTtAddressPlaces\UserFunc\TcaTtAddress;

call_user_func(function() {
    // $GLOBALS['TCA']['tt_address']['columns']['type']['config']['items']['3'] =
    //     ['place', 3];

    // $GLOBALS['TCA']['tt_address']['types']['3'] = [
    //     'showitem' => 'title, bodytext'
    // ];

    if (!isset($GLOBALS['TCA']['tt_address']['ctrl']['type'])) {
        // no type field defined, so we define it here. This will only happen the first time the extension is installed!!
        $GLOBALS['TCA']['tt_address']['ctrl']['type'] = 'tx_extbase_type';
        $tempColumnstx_test_tt_address = [];
        $tempColumnstx_test_tt_address[$GLOBALS['TCA']['tt_address']['ctrl']['type']] = [
            'exclude' => true,
            'label' => 'Record type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Default', ''],
                    ['Place', 'place']
                ],
                'default' => '',
                'size' => 1,
                'maxitems' => 1,
            ]
        ];
        ExtensionManagementUtility::addTCAcolumns('tt_address', $tempColumnstx_test_tt_address);
    }

    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_address',
        $GLOBALS['TCA']['tt_address']['ctrl']['type'],
        '',
        // 'after:' . $GLOBALS['TCA']['tt_address']['ctrl']['label']
        'before: gender'
    );

    $tmp_hh_tt_address_places_columns = [
        'logo' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_place.logo',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                ],
            ],
        ],
        'opening_hours' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:tx_hhttaddressplaces_domain_model_place.opening_hours',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_hhttaddressplaces_domain_model_periodoftime',
                'foreign_field' => 'parentid',
                'foreign_table_field' => 'parenttable',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
    ];
    ExtensionManagementUtility::addTCAcolumns('tt_address', $tmp_hh_tt_address_places_columns);

    $GLOBALS['TCA']['tt_address']['ctrl']['label_userFunc'] = TcaTtAddress::class . '->label';
    // inherit and extend the show items from the parent class
    if (isset($GLOBALS['TCA']['tt_address']['types']['0']['showitem'])) {
        $GLOBALS['TCA']['tt_address']['types']['place']['showitem'] = '
            tx_extbase_type,
            name,
            company,
            --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
            logo,
            image,
            description,
            --div--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_tab.address,
                --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
                --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.coordinates;coordinates,

            --div--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_tab.contact,
                --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
                --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,

            --div--;LLL:EXT:hh_tt_address_places/Resources/Private/Language/locallang_db.xlf:hh_tt_address_places.opening_hours,
                opening_hours,

            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,

            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;paletteHidden,
                --palette--;;paletteAccess,

            --div--;' . 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category, categories
        ';
    }
});
