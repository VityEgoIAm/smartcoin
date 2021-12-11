<?php
    require('analysis_text.php');

    // Получение данных от пользователя
    if (isset($_POST["text1"]) && isset($_POST["text2"])) {
        $text1 = $_POST['text1'];
        $text2 = $_POST['text2'];

        // Сравнение текстов
        $analysis = new AnalysisText($text1, $text2);

        echo $analysis->analysis();
    }
?>
<form method="POST">
    Текст №1:<br />
    <textarea name="text1" rows="8" cols="50"></textarea>
    <br />Текст №2:<br /> 
    <textarea name="text2" rows="8" cols="50"></textarea>
    <br /><br />
    <input type="submit" name="send" value="Сравнить">
</form>