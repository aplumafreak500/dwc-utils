<?php

/*
    pid.php - Nintendo WFC profile ID calculator
    Copyright © 2018 Alex Pensinger (APLumaFreak500)
    This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
    You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

header("Content-Type: text/plain; charset=utf-8");
if (!isset($_GET["rev"])) {
	$rev=0;
}
else {
	if (intval($_GET["rev"])>1) {
		$rev=1;
	}
	else {
		$rev=$_GET["rev"];
	}
}
if (!isset($_GET["fc"])) {
	$fc=gmp_init("021474836481",10);
}
else {
	if ($rev==1) {
		$fc=gmp_init(strrev(str_pad($_GET["fc"],12,"0",STR_PAD_LEFT)),10);
	}
	else {
		$fc=gmp_init(str_pad($_GET["fc"],12,"0",STR_PAD_LEFT),10);
	}
}
function CalcPID($in_fc) {
	return gmp_strval(gmp_and($in_fc,"0xffffffff"),10);
	
}
echo CalcPID($fc);

?>