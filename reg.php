<?php
$name = isset($_POST['userName']) ? $_POST['userName'] : 'No Name Given';
$age = isset($_POST['userAge']) ? $_POST['userAge'] : 'No Age';
$city = isset($_POST['userCity']) ? $_POST['userCity'] : 'No City';

$csvFile = file('csv/users.csv');
$count = count($csvFile);
$info = [++$count, $name, $age, $city];
$csvFile = fopen('csv/users.csv', 'a');
fputcsv($csvFile, $info);
fclose($csvFile);

$csvFile = fopen('csv/users.csv', 'r');
$users = array();
while(!feof($csvFile)) {
    $user = fgetcsv($csvFile);
    if (empty($user)) {
        break;
    }
    array_push($users, $user);
}

fclose($csvFile);

echo json_encode($users);

