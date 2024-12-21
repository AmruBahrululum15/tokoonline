<?php
include 'db.php'; // Koneksi ke database

// Membaca data dari file JSON
$jsonFile = 'users.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Pastikan data ada dalam JSON
if ($data) {
    foreach ($data as $user) {
        // Enkripsi password sebelum disimpan ke database
        $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);

        // Query SQL untuk memasukkan data ke dalam tabel tb_admin
        $query = "INSERT INTO tb_admin (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        // Binding parameter untuk query
        $stmt->bind_param("sss", $user['username'], $user['email'], $password_hash);

        // Menjalankan query dan memeriksa apakah berhasil
        if ($stmt->execute()) {
            echo "User " . $user['username'] . " berhasil dimigrasi.<br>";
        } else {
            echo "Gagal memigrasi user " . $user['username'] . "<br>";
        }
    }

    $stmt->close();
} else {
    echo "File JSON tidak ditemukan atau data kosong!";
}

// Menutup koneksi database
$conn->close();
?>
