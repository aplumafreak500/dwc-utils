# dwc-utils

A set of PHP utilities to easily calculate Nintendo Wi-Fi Connection/Wiimmfi/AltWFC friend codes and profile IDs, for regional conversion, testing purposes, or simply to play around with.

## Installation

If you don't have a PHP-enabled HTTP server, install Apahce and PHP. The gmp module is required, however.

Replace Apache with any PHP-compatible Web server (like Nginx) if desired.

The gmp module comes with PHP on Windows, but you may need to enable it in your php.ini.

For Debian/Ubuntu:

```sh
sudo apt-get install php5 apache2 php5-gmp
```

Clone the repository into your server root:

```sh
cd /var/www/html
git clone --recrusive https://github.com/aplumafreak500/dwc-utils
```
And you're set.

```sh
wget -O fc.txt "http://127.0.0.1/dwc-utils/fc.php?gid=RMCJ&pid=12345&m=wii"
cat fc.txt
```

## GET Parameters

### ms.php
Calculates the ms%d domain for the input.

* game - Internal game name, defaults to "mariokartwii".
* domain - Domain name used in the output, defaults to "nintendowifi.net".

### fc.php
Calculates a friend code from a PID.

* pid - DWC Profile ID, defaults to 1.
* m - Hash method. Keywords "wii" and "ds" will calculate based on MD5 and CRC8 respectively. CalcEtc_FC() relies on hash(), so only hash algorithims supported by your system can be used. Many thanks to Anton Isakov for CRC8 code. Defaults to "wii".
* gid - ID4 of the game. Defaults to "RMCJ" (or AMCJ if generating a DS friend code).
* rev - Reverses the output (for some DS games). Defaults to 0.

### pid.php
Calculates a PID from an FC.

* fc - DWC friend code, without dashes. Leading zeros are optional. Defaults to 021474836481.
* rev - Reverses the input before calculating the PID. Defaults to 0.

## License
This software is licensed under the GNU General Public License v3.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

Uses code by Anton Isakov (<http://crccalc.com>) licensed under the MIT License.

Copyright © 2018 Alex Pensinger (APLumaFreak500). All rights reserved.