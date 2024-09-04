<?php
// Функція для перевірки автентифікації та статусу is_pay
function checkAuth() {
    session_start();
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    } else {
        header("Location: login.php");
        exit();
    }
}

// Функція для перевірки, чи користувач оплатив
function checkPayment($user_id, $conn) {
    $sql = "SELECT is_pay FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row['is_pay'];
}
?>