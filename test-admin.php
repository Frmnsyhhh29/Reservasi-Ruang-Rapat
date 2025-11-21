<?php
// Test file untuk membuat admin user
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Hash;

// Simulasi membuat admin user
echo "Admin Test User:\n";
echo "Email: admin@admin.com\n";
echo "Password: password\n";
echo "Hash: " . Hash::make('password') . "\n";
echo "\nSilakan gunakan kredensial ini untuk login admin.\n";
?>