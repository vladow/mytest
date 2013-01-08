<?php
include_once '/../imgResize.php';



if (!isset($_COOKIE['new_id'])) {
    echo 'Страница не существует';
} else {
    $id = $_COOKIE['new_id'];
    echo $id;
    $result = mysql_query("SELECT * FROM `news` WHERE id=$id");
    if (!$result)
        echo 'не пашет, ошибка: ' . mysql_error();
    while ($rows = @mysql_fetch_assoc($result)) {
        ?>
       
            <?php
        }
    }?>