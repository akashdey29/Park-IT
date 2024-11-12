<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>

<div class="container mt-5 pt-5">
    <div class="card mx-auto" style="width: 22rem;">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-4">
                <img src="./assets/image/SIPARK.png" alt="SIPARK" width="150" class="mx-auto">
            </div>
            <h6 class="card-subtitle mb-0 text-muted text-center">PARK-IT</h6>
            <form action="" method="post" autocomplete="off">
                <p class="card-text pt-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="username">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="kata_sandi"><i class="bi bi-person-fill-lock"></i></span>
                        <input type="password" name="kata_sandi" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="kata_sandi">
                    </div>
                </p>
                <div class="d-flex justify-content-between">
                    <span></span>
                    <button type="submit" name="login" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

function showAlert($title, $message, $icon = 'error') {
    echo "<script>
        Swal.fire(
            '$title',
            '$message',
            '$icon'
        )
    </script>";
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['kata_sandi'] ?? '');

    if (empty($username) && empty($password)) {
        showAlert('Failed', 'Username and password are empty!');
    } elseif (empty($username)) {
        showAlert('Failed', 'Username is empty!');
    } elseif (empty($password)) {
        showAlert('Failed', 'Password is empty!');
    } else {
        // Use prepared statement for security
        $stmt = $connection->prepare("SELECT id, full_name, username, password, role FROM user_data WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password using password_verify
            if (password_verify($password, $user['password'])) {
                // Update login time
                $update_stmt = $connection->prepare("UPDATE user_data SET login_history = NOW() WHERE id = ?");
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();

                // Store necessary session data
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['full_name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Authentication Successful',
                        text: 'You will be redirected to the application after clicking OK',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.href = './page.php'
                    })
                </script>";
            } else {
                showAlert('Failed', 'Please make sure the username and password are correct!');
            }
        } else {
            showAlert('Failed', 'Please make sure the username and password are correct!');
        }

        $stmt->close();
    }
}
?>

<?php require('./template/footer.php') ?>

<!-- View -->
