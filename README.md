# hh_tt_address_places
hh_tt_address_places is a TYPO3 extension.
Use tt_address not only to manage / deliver personal addresses but also for locations / company addresses incl. opening hours.

### Installation
... like any other TYPO3 extension [extensions.typo3.org](https://extensions.typo3.org/ "TYPO3 Extension Repository")
Don't forget to include the PageTS -> backend->rootPage->site configuration->resources!

### Configuration
Add the PageTs to the page / directory (from TYPO3 BE site-tree).
Keep default tt_address (persons) and hh_tt_address_places (places / companies) in a seperate page / directory!
(optional) Add the PageTs (hh_tt_address_places - Allow only Places / Companies) to the storage place of your places / companies.

### Usage
You should have all functions from the EXT:tt_address plugins, so use the tt_address plugins to show the places / companies like the "normal" tt_address entries.
For the opening hours: there are example for the FLUID output at hh_tt_address_places/Resources/Private/Partials/

### ViewHelper
#### openHoursMerged
Usage example: (Input can be any supported date and time format).
optional: timeformat (default: H:i).


$openingHours description, supports lunch break or similar:
open_monday: opening time in the morning (08:00:00),
close_monday: closing time in the morning (12:00:00),
open_monday2: opening time in the afternoon (13:00:00),
close_monday2: closing time in the afternoon (17:00:00)
Results in 08:00 - 12:00, 13:00 - 1700

If you do not want to display a lunch break or similar, please use open_monday and close_monday2 for the opening and closing times.
open_monday: Opening time in the morning (08:00:00),
close_monday2: closing time in the afternoon (17:00:00)
Results in 08:00 - 17:00

```
$openingHours = [
    'open_monday' => '08:00:00',
    'close_monday' => '18:30:00',
    'open_monday2' => '00:00:00',
    'close_monday2' => '00:00:00',
    'open_tuesday' => '13:00:00',
    'close_tuesday' => '18:30:00',
    'open_tuesday2' => '00:00:00',
    'close_tuesday2' => '00:00:00',
    'open_wednesday' => '08:00:00',
    'close_wednesday' => '18:30:00',
    'open_wednesday2' => '00:00:00',
    'close_wednesday2' => '00:00:00',
    'open_thursday' => '08:00:00',
    'close_thursday' => '12:30:00',
    'open_thursday2' => '13:00:00',
    'close_thursday2' => '18:00:00',
    'open_friday' => '08:00:00',
    'close_friday' => '18:30:00',
    'open_friday2' => '00:00:00',
    'close_friday2' => '00:00:00',
    'open_saturday' => '09:00:00',
    'close_saturday' => '12:00:00',
    'open_saturday2' => '00:00:00',
    'close_saturday2' => '00:00:00',
    'open_sunday' => '00:00:00',
    'close_sunday' => '00:00:00',
    'open_sunday2' => '00:00:00',
    'close_sunday2' => '00:00:00',
];

<html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
    xmlns:places="http://typo3.org/ns/HauerHeinrich/HhTtAddressPlaces/ViewHelpers"
    data-namespace-typo3-fluid="true">

<f:variable name="openHours"><places:openHoursMerged hours="{openingHours}" timeFormat="H:i" /></f:variable>
<f:if condition="{openHours}">
    <f:for each="{openHours}" as="hours">
        <span>{hours}</span>
        <f:comment>{hours} = e. g. "Monday - Friday: 08:00 - 18:30"</f:comment>
    </f:for>
</f:if>
```

Translation via TypoScript for the days e. g.:
```
plugin.tx_hh_tt_address_places {
    _LOCAL_LANG {
        de {
            day.monday = Montag
            day.tuesday = Dienstag
            day.wednesday = Mittwoch
            day.thursday = Donnerstag
            day.friday = Freitag
            day.saturday = Samstag
            day.sunday = Sonntag

            day.hour = Uhr
            day.appointment = nur nach Vereinbarung
        }
    }
}
```

### Development

Want to contribute? Great!

#### Preview images:
![example picture from backend](.github/images/opening-hours.jpg?raw=true "opening-hours")
![example picture from backend](.github/images/opening-hours-detail.jpg?raw=true "opening-hours")

##### Copyright notice

This repository is part of the TYPO3 project. The TYPO3 project is
free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

The GNU General Public License can be found at
http://www.gnu.org/copyleft/gpl.html.

This repository is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

This copyright notice MUST APPEAR in all copies of the repository!

##### License
----
GNU GENERAL PUBLIC LICENSE Version 3
