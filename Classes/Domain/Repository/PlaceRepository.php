<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Repository;

use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \FriendsOfTYPO3\TtAddress\Domain\Repository\AddressRepository;

/**
 * This file is part of the "Address places" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Christian Hackl <web@hauer-heinrich.de>, www.hauer-heinrich.de
 */

class PlaceRepository extends AddressRepository {

    protected $defaultOrderings = ['sorting' => QueryInterface::ORDER_ASCENDING];
}
