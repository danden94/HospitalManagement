<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $specialty = $_POST['specialty'];

    $sql = "INSERT INTO Doctors (FullName, Specialty)
            VALUES (?, ?)";
    $params = array($fullName, $specialty);

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "New doctor added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
</head>
<body>
    <h1>Add New Doctor</h1>
    <form method="post">
        Full Name: <input type="text" name="fullName" required><br>
        Specialty: <input type="text" name="specialty" required><br>
        <input type="submit" value="Add Doctor">
    </form>
    <br>
    <a href="indexx.php">Back to Home</a>
</body>
</html>