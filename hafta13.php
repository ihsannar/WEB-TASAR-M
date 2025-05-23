<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Kisiler";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Tablonun doğru şekilde oluşturulduğunu kontrol edin
$sql = "CREATE TABLE IF NOT EXISTS kisi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ad VARCHAR(255) NOT NULL,
    soyad VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";

if (!$conn->query($sql)) {
    die("Tablo oluşturulurken hata: " . $conn->error);
}

// Formdan veri eklendiğinde
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ekle'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];

    $sql = "INSERT INTO kisi (ad, soyad, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $ad, $soyad, $email);

    if ($stmt->execute()) {
        echo "Kışi başarıyla eklendi.";
    } else {
        echo "Hata: " . $conn->error;
    }
    $stmt->close();
}

// Formdan arama yapıldığında
$sonuclar = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ara'])) {
    $arama = $_POST['arama'];

    $sql = "SELECT * FROM kisi WHERE ad LIKE ? OR soyad LIKE ? OR email LIKE ?";
    $stmt = $conn->prepare($sql);
    $arama_param = "%$arama%";
    $stmt->bind_param("sss", $arama_param, $arama_param, $arama_param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $sonuclar[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kışi Yönetimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
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
        input[type="text"], input[type="email"] {
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
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <h1>Kışi Yönetimi</h1>
    <div class="container">
        <form method="POST">
            <h2>Kışi Ekle</h2>
            <label for="ad">Ad:</label>
            <input type="text" name="ad" id="ad" required>
            <label for="soyad">Soyad:</label>
            <input type="text" name="soyad" id="soyad" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <button type="submit" name="ekle">Ekle</button>
        </form>

        <form method="POST">
            <h2>Kışi Ara</h2>
            <label for="arama">Arama:</label>
            <input type="text" name="arama" id="arama" required>
            <button type="submit" name="ara">Ara</button>
        </form>

        <?php if (!empty($sonuclar)) : ?>
            <h2>Arama Sonuçları</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($sonuclar as $kisi) : ?>
                    <tr>
                        <td><?= htmlspecialchars($kisi['id']) ?></td>
                        <td><?= htmlspecialchars($kisi['ad']) ?></td>
                        <td><?= htmlspecialchars($kisi['soyad']) ?></td>
                        <td><?= htmlspecialchars($kisi['email']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
