<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
} else {
    header("Location: index.php");
    exit();
}
?>

<?php
include('db_conn.php');
$id = $_GET['deleteid'];
$sql = "delete from `users` where id=$id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('location:retrieve.php');
} else {
    die(mysqli_error($conn));
}

?>