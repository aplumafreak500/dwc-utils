<?php
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
	$fc=0;
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
	$return=gmp_strval(gmp_and($in_fc,"0xffffffff"),10);
	return $return;
	
}
echo CalcPID($fc);

?>