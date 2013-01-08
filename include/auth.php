<?php
if (!isset($_COOKIE['PHPSESSID'])) {
    session_start();
    header('Location: index.php');
}
$u_sess = $_COOKIE['PHPSESSID'];
$query = "SELECT * FROM $db_user_table WHERE u_sessid = '$u_sess'";
$res = mysql_query($query);
if (!$res) {
    echo 'Ошибка Базы данных: ' . mysql_error() . '<br />';
}
if ($res && mysql_num_rows($res) > 0) {
    //куки совпадают 
    if (isset($_POST['out_click'])) {

        setcookie('PHPSESSID', '', time() - 1);
        setcookie('u_name', '', time() - 1);
        header('Location: index.php');
    }
    ?>
    <form method = "POST" enctype="multipart/form-data" id="forms">
        <label>Привет, <b><?php echo $_COOKIE['u_name']; ?></b>!</label>
        <input type="submit" name="out_click" value="Выйти" />
    </form>
    <?php
} else {
    //куки не совпадают
    if (isset($_POST['auth_click'])) {
        $user_name = @$_POST['login1'];
        $user_pass = @$_POST['pass1'];
        $query = "SELECT * FROM $db_user_table WHERE login = '$user_name'";
        $res = mysql_query($query);
        //проверка логина
        if ($res && mysql_num_rows($res) > 0) {
            $user_pass = md5($user_pass);
            $query = "SELECT * FROM users WHERE pass = '$user_pass'";
            $res = mysql_query($query);
            //проверка пароля
            if ($res && mysql_num_rows($res) > 0) {
                //пользователь существует
                $query = "SELECT * FROM $db_user_table WHERE login = '$user_name'";
                $res = mysql_query($query);
                if ($rows = mysql_fetch_array($res, MYSQL_ASSOC)) {
                    setcookie('PHPSESSID', $rows['u_sessid']);
                    setcookie('u_name', $rows['login']);
                    header('Location: index.php');
                }
            }else
                echo '<div class="err_mess">Неверный логин или пароль</div>';
        }else
            echo '<div class="err_mess">Неверный логин или пароль</div>';
    }
    ?>
    <form method="post" enctype="multipart/form-data" id="forms">
        <label>Логин:</label>
        <input type="text" name="login1" placeholder="Введите логин" title="Логин может состоять только из латинских букв, цифр, тире и нижнего подчеркивания. Длина не менее 5-ти символов, но не более 25"/>
        <label>Пароль:</label>
        <input type="password" name="pass1" placeholder="Введите пароль" title="Пароль может состоять только из латинских букв, цифр, тире и нижнего подчеркивания. Длина не менее 5-ти символов, но не более 25"/>
        <input type="submit" name="auth_click" value="Ok" title="Нажимая кнопку Вы соглашаетесь со всеми правилами данного сайта."/>
        <input type="button" value="Регистрация" onclick="javascript:window.location='http://<?php echo $_SERVER['SERVER_ADDR'].$_SERVER['SCRIPT_NAME']; ?>?page=regestration'"/>
    </form>  
    <?php
}
?>