<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Army Database</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Search The Army Details Here</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])) { echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Dept_ID</th>
                                    <th>Designation</th>
                                    <th>Posting (States)</th>
                                    <th>Age</th>
                                    <th>Salary (per annum)</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost", "root", "", "armydatabase");

                                    if(mysqli_connect_errno()) {
                                        die("Database connection failed: " . mysqli_connect_error());
                                    }

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM armydatabase WHERE CONCAT(Name, Department, Dept_ID, Designation, Posting_States, Age, Salaryper_annum) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(!$query_run) {
                                            die("Query execution failed: " . mysqli_error($con));
                                        }

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            while($items = mysqli_fetch_assoc($query_run))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['Name']; ?></td>
                                                    <td><?= $items['Department']; ?></td>
                                                    <td><?= $items['Dept_ID']; ?></td>
                                                    <td><?= $items['Designation']; ?></td>
                                                    <td><?= $items['Posting_States']; ?></td>
                                                    
                                                    <td><?= $items['Age']; ?></td>
                                                    <td><?= $items['Salaryper_annum']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="10">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
