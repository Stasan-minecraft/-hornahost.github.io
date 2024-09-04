<?php
include 'config.php';
include 'auth.php';

// Перевірка автентифікації
$user_id = checkAuth();

// Перевірка оплати
if (!checkPayment($user_id, $conn)) {
    die("Access denied. Please complete your payment.");
}

// Отримання сайтів користувача
$sql = "SELECT * FROM sites WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h1>Your Sites</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Site Address</th>
        <th>Created At</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><a href="site.php?id=<?php echo $row['id']; ?>"><?php echo $row['site_address']; ?></a></td>
        <td><?php echo $row['created_at']; ?></td>
    </tr>
    <?php } ?>
</table>
