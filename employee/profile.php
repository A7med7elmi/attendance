<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Profile
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Profile</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b>Employee Profile</b></h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['firstname']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['lastname']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Address</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['address']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="datepicker_add" class="col-sm-3 control-label">Birthdate</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['birthdate']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="col-sm-3 control-label">Contact Info</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['contact_info']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-sm-3 control-label">Gender</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['gender']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position" class="col-sm-3 control-label">Position</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['description']; ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schedule" class="col-sm-3 control-label">Schedule</label>
                                <div>
                                    <label class="col-sm-2 control-label" style="color:brown; text-align: left;"><?php echo $user['schedule']; ?></label>
                                </div>
                                <hr>
                            </div>
                            <div class="modal-footer">
                        </form>
                    </div>
                </div>
            </section>   
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/attendance_modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function () {
            $('.edit').click(function (e) {
                e.preventDefault();
                $('#edit').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $('.delete').click(function (e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });
        });

        function getRow(id) {
            $.ajax({
                type: 'POST',
                url: 'attendance_row.php',
                data: {id: id},
                dataType: 'json',
                success: function (response) {
                    $('#datepicker_edit').val(response.date);
                    $('#attendance_date').html(response.date);
                    $('#edit_time_in').val(response.time_in);
                    $('#edit_time_out').val(response.time_out);
                    $('#attid').val(response.attid);
                    $('#employee_name').html(response.firstname + ' ' + response.lastname);
                    $('#del_attid').val(response.attid);
                    $('#del_employee_name').html(response.firstname + ' ' + response.lastname);
                }
            });
        }
    </script>
</body>
</html>
