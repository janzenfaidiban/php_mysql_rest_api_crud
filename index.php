<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Mysql REST API CRUD</title>
    <link rel="icon" type="image/png" href="assets/img/sacode-favicon.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>

    <style>
        .bg-sacode {
        background-color: rgb(3,0,55);background-color: linear-gradient(90deg, rgba(3,0,55,1) 0%, rgba(7,7,80,1) 49%, rgba(3,0,55,1) 100%);
    }
    </style>

</head>
<body class="bg-sacode">

    <div class="container position-absolute top-50 start-50 translate-middle">

        <div class="card bg-dark p-5">

            <div class="card-header d-flex justify-content-between p-0 pb-3">
                <div>
                    <h1 class="text-center fw-bolder text-light">
                        <i class="fas fa-globe"></i> PHP Mysql REST API CRUD
                    </h1>
                </div>
                <div>
                    <a href="#" name="add_button" id="add_button" class="btn btn-lg btn-primary text-dark btn-xs fw-bolder" data-bs-toggle="modal">
                        <i class="fas fa-plus-circle"></i> 
                    </a>
                </div>
            </div>

            <div class="card-body  p-0">
                <div class="table-responsive py-3">
                    <table class="table table-primary table-hover" style="font-size:150%;">
                        <thead class='text-uppercase text-primary'>
                            <tr>
                                <th class="bg-dark text-center" scope="col">No</th>
                                <th class="bg-dark" scope="col">First Name</th>
                                <th class="bg-dark" scope="col">Last Name</th>
                                <th class="bg-dark" scope="col">Email Address</th>
                                <th class="bg-dark text-center" scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody class='text-secondary'></tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-secondary p-0">
                <div class="pt-3 text-center">
                    Develop by Janzen Faidiban - 
                    <a href="https://sacode.web.id" target="_blank">
                        Tim SaCode
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- start modal  -->
    <div id="apicrudModal" class="modal fade" role="dialog">

        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="api_crud_form" enctype="multipart/form-data">
                    <div class="modal-header bg-dark text-light">
                        <h4 class="modal-title">Add Data</h4>
                        <button type="button" class="close btn btn-dark bg-dark text-danger" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="First Name">
                                <label for="first_name">First Name</label>
                            </div>
                        
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Last Name">
                                <label for="last_name">Last Name</label>
                            </div>
                        
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email Address">
                                <label for="email">Email Address</label>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer bg-dark">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" name="action" id="action" value="insert">

                        <button type="submit" name="button_action" id="button_action" class="btn btn-dark bg-primary btn-lg text-dark">Insert</button>
                        <button type="button" class="btn btn-primary btn-lg bg-dark text-primary" data-bs-dismiss="modal">Close</button>
                        
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- end modal  -->

    

    <!-- start modal warning  -->

    <div id="warningModal" class="modal fade" role="dialog">

        <div class="modal-dialog bg-warning">
                
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> <span id="warningModalMessage"></span>
        </div>

        </div>

    </div>

    <!-- end modal warning  -->

    

    <!-- start modal success  -->

    <div id="successModal" class="modal fade" role="dialog">

        <div class="modal-dialog bg-success">
                
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <span id="successModalMessage"></span>
            </div>

        </div>

    </div>

    <!-- end modal success  -->

    

    <!-- start delete alert success  -->

    <div id="deleteAlertModal" class="modal fade" role="dialog">

    <div class="modal-dialog bg-delete">

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Danger!</strong> <span id="deleteAlertModalMessage"></span>
        </div>

    </div>

    </div>

    <!-- end delete alert success  -->


    <!-- start delete modal  -->
    
    <div id="deleteModal" class="modal fade" role="dialog">

        <div class="modal-dialog bg-dark">
            <div class="modal-content">
                <form method="post" id="api_crud_form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Data</h4>
                        <button type="button" class="close btn btn-dark text-dark bg-light" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> </button>
                    </div>

                    <div class="modal-body">
                        <p>Are you sure want to delete this data?</p>
                    </div>

                    <div class="modal-footer">
                    
                    <a href='#' type='button' name='delete' class='btn btn-sm btn-secondary btn-xs text-secondary bg-dark delete' id='"<?= $row->id ?>"'><i class='fas fa-times-circle'></i></a>

                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <input type="hidden" name="action" id="action" value="delete">

                        <button type="submit" name="button_action" id="button_action" class="btn btn-success"> Delete</button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <!-- end delete modal  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){

        fetch_data();

        function fetch_data()
        {
            $.ajax({
                url:"work/fetch.php",
                success:function(data)
                {
                    $('tbody').html(data);
                }
            })
        }

        $('#add_button').click(function(){
        $('#action').val('insert');
        $('#button_action').text('Insert');
        $('.modal-title').text('Add Data');
        $('#apicrudModal').modal('show');
        });

        $('#api_crud_form').on('submit', function(event) {
            event.preventDefault();
            if($('#first_name').val() == '')
            {
                $('#warningModal').modal('show');
                $('#warningModalMessage').text('Please Insert First Name');
            }
            else if($('#last_name').val() == '')
            {
                $('#warningModal').modal('show');
                $('#warningModalMessage').text('Please Insert Last Name');
            }
            else if($('#email').val() == '')
            {
                $('#warningModal').modal('show');
                $('#warningModalMessage').text('Please Insert Email Address');
            }
            else 
            {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "work/action.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        $('#apicrudModal').modal('hide');
                        if(data == 'insert')
                        {
                            $('#successModal').modal('show');
                            $('#successModalMessage').text('Data Inserted Successfully');
                        }
                        if(data == 'update')
                        {
                            $('#successModal').modal('show');
                            $('#successModalMessage').text('Data Updated Successfully');
                        }
                    }
                });
            header("Location: /");
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            var action = 'fetch_single';
            $.ajax({
                url:"work/action.php",
                method:"POST",
                data:{id:id, action:action},
                dataType:"json",
                success:function(data)
                {
                    $('#hidden_id').val(id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#action').val('update');
                    $('#button_action').text('Update');
                    $('.modal-title').text('Edit Data');
                    $('#apicrudModal').modal('show');
                }
            })
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            var action = 'delete';
            if(confirm("Are you sure you want to remove this data using PHP API?"))
            {
                $.ajax({
                    url:"work/action.php",
                    method:"POST",
                    data:{id:id, action:action},
                    success:function(data)
                    {
                    fetch_data();
                    // alert("Data Deleted using PHP API");
                    $('#deleteAlertModal').modal('show');
                    $('#deleteAlertModalMessage').text('Data Deleted Successfully');
                    }
                });
            }
        });

    });
    
</script>


