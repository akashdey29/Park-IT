<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>
<?php require('./template/header.php') ?>

<?php

$id = $_GET['id'];

$SQL = "DELETE
FROM
    data_user
WHERE
    id = $id
;";
$query = mysqli_query($connection, $SQL);

if ($query) { // success
    echo "<script defer>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Successfully deleted the user data',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
} else { // error
    echo "<script defer>
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Failed to delete the user data. A system error occurred',
            confirmButtonText: 'OK',
        }).then((result) => {
            window.location.href = './functionary.php'
        })
    </script>";
}

?>

<?php require('./template/footer.php') ?>
