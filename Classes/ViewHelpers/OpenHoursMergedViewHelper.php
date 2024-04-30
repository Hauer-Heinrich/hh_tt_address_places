<?php
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
    // ];
*/

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use \TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;



class OpenHoursMergedViewHelper extends AbstractViewHelper {
    /**
    * As this ViewHelper renders HTML, the output must not be escaped.
    *
    * @var bool
    */
    protected $escapeOutput = false;

    use CompileWithRenderStatic;

    public function initializeArguments(){
        $this->registerArgument('hours', 'array', '', true);
        $this->registerArgument('timeFormat', 'string', 'Time format e. g. "H:i:s"', false, 'H:i');
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext){
        $openingHours = $arguments['hours'];
        $shortenOpeningHours = array_diff($openingHours, ['00:00:00']);
        $timeFormat = isset($arguments['timeFormat']) ? $arguments['timeFormat'] : 'H:i';

        $newArray = [
            'monday' => '',
            'tuesday' => '',
            'wednesday' => '',
            'thursday' => '',
            'friday' => '',
            'saturday' => '',
            'sunday' => ''
        ];

        foreach ($newArray as $resultDay => $resultValue) {
            foreach ($shortenOpeningHours as $day => $value) {
                switch ($day) {
                    case str_contains($day, 'open_'.$resultDay):
                        if(isset($shortenOpeningHours['open_'.$resultDay]) && isset($shortenOpeningHours['close_'.$resultDay])) {
                            $timeOpen = new \DateTime($shortenOpeningHours['open_'.$resultDay]);
                            $timeClose = new \DateTime($shortenOpeningHours['close_'.$resultDay]);
                            $newArray[$resultDay] = $timeOpen->format($timeFormat) . ' - ' . $timeClose->format($timeFormat);
                        }

                        if(isset($shortenOpeningHours['open_'.$resultDay.'2']) && isset($shortenOpeningHours['close_'.$resultDay.'2'])) {
                            $newArray[$resultDay] .= empty($newArray[$resultDay]) ? '' : ', ' ;
                            $timeOpen2 = new \DateTime($shortenOpeningHours['open_'.$resultDay.'2']);
                            $timeClose2 = new \DateTime($shortenOpeningHours['close_'.$resultDay.'2']);
                            $newArray[$resultDay] .= $timeOpen2->format($timeFormat) . ' - ' . $timeClose2->format($timeFormat);
                        }
                    break;
                    default:
                        break;
                }
            }
        }

        $resultArray = [];
        $i = 0;
        foreach ($newArray as $resultDay => &$resultValue) {
            if(!empty($resultValue)) {
                $sameDays = array_intersect($newArray, [$resultValue]);
                if(empty(next($newArray)) || next($newArray) != prev($newArray)) {
                    $resultArray[] = [$resultDay => $sameDays[$resultDay]];
                    unset($newArray[$resultDay]);
                } else {
                    $resultArray[] = $sameDays;
                    foreach ($sameDays as $k => $v) {
                        unset($newArray[$k]);
                    }
                }
            }
            $i++;
        }

        $result = [];
        foreach ($resultArray as $key => $value) {
            if(count($value) > 2) {
                $result[] = LocalizationUtility::translate('day.'.array_key_first($value), 'hh_tt_address_places') . " - " . LocalizationUtility::translate('day.'.array_key_last($value), 'hh_tt_address_places') . ': ' . $value[array_key_last($value)];
                continue;
            }
            $result[] = LocalizationUtility::translate('day.'.array_key_first($value), 'hh_tt_address_places') . ': ' . $value[array_key_last($value)];
        }

        return $result;
    }
}
