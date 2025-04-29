<?php
session_start();
include '../config/database.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Get user ID from URL parameter
$userId = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$userId) {
    $_SESSION['error'] = "Invalid user ID.";
    header("Location: user_management.php");
    exit();
}

// Get user data
$stmt = $pdo->prepare("SELECT id, username, is_admin FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
if (!$user) {
    $_SESSION['error'] = "User not found.";
    header("Location: user_management.php");
    exit();
}

// Process user update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $isAdmin = isset($_POST['is_admin']) ? 1 : 0;
    $newPassword = trim($_POST['password']);
    $error = false;

    try {
        $pdo->beginTransaction();

        // Update username and admin status
        $updateQuery = "UPDATE users SET username = ?, is_admin = ?";
        $params = [$newUsername, $isAdmin];

        // If new password is provided, include it in the update
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery .= ", password = ?";
            $params[] = $hashedPassword;
        }

        $updateQuery .= " WHERE id = ?";
        $params[] = $userId;

        $stmt = $pdo->prepare($updateQuery);
        if (!$stmt->execute($params)) {
            throw new Exception("Failed to update user.");
        }

        $pdo->commit();
        $_SESSION['success'] = "User updated successfully.";
        header("Location: user_management.php");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Admin</title>
    <style>
        /* Your existing CSS styles */
        .error {
            color: #dc3545;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include 'navbaradmin.php'; ?>
    <div class="container">
        <h1>Edit Pengguna</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST" onsubmit="return confirm('Are you sure you want to update this user?');">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" 
                   value="<?php echo htmlspecialchars($user['username']); ?>" 
                   required>

            <label for="is_admin">Status Admin:</label>
            <select id="is_admin" name="is_admin">
                <option value="0" <?php echo $user['is_admin'] == 0 ? 'selected' : ''; ?>>
                    Pengguna Biasa
                </option>
                <option value="1" <?php echo $user['is_admin'] == 1 ? 'selected' : ''; ?>>
                    Admin
                </option>
            </select>

            <label for="password">Password Baru (Opsional):</label>
            <input type="password" id="password" name="password" 
                   placeholder="Kosongkan jika tidak ingin mengubah">

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
    <?php include 'adminfooter.php'; ?>
</body>
</html>