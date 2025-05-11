<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Level</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> Informasi Level</h5>
                Berikut adalah detail informasi level yang Anda pilih:
            </div>
            
            <table class="table table-sm table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Kode Level:</th>
                        <td>{{ $level->level_kode }}</td>
                    </tr>
                    <tr>
                        <th>Nama Level:</th>
                        <td>{{ $level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat pada:</th>
                        <td>{{ $level->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui pada:</th>
                        <td>{{ $level->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>