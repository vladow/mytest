<h2>Добавление новостей на сайт</h2>
<?php
include_once '/../imgResize.php';
if (isset($_COOKIE['u_name'])) {
    if (isset($_POST['db_ok'])) {
//        echo '<pre>'; var_dump($_POST); echo '</pre>';
        @mkdir("uploads", 0777);
        @copy(@$_FILES['file']['tmp_name'], "uploads/" . @basename(@$_FILES['file']['name']));
        $file = "uploads/" . $_FILES["file"]["name"];
        if (!file_exists($_FILES["file"]["name"])) {
            img_resize($file, $file . '_sml', 200, 150);
        }
        $title = $_POST['title'];
        //$author = $_COOKIE['u_name'];
        $d = getdate();
        $date = $d['year'] . $d['mon'] . $d['mday'];
        $full_text = $_POST['full_text'];
        $mysql_query = mysql_query("SELECT * FROM users WHERE login='{$_COOKIE['u_name']}'");
        if (!$author = mysql_fetch_assoc($mysql_query))
            echo mysql_error();
        $res = mysql_query("INSERT INTO `news` (title, author_id, photo, full_text) VALUES ('$title','{$author['id']}','$file', '$full_text') ");
        if ($res) {
            header('Location: ?index');
        } else {
            echo 'не пашет: ' . mysql_error() . '<br />';
        }
    }
    ?> 
    <form method="POST" enctype="multipart/form-data">
        <p>Тема:</p>
        <p><input type="text" name="title" placeholder="" title="" style="width: 455px;"/><br /></p>
        <p>Текст новости:</p>
        <p><textarea name="full_text" cols="60" rows="10" title="" ></textarea><br /></p>
        <p><label>Загрузить картинку: </label>
            <input type="file" name="file" /></p>
        <p><input type="submit" value="Добавить" name="db_ok"/></p>
    </form>
    <?php
} else {
    echo 'Только авторизованные пользователи могут добавлять новости.';
}
?>
