<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "test"; // Veritabanı adınız

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// Formdan gelen veriyi işle
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_user"])) {
        // Kullanıcı ekleme formu
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $email = $_POST["email"];

        $sql = "INSERT INTO kisi (ad, soyad, email) VALUES ('$ad', '$soyad', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Kullanıcı başarıyla eklendi.";
        } else {
            echo "Hata: " . $conn->error;
        }
    } elseif (isset($_POST["find_user"])) {
        // Kullanıcı bulma formu
        $search_name = $_POST["search_name"];

        $sql = "SELECT soyad, email FROM kisi WHERE ad = '$search_name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Kullanıcı bulundu
            $row = $result->fetch_assoc();
            echo "Soyad: " . $row["soyad"] . "<br>";
            echo "E-posta: " . $row["email"];
        } else {
            echo "Kullanıcı bulunamadı.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Yönetimi</title>
</head>
<body>
    <h1>Kullanıcı Yönetimi</h1>

    <!-- Kullanıcı ekleme formu -->
    <h2>Kullanıcı Ekle</h2>
    <form method="POST" action="">
        <label for="ad">Ad:</label>
        <input type="text" id="ad" name="ad" required><br>

        <label for="soyad">Soyad:</label>
        <input type="text" id="soyad" name="soyad" required><br>

        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" required><br>

        <button type="submit" name="add_user">Ekle</button>
    </form>

    <hr>

    <!-- Kullanıcı bulma formu -->
    <h2>Kullanıcı Bul</h2>
    <form method="POST" action="">
        <label for="search_name">Ad:</label>
        <input type="text" id="search_name" name="search_name" required>
        <button type="submit" name="find_user">Bul</button>
    </form>
</body>
</html>
