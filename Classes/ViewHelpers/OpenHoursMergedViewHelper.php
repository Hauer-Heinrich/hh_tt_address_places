<?php
declare(strict_types=1);

namespace HauerHeinrich\HhTtAddressPlaces\ViewHelpers;

/*
    Usage: (Input can be the raw database row (array) OR a PeriodOfTime domain model.)

    <places:openHoursMerged hours="{openingHours}" />
    <places:openHoursMerged hours="{periodOfTime}" />

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
    //
    // or:
    //
    // $openingHours = instance of \HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime
*/

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use HauerHeinrich\HhTtAddressPlaces\Domain\Model\PeriodOfTime;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;


final class OpenHoursMergedViewHelper extends AbstractViewHelper {
    /**
    * @var bool
    */
    protected $escapeOutput = false;

    private const WEEKDAYS = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    public function initializeArguments(): void {
        $this->registerArgument('hours', 'mixed', 'Opening hours as raw database row (array) or as PeriodOfTime domain model', true);
        $this->registerArgument('timeFormat', 'string', 'Time format e. g. "H:i:s"', false, 'H:i');
        $this->registerArgument('seperator', 'string', 'Seperator between opening hour and closing hour', false, ' - ');
        $this->registerArgument('mergedDays', 'bool', 'If you want to group the weekdays if they has the same opening/closing times', false, false);
        $this->registerArgument('mergedDaysSeperator', 'string', 'Seperator between merged days (if mergedDays is set)', false, ' - ');
    }

    public function render(): array {
        $openingHours = $this->normalizeHours($this->arguments['hours']);

        // '00:00:00' comes from raw database rows, '' (empty string) from the domain model.
        // Both mean "no opening time set" and must be removed, otherwise
        // new \DateTime('') would silently resolve to the *current* time!
        $shortenOpeningHours = array_diff($openingHours, ['00:00:00', '']);
        $timeFormat = isset($this->arguments['timeFormat']) ? $this->arguments['timeFormat'] : 'H:i';

        $newArray = array_fill_keys(self::WEEKDAYS, []);
        $resultArray = [];

        foreach ($newArray as $resultDay => $resultValue) {
            foreach ($shortenOpeningHours as $day => $value) {
                if(str_contains($day, 'appointment_'.$resultDay) && (int)$value === 1) {
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

    /**
     * Brings both supported input types into the flat snake_case structure
     * of the raw database row, so the rest of the ViewHelper can stay untouched.
     *
     * Arrays are passed through as-is. Objects (e. g. the PeriodOfTime domain
     * model) are mapped via their getters - method_exists() is used, so any
     * object providing the same getters will work as well ("duck typing").
     *
     * @param array|object $hours
     */
    private function normalizeHours($hours): array {
        if (is_array($hours)) {
            return $hours;
        }

        if (!is_object($hours) && !$hours instanceof PeriodOfTime) {
            throw new \InvalidArgumentException(
                'The argument "hours" must be an array or an object like ' . PeriodOfTime::class . ', ' . gettype($hours) . ' given.',
                1786320001
            );
        }

        $fieldToGetterMap = [
            'title' => 'getTitle',
            'description' => 'getDescription',
            'closed' => 'getClosed',
            'valid_for' => 'getValidFor',
        ];

        foreach (self::WEEKDAYS as $day) {
            $ucDay = \ucfirst($day);

            $fieldToGetterMap['open_' . $day] = 'getOpen' . $ucDay;
            $fieldToGetterMap['open_' . $day . '2'] = 'getOpen' . $ucDay . '2';
            $fieldToGetterMap['close_' . $day] = 'getClose' . $ucDay;
            $fieldToGetterMap['close_' . $day . '2'] = 'getClose' . $ucDay . '2';
            $fieldToGetterMap['appointment_' . $day] = 'getAppointment' . $ucDay;
        }

        $normalized = [];
        foreach ($fieldToGetterMap as $field => $getter) {
            if (method_exists($hours, $getter)) {
                $normalized[$field] = $hours->{$getter}();
            }
        }

        return $normalized;
    }
}
