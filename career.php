<?php include 'config.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style1.css?version=1" />
    <style>
    .text-heading {
        text-align: left;
        color: white;
        width: 40%;
        position: relative;
        top: 30%;
    }

    .cards {
        display: flex;
    }

    .card {
        margin: 50px;
        float: left;
    }

    .Header-card {
        background-image: url('banner-1.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 340px;
    }

    .login {
        margin-left: 90%;
        position: relative;
        top: -15%;
    }
    </style>
    <title>Career</title>
</head>

<body>
    <div class="Header-card">
        <div class="text-heading">
            <h1>Jobs</h1>
            <div>Best Jobs Available Matching Your Skills</div>
        </div>
        <a href="login.php"><button class="btn btn-light login">Admin Login</button></a>
    </div>
    <div class="row g-0">
        <?php
$sql = "Select company_name , position ,job_desc, CTC, skills from jobs";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($rows = $result->fetch_assoc()) {
        echo '
                    <div class="cards col-lg-3"><div class="card card-body"style="width: 18rem"><h5 class="card-title">' . $rows['position'] . '</h5><h6 class="card-subtitle mb-2 text-muted">' . $rows['company_name'] . '</h6><p class="card-text"><p><strong>Skills Required: </strong>' . $rows['skills'] . '</p> <p><strong>Job Description: </strong>' . $rows['job_desc'] . '</p> <p><strong>CTC: </strong>' . $rows['CTC'] . '</p> <button class="btn btn-primary"type="button"data-bs-toggle="modal"data-bs-target="#exampleModal"
                aria-expanded="false"aria-controls="collapseExample"> Apply For Job </button> </p> </div> </div>';
    }
}
?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apply for Jobs</h5><button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="career.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Full Name</label>
                                <input type="text" class="form-control" id="recipient-name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Applying for</label>
                                <select name="apply" id="" style="width: 100%; height:42px;border-radius:7px">
                                    <option value="-">------------------------------SELECT------------------------------
                                    </option>
                                    <?php
                                        $sql = "Select position,company_name from jobs";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result->num_rows > 0) {
                                            while ($rows = $result->fetch_assoc()) {
                                                echo '
                                                     <option value=' . $rows['position'] . '>' . $rows['company_name'] . '-' . $rows['position'] . '</option>
                                                     ';
                                            }
                                        }
                                    ?>
                                </select>
                                <!-- <input type="text" class="form-control" id="recipient-name" name="apply"> -->
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Qualification</label><input
                                    type="text" class="form-control" id="recipient-name" name="qualification">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Year Passout</label>
                                <input type="text" class="form-control" id="recipient-name" name="year">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Resume</label>
                                <input type="file" class="form-control" id="recipient-name" name="file">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button><button type="submit" name="apply_now"
                                    class="btn btn-primary">Apply Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>