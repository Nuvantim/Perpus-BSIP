@extends('.layout.main')
@section('title')
Rak Buku
@endsection
@section('judul')
Daftar Rak
@endsection
@section('button')
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#input_modal">
  <i class="fas fa-plus"></i><span> Tambah Rak</span></button>
@endsection
@section('content')
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
      <th>Aksi</th>
		</tr>	
	</thead>
	<tbody>
    @foreach ($rak as $rk)
		<tr>
			<td>{{ $loop->iteration }}</td>
      <td>{{ $rk->nama }}</td>
      <td>
        <button class="btn icon icon-left btn-outline-warning" data-toggle="modal"
            data-target="#update_modal{{ $rk->id }}"><i
                data-feather="alert-triangle" class="fas fa-edit"></i></button>
        <form id="del-form" action="{{ route('rak.destroy', $rk->id) }}" method="POST"
            class="d-inline" onsubmit="return confirmDelete();">
            @csrf
            @method('DELETE')
            {{-- pesan hapus --}}
            <button id="del-button" class="btn icon icon-left btn-outline-danger"><i
                    data-feather="alert-circle" class="fas fa-trash-alt"></i>
            </button>
        </form>
    </td>
</tr>
{{-- modal  update rak --}}
<div class="modal" id="update_modal{{ $rk->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit rak</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <!-- Form Input -->
                <form action="{{ route('rak.update', $rk->id ) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Rak: </label>
                        <input type="text" name="nama"
                            value="{{ $rk->nama }}" id="nama"
                            class="form-control" placeholder="Masukkan Nama Rak"
                            required>
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
<div class="modal" id="input_modal">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Header Modal -->
          <div class="modal-header">
              <h4 class="modal-title">Tambah Rak</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
              <!-- Form Input -->
              <form action="{{ route('rak.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="nama">Nama Rak:</label>
                      <input type="text" name="nama" id="nama" class="form-control"
                          placeholder="Masukkan Nama Rak" required>
                  </div>
          </div>

          <!-- Footer Modal -->
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
      </div>
  </div>
</div>
<script>
    function confirmDelete()
    {
        return confirm('Apakaha yakin menghapus Rak ini ?')
    }
</script>
@endsection
