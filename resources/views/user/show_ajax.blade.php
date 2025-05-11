<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> Informasi User</h5>
                Berikut adalah detail informasi user yang Anda pilih:
            </div>
            
            <table class="table table-sm table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Username:</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Nama:</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Level:</th>
                        <td>{{ $user->level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th>Password:</th>
                        <td>{{ $user->password }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat pada:</th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Diperbarui pada:</th>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>