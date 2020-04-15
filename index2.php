Казино
<?php
$file = fopen('входные данные для второй задачи.txt', 'r');
$rates_by_game = [];
$games_results = [];
if ($file) {
    while (($buffer = fgets($file)) !== false) {
        $buffer = trim($buffer);
        $data_by_string[] = $buffer;
    }
}
fclose($file);

$count_of_rates = $data_by_string[0];
$array_of_rates_on_string = array_slice($data_by_string, 1, $count_of_rates);

foreach ($array_of_rates_on_string as $rate){
    $rates_by_game[$rate[0]] = substr($rate, 2);
}
$count_of_games = $data_by_string[(int)$count_of_rates+1];
$array_of_games_on_string = array_slice($data_by_string, $count_of_games+2);

foreach ($array_of_games_on_string as $game) {
    $games_results[$game[0]] = substr($game, 2);
}

$rate_result= 0;
foreach ($games_results as $gameID => $result_of_game)
{
    $result_of_game = explode(' ', $result_of_game);
    $coefficient_of_loss = (float)$result_of_game[0];
    $coefficient_of_win = (float)$result_of_game[1];
    $coefficient_of_draw = 	(float)$result_of_game[2];
    $game_outcome = $result_of_game[3];

    if (!array_key_exists($gameID, $rates_by_game)) continue;
    $rate_on_game = explode(' ', $rates_by_game[$gameID]);
    $rate_rate = (int)$rate_on_game[0];
    $rate_outcome = $rate_on_game[1];


    if ($rate_outcome != $game_outcome){
        $rate_result-= $rate_rate;
    } else {
        switch ($rate_outcome) {
            case 'L':
                $rate_result = $rate_result + $rate_rate * $coefficient_of_loss - $rate_rate; // прибыль минус ставка
                break;
            case 'R':
                $rate_result = $rate_result + $rate_rate * $coefficient_of_win - $rate_rate;
                break;
            case 'D':
                $rate_result = $rate_result + $rate_rate * $coefficient_of_draw - $rate_rate;
                break;
        }
    }
}

echo "OK";
$file = fopen('выходные данные для второй задачи.txt', 'w+');
fwrite($file, $rate_result);
fclose($file);