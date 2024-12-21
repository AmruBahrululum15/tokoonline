<?php 
require 'db.php';

$error = ""; // Variabel untuk menyimpan pesan error
$success = ""; // Variabel untuk menyimpan pesan sukses

if (isset($_POST['register'])) {
    $namalengkap = $_POST['namalengkap'];
    $username = $_POST['username'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi jika password dan konfirmasi password tidak sama
    if ($password !== $confirm_password) {
        $error = "Password dan Konfirmasi Password tidak sesuai!";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Periksa apakah username sudah ada di database
        $query_check = "SELECT * FROM tb_admin WHERE username = ?";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error = "Username sudah terdaftar. Silakan gunakan username lain.";
        } else {
            // Masukkan data ke database
            $query_insert = "INSERT INTO tb_admin (admin_name, admin_telp, admin_email, admin_address, username, password) 
                             VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("ssssss", $namalengkap, $no_hp, $email, $alamat, $username, $hashed_password);

            if ($stmt_insert->execute()) {
                // Simpan data ke file users.json
                $new_user = [
                    'namalengkap' => $namalengkap,
                    'username' => $username,
                    'no_hp' => $no_hp,
                    'email' => $email,
                    'alamat' => $alamat,
                    'password' => $hashed_password
                ];

                // Ambil data pengguna yang sudah ada di file users.json
                $file = 'users.json';
                if (file_exists($file)) {
                    $existing_users = json_decode(file_get_contents($file), true);
                } else {
                    $existing_users = [];
                }

                // Tambahkan pengguna baru ke dalam array
                $existing_users[] = $new_user;

                // Tulis kembali data ke file users.json
                file_put_contents($file, json_encode($existing_users, JSON_PRETTY_PRINT));

                $success = "Pendaftaran berhasil! Silakan login.";
            } else {
                $error = "Terjadi kesalahan. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Gaya CSS serupa dengan halaman login */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #00b09b, #96c93d); 
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .signup-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 400px;
            max-width: 100%;
        }
        .signup-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .signup-btn {
            width: 100%;
            background: linear-gradient(to right, #96c93d, #00b09b);
            border: none;
            color: white;
            padding: 10px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .signup-btn:hover {
            background: linear-gradient(to right, #96c93d, #00b09b);
            transform: scale(1.05);
        }
        .error-message, .success-message {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #2575fc;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>

        <!-- Menampilkan pesan error atau sukses -->
        <?php if ($error): ?>
            <div class="error-message"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-message"><?= $success ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="namalengkap" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="no_hp" placeholder="No HP" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="signup-btn" name="register">Sign Up</button>
        </form>

        <!-- Link ke halaman login -->
        <div class="login-link">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
