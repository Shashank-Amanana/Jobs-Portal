<?php include 'config.php'?>
<?php include 'header.php'?>
<!-- The sidebar -->
<div class="sidebar">
    <a href="index.php">Jobs</a>
    <a class="active" href="jobs.php">Candidates Applied</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
</div>
<div class="content">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Candidate Name</th>
                <th scope="col">Qualification</th>
                <th scope="col">Year Passout</th>
                <th>Resume</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT name,qualification,year,resume FROM candidates";
            $result = mysqli_query($conn, $sql);   
            if($result -> num_rows>0){
                $i = 0;
                while($rows= $result -> fetch_assoc()){
                    echo 
                    "<tr><td>".++$i."</td>
                    <td>".$rows['name']."</td>
                    <td>".$rows['qualification']."</td>
                    <td>".$rows['year']."</td>
                    <td><a download=".$rows['resume']." href='uploads/".$rows['resume']."' target='_blank'><i class='fa-solid fa-download'></i></a></td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>