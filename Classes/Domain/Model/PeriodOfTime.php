<?php

declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Model;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * This file is part of the "blubb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023
 */

/**
 * PeriodOfTime
 */
class PeriodOfTime extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    const DAYSOFWEEK = [
        "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
    ];

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * validFor
     *
     * @var int
     */
    protected $validFor = null;

    /**
     * closed
     *
     * @var int
     */
    protected $closed = null;

    /**
     * closedFromDate
     *
     * @var \DateTime
     *
     */
    protected $closedFromDate = 0;

    /**
     * closedToDate
     *
     * @var \DateTime
     */
    protected $closedToDate = 0;

    /**
     * openMonday
     *
     * @var string
     */
    protected string $openMonday = '';

    /**
     * openMonday2
     *
     * @var string
     */
    protected string $openMonday2 = '';

    /**
     * closeMonday
     *
     * @var string
     */
    protected string $closeMonday = '';

    /**
     * closeMonday2
     *
     * @var string
     */
    protected string $closeMonday2 = '';

    /**
     * openTuesday
     *
     * @var string
     */
    protected string $openTuesday = '';

    /**
     * openTuesday2
     *
     * @var string
     */
    protected string $openTuesday2 = '';

    /**
     * closeTuesday
     *
     * @var string
     */
    protected string $closeTuesday = '';

    /**
     * closeTuesday2
     *
     * @var string
     */
    protected string $closeTuesday2 = '';

    /**
     * openWednesday
     *
     * @var string
     */
    protected string $openWednesday = '';

    /**
     * openWednesday2
     *
     * @var string
     */
    protected string $openWednesday2 = '';


    /**
     * closeWednesday
     *
     * @var string
     */
    protected string $closeWednesday = '';

    /**
     * closeWednesday2
     *
     * @var string
     */
    protected string $closeWednesday2 = '';

    /**
     * openThursday
     *
     * @var string
     */
    protected string $openThursday = '';

    /**
     * openThursday2
     *
     * @var string
     */
    protected string $openThursday2 = '';

    /**
     * closeThursday
     *
     * @var string
     */
    protected string $closeThursday = '';

    /**
     * closeThursday2
     *
     * @var string
     */
    protected string $closeThursday2 = '';

    /**
     * openFriday
     *
     * @var string
     */
    protected string $openFriday = '';

    /**
     * openFriday2
     *
     * @var string
     */
    protected string $openFriday2 = '';

    /**
     * closeFriday
     *
     * @var string
     */
    protected string $closeFriday = '';

    /**
     * closeFriday2
     *
     * @var string
     */
    protected string $closeFriday2 = '';

    /**
     * openSaturday
     *
     * @var string
     */
    protected string $openSaturday = '';

    /**
     * openSaturday2
     *
     * @var string
     */
    protected string $openSaturday2 = '';

    /**
     * closeSaturday
     *
     * @var string
     */
    protected string $closeSaturday = '';

    /**
     * closeSaturday2
     *
     * @var string
     */
    protected string $closeSaturday2 = '';

    /**
     * openSunday
     *
     * @var string
     */
    protected string $openSunday = '';

    /**
     * openSunday2
     *
     * @var string
     */
    protected string $openSunday2 = '';

    /**
     * closeSunday
     *
     * @var string
     */
    protected string $closeSunday = '';

    /**
     * closeSunday2
     *
     * @var string
     */
    protected string $closeSunday2 = '';

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns the validFor
     *
     * @return int
     */
    public function getValidFor(): int
    {
        return $this->validFor;
    }

    /**
     * Sets the validFor
     *
     * @param int $validFor
     * @return void
     */
    public function setValidFor(string $validFor): void
    {
        $this->validFor = $validFor;
    }

    /**
     * Returns the closed
     *
     * @return int
     */
    public function getClosed(): int
    {
        return $this->closed;
    }

    /**
     * Sets the closed
     *
     * @param int $closed
     * @return void
     */
    public function setClosed(string $closed): void
    {
        $this->closed = $closed;
    }

    /**
     * Returns the closedFromDate
     * @return ?\DateTime
     */
    public function getClosedFromDate(): ?\DateTime
    {
        return $this->closedFromDate;
    }

    /**
     * Sets the closedFromDate
     *
     * @param ?\DateTime $closedFromDate
     * @return void
     */
    public function setClosedFromDate(?\DateTime $closedFromDate = null): void
    {
        $this->closedFromDate = $closedFromDate;
    }

    /**
     * Returns the closedToDate
     * @return ?\DateTime
     */
    public function getClosedToDate(): ?\DateTime
    {
        return $this->closedToDate;
    }

    /**
     * Sets the closedToDate
     *
     * @param ?\DateTime $closedToDate
     * @return void
     *
     */
    public function setClosedToDate(?\DateTime $closedToDate = null): void
    {
        $this->closedToDate = $closedToDate;
    }

    /**
     * Returns the openMonday
     * @return string
     */
    public function getOpenMonday(): string
    {
        return $this->openMonday;
    }

    /**
     * Sets the openMonday
     * @param string $openMonday
     * @return void
     */
    public function setOpenMonday(string $openMonday): void
    {
        $this->openMonday = $openMonday;
    }

    /**
     * Returns the closeMonday
     *
     * @return string
     */
    public function getCloseMonday(): string
    {
        return $this->closeMonday;
    }

    /**
     * Sets the closeMonday
     *
     * @param string $closeMonday
     * @return void
     */
    public function setCloseMonday(string $closeMonday): void
    {
        $this->closeMonday = $closeMonday;
    }

    /**
     * Returns the openMonday2
     *
     * @return string
     */
    public function getOpenMonday2(): string
    {
        return $this->openMonday2;
    }

    /**
     * Sets the openMonday2
     *
     * @param string $openMonday2
     * @return void
     */
    public function setOpenMonday2(string $openMonday2): void
    {
        $this->openMonday2 = $openMonday2;
    }

    /**
     * Returns the closeMonday2
     *
     * @return string
     */
    public function getCloseMonday2(): string
    {
        return $this->closeMonday2;
    }

    /**
     * Sets the closeMonday2
     *
     * @param string $closeMonday2
     * @return void
     */
    public function setCloseMonday2(string $closeMonday2): void
    {
        $this->closeMonday2 = $closeMonday2;
    }

    /**
     * Returns the openTuesday
     *
     * @return string
     */
    public function getOpenTuesday(): string
    {
        return $this->openTuesday;
    }

    /**
     * Sets the openTuesday
     *
     * @param string $openTuesday
     * @return void
     */
    public function setOpenTuesday(string $openTuesday): void
    {
        $this->openTuesday = $openTuesday;
    }

    /**
     * Returns the closeTuesday
     *
     * @return string
     */
    public function getCloseTuesday(): string
    {
        return $this->closeTuesday;
    }

    /**
     * Sets the closeTuesday
     *
     * @param string $closeTuesday
     * @return void
     */
    public function setCloseTuesday(string $closeTuesday): void
    {
        $this->closeTuesday = $closeTuesday;
    }

    /**
     * Returns the openTuesday2
     *
     * @return string
     */
    public function getOpenTuesday2(): string
    {
        return $this->openTuesday2;
    }

    /**
     * Sets the openTuesday2
     *
     * @param string $openTuesday2
     * @return void
     */
    public function setOpenTuesday2(string $openTuesday2): void
    {
        $this->openTuesday2 = $openTuesday2;
    }

    /**
     * Returns the closeTuesday2
     *
     * @return string
     */
    public function getCloseTuesday2(): string
    {
        return $this->closeTuesday2;
    }

    /**
     * Sets the closeTuesday2
     *
     * @param string $closeTuesday2
     * @return void
     */
    public function setCloseTuesday2(string $closeTuesday2): void
    {
        $this->closeTuesday2 = $closeTuesday2;
    }

    /**
     * Returns the openWednesday
     *
     * @return string
     */
    public function getOpenWednesday(): string
    {
        return $this->openWednesday;
    }

    /**
     * Sets the openWednesday
     *
     * @param string $openWednesday
     * @return void
     */
    public function setOpenWednesday(string $openWednesday): void
    {
        $this->openWednesday = $openWednesday;
    }

    /**
     * Returns the closeWednesday
     *
     * @return string
     */
    public function getCloseWednesday(): string
    {
        return $this->closeWednesday;
    }

    /**
     * Sets the closeWednesday
     *
     * @param string $closeWednesday
     * @return void
     */
    public function setCloseWednesday(string $closeWednesday): void
    {
        $this->closeWednesday = $closeWednesday;
    }

    /**
     * Returns the openWednesday2
     *
     * @return string
     */
    public function getOpenWednesday2(): string
    {
        return $this->openWednesday2;
    }

    /**
     * Sets the openWednesday2
     *
     * @param string $openWednesday2
     * @return void
     */
    public function setOpenWednesday2(string $openWednesday2): void
    {
        $this->openWednesday2 = $openWednesday2;
    }

    /**
     * Returns the closeWednesday2
     *
     * @return string
     */
    public function getCloseWednesday2(): string
    {
        return $this->closeWednesday2;
    }

    /**
     * Sets the closeWednesday2
     *
     * @param string $closeWednesday2
     * @return void
     */
    public function setCloseWednesday2(string $closeWednesday2): void
    {
        $this->closeWednesday2 = $closeWednesday2;
    }

    /**
     * Returns the openThursday
     *
     * @return string
     */
    public function getOpenThursday(): string
    {
        return $this->openThursday;
    }

    /**
     * Sets the openThursday
     *
     * @param string $openThursday
     * @return void
     */
    public function setOpenThursday(string $openThursday): void
    {
        $this->openThursday = $openThursday;
    }

    /**
     * Returns the closeThursday
     *
     * @return string
     */
    public function getCloseThursday(): string
    {
        return $this->closeThursday;
    }

    /**
     * Sets the closeThursday
     *
     * @param string $closeThursday
     * @return void
     */
    public function setCloseThursday(string $closeThursday): void
    {
        $this->closeThursday = $closeThursday;
    }

    /**
     * Returns the openThursday2
     *
     * @return string
     */
    public function getOpenThursday2(): string
    {
        return $this->openThursday2;
    }

    /**
     * Sets the openThursday2
     *
     * @param string $openThursday2
     * @return void
     */
    public function setOpenThursday2(string $openThursday2): void
    {
        $this->openThursday2 = $openThursday2;
    }

    /**
     * Returns the closeThursday2
     *
     * @return string
     */
    public function getCloseThursday2(): string
    {
        return $this->closeThursday2;
    }

    /**
     * Sets the closeThursday2
     *
     * @param string $closeThursday2
     * @return void
     */
    public function setCloseThursday2(string $closeThursday2): void
    {
        $this->closeThursday2 = $closeThursday2;
    }

    /**
     * Returns the openFriday
     *
     * @return string
     */
    public function getOpenFriday(): string
    {
        return $this->openFriday;
    }

    /**
     * Sets the openFriday
     *
     * @param string $openFriday
     * @return void
     */
    public function setOpenFriday(string $openFriday): void
    {
        $this->openFriday = $openFriday;
    }

    /**
     * Returns the closeFriday
     *
     * @return string
     */
    public function getCloseFriday(): string
    {
        return $this->closeFriday;
    }

    /**
     * Sets the closeFriday
     *
     * @param string $closeFriday
     * @return void
     */
    public function setCloseFriday(string $closeFriday): void
    {
        $this->closeFriday = $closeFriday;
    }

    /**
     * Returns the openFriday2
     *
     * @return string
     */
    public function getOpenFriday2(): string
    {
        return $this->openFriday2;
    }

    /**
     * Sets the openFriday2
     *
     * @param string $openFriday2
     * @return void
     */
    public function setOpenFriday2(string $openFriday2): void
    {
        $this->openFriday2 = $openFriday2;
    }

    /**
     * Returns the closeFriday2
     *
     * @return string
     */
    public function getCloseFriday2(): string
    {
        return $this->closeFriday2;
    }

    /**
     * Sets the closeFriday2
     *
     * @param string $closeFriday2
     * @return void
     */
    public function setCloseFriday2(string $closeFriday2): void
    {
        $this->closeFriday2 = $closeFriday2;
    }

    /**
     * Returns the openSaturday
     *
     * @return string
     */
    public function getOpenSaturday(): string
    {
        return $this->openSaturday;
    }

    /**
     * Sets the openSaturday
     *
     * @param string $openSaturday
     * @return void
     */
    public function setOpenSaturday(string $openSaturday): void
    {
        $this->openSaturday = $openSaturday;
    }

    /**
     * Returns the closeSaturday
     *
     * @return string
     */
    public function getCloseSaturday(): string
    {
        return $this->closeSaturday;
    }

    /**
     * Sets the closeSaturday
     *
     * @param string $closeSaturday
     * @return void
     */
    public function setCloseSaturday(string $closeSaturday): void
    {
        $this->closeSaturday = $closeSaturday;
    }

    /**
     * Returns the openSaturday2
     *
     * @return string
     */
    public function getOpenSaturday2(): string
    {
        return $this->openSaturday2;
    }

    /**
     * Sets the openSaturday2
     *
     * @param string $openSaturday2
     * @return void
     */
    public function setOpenSaturday2(string $openSaturday2): void
    {
        $this->openSaturday2 = $openSaturday2;
    }

    /**
     * Returns the closeSaturday2
     *
     * @return string
     */
    public function getCloseSaturday2(): string
    {
        return $this->closeSaturday2;
    }

    /**
     * Sets the closeSaturday2
     *
     * @param string $closeSaturday2
     * @return void
     */
    public function setCloseSaturday2(string $closeSaturday2): void
    {
        $this->closeSaturday2 = $closeSaturday2;
    }

    /**
     * Returns the openSunday
     *
     * @return string
     */
    public function getOpenSunday(): string
    {
        return $this->openSunday;
    }

    /**
     * Sets the openSunday
     *
     * @param string $openSunday
     * @return void
     */
    public function setOpenSunday(string $openSunday): void
    {
        $this->openSunday = $openSunday;
    }

    /**
     * Returns the closeSunday
     *
     * @return string
     */
    public function getCloseSunday(): string
    {
        return $this->closeSunday;
    }

    /**
     * Sets the closeSunday
     *
     * @param string $closeSunday
     * @return void
     */
    public function setCloseSunday(string $closeSunday): void
    {
        $this->closeSunday = $closeSunday;
    }

    /**
     * Returns the openSunday2
     *
     * @return string
     */
    public function getOpenSunday2(): string
    {
        return $this->openSunday2;
    }

    /**
     * Sets the openSunday2
     *
     * @param string $openSunday2
     * @return void
     */
    public function setOpenSunday2(string $openSunday2): void
    {
        $this->openSunday2 = $openSunday2;
    }

    /**
     * Returns the closeSunday2
     *
     * @return string
     */
    public function getCloseSunday2(): string
    {
        return $this->closeSunday2;
    }

    /**
     * Sets the closeSunday2
     *
     * @param string $closeSunday2
     * @return void
     */
    public function setCloseSunday2(string $closeSunday2): void
    {
        $this->closeSunday2 = $closeSunday2;
    }

    /**
     * dynamically call method of this class
     *
     * @param string $method - e. g. getOpenMonday
     * @return mixed
     */
    protected function getMethod($method) {
        if (is_callable([$this, $method])) {
            return $this->$method();
        }
    }

    public function getStructuredOpeningTimes(): array {
        $return = [];

        if(!empty(self::DAYSOFWEEK) && \is_array(self::DAYSOFWEEK)) {
            foreach (self::DAYSOFWEEK as $day) {
                $lowerDay = strtolower($day);
                $openTime1 = $this->getMethod('getOpen'.$day);
                $closeTime1 = $this->getMethod('getClose'.$day);
                $openTime2 = $this->getMethod('getOpen'.$day.'2');
                $closeTime2 = $this->getMethod('getClose'.$day.'2');

                if(!empty($openTime1) && $openTime1 != '00:00:00') {
                    $return[$lowerDay]['open'][] = $openTime1;
                }
                if(!empty($closeTime1) && $closeTime1 != '00:00:00') {
                    $return[$lowerDay]['close'][] = $closeTime1;
                }

                if(!empty($openTime2) && $openTime2 != '00:00:00') {
                    $return[$lowerDay]['open'][] = $openTime2;
                }
                if(!empty($closeTime2) && $closeTime2 != '00:00:00') {
                    $return[$lowerDay]['close'][] = $closeTime2;
                }
            }
        }

        return $return;
    }
}
