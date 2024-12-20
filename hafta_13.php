<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form İşlemleri</title>
</head>
<body>
    <h1>Kişi Veritabanı İşlemleri</h1>

    <!-- Form 1: Kişi Ekleme -->
    <h2>Kişi Ekle</h2>
    <form id="addForm" method="post" action="/add_person">
        <label for="name">Ad:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="surname">Soyad:</label>
        <input type="text" id="surname" name="surname" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <button type="submit">Kaydet</button>
    </form>

    <!-- Form 2: Kişi Arama -->
    <h2>Kişi Bul</h2>
    <form id="searchForm" method="get" action="/search_person">
        <label for="searchName">Ad:</label>
        <input type="text" id="searchName" name="searchName" required>
        <button type="submit">Bul</button>
    </form>

    <!-- Arama Sonuçları -->
    <div id="searchResults">
        <!-- Replace template logic with backend implementation -->
        <!-- Example: Use backend framework like Flask or Express.js -->
        <h3>Sonuç:</h3>
        <p>Soyad: Soyad bilgisi burada gösterilecek.</p>
        <p>Email: Email bilgisi burada gösterilecek.</p>
    </div>
</body>
</html>
