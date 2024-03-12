<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
    require "conn.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['status'])) {
        $citizenID = $_GET['id'];
        $banStatus = $_GET['status'];

        $updateSQL = "UPDATE citizens SET ban = '$banStatus' WHERE citizenID = $citizenID";

        if ($conn->query($updateSQL) === TRUE) {
            header("Location: admin_mng_citizens.php");
            exit;
        } else {
            echo "<script>
                alert('Error updating ban status: " . $conn->error . "');
                window.location.href = 'admin_mng_citizens.php';
            </script>";
        }
    } else {
        header("Location: invalid.php");
    }
} else {
    header("Location: invalid.php");
}
?>
