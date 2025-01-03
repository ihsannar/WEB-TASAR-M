<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dinamik Tablo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
        }
        h1 {
            margin-top: 20px;
            color: #4CAF50;
        }
        form {
            margin: 20px auto;
            max-width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
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
            echo "<table>";
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
