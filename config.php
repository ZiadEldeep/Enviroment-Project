<?php
// معلومات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enviroSolutions";
// mmmmmmmm

// إنشاء اتصال بقاعدة البيانات
$conn = mysqli_connect($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn) {
    echo "";
}
else{
    die("فشل الاتصال: " . mysqli_connect_error());
}
?>
