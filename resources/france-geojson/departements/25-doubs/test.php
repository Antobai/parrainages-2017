<?php
$content = file_get_contents('communes-25-doubs.geojson');
$datas = json_decode($content);
$i = 0;
foreach($datas->features as $k=>$v) {
    print_r($v);
    exit;
    $i = $i+count($v->Parrainages);
}
echo "\r\n";
echo $i;
//print_r($datas);
