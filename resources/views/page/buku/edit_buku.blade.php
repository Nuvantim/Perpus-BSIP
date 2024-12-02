@extends('.layout.main')
@section('title')
Edit Buku
@endsection
@section('judul')
Edit Buku
@endsection
@section('content')
<form action="{{ route('buku.update',$buku->id) }}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Judul Buku : </label>
        <input class="form-control" type="text" value="{{ $buku->judul }}" placeholder="Judul Buku" autofocus name="judul" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">ISBN : </label>
        <input class="form-control" type="text" value="{{ $buku->isbn }}" placeholder="ISBN" name="isbn" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Penulis :</label>
        <input class="form-control" type="text" value="{{ $buku->penulis }}" placeholder="Penulis Buku" name="penulis" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Penerbit :</label>
        <input class="form-control" type="text" value="{{ $buku->penerbit }}" placeholder="Penerbit Buku" name="penerbit" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Kategori :</label>
        <select class="form-control select2" style="width: 100%;" name="kategori">
          @foreach ($kategori as $ktg)
            <option value="{{ $ktg->id }}"
              {{ $buku->kategoti_id == $ktg->id ? 'selected' : '' }}>{{ $ktg->nama }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Rak :</label>
        <select class="form-control select2" style="width: 100%;" name="rak">
          @foreach ($rak as $rk)
            <option value="{{ $rk->id }}"
              {{ $buku->rak_id == $rk->id ? 'selected' : '' }}>{{ $rk->nama }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Tahun Terbit :</label>
        <input class="form-control" type="number" value="{{ $buku->tahun }}" placeholder="Tahun Terbit Buku" name="tahun" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Tanggal masuk :</label>
        <input class="form-control" type="date" value="{{ $buku->tanggal_masuk }}" placeholder="Tanggal Masuk" name="tanggal_masuk" required>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Isi Buku : </label>
        <input class="form-control" type="number" value="{{ $buku->isi }}" placeholder="Isi Buku" name="isi" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Jumlah Buku : </label>
        <input class="form-control" type="number" value="{{ $buku->jumlah }}" placeholder="Jumlah Buku" name="jumlah" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">No Induk : </label>
          <input class="form-control" type="text" value="{{ $buku->no_induk }}" placeholder="No Induk" name="induk" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">No Barcode : </label>
          <input class="form-control" type="text" value="{{ $buku->no_barcode }}" placeholder="No Barcode" name="barcode" required>
      </div>
      <div class="form-group">
          <label for="exampleInputEmail1">RF-ID : </label>
          <input class="form-control" type="text" value="{{ $buku->rf_id }}" placeholder="RF-ID" name="rf_id" required>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Sumber Peroleh</label>
        <select class="custom-select form-control-border" id="exampleSelectBorder" name="peroleh">
          <option @if ($buku->peroleh == "Hibah / Hadiah" )selected @endif>Hibah / Hadiah</option>
          <option @if ($buku->peroleh == "Pembelian" )selected @endif>Pembelian</option>
          <option @if ($buku->peroleh == "Pinjam" )selected @endif>Pinjam</option>
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
