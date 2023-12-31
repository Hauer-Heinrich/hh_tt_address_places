<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Repository;


/**
 * This file is part of the "Address places" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Christian Hackl <web@hauer-heinrich.de>, www.hauer-heinrich.de
 */

/**
 * The repository for Places
 */
class PlaceRepository extends \FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository {

    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
}
