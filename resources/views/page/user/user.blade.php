@extends('.layout.main')
@section('title')
Pengguna Sistem
@endsection
@section('judul')
Daftar Pengguna
@endsection
@section('content')
<div class="row table-responsive">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>   
    </thead>
    <tbody>
    @foreach ($usr as $usr)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $usr->name }}</td>
            <td>{{ $usr->email }}</td>
            <td>{{ optional($usr->roles->first())->name }}</td>
            <td>
            <button class="btn icon icon-left btn-outline-warning" data-toggle="modal"
                data-target="#update_modal{{ $usr->id }}"><i
                    data-feather="alert-triangle" class="fas fa-edit"></i></button>
            </td>
        </tr>
    </tbody>
</div>
{{-- modal  update rak --}}
<div class="modal" id="update_modal{{ $usr->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <!-- Form Input -->
                <form action="{{ route('user.update',$usr->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama : </label>
                        <input type="text" name="nama"
                            value="{{ $usr->name }}" id="nama"
                            class="form-control" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Email : </label>
                        <input type="text" name="email"
                            value="{{ $usr->email }}" id="email"
                            class="form-control" placeholder="Masukkan Email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Password : </label>
                        <small><strong>*Optional</strong></small>
                        <input type="password" name="password"
                            id="nama"
                            class="form-control" placeholder="Password"
                            >
                    </div>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End modal --}}
		</tr> 
    @endforeach
	</tbody>
</table>
@endsection
