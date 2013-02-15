<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Облачко</title>
        <script src="js/cookie.js"></script>
        <script src="js/cloud.js"></script>
        <link rel="stylesheet" type="text/css" href="style/style.css" />
    </head>
    <body onload="resizeCloud(); window.angryTimerID = angryStart(); greetUser();" onresize="resizeCloud();">
        <div id="cloud" >
            <img id="cloudImg" src="img/sad.png" onclick="alert('Добро пожаловать в программу \'Скажена Хмарка\'! Вовремя веселите облачко, и не давайте ему злиться!\nПриятного время препровождения!\nПрограмма полностью написана и нарисована by Влад Михалёв.\nP.S: Облачко напоминает Алёнку... ;)');" />
            <div id="navigate">
                <input type="button" id="happyButton" value="Развеселить облачко" onclick="cloudHappy();" />
                <input type="button" id="angryButton" value="Успокоить облачко" onclick="angryStop();" />
            </div>
        </div>

    </body>
</html>
