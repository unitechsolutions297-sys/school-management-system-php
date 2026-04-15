<?php
require 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Student ID missing.";
    exit();
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "Student not found.";
    exit();
}

if (isset($_POST['update'])) {
    $name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];

    $updateStmt = $conn->prepare("UPDATE students SET full_name = ?, age = ?, gender = ?, course = ? WHERE id = ?");
    $updateStmt->bind_param("sisss", $name, $age, $gender, $course, $id);
    $updateStmt->execute();

    header("Location: students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Student</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($student['full_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($student['age']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="Male" <?= $student['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $student['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" name="course" class="form-control" value="<?= htmlspecialchars($student['course']) ?>" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="update" class="btn btn-primary">Update Student</button>
                            <a href="students.php" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
