<?php
require 'config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Student Management</a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Welcome, <?= $_SESSION['admin']; ?>
            </span>
            <a href="logout.php" class="btn btn-outline-light">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="text-center">
        <h2 class="mb-4">Admin Dashboard</h2>
        <p class="text-muted">Manage students and system access</p>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-4">
            <a href="add_student.php" class="btn btn-success w-100 p-3 fs-5 shadow-sm">
                ➕ Add New Student
            </a>
        </div>
        <div class="col-md-4">
            <a href="students.php" class="btn btn-info w-100 p-3 fs-5 shadow-sm text-white">
                📋 View All Students
            </a>
        </div>
        <div class="col-md-4">
            <a href="logout.php" class="btn btn-danger w-100 p-3 fs-5 shadow-sm">
                🔓 Logout
            </a>
        </div>
    </div>
</div>

</body>
</html>
