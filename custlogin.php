<?php
include "db_connect1.php"; // Make sure this file contains your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") 

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row["password"])) {
            echo "Login successful! Welcome, " . $row["first_name"] . " " . $row["last_name"];
        } else {
            echo "Invalid password.";
        } else {
        echo "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>
