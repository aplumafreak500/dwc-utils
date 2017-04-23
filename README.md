# dwc-utils

## GET Parameters

### ms.php
Calculates the ms%d domain for the input.

* game - Internal game name

### fc.php
Calculates a friend code from a PID.

* pid - DWC Profile ID
* m - Hash method. Keywords "wii" and "ds" will calculate based on MD5 and CRC8 respectively. Also has CRC16 support. CalcEtc_FC relies on hash(), so only hash algorithims supported by your system can be used.
* gid - ID4 of the game
* rev - Reverses the output (for some DS games)

### pid.php
Calculates a PID from an FC.

* fc - DWC friend code, without dashes
* rev - Reverses the input before calculating the PID

## License
This software is licensed under the GNU General Public License v3.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

Copyright © 2017 Alex Pensinger (APLumaFreak500). All rights reserved.