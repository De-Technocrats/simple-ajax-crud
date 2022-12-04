<?php
// connect the database
include_once 'connection.php';

// query select to show the data in users table
$data_users = mysqli_query($db, "SELECT * FROM users");
?>

<h3 class="text-center mt-5">Simple Ajax Crud</h3>

<table class="table table-bordered border-dark mt-5">
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
            $link_delete = "<a class='btn btn-danger mb-1 deleteData' href='deleteData.php?id=" . $data['id'] . "'>Delete</a>";
            $link_update = "<a class='btn btn-warning mb-1 updateData' data-bs-toggle='modal' data-bs-target='#editData' href='updateData.php?id=" . $data['id'] . "'>Update</a>";
        ?>
            <tr>
                <td style="display:none;"><?php echo $data['id']; ?></td>
                <td><?php echo $i++; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['age']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo "<center>$link_delete $link_update</center>"; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>