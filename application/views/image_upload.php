<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeigniter AjaX by Weblesson</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>

<body>
    <div class="container">
        <br><br><br>
        <h3 class="text-center"><?= $title ?> </h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="upload_form" method="post" class="align-center" action="<?= base_url('main/image_upload') ?>">
                            <input type="file" name="image_file" id="image_file">
                            <br><br><br>
                            <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info">
                            <br><br><br>
                            <hr>

                            <div class="row" id="uploaded_image">
                                <?php
                                if (isset($image_data)) {
                                    echo $image_data;
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/jquery-3.7.1.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#upload_form').on('submit', function(e) {
                e.preventDefault();
                if ($('#image_file').val() === "") {
                    alert("Please select the file");
                } else {
                    $.ajax({
                        url: "<?= base_url('') ?>main/ajax_upload",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $('#uploaded_image').html(data);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>