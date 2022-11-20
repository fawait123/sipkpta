<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> | SIPKPTA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/dist/css/adminlte.min.css">
    <link rel="icon" href="<?= base_url(''); ?>/logo_uty.ico" type="image/gif">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(''); ?>/adminlte/plugins/summernote/summernote-bs4.min.css">
    <!-- fullCalendar -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- jquery-validation -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/moment/moment.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- select 2 -->
    <link rel="stylesheet" href="<?= base_url('select2/dist/css/select2.min.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?= $this->include('navbar'); ?>

        <!-- Main Sidebar Container -->
        <?= $this->include('sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?= $this->include('header'); ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?= $this->renderSection('content'); ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <script>
                    document.write(new Date().getFullYear());
                </script> SIP KP/TA UTY</strong>
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 0.1
            </div>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah yakin ingin logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url() ?>/Auth/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(''); ?>/adminlte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(''); ?>/adminlte/dist/js/demo.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/toastr/toastr.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- InputMask -->
    <script src="<?= base_url(''); ?>/adminlte/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(''); ?>/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- select 2 -->
    <script src="<?= base_url('select2/dist/js/select2.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "scrollX": true,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
            $('#example2').removeAttr('width').DataTable({
                "scrollY": "600px",
                "scrollX": true,
                "paging": false,
            });
            $('#example3').removeAttr('width').DataTable({
                "scrollY": "600px",
                "scrollX": true,
                "paging": false,
            });
            $('#mydata').dataTable({
                "scrollY": "600px",
                "scrollX": true,
                "paging": false,
            });
        });
    </script>
</body>

</html>