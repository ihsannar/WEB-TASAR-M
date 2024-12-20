<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dinamik Tablo</title>
</head>
<body>
    <h1>Dinamik Tablo Oluştur</h1>
    <form method="post" action="">
        <label for="rows">Satır Sayısı:</label>
        <input type="number" id="rows" name="rows" min="1" required>
        <br><br>
        <label for="cols">Sütun Sayısı:</label>
        <input type="number" id="cols" name="cols" min="1" required>
        <br><br>
        <button type="submit">Tablo Oluştur</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rows = intval($_POST['rows']);
        $cols = intval($_POST['cols']);

        if ($rows > 0 && $cols > 0) {
            echo "<h2>Oluşturulan Tablo</h2>";
            echo "<table border='1' style='border-collapse: collapse; text-align: center;'>";
            for ($i = 0; $i < $rows; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $cols; $j++) {
                    $randomNumber = rand(1, 100);
                    echo "<td>$randomNumber</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Lütfen geçerli bir sayı giriniz.</p>";
        }
    }
    ?>
</body>
</html>
