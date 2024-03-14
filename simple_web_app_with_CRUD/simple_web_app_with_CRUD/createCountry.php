<!-- جلب محتويات الملف DatabaseMange.php -->
<?php
require 'DatabaseMange.php';

//  check form submited

if (!empty($_POST['country_name'])) {
    createCountry($_POST['country_name']);
}
?>

<!-- comment -->
<!doctype html>
<html lang="en">

<head> <!-- هيدر الصفحه -->
    <!-- ترميز الصفحه -->
    <meta charset="utf-8">
    <!-- سطر خاص بجعل الموقع متجاوب مع جميع الشاشات الصفحه -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- عنوان الصفحه -->
    <title>Create Country</title>
    <!-- logo الصفحه -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.svg">
    <!-- استيراد ملف السي اس اس الخاص بالتصميم قي مكتبه بوتستراب -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- nav -->
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/simple_web_app_with_CRUD">
                <!-- logo -->
                <img src="assets/logo.svg" alt="Logo" width="34" height="34" class="d-inline-block align-text-top mx-3" />
                <!-- end logo -->
                Create Country
            </a>
        </div>
    </nav>
    <!-- end nav -->

    <!-- main -->
    <div class="mt-4 mx-3">
        <!-- form -->
        <form action="createCountry.php" method="POST">
            <div class="py-3">
                <!-- Class name -->
                <input type="text" required class="form-control text-center" name="country_name" placeholder="Country name" />
                <!-- end Class name -->
            </div>
            <input type="submit" class="btn w-100 mb-5 btn-dark" value="Add" />
        </form>
        <!-- end form -->
    </div>
    <!-- end main -->
</body>

</html>

<!-- استيراد ملف الجافا سكريبت الخاص بمكتبه بوتستراب -->
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>