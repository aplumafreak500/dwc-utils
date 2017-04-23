<?php
header("Content-Type: text/plain; charset=utf-8");
if (!isset($_GET["pid"])) {
	$pid=gmp_init("0",10);
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
function CalcFC($profile_id, $game_id) {
    $csum = md5(pack("V",gmp_intval($profile_id)).strrev($game_id),true);
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function CalcDS_FC($profile_id, $game_id) {
    $csum = crc8(sbin2ar(pack("V",gmp_intval($profile_id)).strrev($game_id),true));
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function CalcCRC16_FC($profile_id, $game_id) {
    $csum = crc16(sbin2ar(pack("V",gmp_intval($profile_id)).strrev($game_id),true));
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
	$fc=gmp_strval($return,10);
	return $fc;
}
function CalcSHA1_FC($profile_id, $game_id) {
    $csum = sha1(pack("V",gmp_intval($profile_id)).strrev($game_id),true);
    $return=gmp_or($profile_id, gmp_shiftl((ord($csum) & 0xfe), 31));
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
function crcnifull ($dato, $byte)
{
  static $PolyFull=0x8c;

  for ($i=0; $i<8; $i++)
  {
    $x=$byte&1;
    $byte>>=1;
    if ($dato&1) $byte|=0x80;
    if ($x) $byte^=$PolyFull;
    $dato>>=1;
  }
  return $byte;
}

function crc8 (array $ar,$n=false)
{
  if ($n===false) $n=count($ar);
  $crcbyte=0;
  for ($i=0; $i<$n; $i++) $crcbyte=crcnifull($ar[$i], $crcbyte);
  return $crcbyte;
}
function crcnifull16 ($dato, $byte)
{
  static $PolyFull=0x8c;

  for ($i=0; $i<16; $i++)
  {
    $x=$byte&1;
    $byte>>=1;
    if ($dato&1) $byte|=0x80;
    if ($x) $byte^=$PolyFull;
    $dato>>=1;
  }
  return $byte;
}

function crc16 (array $ar,$n=false)
{
  if ($n===false) $n=count($ar);
  $crcbyte=0;
  for ($i=0; $i<$n; $i++) $crcbyte=crcnifull16($ar[$i], $crcbyte);
  return $crcbyte;
}
function sbin2ar($sbin)
{
  $ar=array();
  $ll=strlen($sbin);
  for ($i=0; $i<$ll; $i++) $ar[]=ord(substr($sbin,$i,1));
  return $ar;
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
else if ($m=="crc16"){
	if ($rev==1) {
		echo strrev(str_pad(CalcCRC16_FC($pid,$gid),12,"0",STR_PAD_LEFT));
	}
	else {
		echo str_pad(CalcCRC16_FC($pid,$gid),12,"0",STR_PAD_LEFT);
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