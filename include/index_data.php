<?php

$error_message = 'Страница не найдена';
if (isset($_GET['page'])) {
    $filename = "include/content/{$_GET['page']}.php";
    if (file_exists($filename)) {
        include $filename;
    } else {
        echo $error_message."<br />".$filename;
    }
} else {
    @include 'content/index.php';
}
?>
