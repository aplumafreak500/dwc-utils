<?php
header("Content-Type: text/plain; charset=utf-8");
if (!isset($_GET["game"])) {
	$game="mariokartwii";
}
else {
	$game=$_GET["game"];
}
if (!isset($_GET["domain"])) {
	$game="nintendowifi.net";
}
else {
	$game=$_GET["domain"];
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