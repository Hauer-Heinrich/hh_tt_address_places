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
