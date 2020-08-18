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
                    My attendance
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Employees</li>
                    <li class="active">Schedules</li>
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
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Overtime Hours</th>
<!--                                    <th>Late Hours</th>-->
                                    <th>Working Hours</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_hours = 0.0;
                                        $total_overtime = 0.0;
                                        $total_late = 0.0;
                                        $sql = "SELECT * FROM attendance where employee_id='" . $_SESSION['employee'] . "'";
                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_assoc()) {
                                            $total_hours+=(float) round(($row['num_hr']), 2);
                                            $total_overtime+=(float) round(($row['overtime_hr']), 2);
                                            $total_late+=(float) round(($row['late_hr']), 2);
                                            $time_out = "";
                                            if ($row['time_out'] == "00:00:00")
                                                $time_out = "----";
                                            else {
                                                $time_out = date('h:i A', strtotime($row['time_out']));
                                            }
                                            echo "
                                                <tr>
                                                  <td>" . date('Y-m-d', strtotime($row['date'])) . "</td>
                                                  <td>" . date('h:i A', strtotime($row['time_in'])) . "</td>
                                                  <td>" . $time_out . "</td>
                                                  <td>" . round(($row['overtime_hr']), 2) . "</td>
                                                  <td>" . round(($row['num_hr']), 2) . "</td>
                                                </tr>
                                              ";
                                        }
                                        echo "
                                                <tr>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <th>Total Hours</th>
                                                  <td>$total_overtime</td>
                                                  <td>$total_late</td>
                                                  <td>$total_hours</td>
                                                </tr>
                                              ";
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>   
        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/schedule_modal.php'; ?>
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
                url: 'schedule_row.php',
                data: {id: id},
                dataType: 'json',
                success: function (response) {
                    $('#timeid').val(response.id);
                    $('#edit_time_in').val(response.time_in);
                    $('#edit_time_out').val(response.time_out);
                    $('#del_timeid').val(response.id);
                    $('#del_schedule').html(response.time_in + ' - ' + response.time_out);
                }
            });
        }
    </script>
</body>
</html>
