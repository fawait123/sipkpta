<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<!-- Default box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="<?= base_url(''); ?>/GantiPassword/gantiPassword" method="post">
            <input type="hidden" name="username" value="<?= $username; ?>">
            <div class="card-body">
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password Lama">
                        <input type="checkbox" onclick="myFunction()">&nbsp Show Password
                    </div>
                </div>
                <script>
                    function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passwordbaru" name="passwordbaru" placeholder="Password Baru">
                        <input type="checkbox" onclick="myFunction2()">&nbsp Show Password
                    </div>
                </div>
                <script>
                    function myFunction2() {
                        var x = document.getElementById("passwordbaru");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passwordbaru2" name="passwordbaru2" placeholder="Ulangi Password Baru">
                        <input type="checkbox" onclick="myFunction3()">&nbsp Show Password
                    </div>
                </div>
                <script>
                    function myFunction3() {
                        var x = document.getElementById("passwordbaru2");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
                <p>Hasil dari <br></p>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka1" autocomplete="false" readonly> &nbsp&nbsp&nbsp+&nbsp&nbsp&nbsp
                    <input type="number" class="form-control" style="width: 50px;" value="<?= rand(1, 10) ?>" name="angka2" autocomplete="false" readonly>
                </div>
                <p>adalah?</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Jawaban" name="c" autocomplete="false" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-equals"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Ganti Password</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<?= $this->endsection(); ?>