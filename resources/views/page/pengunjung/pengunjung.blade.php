@extends('.layout.main')
@section('title')
Pengunjung
@endsection
@section('judul')
Daftar Pengunjung
@endsection
@section('content')
@section('button')
<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#input_modal">
  <i class="fas fa-file-download"></i><span> Download Data Pengunjung</span></button>
@endsection
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Instansi</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
			<th>Tujuan</th>
			<th>Tanggal</th>
		</tr>	
	</thead>
	<tbody>
    @foreach ($pengunjung as $png)
		<tr>
			<td>{{ $loop->iteration }}</td>
      <td>{{ $png->nama }}</td>
      <td>{{ $png->instansi }}</td>
      <td>{{ $png->alamat }}</td>
      <td>{{ $png->jenis_kelamin }}</td>
      <td>{{ $png->tujuan }}</td>
      <td>{{ date('d-m-Y',strtotime($png->tanggal)) }}</td>
		</tr> 
    @endforeach
	</tbody>
</table>
<div class="modal" id="input_modal">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Header Modal -->
          <div class="modal-header">
              <h4 class="modal-title">Export Data Pengunjung</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Body Modal -->
          <div class="modal-body">
              <!-- Form Input -->
              <form action="{{ route('pengunjung.download') }}" method="post">
                  @csrf
                  <div class="form-group">
			        <label for="exampleInputEmail1">Dari Tanggal :</label>
			        <input class="form-control" type="date" placeholder="Tanggal awal" name="dari_tanggal" required>
			      </div>
			      <div class="form-group">
			        <label for="exampleInputEmail1">Sampai Tanggal :</label>
			        <input class="form-control" type="date" placeholder="Tanggal akhir" name="sampai_tanggal" required>
			      </div>
          </div>

          <!-- Footer Modal -->
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Export</button>
          </div>
          </form>
      </div>
  </div>
</div>
@endsection
