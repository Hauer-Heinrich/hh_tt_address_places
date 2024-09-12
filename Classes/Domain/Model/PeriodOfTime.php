<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\Domain\Model;

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
class PeriodOfTime extends AbstractEntity {

    const DAYSOFWEEK = [
        "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
    ];

    protected string $title = '';
    protected string $description = '';
    protected string $validFor = '';
    protected int $closed = 0;

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

    protected string $openMonday = '';
    protected string $openMonday2 = '';
    protected string $closeMonday = '';
    protected string $closeMonday2 = '';
    protected int $appointmentMonday = 0;

    protected string $openTuesday = '';
    protected string $openTuesday2 = '';
    protected string $closeTuesday = '';
    protected string $closeTuesday2 = '';
    protected int $appointmentTuesday = 0;

    protected string $openWednesday = '';
    protected string $openWednesday2 = '';
    protected string $closeWednesday = '';
    protected string $closeWednesday2 = '';
    protected int $appointmentWednesday = 0;

    protected string $openThursday = '';
    protected string $openThursday2 = '';
    protected string $closeThursday = '';
    protected string $closeThursday2 = '';
    protected int $appointmentThursday = 0;

    protected string $openFriday = '';
    protected string $openFriday2 = '';
    protected string $closeFriday = '';
    protected string $closeFriday2 = '';
    protected int $appointmentFriday = 0;

    protected string $openSaturday = '';
    protected string $openSaturday2 = '';
    protected string $closeSaturday = '';
    protected string $closeSaturday2 = '';
    protected int $appointmentSaturday = 0;

    protected string $openSunday = '';
    protected string $openSunday2 = '';
    protected string $closeSunday = '';
    protected string $closeSunday2 = '';
    protected int $appointmentSunday = 0;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getValidFor(): string
    {
        return $this->validFor;
    }

    public function setValidFor(string $validFor): void
    {
        $this->validFor = $validFor;
    }

    public function getClosed(): int
    {
        return $this->closed;
    }

    public function setClosed(int $closed): void
    {
        $this->closed = $closed;
    }

    public function getClosedFromDate(): ?\DateTime
    {
        return $this->closedFromDate;
    }

    public function setClosedFromDate(?\DateTime $closedFromDate = null): void
    {
        $this->closedFromDate = $closedFromDate;
    }

    public function getClosedToDate(): ?\DateTime
    {
        return $this->closedToDate;
    }

    public function setClosedToDate(?\DateTime $closedToDate = null): void
    {
        $this->closedToDate = $closedToDate;
    }

    public function getOpenMonday(): string
    {
        return $this->openMonday;
    }

    public function setOpenMonday(string $openMonday): void
    {
        $this->openMonday = $openMonday;
    }

    public function getCloseMonday(): string
    {
        return $this->closeMonday;
    }

    public function setCloseMonday(string $closeMonday): void
    {
        $this->closeMonday = $closeMonday;
    }

    public function getOpenMonday2(): string
    {
        return $this->openMonday2;
    }

    public function setOpenMonday2(string $openMonday2): void
    {
        $this->openMonday2 = $openMonday2;
    }

    public function getCloseMonday2(): string
    {
        return $this->closeMonday2;
    }

    public function setCloseMonday2(string $closeMonday2): void
    {
        $this->closeMonday2 = $closeMonday2;
    }

    public function getOpenTuesday(): string
    {
        return $this->openTuesday;
    }

    public function setOpenTuesday(string $openTuesday): void
    {
        $this->openTuesday = $openTuesday;
    }

    public function getCloseTuesday(): string
    {
        return $this->closeTuesday;
    }

    public function setCloseTuesday(string $closeTuesday): void
    {
        $this->closeTuesday = $closeTuesday;
    }

    public function getOpenTuesday2(): string
    {
        return $this->openTuesday2;
    }

    public function setOpenTuesday2(string $openTuesday2): void
    {
        $this->openTuesday2 = $openTuesday2;
    }

    public function getCloseTuesday2(): string
    {
        return $this->closeTuesday2;
    }

    public function setCloseTuesday2(string $closeTuesday2): void
    {
        $this->closeTuesday2 = $closeTuesday2;
    }

    public function getOpenWednesday(): string
    {
        return $this->openWednesday;
    }

    public function setOpenWednesday(string $openWednesday): void
    {
        $this->openWednesday = $openWednesday;
    }

    public function getCloseWednesday(): string
    {
        return $this->closeWednesday;
    }

    public function setCloseWednesday(string $closeWednesday): void
    {
        $this->closeWednesday = $closeWednesday;
    }

    public function getOpenWednesday2(): string
    {
        return $this->openWednesday2;
    }

    public function setOpenWednesday2(string $openWednesday2): void
    {
        $this->openWednesday2 = $openWednesday2;
    }

    public function getCloseWednesday2(): string
    {
        return $this->closeWednesday2;
    }

    public function setCloseWednesday2(string $closeWednesday2): void
    {
        $this->closeWednesday2 = $closeWednesday2;
    }

    public function getOpenThursday(): string
    {
        return $this->openThursday;
    }

    public function setOpenThursday(string $openThursday): void
    {
        $this->openThursday = $openThursday;
    }

    public function getCloseThursday(): string
    {
        return $this->closeThursday;
    }

    public function setCloseThursday(string $closeThursday): void
    {
        $this->closeThursday = $closeThursday;
    }

    public function getOpenThursday2(): string
    {
        return $this->openThursday2;
    }

    public function setOpenThursday2(string $openThursday2): void
    {
        $this->openThursday2 = $openThursday2;
    }

    public function getCloseThursday2(): string
    {
        return $this->closeThursday2;
    }

    public function setCloseThursday2(string $closeThursday2): void
    {
        $this->closeThursday2 = $closeThursday2;
    }

    public function getOpenFriday(): string
    {
        return $this->openFriday;
    }

    public function setOpenFriday(string $openFriday): void
    {
        $this->openFriday = $openFriday;
    }

    public function getCloseFriday(): string
    {
        return $this->closeFriday;
    }

    public function setCloseFriday(string $closeFriday): void
    {
        $this->closeFriday = $closeFriday;
    }

    public function getOpenFriday2(): string
    {
        return $this->openFriday2;
    }

    public function setOpenFriday2(string $openFriday2): void
    {
        $this->openFriday2 = $openFriday2;
    }

    public function getCloseFriday2(): string
    {
        return $this->closeFriday2;
    }

    public function setCloseFriday2(string $closeFriday2): void
    {
        $this->closeFriday2 = $closeFriday2;
    }

    public function getOpenSaturday(): string
    {
        return $this->openSaturday;
    }

    public function setOpenSaturday(string $openSaturday): void
    {
        $this->openSaturday = $openSaturday;
    }

    public function getCloseSaturday(): string
    {
        return $this->closeSaturday;
    }

    public function setCloseSaturday(string $closeSaturday): void
    {
        $this->closeSaturday = $closeSaturday;
    }

    public function getOpenSaturday2(): string
    {
        return $this->openSaturday2;
    }

    public function setOpenSaturday2(string $openSaturday2): void
    {
        $this->openSaturday2 = $openSaturday2;
    }

    public function getCloseSaturday2(): string
    {
        return $this->closeSaturday2;
    }

    public function setCloseSaturday2(string $closeSaturday2): void
    {
        $this->closeSaturday2 = $closeSaturday2;
    }

    public function getOpenSunday(): string
    {
        return $this->openSunday;
    }

    public function setOpenSunday(string $openSunday): void
    {
        $this->openSunday = $openSunday;
    }

    public function getCloseSunday(): string
    {
        return $this->closeSunday;
    }

    public function setCloseSunday(string $closeSunday): void
    {
        $this->closeSunday = $closeSunday;
    }

    public function getOpenSunday2(): string
    {
        return $this->openSunday2;
    }

    public function setOpenSunday2(string $openSunday2): void
    {
        $this->openSunday2 = $openSunday2;
    }

    public function getCloseSunday2(): string
    {
        return $this->closeSunday2;
    }

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
