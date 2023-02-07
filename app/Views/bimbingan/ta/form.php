<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<!-- Default box -->
<div class="card">
    <div class="card-body">
        <form action="<?= base_url('bimbingan/submitbimbinganta') ?>" method="POST" enctype="multipart/form-data" id="bimbingan-online-kp">
            <div class="form-group">
                <label for="npm">NPM</label>
                <input type="text" name="npm" value="<?= session()->get('username') ?>" id="npm" class="form-control" readonly>
            </div>
            <div class="form-group">
                <input type="hidden" name="nik" id="nik" value="<?= $dosbing->nik ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="materi">Materi</label>
                <input type="text" name="materi" id="materi" class="form-control">
            </div>
            <div class="form-group">
                <label for="metode">Metode</label>
                <select name="metode" id="metode" class="form-control metode">
                    <option value="">:: pilih ::</option>
                    <option value="online">Bimbingan Online</option>
                    <option value="offline">Bimbingan Offline</option>
                </select>
            </div>
            <div class="form-group file">

            </div>
            <div class="form-group date">

            </div>
            <div class="form-group btn_row">
                <button type="submit" class="btn btn-primary btn-sm" id="btn-submit" disabled>Kirim</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        // pilih metode bimbingan
        $(".metode").on("change", function() {
            let file = "";
            let date = "";
            let disabled = true;
            if ($(this).val() == "online") {
                message = "File extensi PDF";
                file = `<label for="file">File Laporan</label>
                <input type="file" name="file" id="file" class="form-control">`;
                date = ''
                disabled = false
            } else if($(this).val() == "offline") {
                extension = "jpg|jpeg|png";
                message = "File extensi JPG|JPEG|PNG";
                file = `<label for="foto">Bukti Bimbingan</label>
                <input type="file" name="foto" id="foto" class="form-control">`;
                date = `    <label for="date">Tanggal Bimbingan</label>
                            <input type="date" name="date" class="form-control">`;
                disabled = false
            }else{
                message = '';
                file = '';
                date = ''
                disabled = true
            }
            $(".date").html(date);
            $(".file").html(file);
            $("#btn-submit").attr("disabled",disabled);
        });

        // form submit.
        $("#bimbingan-online-kp").validate({
            rules: {
                materi: {
                    required: true
                },
                metode: {
                    required: true
                },
                file: {
                    required: true,
                    extension: "pdf"
                },
                foto: {
                    required: true,
                    extension: "jpg|jpeg|png"
                },
                date:{
                    required:true
                }
            },
            messages: {
                materi: {
                    required: "Inputan Materi tidak boleh kosong"
                },
                metode: {
                    required: "Inputan Metode tidak boleh kosong"
                },
                file: {
                    required: "Inputan File Laporan tidak boleh kosong",
                    extension: "File Laporan extensi PDF"
                },
                foto: {
                    required: "Inputan Bukti Bimbingan tidak boleh kosong",
                    extension: "File Bukti Bimbingan JPG|JPEG|PNG"
                },
                date:{
                    required:'Inputan Tanggal Bimbingan tidak boleh kosong'
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler:function(form){
                let formData = new FormData($(form)[0]);
            let metode = formData.get('metode')
            if(metode == 'online'){
                formData.append('file',$("input[name=file]")[0].files[0]);
            }else{
                formData.append('foto',$("input[name=foto]")[0].files[0]);
            }

            $.ajax({
            url:"<?= base_url('bimbingan/submitbimbinganta') ?>",
            type:"post",
            processData: false,
            contentType: false,
            data:formData,
            beforeSend: function() {
                $("#btn-submit").attr("disabled",true)
                $("#btn-submit").html("Loading...")
            },
            success:function(res){
                console.log(res)
                if(res === "success" || res === 'warning'){
                    window.location.href = "<?= base_url('bimbingan/ta') ?>"
                }else{
                    toastr.info('Terjadi kesalahan saat mengunggah file');
                }
                },
                error: function(xhr) { // if error occured
                    let err = eval("(" + xhr.responseText + ")");
                    toastr.info(err.message);
                    $("#btn-submit").attr("disabled",false)
                    $("#btn-submit").html("Kirim")
                },
            })
            }
        });
    });
</script>
<?= $this->endsection(); ?>