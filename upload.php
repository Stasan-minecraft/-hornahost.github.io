<?php
include 'config.php';
include 'auth.php';

// Перевірка автентифікації
$user_id = checkAuth();

// Перевірка оплати
if (!checkPayment($user_id, $conn)) {
    die("Access denied. Please complete your payment.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_address = $_POST["site_address"]; // Поле для адреси сайту

    // Створення унікальної директорії для сайту
    $site_folder = 'sites/' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $site_address);
    if (!file_exists($site_folder)) {
        mkdir($site_folder, 0777, true);
        mkdir($site_folder . '/thumbnails', 0777, true);
        mkdir($site_folder . '/videos', 0777, true);
    }

    $thumbnail = $_FILES["thumbnail"]["name"];
    $video = $_FILES["video"]["name"];
    
    // Переміщення завантажених файлів
    move_uploaded_file($_FILES["thumbnail"]["tmp_name"], "$site_folder/thumbnails/" . $thumbnail);
    move_uploaded_file($_FILES["video"]["tmp_name"], "$site_folder/videos/" . $video);

    echo "Files uploaded successfully!";
}
?>