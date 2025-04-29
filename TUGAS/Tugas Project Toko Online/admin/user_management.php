<?php
session_start();
include '../config/database.php';

// Cek apakah pengguna sudah login sebagai admin

// Ambil semua data pengguna dari database
$query = "SELECT id, username, is_admin, created_at, password FROM users";
$stmt = $pdo->query($query);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Proses hapus pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];

    // Hapus pengguna dari database
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    // Redirect ke halaman yang sama untuk refresh
    header("Location: user_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-table th,
        .admin-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .admin-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .admin-table tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            margin: 15px;
        }

        .btn-edit {
            background-color: #3498db;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .empty-message {
            text-align: center;
            font-size: 16px;
            color: #777;
        }
    </style>
</head>
<body>
    <?php include 'navbaradmin.php'; ?>
    <div class="container">
        <h1>Manajemen Pengguna</h1>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Status Admin</th>
                    <th>Tanggal Dibuat</th>
                    <th>Password Hash</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo $user['is_admin'] ? 'Admin' : 'Pengguna Biasa'; ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-edit">Edit</a>
                                <!-- Form untuk Hapus -->
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" name="delete_user" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-message">Tidak ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include 'adminfooter.php'; ?>
</body>
</html>