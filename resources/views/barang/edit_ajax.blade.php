@empty($barang)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else

<form action="{{ url('/barang/' . $barang->barang_id.'/update_ajax') }}" method="POST" id="form-edit-barang">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $kat)
                        <option value="{{ $kat->kategori_id }}" {{ $barang->kategori_id == $kat->kategori_id ? 'selected' : '' }}>
                            {{ $kat->kategori_nama }}
                        </option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Kode Barang</label>
                    <input value="{{ $barang->barang_kode }}" type="text" name="barang_kode" id="barang_kode" class="form-control" required>
                    <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input value="{{ $barang->barang_nama }}" type="text" name="barang_nama" id="barang_nama" class="form-control" required>
                    <small id="error-barang_nama" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Harga Beli</label>
                    <input value="{{ $barang->harga_beli }}" type="number" name="harga_beli" id="harga_beli" class="form-control" required>
                    <small id="error-harga_beli" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Harga Jual</label>
                    <input value="{{ $barang->harga_jual }}" type="number" name="harga_jual" id="harga_jual" class="form-control" required>
                    <small id="error-harga_jual" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <!-- Pastikan modal-footer ada di dalam modal-content -->
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-edit-barang").validate({
            rules: {
                barang_kode: {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                barang_nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 100
                },
                harga_beli: {
                    required: true,
                    number: true,
                    min: 0
                },
                harga_jual: {
                    required: true,
                    number: true,
                    min: 0
                }
            },
            messages: {
                barang_kode: {
                    required: "Kode Barang wajib diisi",
                    minlength: "Kode Barang minimal 2 karakter",
                    maxlength: "Kode Barang maksimal 10 karakter"
                },
                barang_nama: {
                    required: "Nama Barang wajib diisi",
                    minlength: "Nama Barang minimal 3 karakter",
                    maxlength: "Nama Barang maksimal 100 karakter"
                },
                harga_beli: {
                    required: "Harga Beli wajib diisi",
                    number: "Harga Beli harus berupa angka",
                    min: "Harga Beli tidak boleh kurang dari 0"
                },
                harga_jual: {
                    required: "Harga Jual wajib diisi",
                    number: "Harga Jual harus berupa angka",
                    min: "Harga Jual tidak boleh kurang dari 0"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataBarang.ajax.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
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
            }
        });
    });
</script>
@endempty