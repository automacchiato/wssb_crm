<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login - MalmoDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5 col-md-4">
        <div class="card shadow p-3">
            <h4 class="mb-3">MalmoDB Login</h4>
            <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST">
                <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button class="btn btn-dark w-100">Login</button>
            </form>
        </div>
    </div>
</body>

</html>