<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Ajax Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Main content -->
                <div id="mainContent"></div>

                <!-- Button trigger modal -->
                <!-- <button type="button" class="btn btn-success mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Insert Data
                </button> -->

                <!-- Modal insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Data</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- Form insert -->
                                <form method="post" action="insertData.php" id="formInsert">

                                    <!-- Message success -->
                                    <div class="alert alert-success text-center messageInsert" role="alert" style="display:none;">
                                        The data has been insert.

                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name </label>
                                        <input type="text" class="form-control" id="name" name="name" autocomplete='off' />
                                    </div>

                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="age" name="age" autocomplete='off' />
                                    </div>


                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="gender" name="gender" autocomplete='off' />
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="submit">Insert</button>
                                    </div>
                                </form>

                                <!-- End form -->
                            </div>

                        </div>
                    </div>
                </div>

                <!-- End insert modal -->

                <!-- Modal edit-->
                <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editData" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editData">Edit Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- This modal edit will be show for each the value in your table-->
                            <div class="modal-body" id="modal-edit">

                            </div>

                        </div>
                    </div>
                </div>

                <!-- End modal edit -->

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js" integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.15/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script>
        // load document HTML
        $(document).ready(function() {

            // load data ajax
            loadData()

            // function for load data AJAX
            function loadData() {

                $.ajax({
                    url: 'getData.php',
                    type: 'GET',
                    success: function(data) {
                        $("#mainContent").html(data);


                        // Delete Alert JQuery 
                        $('.deleteData').on('click', function(event) {
                            event.preventDefault();
                            const deleteUrl = $(this).attr('href');
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Record has been deleted.',
                                        'success'
                                    )
                                    $.ajax({
                                        // use method GET
                                        type: 'GET',

                                        // take the variabel $link_delete on file getData.php for using href 
                                        url: deleteUrl,

                                        // this when success
                                        success: function() {
                                            //load data using AJAX
                                            loadData();
                                        }
                                    });
                                }
                            })
                        });
                        // check if you clicked on the button delete 
                        // $('.deleteData').click(function(e) {

                        //     if (confirm('Are you sure want to delete this?') == true) {

                        //         // e.preventDefault() function in this study case is for keep you in index.php
                        //         e.preventDefault()

                        //         // do ajax
                        //         $.ajax({

                        //             // use method GET
                        //             type: 'GET',

                        //             // take the variabel $link_delete on file getData.php for using href 
                        //             url: $(this).attr('href'),

                        //             // this when success
                        //             success: function() {
                        //                 //load data using AJAX
                        //                 loadData()
                        //             }
                        //         })

                        //         // check if you cancel for delete the data 
                        //     } else {
                        //         // don't delete and keep stay in index.php
                        //         e.preventDefault()

                        //     }

                        // })
                    }
                })

            }

            // validation form insert
            $('#formInsert').validate({

                rules: {
                    name: 'required',
                    age: 'required',
                    gender: 'required'
                },

                messages: {
                    name: "Field username don't be blank",
                    age: "Field age don't be blank",
                    gender: "Field gender don't be blank"
                },

                highlight: function(element) {
                    $(element).children().addClass('error')
                },
                unhighlight: function(element) {
                    $(element).children().removeClass('error')
                },

                // do insert data
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: $(form).attr('method'),
                        data: $(form).serialize(),
                        success: function(response) {
                            $('[type=text]').val('')
                            loadData();

                            Swal.fire({
                                title: 'Record has been Inserted',
                                // text: "You won't be able to revert this!",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Insert More'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                } else {
                                    $('#exampleModal').modal('hide');
                                }
                            })
                            // show message when the data has been successfully insert
                            // document.querySelector(".messageInsert").style.display = "block";

                            // delete message when after half second
                            // setTimeout(function() {
                            //     document.querySelector(".messageInsert").style.display = "none";
                            // }, 1500)

                        }
                    });
                }
            });

            // check if the button editData has been clicked
            $('#editData').modal({
                keyboard: true,
                backdrop: "static",
                show: false,

                // this will be show your data when you clicked on the button editData
            }).on("show.bs.modal", function(event) {
                var button = $(event.relatedTarget);
                var id = $(event.relatedTarget).closest("tr").find("td:eq(0)").text();
                var name = $(event.relatedTarget).closest("tr").find("td:eq(2)").text();
                var age = $(event.relatedTarget).closest("tr").find("td:eq(3)").text();
                var gender = $(event.relatedTarget).closest("tr").find("td:eq(4)").text();

                // show form modal edit
                $(this).find('#modal-edit').html($(
                    `
                <!-- Form edit -->
                    <form method="post" class="updateData" id="formEdit">
                    
                    <!-- Message when the data has been update -->
                    <div class="alert alert-success text-center messageUpdate" role="alert" style="display:none;">
                       The data has been update.                    
                        </div>

                    <div class="mb-3">
                        <label for="id" class="form-label d-none">Id</label>
                        <input type="text" class="form-control d-none" id="id" name="id" autocomplete='off' value="${id}" />
                    </div>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" autocomplete='off' value="${name}" />
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" class="form-control" id="age" name="age" autocomplete='off' value="${age}" />
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" autocomplete='off' value="${gender}" />
                    </div>
                  
                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit" id="edit">Edit</button>
                    </div>
               
                    </form>
                    <!-- End form edit -->
                    
               `

                ))

                // validation form edit
                $('#formEdit').validate({

                    rules: {
                        name: 'required',
                        age: 'required',
                        gender: 'required'
                    },

                    messages: {
                        name: "Field username don't be blank",
                        age: "Field age don't be blank",
                        gender: "Field gender don't be blank"
                    },

                    highlight: function(element) {
                        $(element).children().addClass('error')
                    },
                    unhighlight: function(element) {
                        $(element).children().removeClass('error')
                    },

                    // do update data
                    submitHandler: function(form) {
                        $.ajax({
                            url: 'updateData.php',
                            type: $(form).attr('method'),
                            data: $(form).serialize(),
                            success: function(response) {
                                $('[type=text]').val('')
                                loadData();

                                // show message when the data has been successfully update
                                // document.querySelector(".messageUpdate").style.display = "block";
                                Swal.fire(
                                    'Updated!',
                                    'Your record has been updated successfully.',
                                    'success'
                                )
                                // delete message when after half second
                                setTimeout(function() {
                                    $('#editData').modal('hide');
                                }, 1000)

                            }
                        });
                    }
                });

                // end modal
            }).on('hide.bs.modal', function(event) {
                $(this).find('#modal-edit').html("")
            })

        })
    </script>
</body>

</html>