<?php
// الاتصال بقاعده البيانات MySql
function connect()
{
    // Server name of MySql
    $servername = "localhost";

    // MySql username
    $username = "root";

    // MySql password
    $password = "";

    // انشاء اتصال
    $conn = new mysqli(
        $servername,
        $username,
        $password
    );

    // فحص الاتصال
    if ($conn->connect_error) {
        die("Connection failure: "
            . $conn->connect_error);
    }

    // انشاء قاعده بيانات جديده simplewebappwithcrud مع ادخال هيكل البيانات ان لم يكن موجوداً
    $sql = "CREATE DATABASE IF NOT EXISTS simplewebappwithcrud";
    $conn->query($sql);

    // انشاء جدول classes جديد مع ادخال هيكل البيانات ان لم يكن موجوداً
    $sql = "CREATE TABLE IF NOT EXISTS simplewebappwithcrud.classes (id int NOT NULL AUTO_INCREMENT COLLATE utf8mb4_unicode_ci, class_name varchar(255)  COLLATE utf8mb4_unicode_ci, CreatedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ModifiedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));";
    $conn->query($sql);

    // انشاء جدول countries جديد مع ادخال هيكل البيانات ان لم يكن موجوداً
    $sql = "CREATE TABLE IF NOT EXISTS simplewebappwithcrud.countries (id int NOT NULL AUTO_INCREMENT COLLATE utf8mb4_unicode_ci, name varchar(255)  COLLATE utf8mb4_unicode_ci, CreatedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ModifiedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));";
    $conn->query($sql);

    // انشاء جدول students جديد مع ادخال هيكل البيانات ان لم يكن موجوداً
    $sql = "CREATE TABLE IF NOT EXISTS simplewebappwithcrud.students (id int NOT NULL AUTO_INCREMENT COLLATE utf8mb4_unicode_ci, class_id int NOT NULL, country_id int NOT NULL, name varchar(255)  COLLATE utf8mb4_unicode_ci, date_of_birth date NOT NULL, CreatedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ModifiedDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id));";
    $conn->query($sql);

    // إرجاع المتغير $conn
    return $conn;
}

// غلق الاتصال بقاعده البيانات MySql
function disconnect()
{
    // فحص المتغير ذو قيمه ام فارغ
    if (!empty($conn)) {
        $conn->close();
    }
}

connect();
disconnect();

// استدعاء جميع الطلاب
function getStudents()
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.students";
    $result = $conn->query($sql);
    disconnect();
    return $result;
}
// استدعاء جميع الفصول
function getClasses()
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.classes";
    $result = $conn->query($sql);
    disconnect();
    return $result;
}

// استدعاء جميع الدول
function getCountries()
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.countries";
    $result = $conn->query($sql);
    disconnect();
    return $result;
}

// استدعاء طالب بالid
function getStudent($id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.students WHERE id='$id'";
    $result = $conn->query($sql);
    disconnect();
    return $result->fetch_assoc();
}

// استدعاء فصل بالid
function getClass($id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.classes WHERE id='$id'";
    $result = $conn->query($sql);
    disconnect();
    return $result->fetch_assoc();
}

// استدعاء دوله بالid
function getCountry($id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.countries WHERE id='$id'";
    $result = $conn->query($sql);
    disconnect();
    return $result->fetch_assoc();
}

// انشاء فصل جديد
function addStudent($class_id, $country_id, $name, $date_of_birth)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO simplewebappwithcrud.students (class_id, country_id, name, date_of_birth) VALUES ('$class_id', '$country_id', '$name', '$date_of_birth')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// انشاء فصل جديد
function createClass($class_name)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO simplewebappwithcrud.classes (class_name) VALUES ('$class_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// انشاء دوله جديده
function createCountry($country_name)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO simplewebappwithcrud.countries (name) VALUES ('$country_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// تحديث بيانات طالب مسبقه
function updateStudent($id, $class_id, $country_id, $name, $date_of_birth)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE simplewebappwithcrud.students SET class_id='$class_id', country_id='$country_id', name='$name', date_of_birth='$date_of_birth' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// تحديث بيانات فصل مسبقه
function updateClass($id, $name)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE simplewebappwithcrud.classes SET class_name='$name' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// تحديث بيانات دوله مسبقه
function updateCountry($id, $name)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE simplewebappwithcrud.countries SET name='$name' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// استدعاء فصل بالid
function del($db, $id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM simplewebappwithcrud.$db WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href='/simple_web_app_with_CRUD'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    disconnect();
}

// count Of Students Per Class
function countOfStudentsPerClass($id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.students WHERE class_id='$id'";
    $result = $conn->query($sql);
    disconnect();
    return mysqli_num_rows($result);
}

// count Of Students Per Country
function countOfStudentsPerCountry($id)
{
    $conn = connect();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM simplewebappwithcrud.students WHERE country_id='$id'";
    $result = $conn->query($sql);
    disconnect();
    return mysqli_num_rows($result);
}
