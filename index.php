<?php include 'config.php'?>
<?php include 'header.php'; ?>
<!-- Page content -->

<!-- The sidebar -->
<div class="sidebar">
    <a class="active" href="index.php">Jobs</a>
    <a href="jobs.php">Candidates Applied</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
</div>
<div class="content">
    <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            Post Jobs
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="CompanyName" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="CompanyName" name="company_name">
                </div>
                <div class="mb-3">
                    <label for="Position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="Position" name="position">
                </div>
                <div class="mb-3">
                    <label for="JobDesc" class="form-label">Job Description</label>
                    <input type="text" class="form-control" id="JobDesc" name="job_desc">
                </div>
                <div class="mb-3">
                    <label for="skills" class="form-label">Skills Required</label>
                    <input type="text" class="form-control" id="skills" name="skills">
                </div>
                <div class="mb-3">
                    <label for="CTC" class="form-label">CTC</label>
                    <input type="text" class="form-control" id="CTC" name="CTC">
                </div>

                <button type="submit" class="btn btn-primary" name="jobs_submit">Submit</button>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Company Name</th>
                <th scope="col">Position</th>
                <th scope="col">CTC</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "Select company_name , position , CTC from jobs";
            $result = mysqli_query($conn, $sql);   
            if($result -> num_rows>0){
                $i = 0;
                while($rows= $result -> fetch_assoc()){
                    echo "<tr><td>".++$i."</td>
                    <td>".$rows['company_name']."</td>
                    <td>".$rows['position']."</td>
                    <td>".$rows['CTC']."</td></tr>";
                }
            }
            else{
                $error  = 'email or password is incorrect';
            }
            ?>
        </tbody>
    </table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
</body>

</html>