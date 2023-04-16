<?php
// connect the database
include_once 'connection.php';

// query select to show the data in users table
$data_users = mysqli_query($db, "SELECT * FROM users");
?>

<h3 class="text-center mt-5">Simple Ajax Crud</h3>


<div class="container-xl mt-5">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="d-flex justify-content-between align-items-center bg-dark text-white p-3 rounded">
                    <h2>Manage <b>Employees</b></h2>
                    <div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="material-icons">&#xE147;</i> <span>Add New +</span></button>
                        <!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                class="material-icons">&#xE15C;</i> <span>Delete</span></a> -->
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="display:none;">Id</th>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

        // init for loop
        $i = 1;

        // fetch the data from database
        while ($data = mysqli_fetch_assoc($data_users)) {
            $link_delete = "<a class='btn btn-danger btn-sm mb-1 deleteData' href='deleteData.php?id=" . $data['id'] . "'><i class='fa fa-trash'></i></a>";
            $link_update = "<a class='btn btn-warning btn-sm mb-1 updateData' data-bs-toggle='modal' data-bs-target='#editData' href='updateData.php?id=" . $data['id'] . "'><i class='fa fa-edit'></i></a>";
        ?>
                    <tr>
                        <td style="display:none;"><?php echo $data['id']; ?></td>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['age']; ?></td>
                        <td><?php echo $data['gender']; ?></td>
                        <td><?php echo "$link_delete $link_update"; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>