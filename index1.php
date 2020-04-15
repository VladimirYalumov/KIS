<?
$n = 2;
$flight[0] = '19.12.2018_19:10:00 -5 20.12.2018_12:25:00 3';
$flight[1] = '19.12.2018_06:45:00 7 19.12.2018_06:45:01 8';

$pieces = explode(" ", $flight[0]);

for($i=0; $i<$n; $i++){
    $pieces = explode(" ", $flight[$i]);

    $new = explode("_", $pieces[0]);
    $new_date = explode(".", $new[0]);
    $new_date_part = $new_date[2]."-".$new_date[1]."-".$new_date[0];
    $pieces[0] = $new_date_part." ".$new[1];

    $new = explode("_", $pieces[2]);
    $new_date = explode(".", $new[0]);
    $new_date_part = $new_date[2]."-".$new_date[1]."-".$new_date[0];
    $pieces[2] = $new_date_part." ".$new[1];

    // timestamp первой даты
    $d1_ts = strtotime($pieces[0]);

    // timestamp второй даты
    $d2_ts = strtotime($pieces[2]);

    $d1_ts = $d1_ts + $pieces[1]*3600;
    $d2_ts = $d2_ts + $pieces[3]*3600;

    //echo $seconds;
    echo abs($d1_ts - $d2_ts)."<br>";
}