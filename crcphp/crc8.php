<?php
include_once 'crcstructs.php';
class Crc8 {

    public function ComputeCrc($crcParams, $data) {
        $crc = $crcParams->Init;

        foreach ($data as $d) {
            $crc = $crcParams->Array[$d ^ $crc];
        }

        $crc = $crc ^ $crcParams->XorOut;

        $result = new CrcResult();
        $result->Crc = $crc & 0xFF;

        return $result;
    }
}

include_once 'crc8/crc_8.php';


$crcList = array(
    $CRC_8_
);