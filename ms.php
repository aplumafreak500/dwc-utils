<?php
header("Content-Type: text/plain; charset=utf-8");
if (!isset($_GET["game"])) {
	$game="mariokartwii";
}
else {
	$game=$_GET["game"];
}
function CalcMS($game) {
	$svr=gmp_init(0,10);
	for ($i=0;$i<strlen($game);$i++) {
		$c=ord(strtolower($game[$i]));
		$svr=gmp_sub((gmp_mul(1664117991,$svr)),$c);
	}
	$return=gmp_abs(gmp_div_r($svr,20));
	return gmp_strval($return);
	
}
echo $game.".ms".CalcMS($game).".gs.nintendowifi.net";