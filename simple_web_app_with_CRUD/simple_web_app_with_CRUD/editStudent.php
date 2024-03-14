<!-- جلب محتويات الملف DatabaseMange.php -->
<?php
require 'DatabaseMange.php';

//  check id
if (empty($_GET['id'])) {
    exit();
}
//  check form submited
if (!empty($_POST['name'])) {
    updateStudent($_GET['id'], (int)$_POST['class_id'], (int)$_POST['country_id'], $_POST['name'], $_POST['date_of_birth']);
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
    <title>Edit Student</title>
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
                Edit Student
            </a>
        </div>
    </nav>
    <!-- end nav -->

    <!-- main -->
    <div class="mt-4 mx-3">
        <!-- form -->
        <form action="editStudent.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="py-3">
                <div class="mb-3">
                    <h6>
                        Country
                    </h6>
                </div>
                <div class="mb-4">
                    <select class="form-select" aria-label="Default select example" name="country_id" required>
                        <?php
                        // get all from classes
                        $countries = getCountries();
                        ?>
                        <?php if ($countries->num_rows > 0) {
                            // output data
                            while ($row = $countries->fetch_assoc()) {
                                echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <h6>
                        Class
                    </h6>
                </div>
                <div class="mb-4">
                    <select class="form-select" aria-label="Default select example" name="class_id" required>
                        <?php
                        // get all from classes
                        $classes = getClasses();
                        ?>
                        <?php if ($classes->num_rows > 0) {
                            // output data
                            while ($row = $classes->fetch_assoc()) {
                                echo "<option value=" . $row["id"] . ">" . $row["class_name"] . "</option>";
                            }
                        } ?>
                    </select>
                </div>
                <div class="mb-4">
                    <input type="text" required class="form-control text-center" name="name" placeholder="Name" />
                </div>
                <div class="mb-3">
                    <h6>
                        Date of birth
                    </h6>
                </div>
                <div class="mb-4">
                    <input type="date" name="date_of_birth" value="<?php echo date("Y-m-d"); ?>">
                </div>
            </div>
            <input type="submit" class="btn w-100 mb-5 btn-dark" value="Save" />
        </form>
        <!-- end form -->
    </div>
    <!-- end main -->
</body>

</html>

<!-- استيراد ملف الجافا سكريبت الخاص بمكتبه بوتستراب -->
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>