<?php
require_once 'includes/auth.php';
require_once 'db_connect.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?");
    if ($stmt->execute([$first_name, $last_name, $email, $user_id])) {
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Error updating profile.";
    }
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-size: 18px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Profile</h2>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label>First Name:</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Last Name:</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>
</html>