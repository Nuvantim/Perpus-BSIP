@extends('.layout.main')
@section('title')
Info Buku
@endsection
@section('judul')
Info Buku
@endsection
@section('content')
<div class="form-group">
  <img src="{{ asset('storage/sampul/' . $buku->sampul) }}"
					width="150px"
					height="auto"
					alt="sampul_buku">
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Judul Buku : </label><br>
      <span>{{ $buku->judul }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">ISBN : </label><br>
      <span>{{ $buku->isbn }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Penulis :</label><br>
      <span>{{ $buku->penulis }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Penerbit :</label><br>
      <span>{{ $buku->penerbit }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kategori :</label><br>
      <span>{{ $buku->kategori->nama }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Rak :</label><br>
      <span>{{ $buku->rak->nama}}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tahun Terbit :</label><br>
      <span>{{ $buku->tahun }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal masuk :</label><br>
      <span>{{ date('d-m-Y',strtotime($buku->tanggal_masuk)) }}</span>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Isi Buku : </label><br>
      <span>{{ $buku->isi }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Buku : </label><br>
      <span>{{ $buku->jumlah }}</span>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">No Induk : </label><br>
        <span>{{ $buku->no_induk }}</span>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">No Barcode : </label><br>
        <span>{{ $buku->no_barcode }}</span>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">RF-ID : </label><br>
        <span>{{ $buku->rf_id }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Sumber Peroleh</label><br>
      <span>{{ $buku->peroleh }}</span>
    </div>
  </div>
</div>
@role('Petugas')
<div class="col-md-2">
  <form action="{{ route('buku.edit',$buku->id) }}">
    <button class="btn btn-block btn-warning"><i class="fas fa-edit"></i>Edit</button>
  </form>
</div>
@endrole


@endsection
