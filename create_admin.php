<?php
// Script untuk membuat admin user secara manual
// Jalankan dengan: php create_admin.php

require_once 'vendor/autoload.php';

// Load environment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Database connection
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbname = $_ENV['DB_DATABASE'] ?? 'meeting_reservation';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Hash password
    $hashedPassword = password_hash('password', PASSWORD_DEFAULT);
    
    // Insert admin user
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW()) ON DUPLICATE KEY UPDATE is_admin = 1");
    $stmt->execute(['Admin', 'admin@admin.com', $hashedPassword, 1]);
    
    echo "✅ Admin user berhasil dibuat!\n";
    echo "📧 Email: admin@admin.com\n";
    echo "🔑 Password: password\n";
    echo "🌐 Login URL: http://localhost:8000/admin/login\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>