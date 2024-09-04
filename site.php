<?php
include 'config.php';
include 'auth.php';

// Отримання ID сайту
$site_id = $_GET['id'];

// Отримання інформації про сайт
$sql = "SELECT * FROM sites WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $site_id);
$stmt->execute();
$result = $stmt->get_result();
$site = $result->fetch_assoc();

if (!$site) {
    die("Site not found.");
}
?>

<h1>Site: <?php echo $site['site_address']; ?></h1>
<p>Created At: <?php echo $site['created_at']; ?></p>
<a href="uploads/<?php echo $site['site_address']; ?>/">View Files</a>
