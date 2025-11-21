<?php
// Script sederhana untuk membuat admin user
echo "Creating admin user...\n";

// Database config (sesuaikan dengan .env Anda)
$host = 'localhost';
$dbname = 'reservasi_rapat'; // sesuai dengan .env
$username = 'root';
$password = ''; // password MySQL Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Hash password menggunakan Laravel format
    $hashedPassword = '$2y$12$' . substr(str_replace('+', '.', base64_encode(pack('N4', mt_rand(), mt_rand(), mt_rand(), mt_rand()))), 0, 22);
    $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
    
    // Cek apakah admin sudah ada
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute(['admin@admin.com']);
    
    if ($check->rowCount() > 0) {
        // Update existing user to admin
        $stmt = $pdo->prepare("UPDATE users SET is_admin = 1 WHERE email = ?");
        $stmt->execute(['admin@admin.com']);
        echo "✅ User admin@admin.com sudah ada, diupdate menjadi admin!\n";
    } else {
        // Insert new admin user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, is_admin, email_verified_at, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW(), NOW())");
        $stmt->execute(['Admin', 'admin@admin.com', $hashedPassword, 1]);
        echo "✅ Admin user berhasil dibuat!\n";
    }
    
    echo "\n📋 INFO LOGIN ADMIN:\n";
    echo "📧 Email: admin@admin.com\n";
    echo "🔑 Password: password\n";
    echo "🌐 URL: http://localhost:8000/admin/login\n";
    echo "\n💡 Atau klik link 'Admin' di navbar website\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\n💡 Tips:\n";
    echo "1. Pastikan MySQL sudah running\n";
    echo "2. Sesuaikan nama database di script ini\n";
    echo "3. Sesuaikan username/password MySQL\n";
}
?>