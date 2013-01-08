<?php
//проверка нажатия кнопки
if (isset($_POST['reg_click'])) {
    $user_name = @$_POST['login'];
    $user_pass = @$_POST['pass'];

    //require_once 'data/functions.php';
    //проверка правильности логина и пароля
    function account_valid($logpass) {

//допустимые символы 
        $char_valid = '1234567890QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm-_';
////минимальное количество символов 
        $char_min_length = 5;
////максимальное количество символов 
        $char_max_length = 25;

        if (strspn($_POST[$logpass], $char_valid) != strlen($_POST[$logpass])) {
            return false;
        }
        if (strlen($_POST[$logpass]) < $char_min_length) {
            return false;
        }
        if (strlen($_POST[$logpass]) > $char_max_length) {
            return false;
        }
        return true;
    }

//ошибки
    function valid($user_name) {
        global $err_m;

        if (account_valid('login') == FALSE) {
            $err_m = 'Неверный логин';
            return false;
        }
        if (account_valid('pass') == FALSE) {
            $err_m = 'Неверный пароль';
            return false;
        }
        if ($_POST['pass'] !== $_POST['pass2']) {
            $err_m = 'Пароли не совпадают';
            return false;
        }
        $query = "SELECT * FROM users WHERE u_name = '$user_name'";
        $result = mysql_query($query);
        if ($result && mysql_num_rows($result) > 0) {
            $err_m = 'Имя пользователя уже существует';
            return false;
        }
        return TRUE;
    }

//заносим логин и пароль в базу данных
//генерируем случайную строку
    function generateString($length = 32) {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    ;
//сохраняем в переменную пароль и шифруем его
    $hash = md5($user_pass);



    if (valid($user_name) == FALSE) {
        ?> <p id="err" class="message"> <?php echo $err_m; ?> </p>
        <?php
    } else {
        $u_sess = md5(generateString(26));
        $user_pass = md5($user_pass);
        $result = mysql_query("INSERT INTO $db_user_table (login, pass, role, u_sessid) VALUES ('$user_name', '$user_pass', '$u_role', '$u_sess')");
        if ($result) {
            session_id($u_sess);
            if (session_id() == '')
                session_start();
            else
                session_regenerate_id();
            ?> <p id="err" class="message"><?php echo "Регистрация прошла успешно!"; ?> </p>
            <?php
        } else {
            echo "Ошибка при работе с базой данных. <br />";
            echo mysql_error();
        }
    }
}
if (strlen($reg_text) > 0)
    
    ?> <p id="reg_message"><?php echo $reg_text; ?></p> 


<!--форма воода логина и пароля-->
<form method="post" enctype="multipart/form-data">
    <p><label>Логин:</label></p>
    <p><input type="text" name="login" placeholder="Введите логин" title="Логин может состоять только из латинских букв, цифр, тире и нижнего подчеркивания. Длина не менее 5-ти символов, но не более 25"/></p>
    <p><label>Пароль:</label></p>
    <p><input type="password" name="pass" placeholder="Введите пароль" title="Пароль может состоять только из латинских букв, цифр, тире и нижнего подчеркивания. Длина не менее 5-ти символов, но не более 25"/></p>
    <p><input type="password" name="pass2" placeholder="Пароль еще раз" title="Пароль может состоять только из латинских букв, цифр, тире и нижнего подчеркивания. Длина не менее 5-ти символов, но не более 25" /></p>
    <input type="submit" name="reg_click" value="Регистрация" title="Нажимая кнопку Вы соглашаетесь со всеми правилами данного сайта."/>
</form>  