<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Tek Sayılar</title>
</head>
<body>
    <h1>1 ile 100 Arası Tek Sayılar</h1>
    <ul>
        <?php
        for ($i = 1; $i <= 100; $i += 2) {
            echo "<li>$i</li>";
        }
        ?>
    </ul>
</body>
</html>
