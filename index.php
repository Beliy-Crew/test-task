<?php

//функция вывода информации для удобного чтения
function die_r($value) {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    die();
}

//подсоединение класса
require_once './Database.php';

//переменная которая принимает объект
$db = new Database();

//Вызываем метод getRow выбор по id
//$getRow = (object) $db->getRow("SELECT * FROM users WHERE id = ?", ["2"]);
//die_r($getRow);

//Вызываем метод getRows
$getRows = (object) $db->getRows("SELECT * FROM users");
//die_r($getRows);

//Внесение в базу 
//$insertRow = $db->insertRow ("INSERT INTO `users` (`id`, `name`, `surname`, `births`, `gender`, `city`) VALUES(?, ?, ?, ?, ?, ?)", [
//  NULL, 'Дмитрий', 'Абрамович', '1980-05-10', '1', 'Минск']);
//die_r($insertRow);


//изменение записи  выбор по id
//$updateRow = $db->updateRow("UPDATE users SET name = ?, surname = ?, births = ?, gender = ?, city = ? WHERE id = ?", [
//  'Измена', 'Изменённый', '2000-01-01', '0', 'Неизвестно', '4']);
//die_r($updateRow);


//удаление записи выбор по id
//$deleteRow = $db->deleteRow("DELETE FROM users WHERE id = ?", ['4']);
//die_r($deleteRow;


//$id = $getRows->id;
//$name = $getRows->name;
//$surname = $getRows->surname;
//$births = $getRows->births;
//$gender = $getRows->gender;
//$city = $getRows->city;


//преобразование пола
//if ($gender == '1') {
//    $gender = 'муж';
//} elseif ($gender == '0') {
//    $gender = 'жен';
//} else {
//    $gender = 'неопределён';
//}


//преобразование даты в полных лет
//$origin = new DateTime($births);
//$target = new DateTime();
//$interval = $origin->diff($target);
//$births1 = $interval->format('%r%y'); //только года
//echo $interval->format('%r%y years'); //только года
//echo $interval->format('%r%y years, %m months, %d days'); //год, месяц, день

//echo 'id - ' . $id . '; ' . $name . ' ' . $surname . '; возраст - ' . $births1 . '; пол - ' . $gender . '; город рождения - ' . $city . '.';
//die_r($object);


foreach ($getRows as $item) {

    $origin = new DateTime($item['births']);
    $target = new DateTime();
    $interval = $origin->diff($target);
    $births1 = $interval->format('%r%y'); //только года

    if ($item['gender'] == '1') {
        $gender = 'муж.';
    } elseif ($item['gender'] == '0') {
        $gender = 'жен.';
    } else {
        $gender = 'неопределён';
    }

    echo "Имя: {$item['name']} <br>";
    echo "Фамилия: {$item['surname']} <br>";
    echo "Д.Р.: {$item['births']} <br>";
    echo "Возраст: $births1 <br>";
    echo "Пол: $gender <br>";
    echo "Город: {$item['city']} <br>";
    echo '<hr>';
}