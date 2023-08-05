<?php
defined('TYPO3_MODE') || die();

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
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_address', $tempColumnstx_test_tt_address);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_address',
    $GLOBALS['TCA']['tt_address']['ctrl']['type'],
    '',
    // 'after:' . $GLOBALS['TCA']['tt_address']['ctrl']['label']
    'before: gender'
);

// inherit and extend the show items from the parent class
if (isset($GLOBALS['TCA']['tt_address']['types']['0']['showitem'])) {
    $GLOBALS['TCA']['tt_address']['types']['place']['showitem'] = '
        tx_extbase_type,
        name,
        company,
        --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.building;building,
        image,
        description,

        --div--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_tab.address,
            --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.address;address,
            --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.coordinates;coordinates,

        --div--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_tab.contact,
            --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.contact;contact,
            --palette--;LLL:EXT:tt_address/Resources/Private/Language/locallang_db.xlf:tt_address_palette.social;social,

        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,

        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;paletteHidden,
            --palette--;;paletteAccess,

        --div--;' . 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category, categories
    ';
}
