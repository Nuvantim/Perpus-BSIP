@extends('.layout.main')
@section('title')
Buku Pengunjung
@endsection
@section('judul')
Buku Pengunjung
@endsection
@section('content')
<form action="{{ route('pengunjung.store') }}" method="POST">
  @csrf
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama</label>
      <input class="form-control" type="text" placeholder="Nama Pengunjung" autofocus name="nama" required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Instansi</label>
      <input class="form-control" type="text" placeholder="Nama Instansi" name="instansi"required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Alamat</label>
      <input class="form-control" type="text" placeholder="Alamat Pengunjung" name="alamat"required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Jenis Kelamin</label>
      <select class="custom-select form-control-border" id="exampleSelectBorder" name="jenis_kelamin">
        <option>Laki-Laki</option>
        <option>Perempuan</option>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tujuan</label>
      <select class="custom-select form-control-border" id="exampleSelectBorder" name="tujuan">
        <option>Membaca</option>
        <option>Berkunjung</option>
        <option>Meminjam</option>
      </select>
    </div>
    <button class="btn btn-block btn-outline-primary" type="submit">Simpan</button>
  </div>
</form>
@endsection

