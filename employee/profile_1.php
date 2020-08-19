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
                                <label for="password" class="col-sm-3 control-label">Password</label>

                                <div class="col-sm-9"> 
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="col-sm-3 control-label">Photo:</label>

                                <div class="col-sm-9">
                                    <input type="file" id="photo" name="photo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Address</label>

                                <div class="col-sm-9">
                                    <textarea class="form-control" name="address" id="address"><?php echo $user['address']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="datepicker_add" class="col-sm-3 control-label">Birthdate</label>

                                <div class="col-sm-9"> 
                                    <div class="date">
                                        <input type="text" class="form-control" id="datepicker_add" name="birthdate" value="<?php echo $user['birthdate']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $user['contact_info']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender" class="col-sm-3 control-label">Gender</label>

                                <div class="col-sm-9"> 
                                    <select class="form-control" name="gender" id="gender" required>
                                        <option value="" selected>- Select -</option>
                                        <option value="Male" <?php if ($user['gender'] == "Male") echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if ($user['gender'] == "Female") echo 'selected'; ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position" class="col-sm-3 control-label">Position</label>

                                <div class="col-sm-9">
                                    <select class="form-control" name="position" id="position" required>
                                        <option value="" selected>- Select -</option>
                                        <?php
                                        $sql = "SELECT * FROM position";
                                        $query = $conn->query($sql);
                                        while ($prow = $query->fetch_assoc()) {
                                            $selected = "";
                                            if ($user['position_id'] == $prow['id']) 
                                                $selected = "selected";
                                            echo "
                              <option value='" . $prow['id'] . "' $selected>" . $prow['description'] . "</option>
                            ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="schedule" class="col-sm-3 control-label">Schedule</label>

                                <div class="col-sm-9">
                                    <select class="form-control" id="schedule" name="schedule" required>
                                        <option value="" selected>- Select -</option>
                                        <?php
                                        $sql = "SELECT * FROM schedules";
                                        $query = $conn->query($sql);
                                        while ($srow = $query->fetch_assoc()) {
                                            $selected = "";
                                            if ($user['schedule_id'] == $srow['id']) 
                                                $selected = "selected";
                                            echo "
                              <option value='" . $srow['id'] . "' $selected>" . $srow['time_in'] . ' - ' . $srow['time_out'] . "</option>
                            ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
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
