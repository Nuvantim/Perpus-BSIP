@extends('.layout.main')
@section('title')
Tambah Buku
@endsection
@section('judul')
Tambah Buku
@endsection
@section('content')
<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Judul Buku : </label>
        <input class="form-control" type="text" placeholder="Judul Buku" autofocus name="judul" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">ISBN : </label>
        <input class="form-control" type="text" placeholder="ISBN" name="isbn" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Penulis :</label>
        <input class="form-control" type="text" placeholder="Penulis Buku" name="penulis" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Penerbit :</label>
        <input class="form-control" type="text" placeholder="Penerbit Buku" name="penerbit" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Kategori :</label>
        <select class="form-control select2" style="width: 100%;" name="kategori">
          @foreach ($kategori as $ktg)
            <option value="{{ $ktg->id }}">{{ $ktg->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Rak :</label>
        <select class="form-control select2" style="width: 100%;" name="rak">
          @foreach ($rak as $rk)
            <option value="{{ $rk->id }}">{{ $rk->nama }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Tahun Terbit :</label>
        <input class="form-control" type="number" placeholder="Tahun Terbit Buku" name="tahun" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Tanggal masuk :</label>
        <input class="form-control" type="date" placeholder="Tanggal Masuk" name="tanggal_masuk" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Isi Buku : </label>
        <input class="form-control" type="number" placeholder="Isi Buku" name="isi" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Buku : </label>
        <input class="form-control" type="number" placeholder="Jumlah Buku" name="jumlah" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">No Induk : </label>
          <input class="form-control" type="text" placeholder="No Induk" name="induk" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">No Barcode : </label>
          <input class="form-control" type="text" placeholder="No Barcode" name="barcode" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">RF-ID : </label>
          <input class="form-control" type="text" placeholder="RF-ID" name="rf_id" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Sumber Peroleh</label>
        <select class="custom-select form-control-border" id="exampleSelectBorder" name="peroleh">
          <option>Hibah / Hadiah</option>
          <option>Pembelian</option>
          <option>Pinjam</option>
        </select>
      </div>
      <div class="form-group">
        <label for="formFile" class="form-label">Sampul Buku : </label>
        <span><small>*optional</small></span>
        <br>
        <input type="file" class="form-controll" id="formFile" data-max-file-size="5MB" name="sampul" accept=".jpeg, .jpg, .png">
      </div>
    </div>
  </div>
<div class="col-md-2">
  <button class="btn btn-block btn-primary" type="submit">Simpan</button>
</div>
</form>


@endsection
