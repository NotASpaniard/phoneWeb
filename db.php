<?php
// Kết nối đến MySQL
$conn = mysqli_connect('localhost', 'root', '', 'new_sql');

// Kiểm tra kết nối
if (!$conn) {
    die("Connection Error !".mysqli_connect_error());
}
mysqli_set_charset($conn, 'UTF8');
?>