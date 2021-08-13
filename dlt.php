<?php
$row = isset($_POST['row']) ? $_POST['row'] : 'No Row';

$csvFile = fopen('csv/users.csv', 'r');
$users = array();
while(!feof($csvFile)) {
    $user = fgetcsv($csvFile);
    if (empty($user))
        break;
    if ($user[0] != $row)
        array_push($users, $user);
}

fclose($csvFile);

$csvFile = fopen('csv/users.csv', 'w');
foreach ($users as $user) {
    fputcsv($csvFile, $user);
}
fclose($csvFile);

$csvFile = fopen('csv/users.csv', 'r');
$users = array();
while(!feof($csvFile)) {
    $user = fgetcsv($csvFile);
    if (empty($user))
        break;
    array_push($users, $user);
}

fclose($csvFile);

echo json_encode($users);

?>