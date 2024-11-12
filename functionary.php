<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->

<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

<?php

    if (isset($_REQUEST['add'])) {
        $nama = mysqli_real_escape_string($connection, trim($_REQUEST['nama']));
        $username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));
        $password = mysqli_real_escape_string($connection, trim($_REQUEST['password']));

        $SQL = "INSERT INTO data_user (
            nama_lengkap,
            username,
            password
        )
        VALUES (
            '$nama',
            '$username',
            '$password'
        )
        ;";
        $query = mysqli_query($connection, $SQL);

        if ($query) { // success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Successfully added new user data',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './$currentPage'
                })
            </script>";
        } else { // error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Failed to add new user data. A system error occurred',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    window.location.href = './$currentPage'
                })
            </script>";
        }
    }

?>

<main>
    <h3>User Data</h3>
    <hr>
    <div class="d-flex mb-3">
        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#add">Add User <i class="bi bi-file-earmark-person-fill"></i></a>

        <!-- Add data -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addLabel">Add User <i class="bi bi-file-earmark-person-fill"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Username</span>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Password&nbsp;</span>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add" class="btn btn-warning">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add data -->
    </div>
    <div class="row">
        <?php

            $SQL = "SELECT
                *
            FROM
                data_user
            WHERE
                kode_status != 0
            ;";
            $query = mysqli_query($connection, $SQL);

        ?>
        <?php if (mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive" style="max-height: 420px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while (list($id, $fullname, $username, $password, $role, $created, $login_history, $logout_history) = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $fullname ?></td>
                                <td><?= $username ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-<?= $id ?>"><i class="bi bi-pen-fill"></i></a>
                                    <a href="./functionary.delete.php?id=<?= $id ?>" class="delete btn btn-danger btn-sm"><i class="bi bi-trash2"></i></a>
                                </td>
                            </tr>

                            <!-- Edit data -->
                            <div class="modal fade" id="edit-<?= $id ?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="editLabel">Edit User Data <i class="bi bi-file-earmark-person-fill"></i></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="./functionary.edit.php" method="post" class="edit">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <input
                                                        type="text"
                                                        name="nama"
                                                        id="nama"
                                                        class="form-control"
                                                        required
                                                        value="<?= $fullname ?>">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Username</span>
                                                    <input
                                                        type="text"
                                                        name="username"
                                                        id="username"
                                                        class="form-control"
                                                        required
                                                        value="<?= $username ?>">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit data -->

                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <!-- NONE -->
        <?php endif; ?>
    </div>
</main>

<script>
    const editOptionForm = document.getElementsByClassName('edit')

    for (const edit_ of editOptionForm) {
        edit_.addEventListener('submit', (event) => {
            event.returnValue = false

            Swal.fire({
                title: 'Edit?',
                text: "Are you sure you want to edit this user data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    edit_.submit()
                }
            })
        })
    }

    const deleteOption = document.getElementsByClassName('delete')

    for (let i = 0; i < deleteOption.length; i++) {
        deleteOption[i].addEventListener('click', (event) => {
            event.returnValue = false

            const link_ref = deleteOption[i].getAttribute('href')

            Swal.fire({
                title: 'Delete?',
                text: "Are you sure you want to delete this user data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `./${link_ref}`
                }
            })
        })
    }
</script>

<?php require('./template/footer.php') ?>

<!-- View -->
