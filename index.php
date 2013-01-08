<?php
require_once 'include/vars.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>Красивое название сайта</title> 
        <link rel="stylesheet" type="text/css" href="style.css"
</head> 
<body> 
    <div id="header">
        <div id="title"><h1><a href="?page=index">Красивое название сайта</a></h1></div>
        <div id="menu_wrapper">
            <ul id="menu"><?php require_once 'include/menu.php'; ?></ul>
        </div>
    </div>
    <div id="container">

        <div id="sidebar">
            <div id="r_menu">
                <ul class="new">
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>
                    <li>Какой-то тег</li>

                </ul>
            </div>
        </div>
        <div id="main"> 
            <div id="auth">
                <?php require_once 'include/auth.php'; ?>
            </div>
            <div class="new">
                <?php
                include_once 'include/index_data.php';
                ?>
            </div>
        </div> 

    </div> 
    <div id="footer"> 
        © Vladlen Mihaliov 2012     
    </div> 
</body> 
</html>
