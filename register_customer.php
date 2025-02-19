<?php
include 'db_connect1.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"] ?? ''; // Optional field
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash password for security

    // Insert into database
    $sql = "INSERT INTO customers (first_name, last_name, email, phone, password) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $password);

    if ($stmt->execute()) {
        echo "New customer registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
