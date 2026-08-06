<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Model;

use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use \TYPO3\CMS\Extbase\Domain\Model\FileReference;
use \FriendsOfTYPO3\TtAddress\Domain\Model\Address;
use \FriendsOfTYPO3\TtAddress\Utility\PropertyModification;
use \HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime;

/**
 * This file is part of the "Address places" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Christian Hackl <web@hauer-heinrich.de>, www.hauer-heinrich.de
 */

class Place extends Address {

    /** @var ObjectStorage<FileReference> */
    protected $logo;

    /**
     * openingHours
     *
     * @var ObjectStorage<PeriodOfTime>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $openingHours = null;

    protected string $link = '';

    public function __construct() {
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
    public function initializeObject(): void {
        $this->logo = new ObjectStorage();
        $this->openingHours = $this->openingHours ?: new ObjectStorage();
    }

    public function addLogo(FileReference $logo): void { $this->logo->attach($logo); }
    public function removeLogo(FileReference $logoToRemove): void { $this->logo->detach($logoToRemove); }
    /**
     * @return ObjectStorage<FileReference>
     */
    public function getLogo(): ?ObjectStorage { return $this->logo; }
    /**
     * @param ObjectStorage<FileReference> $logo
     */
    public function setLogo(ObjectStorage $logo): void { $this->logo = $logo; }


    public function addOpeningHour(PeriodOfTime $openingHour): void { $this->openingHours->attach($openingHour); }
    public function removeOpeningHour(PeriodOfTime $openingHourToRemove): void { $this->openingHours->detach($openingHourToRemove); }
    /**
     * @return ObjectStorage<PeriodOfTime> openingHours
     */
    public function getOpeningHours() { return $this->openingHours; }
    /**
     * @param ObjectStorage<PeriodOfTime> $openingHours
     */
    public function setOpeningHours(ObjectStorage $openingHours): void { $this->openingHours = $openingHours; }


    public function setLink(string $link): void { $this->link = $link; }
    public function getLink(): string { return $this->link; }


    public function getLinkSimplified(): string { return PropertyModification::getCleanedDomain($this->link); }
}
