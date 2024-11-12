<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

$id = $_REQUEST['id'];

$nama = mysqli_real_escape_string($connection, trim($_REQUEST['nama']));
$username = mysqli_real_escape_string($connection, trim($_REQUEST['username']));

$SQL = "UPDATE
    data_user
SET
    nama_lengkap = '$nama',
    username = '$username'
WHERE
    id = $id
;";
$query = mysqli_query($connection, $SQL);

if ($query) { // success
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Successfully updated user data',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
} else { // error
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Failed to update user data. A system error occurred',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
}

?>

<?php require('./template/footer.php') ?>
