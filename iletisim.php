<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Veritabanı bağlantısı için gerekli bilgileri yazın
$servername = "localhost";
$username = "root";  // XAMPP varsayılan kullanıcı adı
$password = "";  // XAMPP varsayılan şifre boş
$dbname = "iletisim_formu";  // Oluşturduğunuz veritabanının adı

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Zaman dilimini ayarlayın (örneğin, Türkiye için)
date_default_timezone_set('Europe/Istanbul');

// Formdan gelen verileri al ve kontrol et
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini kontrol et
    echo "<pre>";
    print_r($_POST);  // Formdan gelen verileri ekrana yazdır
    echo "</pre>";

    // Verilerin boş olup olmadığını kontrol et
    if (!empty($_POST['ad']) && !empty($_POST['email']) && !empty($_POST['mesaj'])) {
        $ad = $_POST['ad'];
        $email = $_POST['email'];
        $mesaj = $_POST['mesaj'];
        $tarih = date('Y-m-d H:i:s');  // Geçerli tarihi al

        // E-posta doğrulaması
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Geçersiz e-posta adresi.";
        } else {
            // SQL sorgusunu hazırlamak için prepared statements kullan
            $stmt = $conn->prepare("INSERT INTO form (ad, email, mesaj, tarih) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $ad, $email, $mesaj, $tarih);  // Parametreleri bağla

            // Sorguyu çalıştır ve sonucu kontrol et
            if ($stmt->execute()) {
                echo "Mesajınız başarıyla gönderildi!";
            } else {
                echo "Hata: " . $stmt->error;
            }

            // Prepared statement'ı kapat
            $stmt->close();
        }
    } else {
        echo "Lütfen tüm alanları doldurduğunuzdan emin olun.";
    }
}

// Bağlantıyı kapat
$conn->close();
?>