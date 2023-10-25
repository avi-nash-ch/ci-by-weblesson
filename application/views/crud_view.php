<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 900px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container box">
        <h3 class="text-center"><?php echo $title; ?></h3>
        <hr>
        <div class="row">
            <div id="showMessege" class="alert alert-success alert-dismissible" style="display: none;">
                User Added Successfully
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">Add</button>
        <div class="table-responsive">
            <br />
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10%">Image</th>
                        <th width="35%">First Name</th>
                        <th width="35%">Last Name</th>
                        <th width="10%">Edit</th>
                        <th width="10%">Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>
<!-- Modal Start -->
<div class="modal" tabindex="-1" role="dialog" id="userModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="user_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fname">Enter First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Enter Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Select User Image</label>
                        <input type="file" name="image" id="image" class="form-control" required>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<script type="text/javascript" language="javascript">
    function showModel() {
        $('#userModal').modal('show');
    }

    $(document).ready(function() {
        // Initialize DataTable with options
        var dataTable = $('#user_data').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "<?= base_url('crud/fetch_user') ?>",
                type: "POST"
            },
            columnDefs: [{
                targets: [0, 3, 4],
                orderable: false
            }, ]
        });

        $(document).on('submit', '#user_form', function(event) {
            event.preventDefault();
            var firstname = $('#fname').val();
            var lastname = $('#lname').val();
            var extension = $('#image').val().split('.').pop().toLoweCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                alert('Invalid Image');
                $('#image').val('');
                return false;
            }
            if (firstname != '' && lastname != '') {
                $.ajax({
                    url: "<?= base_url('crud/user_action') ?>",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#userModal').modal('hide');
                        $('#showMessege').show();
                        $('#user_form')[0].reset();
                    }
                });
            } else {
                alert('Please Fill All Fields');
            }
        });
    });
</script>