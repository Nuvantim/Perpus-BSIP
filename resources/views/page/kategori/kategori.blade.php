@extends('.layout.main')
@section('title')
Kategori Buku
@endsection
@section('judul')
Daftar Kategori
@endsection
@section('button')
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#input_modal">
  <i class="fas fa-plus"></i><span> Tambah Kategori</span></button>
@endsection
@section('content')
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
            <td>Aksi</td>
		</tr>	
	</thead>
	<tbody>
    @foreach ($kategori as $ktg)
		<tr>
			<td>{{ $loop->iteration }}</td>
      <td>{{ $ktg->nama }}</td>
      <td>
        <button class="btn icon icon-left btn-outline-warning" data-toggle="modal"
            data-target="#update_modal{{ $ktg->id }}"><i
                data-feather="alert-triangle" class="fas fa-edit"></i></button>
        <form id="del-form" action="{{ route('kategori.destroy', $ktg->id) }}" method="POST"
            class="d-inline" onsubmit="return confirmDelete();">
            @csrf
            @method('DELETE')
            <button id="del-button" class="btn icon icon-left btn-outline-danger"><i
                    data-feather="alert-circle" class="fas fa-trash-alt"></i>
            </button>
        </form>
    </td>
</tr>
{{-- modal  update Kategori --}}
<div class="modal" id="update_modal{{ $ktg->id }}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header Modal -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <!-- Form Input -->
                <form action="{{ route('kategori.update', $ktg->id ) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Kategori: </label>
                        <input type="text" name="nama"
                            value="{{ $ktg->nama }}" id="nama"
                            class="form-control" placeholder="Masukkan Nama Kategori"
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
              <h4 class="modal-title">Tambah Kategori</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
              <!-- Form Input -->
              <form action="{{ route('kategori.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="nama">Nama Kategori:</label>
                      <input type="text" name="nama" id="nama" class="form-control"
                          placeholder="Masukkan Nama Kategori" required>
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
        return confirm('Apakaha yakin menghapus kategori ini ?')
    }
</script>
@endsection
