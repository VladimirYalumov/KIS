<?php
$fp = fopen('входные данные для третьей задачи.txt', 'r');
$arr = [];

if ($fp) {
    while (($buffer = fgets($fp)) !== false) {
        $str = $buffer;
        echo $buffer;
    }
}
fclose($fp);

$result = substr($str, 0, 4);


if ($str[4] == 's'){
    $result = $result . $str[4];
    $protocol_end_pos = 5;
} else {
    $protocol_end_pos = 4;
}

$result  = $result . '://';

$loc_pos = strpos($str, 'ru');
$loc_rpos = $loc_pos+ 2;
$loc = 'ru';
if ($loc_pos == False){
    $loc_pos = strpos($str, 'com');
    $loc_rpos = $loc_pos + 3;
    $loc = 'com';
}

$result = $result . substr($str, $protocol_end_pos, $loc_pos - $protocol_end_pos) . '.' . $loc . '/' . substr($str, $loc_rpos);

$fp = fopen('выходные данные для третьей задачи.txt', 'a');
fwrite($fp, $result);
fclose($fp);
?>