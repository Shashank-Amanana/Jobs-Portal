<?php
session_start();
$server = 'localhost:3309';
$username = 'root';
$password = '';
$database = 'jobs';
$errors = array();
$conn = mysqli_connect($server, $username, $password, $database) or die("Connection Failed:" . $conn->connect_error);

//REGISTER 
if (isset($_POST['register_submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $ph_no = $_POST['phone_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //form validation
    if (empty($name)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "password is required");
    }
    if ($password != $cpassword) {
        array_push($errors, "Passwords do not match");
    }

    // check db for existing user for same Username
    $user_check_query = "SELECT * FROM users WHERE Name='$name' or email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['Name'] === $name) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email in use");
        }
    }
    //Registration
    if (count($errors) == 0) {
        $pass = md5($password); //for encryption use md5
        $sql = "INSERT INTO `users`(`Name`, `email`, `password`, `phone_no`) VALUES ('$name','$email','$password','$ph_no')";
        mysqli_query($conn, $sql);
        $_SESSION['Name'] = $name;
        $_SESSION['success'] = "Your are now logged in";
        header('location: index.php');
    }
}


//LOGIN 
if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$password'";
        $results = mysqli_query($conn, $sql);

        if (mysqli_num_rows($results)) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Logged in successfully";
            header('location: index.php');
        }
        else {
            array_push($errors, "Wrong Email/password combination");
        }
    }
}

//POSTING JOBS
if (isset($_POST['jobs_submit'])) {
    $cname = $_POST['company_name'];
    $position = $_POST['position'];
    $job_desc = $_POST['job_desc'];
    $skills = $_POST['skills'];
    $ctc = $_POST['CTC'];

    $query2 = "INSERT INTO `jobs`(`company_name`, `position`, `job_desc`, `skills`,`CTC`) VALUES ('$cname','$position','$job_desc','$skills','$ctc')";
    $result = mysqli_query($conn, $query2);
    if ($result) {
        echo "Inserted Jobs successfully";
    }
    else {
        $error = 'email or password is incorrect';
    }
}

//CANDIDATES APPLIED
if (isset($_POST['apply_now'])) {
    $name = $_POST['name'];
    $apply = $_POST['apply'];
    $qualification = $_POST['qualification'];
    $year = $_POST['year'];
    $file = $_FILES['file'];
    // print_r($file);
    // RESUME UPLOAD VALIDATION
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $fileExt = explode('.', $fileName);
    // echo "<br><br>";
    //print_r($fileExt);

    $fileActualExt = strtolower(end($fileExt));
    //echo "<br><br>";
    //print_r($fileActualExt);

    $fileTypeAllowed = array('pdf', 'doc', 'docx');

    if (in_array($fileActualExt, $fileTypeAllowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                //Creates Random name for file
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                // $filestart = explode('.', $fileNameNew);
                // $fileActualstart = strtolower(reset($filestart)).".".strtolower(next($filestart));
                //Uploads Original Name
                //$fileNameNew =$fileName;
                $fileDestination = 'uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                echo "File Uploaded Successfully " . $fileNameNew;
                $query3 = "INSERT INTO `candidates`(`name`, `apply`, `qualification`, `year`, `resume`) VALUES ('$name','$apply','$qualification','$year','$fileNameNew')";
                $result = mysqli_query($conn, $query3);
                if ($result) {
                    echo "Inserted Applicants successfully";
                }
                else {
                    $error = 'incorrect';
                }
            }
            else {
                echo "Your file size is TOO big ";
            }
        }
        else {
            echo "There is an error in uploading your file!!!";
        }
    }
    else {
        echo "You can't upload the file of this type";
    }
}
?>