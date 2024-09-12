<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Model;

use \FriendsOfTYPO3\TtAddress\Domain\Model\Address;

/**
 * This file is part of the "Address places" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Christian Hackl <web@hauer-heinrich.de>, www.hauer-heinrich.de
 */

/**
 * Place
 */
class Place extends Address {

    protected $txExtbaseType = '';

    /**
     * openingHours
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $openingHours = null;

    /**
     * __construct
     */
    public function __construct()
    {

        // Do not remove the next line: It would break the functionality
        $this->initializeObject();
    }

    /**
     * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->openingHours = $this->openingHours ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    public function getTxExtbaseType(): string
    {
        return $this->txExtbaseType;
    }

    public function setTxExbaseType($extbaseType): void
    {
        $this->txExtbaseType = $extbaseType;
    }

    /**
     * Adds a OpeningHoursSpecification
     *
     * @param \HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime $openingHour
     * @return void
     */
    public function addOpeningHour(\HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime $openingHour)
    {
        $this->openingHours->attach($openingHour);
    }

    /**
     * Removes a OpeningHoursSpecification
     *
     * @param \HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime $openingHourToRemove The PeriodOfTime to be removed
     * @return void
     */
    public function removeOpeningHour(\HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime $openingHourToRemove)
    {
        $this->openingHours->detach($openingHourToRemove);
    }

    /**
     * Returns the openingHours
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime> openingHours
     */
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * Sets the openingHours
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime> $openingHours
     * @return void
     */
    public function setOpeningHours(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $openingHours)
    {
        $this->openingHours = $openingHours;
    }
}
