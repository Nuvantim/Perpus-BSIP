@extends('.layout.main')
@section('title')
Buku
@endsection
@section('judul')
Daftar Buku Perpustakaan
@endsection
@section('button')
@role('Petugas')
<a href="{{ route('buku.create') }}" class="btn btn-outline-primary">
	<i class="fas fa-plus"></i><span>Tambah Buku</span>
</a>

<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#input_modal">
  <i class="fas fa-file-import"></i><span>Import Data Buku</span></button>

<a href="{{ asset('csv/data_buku.csv') }}" class="btn btn-outline-dark">
	<i class="fas fa-file-download"></i><span> Download CSV File</span>
</a>
@endrole
@endsection
@section('content')
<div class="row table-responsive">
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				 <th>No</th>
				 <th>Sampul</th>
				 <th>Judul</th>
				 <th>Kategori</th>
				 <th>Rak</th>
				 <th>Penerbit</th>
				 <th>Penulis</th>
				 <th>Tahun</th>
				 <th>Aksi</th>
			</tr>	
		</thead>
		<tbody>
			@foreach($buku as $bk)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>
						@if($bk->sampul != null )
							<img src="{{ asset('storage/sampul/' . $bk->sampul) }}"
							width="100px"
							height="auto"
							alt="sampul_buku">
						@else
							<img src="{{ asset('icon/book.png') }}"
							width="100px"
							height="auto"
							alt="sampul_buku">
						@endif
						
					</td>
					<td>{{ $bk->judul }}</td>
					<td>{{ $bk->kategori->nama }}</td>
					<td>{{ $bk->rak->nama }}</td>
					<td>{{ $bk->penerbit }}</td>
					<td>{{ $bk->penulis }}</td>
					<td>{{ $bk->tahun }}</td>
					<td>
						<div class="d-flex center-content-between">
							<form action="{{ route('buku.info',$bk->id) }}">
								@csrf
								<button class="btn btn-outline-primary"><i class="fas fa-info"></i></button>
							</form>
							<form action="{{ route('buku.destroy',$bk->id) }}" method="POST" onsubmit="return confirmDelete();">
								@csrf
								@method('DELETE')
								<button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
							</form>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal" id="input_modal">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Header Modal -->
          <div class="modal-header">
              <h4 class="modal-title">Import Data Buku</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
              <!-- Form Input -->
              <form action="{{ route('buku.upload') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="nama">Upload CSV File:</label>
                      <div class="custom-file">
	                        <input type="file" 
	                        class="custom-file-input" 
	                        name="file" 
	                        accept=".csv">
	                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
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
			return confirm('Apakaha yakin menghapus Buku ini ?')
	}
</script>
@endsection
