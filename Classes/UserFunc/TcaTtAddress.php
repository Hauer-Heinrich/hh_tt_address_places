<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\UserFunc;

/**
 * This file is part of the "hh_tt_address_places" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 Christian Hackl <chackl@hauer-heinrich.de>, www.Hauer-Heinrich.de
 */

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Backend\Utility\BackendUtility;

class TcaTtAddress {
    /**
     * label
     * switch lable for location or person data-set
     *
     * @param array $parameters
     * @deprecated experimental
     * @todo
     * @return void
     */
    public function label(array &$parameters): void {
        $title = '';

        if(
            isset($parameters['table'])
            && isset($parameters['row']['uid'])
            && $parameters['table'] === 'tt_address'
        ) {
            $row = BackendUtility::getRecord('tt_address', $parameters['row']['uid'], 'uid, pid, last_name, first_name, company, email, tx_extbase_type');

            if(!empty($row)) {
                if(isset($row['tx_extbase_type']) && $row['tx_extbase_type'] === 'place') {
                    if(!empty($row['last_name'])) {
                        $title .= BackendUtility::getProcessedValue('tt_address', 'last_name', $row['last_name'], 0, false, 0, $row['uid']);
                    }
                    if(!empty($row['first_name'])) {
                        $title .= ' ' . BackendUtility::getProcessedValue('tt_address', 'first_name', $row['first_name'], 0, false, 0, $row['uid']);
                    }
                    if(!empty($row['company'])) {
                        $title .= ' ' . BackendUtility::getProcessedValue('tt_address', 'company', $row['company'], 0, false, 0, $row['uid']);
                    }
                } else {
                    if(!empty($row['last_name'])) {
                        $title .= BackendUtility::getProcessedValue('tt_address', 'last_name', $row['last_name'], 0, false, 0, $row['uid']);
                    }
                    if(!empty($row['first_name'])) {
                        $title .= ' ' . BackendUtility::getProcessedValue('tt_address', 'first_name', $row['first_name'], 0, false, 0, $row['uid']);
                    }

                    if(empty($title)) {
                        $title .= ' ' . BackendUtility::getProcessedValue('tt_address', 'email', $row['email'], 0, false, 0, $row['uid']);
                    }
                }
            }
        }

        $parameters['title'] = trim($title);

        return;
    }
}
