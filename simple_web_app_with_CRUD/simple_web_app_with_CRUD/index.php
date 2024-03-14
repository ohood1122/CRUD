<!-- جلب محتويات الملف DatabaseMange.php -->
<?php
require 'DatabaseMange.php';
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
    <title>Simple web app with CRUD</title>
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
                Simple web app with CRUD
            </a>
        </div>
    </nav>
    <!-- end nav -->

    <!-- main -->
    <div class="mt-4 mx-3">
        <!-- statistics -->
        <div>
            <!-- Average age of students -->
            <div class="card mb-4">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent mx-1" viewBox="0 0 16 16">
                        <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                    Average age of students
                </div>
                <div class="card-body">
                    <?php
                    $age = [];
                    // get all from classes
                    $students = getStudents();
                    if ($students->num_rows > 0) {
                        // output data
                        while ($row = $students->fetch_assoc()) {
                            $class = getClass($row["class_id"]);
                            $country = getCountry($row["country_id"]);
                            $age[] = date('Y') - date('Y', strtotime($row["date_of_birth"]));
                        }
                    }
                    $age = array_filter($age);
                    if (count($age)) {
                        echo $average = array_sum($age) / count($age);
                    }
                    ?>
                </div>
            </div>
            <!-- end Average age of students -->
            <!-- Count of students per class -->
            <div class="card mb-4">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backpack mx-1" viewBox="0 0 16 16">
                        <path d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14M4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10z" />
                        <path d="M6 2.341V2a2 2 0 1 1 4 0v.341c2.33.824 4 3.047 4 5.659v5.5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5V8a6 6 0 0 1 4-5.659M7 2v.083a6 6 0 0 1 2 0V2a1 1 0 0 0-2 0m1 1a5 5 0 0 0-5 5v5.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8a5 5 0 0 0-5-5" />
                    </svg>
                    Count of students per class
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        // get all from classes
                        $classes = getClasses();
                        if ($classes->num_rows > 0) {
                            // output data
                            while ($row = $classes->fetch_assoc()) {
                                echo '<li class="list-group-item">' . $row["class_name"] . ' => ' . countOfStudentsPerClass($row["id"]) . '</li>';
                            }
                        } ?>
                    </ul>
                </div>
            </div>
            <!-- end Count of students per class -->
            <!-- Count of students per country -->
            <div class="card mb-4">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas mx-1" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                    </svg>
                    Count of students per country
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        // get all from countries
                        $countries = getCountries();
                        if ($countries->num_rows > 0) {
                            // output data
                            while ($row = $countries->fetch_assoc()) {
                                echo '<li class="list-group-item">' . $row["name"] . ' => ' . countOfStudentsPerCountry($row["id"]) . '</li>';
                            }
                        } ?>
                    </ul>
                </div>
            </div>
            <!-- end Count of students per country -->
        </div>
        <!-- end statistics -->

        <!-- Create -->
        <a href="addStudent.php" class="btn w-100 mb-3 btn-primary">Add student</a>
        <a href="createClass.php" class="btn w-100 mb-3 btn-primary">Create class</a>
        <a href="createCountry.php" class="btn w-100 mb-5 btn-primary">Create country</a>
        <!-- end Create -->

        <!-- All students view -->
        <div class="card mb-4">
            <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas mx-1" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
                Students
            </div>
            <?php
            // get all from classes
            $students = getStudents();
            ?>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of birth</th>
                        <th>Class</th>
                        <th>Country</th>
                        <th>Mange</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($students->num_rows > 0) {
                        // output data
                        while ($row = $students->fetch_assoc()) {
                            $class = getClass($row["class_id"]);
                            $country = getCountry($row["country_id"]);
                            echo "<tr><td> " . $row["id"] . "</td>" . "<td> " . $row["name"] . "</td>" . "<td> " . $row["date_of_birth"] . "</td>" . "<td> " . (empty($class["class_name"]) ? $row["class_id"] : $class["class_name"]) . "</td>" . "</td>" . "<td> " . (empty($country["name"]) ? $row["country_id"] : $country["name"]) . "</td>"
                                . '<td><div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="editStudent.php?id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')"  class="btn btn-secondary me-md-2" type="button">Edit</a>
                                    <a href="del.php?db=students&id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')" class="btn btn-danger" type="button">Delete</a>
                                  </div></td></tr>';
                        }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- end All students view -->

        <!-- All classes view -->
        <div class="card mb-4">
            <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas mx-1" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
                classes
            </div>
            <?php
            // get all from classes
            $classes = getClasses();
            ?>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Class ID</th>
                        <th>Class name</th>
                        <th>Mange</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($classes->num_rows > 0) {
                        // output data
                        while ($row = $classes->fetch_assoc()) {
                            echo "<tr><td> " . $row["id"] . "</td>" . "<td> " . $row["class_name"] . "</td>"
                                . '<td><div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="editClass.php?id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')"  class="btn btn-secondary me-md-2" type="button">Edit</a>
                                    <a href="del.php?db=classes&id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')" class="btn btn-danger" type="button">Delete</a>
                                  </div></td></tr>';
                        }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- end All classes view -->

        <!-- All countries view -->
        <div class="card mb-4">
            <div class="card-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe-americas mx-1" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                </svg>
                countries
            </div>
            <?php
            // get all from countries
            $countries = getCountries();
            ?>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Country ID</th>
                        <th>Country</th>
                        <th>Mange</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($countries->num_rows > 0) {
                        // output data
                        while ($row = $countries->fetch_assoc()) {
                            echo "<tr><td> " . $row["id"] . "</td>" . "<td> " . $row["name"] . "</td>"
                                . '<td><div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                    <a href="editCountry.php?id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')"  class="btn btn-secondary me-md-2" type="button">Edit</a>
                                    <a href="del.php?db=countries&id=' . $row["id"] . '" onclick="return confirm(\'هل أنت متأكد من ذلك؟\')" class="btn btn-danger" type="button">Delete</a>
                                  </div></td></tr>';
                        }
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- end All countries view -->

    </div>
    <!-- end main -->
</body>

</html>

<!-- استيراد ملف الجافا سكريبت الخاص بمكتبه بوتستراب -->
<script src="bootstrap/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>