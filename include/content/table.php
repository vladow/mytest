<h2>Создание новой таблицы в базе данных</h2>
<?php
//подключение к базе данных
if (!mysql_connect("$HOST", "$USER", "$PASS"))
    echo 'Не удается подключить базу данных MySQL<br />';

if (isset($_POST['table_submit'])) {
//выбор БД с именем $db_name
    mysql_select_db($_POST['db_name']);
    echo '<div><pre>' . var_dump($_POST) . '</pre></div>';
//создание таблицы пользователей
    $query = 'CREATE TABLE ' . $_POST['table_name'] . ' ( ';
    $arr = $_POST['row'];
    foreach ($arr as $key => $value) {
        if (!next($arr))
            $query = $query . '`' . $value . '` ' . $_POST['type'][$key] . ' NOT NULL, PRIMARY KEY (`' . $p_key . '`)) ENGINE=MyISAM DEFAULT CHARSET=utf8';
        else {
            if (@$_POST['p_key'][$key] == 'on')
                $p_key = @$_POST['row'][$key];
            if (@$_POST['inc'][$key] == 'on') {
                $query = $query . '`' . $value . '` ' . $_POST['type'][$key] . ' unsigned NOT NULL auto_increment, ';
            } else {
                $query = $query . '`' . $value . '` ' . $_POST['type'][$key] . ' NOT NULL, ';
            }
        }
    }
    if (!$result = mysql_query($query))
        echo 'нефарт, ошибка: ' . mysql_error();
} else {
    ?>
    <p><form method="POST">
        <label>База данных:</label>
        <select size="1" name="db_name" >
            <option disabled selected="">Выберите базу данных</option>
            <?php
            $db_list = mysql_list_dbs();
            $i = 0;
            $cnt = mysql_num_rows($db_list);
            while ($i < $cnt) {
                echo '<option value="' . mysql_db_name($db_list, $i) . '">' . mysql_db_name($db_list, $i) . "</option>";
                $i++;
            }
            ?>
        </select>
        <label>Имя таблицы:</label>
        <input type="text" name="table_name" />
        <label>Добавление столбцов:</label>
        <a style="color:red;" onclick="return deleteField(this)" href="#">[—]</a>
        <a style="color:green;" onclick="return addField()" href="#">[+]</a>
        <div id="parentId">
            <div>
                <input name="row[1]" type="text" />
                <select size="1" name="type[1]">
                    <option value="varchar(255)">Строка</option>
                    <option value="int(11)">Число</option>
                    <option value="date">Дата</option>
                    <option value="text">Текст</option>
                </select>
                <label>PRIMARY_KEY</label>
                <input name="p_key[1]" type="checkbox" />
                <label>AUTO_INCREMENT </label>
                <input name="inc[1]" type="checkbox" />

            </div>
        </div>
        <script>
            var countOfFields = 1; // Текущее число полей
            var curFieldNameId = 1; // Уникальное значение для атрибута name
            var maxFieldLimit = 25; // Максимальное число возможных полей
            function deleteField(a) {
                if (countOfFields > 1)
                {
                    // Получаем доступ к ДИВу, содержащему поле
                    var contDiv = a.parentNode;
                    // Удаляем этот ДИВ из DOM-дерева
                    contDiv.parentNode.removeChild(contDiv);
                    // Уменьшаем значение текущего числа полей
                    countOfFields--;
                }
                // Возвращаем false, чтобы не было перехода по сслыке
                return false;
            }
            function addField() {
                // Проверяем, не достигло ли число полей максимума
                if (countOfFields >= maxFieldLimit) {
                    alert("Число полей достигло своего максимума = " + maxFieldLimit);
                    return false;
                }
                // Увеличиваем текущее значение числа полей
                countOfFields++;
                // Увеличиваем ID
                curFieldNameId++;
                // Создаем элемент ДИВ
                var div = document.createElement("div");
                // Добавляем HTML-контент с пом. свойства innerHTML
                div.innerHTML = "<nobr><input name=\"row[" + curFieldNameId + "]\" type=\"text\"  /><select size=\"1\" name=\"type[" + curFieldNameId + "]\" ><option value=\"varchar(255)\">Строка</option><option value=\"int(11)\">Число</option><option value=\"date\">Дата</option><option value=\"text\">Текст</option></select><label>PRIMARY_KEY </label><input name=\"p_key[" + curFieldNameId + "]\" type=\"checkbox\"  /><label>AUTO_INCREMENT </label><input name=\"inc[" + curFieldNameId + "]\" type=\"checkbox\"  /></nobr>";
                // Добавляем новый узел в конец списка полей
                document.getElementById("parentId").appendChild(div);
                // Возвращаем false, чтобы не было перехода по сслыке
                return false;
            }
        </script>
        <input type="submit" name="table_submit" value="Ок" />
    </form>
    </p>
<?php } ?>