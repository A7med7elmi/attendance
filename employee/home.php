<?php include 'includes/session.php'; ?>
<?php
include 'timezone.php';
$today = date('Y-m-d');
$last_login = date('Y-m-d H:i:s',$_SESSION['loginTime']);

$year = date('Y');
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
?>
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
                    Home page
                </h1>
                <ol class="breadcrumb">
                    <li class="active">Home page</li>
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
                <!-- /.row -->
                <div class="login-box">
                    <div class="login-logo">
                        <p id="date1"><p class="bold">Logged in time : </p><?php echo $last_login; ?></p>
                        <p id="time" class="bold"></p>
                    </div>

                    <div class="login-box-body">
                        <form class="form-horizontal" method="POST" action="logout.php">
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="break"><i class="fa fa-sign-in"></i>Break</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
                    </div>
                    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
                    </div>

                </div>

            </section>
            <!-- right col -->
        </div>
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <!-- Chart Data -->
    <?php
    $and = 'AND YEAR(date) = ' . $year;
    $months = array();
    $ontime = array();
    $late = array();
    for ($m = 1; $m <= 12; $m++) {
        $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 1 $and";
        $oquery = $conn->query($sql);
        array_push($ontime, $oquery->num_rows);

        $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
        $lquery = $conn->query($sql);
        array_push($late, $lquery->num_rows);

        $num = str_pad($m, 2, 0, STR_PAD_LEFT);
        $month = date('M', mktime(0, 0, 0, $m, 1));
        array_push($months, $month);
    }

    $months = json_encode($months);
    $late = json_encode($late);
    $ontime = json_encode($ontime);
    ?>
    <!-- End Chart Data -->
    <?php include 'includes/scripts.php' ?>
    <script type="text/javascript">
        $(function () {
            var interval = setInterval(function () {
                var momentNow = moment();
                $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
                $('#time').html(momentNow.format('hh:mm:ss A'));
            }, 100);

            $('#attendance').submit(function (e) {
                e.preventDefault();
                var attendance = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'attendance.php',
                    data: attendance,
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            $('.alert').hide();
                            $('.alert-danger').show();
                            $('.message').html(response.message);
                        }
                        else {
                            $('.alert').hide();
                            $('.alert-success').show();
                            $('.message').html(response.message);
                            $('#employee').val('');
                        }
                    }
                });
            });

        });
    </script>
</body>
</html>
