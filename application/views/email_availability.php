<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h3><?= $title ?></h3>
                        <hr>
                        <!-- Add a form element -->
                        <!-- Here in action just using for checking purpose-->
                        <form id="login_form" method="post" action="process_login.php">
                            <div class="row">
                                <label>Email:</label>
                                <input type="email" name="email" id="email" class="form-control">
                                <span id="email_result"></span>
                            </div>
                            <div class="row">
                                <label>Password:</label>
                                <!-- Correct the class name to "form-control" -->
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <!-- Add a submit button -->
                            <div class="row mt-3">
                                <input type="submit" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/jquery-3.7.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#email').change(function() {
            var email = $('#email').val();
            if (email != '') {
                $.ajax({
                    url: "<?= base_url('main/check_email_availability') ?>",
                    type: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $('#email_result').html(data);
                    }
                });
            }
        });
    });
</script>
