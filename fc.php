<?php

/*
    fc.php - Nintendo WFC friend code calculator
    Copyright © 2018 Alex Pensinger (APLumaFreak500)
    This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
    You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

include_once("crcphp/crc8.php");

header("Content-Type: text/plain");
if (!isset($_GET["pid"])) {
	$pid=gmp_init("1",10);
}
else {
	$pid=gmp_init($_GET["pid"], 10);
}
if (!isset($_GET["m"])) {
	$m="wii";
}
else {
	$m=$_GET["m"];
}
if (!isset($_GET["gid"])) {
	if ($m=="ds" or $m=="crc8"){
		$gid="AMCJ";
	}
	else if ($m=="wii" or $m=="md5"){
		$gid="RMCJ";
	}
	else {
		$gid="RMCJ";
	}
}
else {
	$gid=$_GET["gid"];
}
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

function sbin2ar($sbin)
{
  $ar=array();
  $ll=strlen($sbin);
  for ($i=0; $i<$ll; $i++) $ar[]=ord(substr($sbin,$i,1));
  return $ar;
}

function CalcFC($profile_id, $game_id) {
    $csum = md5(pack("V",gmp_intval($profile_id)).strrev($game_id),true);
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function CalcDS_FC($profile_id, $game_id) {
	global $CRC_8_;
	$crc8 = new Crc8();
    $csum = $crc8->ComputeCrc($CRC_8_,sbin2ar(pack("V",gmp_intval($profile_id)).strrev($game_id),true));
    $return=gmp_or($profile_id, gmp_shiftl(($csum->Crc & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function CalcEtc_FC($profile_id, $game_id, $method) {
    $csum = hash($method, pack("V",gmp_intval($profile_id)).strrev($game_id),true);
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function gmp_shiftl($x,$n) {
  return(gmp_mul($x,gmp_pow(2,$n))); 
} 

function gmp_shiftr($x,$n) {
  return(gmp_div($x,gmp_pow(2,$n))); 
} 
if ($m=="wii" or $m=="md5") {
	if ($rev==1) {
		echo strrev(str_pad(CalcFC($pid,$gid),12,"0",STR_PAD_LEFT));
	}
	else {
		echo str_pad(CalcFC($pid,$gid),12,"0",STR_PAD_LEFT);
	}
}
else if ($m=="ds" or $m=="crc8"){
	if ($rev==1) {
		echo strrev(str_pad(CalcDS_FC($pid,$gid),12,"0",STR_PAD_LEFT));
	}
	else {
		echo str_pad(CalcDS_FC($pid,$gid),12,"0",STR_PAD_LEFT);
	}
}
else {
	if ($rev==1) {
		echo @strrev(str_pad(CalcEtc_FC($pid,$gid,$m),12,"0",STR_PAD_LEFT));
	}
	else {
		echo @str_pad(CalcEtc_FC($pid,$gid,$m),12,"0",STR_PAD_LEFT);
	}
}
?>