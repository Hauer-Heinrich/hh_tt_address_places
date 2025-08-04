<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\ViewHelpers;

/*
    Usage: (Input can be any supported date and time format.)
    <places:openHoursMerged hours="{openingHours}" />

    <f:variable name="openHours"><places:openHoursMerged hours="{openingHours}" /></f:variable>
    <f:if condition="{openHours}">
        <f:for each="{openHours}" as="hours">
            <span>{hours}</span>
        </f:for>
    </f:if>

    // $openingHours = [
    //     'open_monday' => '08:00:00',
    //     'close_monday' => '18:30:00',
    //     'open_monday2' => '00:00:00',
    //     'close_monday2' => '00:00:00',
    //     'open_tuesday' => '13:00:00',
    //     'close_tuesday' => '18:30:00',
    //     'open_tuesday2' => '00:00:00',
    //     'close_tuesday2' => '00:00:00',
    //     'open_wednesday' => '08:00:00',
    //     'close_wednesday' => '18:30:00',
    //     'open_wednesday2' => '00:00:00',
    //     'close_wednesday2' => '00:00:00',
    //     'open_thursday' => '08:00:00',
    //     'close_thursday' => '12:30:00',
    //     'open_thursday2' => '13:00:00',
    //     'close_thursday2' => '18:00:00',
    //     'open_friday' => '08:00:00',
    //     'close_friday' => '18:30:00',
    //     'open_friday2' => '00:00:00',
    //     'close_friday2' => '00:00:00',
    //     'open_saturday' => '09:00:00',
    //     'close_saturday' => '12:00:00',
    //     'open_saturday2' => '00:00:00',
    //     'close_saturday2' => '00:00:00',
    //     'open_sunday' => '00:00:00',
    //     'close_sunday' => '00:00:00',
    //     'open_sunday2' => '00:00:00',
    //     'close_sunday2' => '00:00:00',
    //     'appointment_monday' => 0,
    //     'appointment_tuesday' => 0,
    //     'appointment_wednesday' => 0,
    //     'appointment_thursday' => 0,
    //     'appointment_friday' => 0,
    //     'appointment_saturday' => 0,
    //     'appointment_sunday' => 1,
    // ];
*/

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;


final class OpenHoursMergedViewHelper extends AbstractViewHelper {
    /**
    * As this ViewHelper renders HTML, the output must not be escaped.
    *
    * @var bool
    */
    protected $escapeOutput = false;

    public function initializeArguments(){
        $this->registerArgument('hours', 'array', '', true);
        $this->registerArgument('timeFormat', 'string', 'Time format e. g. "H:i:s"', false, 'H:i');
        $this->registerArgument('seperator', 'string', 'Seperator between opening hour and closing hour', false, ' - ');
        $this->registerArgument('mergedDays', 'bool', 'If you want to group the weekdays if they has the same opening/closing times', false, false);
        $this->registerArgument('mergedDaysSeperator', 'string', 'Seperator between merged days (if mergedDays is set)', false, ' - ');
    }

    public function render(): array {
        $openingHours = $this->arguments['hours'];
        $shortenOpeningHours = array_diff($openingHours, ['00:00:00']);
        $timeFormat = isset($this->arguments['timeFormat']) ? $this->arguments['timeFormat'] : 'H:i';

        $newArray = [
            'monday' => [],
            'tuesday' => [],
            'wednesday' => [],
            'thursday' => [],
            'friday' => [],
            'saturday' => [],
            'sunday' => [],
        ];
        $resultArray = [];

        foreach ($newArray as $resultDay => $resultValue) {
            foreach ($shortenOpeningHours as $day => $value) {
                if(str_contains($day, 'appointment_'.$resultDay) && $value === 1) {
                    $resultArray['days'][$resultDay]['appointment'] = 1;
                }

                if(str_contains($day, 'open_'.$resultDay)) {
                    if(isset($shortenOpeningHours['open_'.$resultDay]) && isset($shortenOpeningHours['close_'.$resultDay])) {
                        $timeOpen = new \DateTime($shortenOpeningHours['open_'.$resultDay]);
                        $timeClose = new \DateTime($shortenOpeningHours['close_'.$resultDay]);
                        $resultArray['days'][$resultDay]['morning'] = $timeOpen->format($timeFormat) . $this->arguments['seperator'] . $timeClose->format($timeFormat);
                    }

                    if(isset($shortenOpeningHours['open_'.$resultDay.'2']) && isset($shortenOpeningHours['close_'.$resultDay.'2'])) {
                        $timeOpen2 = new \DateTime($shortenOpeningHours['open_'.$resultDay.'2']);
                        $timeClose2 = new \DateTime($shortenOpeningHours['close_'.$resultDay.'2']);
                        $resultArray['days'][$resultDay]['afternoon'] = $timeOpen2->format($timeFormat) . $this->arguments['seperator'] . $timeClose2->format($timeFormat);
                    }
                }
            }
        }

        // group an array of weekdays if their contents are identical
        // and the days are consecutive.
        // The day names should be merged, e.g. “monday - thursday”
        if($this->arguments['mergedDays'] == true) {
            $merged = [];
            $prevDay = null;
            $rangeStart = null;
            $prevValue = null;

            foreach ($newArray as $day => $value) {
                if (!isset($resultArray['days'][$day])) {
                    continue;
                }

                $currentValue = $resultArray['days'][$day];

                if ($prevValue === null) {
                    // first element
                    $rangeStart = $day;
                } elseif ($currentValue !== $prevValue) {
                    // New content -> Close previous group
                    if ($rangeStart === $prevDay) {
                        $merged[$rangeStart] = $prevValue;
                        $merged[$rangeStart]['dayFrom'] = $rangeStart;
                    } else {
                        $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"] = $prevValue;
                        $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"]['dayFrom'] = $rangeStart;
                        $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"]['dayTo'] = $prevDay;
                    }
                    $rangeStart = $day;
                }

                // Prepare last run
                $prevDay = $day;
                $prevValue = $currentValue;
            }

            // last element
            if ($rangeStart !== null) {
                if ($rangeStart === $prevDay) {
                    $merged[$rangeStart] = $prevValue;
                    $merged[$rangeStart]['dayFrom'] = $rangeStart;
                } else {
                    $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"] = $prevValue;
                    $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"]['dayFrom'] = $rangeStart;
                    $merged["$rangeStart {$this->arguments['mergedDaysSeperator']} $prevDay"]['dayTo'] = $prevDay;
                }
            }

            if(!empty($merged)) {
                $resultArray['mergedDays'] = $merged;
            }
        }

        if(isset($openingHours['title'])) {
            $resultArray['title'] = $openingHours['title'];
        }

        if(isset($openingHours['description'])) {
            $resultArray['description'] = $openingHours['description'];
        }

        if(isset($openingHours['closed'])) {
            $resultArray['closed'] = $openingHours['closed'];
        }

        if(isset($openingHours['valid_for'])) {
            $resultArray['valid_for'] = $openingHours['valid_for'];
        }

        return $resultArray;
    }
}
