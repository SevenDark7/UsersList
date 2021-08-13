<?php

$id = isset($_POST['id']) ? $_POST['id'] : 'No ID';
$name = isset($_POST['name']) ? $_POST['name'] : 'No Name';
$age = isset($_POST['age']) ? $_POST['age'] : 'No Age';
$city = isset($_POST['city']) ? $_POST['city'] : 'No City';

$edtUser = [$id, $name, $age, $city];
$users = array();
$csvFile = fopen('csv/users.csv', 'r');
while (!feof($csvFile)) {
    $data = fgetcsv($csvFile);
    if (empty($data))
        break;
        
    if ($data[0] != $id) {
        array_push($users, $data);
    }
    else {
        array_push($users, $edtUser);
    }
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



