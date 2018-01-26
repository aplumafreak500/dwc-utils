<?php

/*
    ms.php - Nintendo WFC "ms" subdomain calculator
    Copyright © 2018 Alex Pensinger (APLumaFreak500)
    This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
    You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

header("Content-Type: text/plain; charset=utf-8");
if (!isset($_GET["game"])) {
	$game="mariokartwii";
}
else {
	$game=$_GET["game"];
}
if (!isset($_GET["domain"])) {
	$domain="nintendowifi.net";
}
else {
	$domain=$_GET["domain"];
}
function CalcMS($game) {
	$svr=gmp_init(0,10);
	for ($i=0;$i<strlen($game);$i++) {
		$c=ord(strtolower($game[$i]));
		$svr=gmp_sub((gmp_mul(1664117991,$svr)),$c);
	}
	return gmp_strval(gmp_abs(gmp_div_r($svr,20)));
	
}
echo $game.".ms".CalcMS($game).".gs.".$domain;
?>