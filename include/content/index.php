<?php

if (!$result_news = mysql_query("SELECT *,news.id as uid FROM `news` INNER JOIN users ON news.author_id=users.id ORDER BY news.id DESC"))
    echo 'не пашет, ошибка: ' . mysql_error();
if (isset($_GET['do']) && $_GET['id']) {
    mysql_query("DELETE FROM news WHERE id={$_GET['id']}");
    header('Location: ?page=index');
}
while ($rows = @mysql_fetch_assoc($result_news)):
    echo '<div style="clear:both"><h2>' . $rows['title'] . '</h2>';
    if (file_exists($rows['photo'] . '_sml'))
        echo '<img id="img_news" src="' . $rows['photo'] . '_sml' . '" style="float:left; margin-right:10px; margin-botoom:10px;" />';
    echo '<p>' . $rows['full_text'] . '</p>';
    echo '<p class="news_info">Автор: ' . $rows['login'] . ' | ';
    echo 'Дата: ' . $rows['timestamp'] . ' | ';
    if (($rows['login'] == @$_COOKIE['u_name']) || (@$_COOKIE['u_name'] == 'admin')):
        echo '<a href="?page=index&do=delete&id=' . $rows['uid'] . '">удалить</a>';
    endif;
    echo '</p></div>';
endwhile;
?>
