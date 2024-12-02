@extends('.layout.main')
@section('title')
Info Peminjam
@endsection
@section('judul')
Info Peminjam
@endsection
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Peminjam : </label><br>
      <span>{{ $pinjam->nama }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Pinjam :</label><br>
      <span>{{ date('d-m-Y',strtotime($pinjam->tgl_pinjam)) }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Tanggal Kembali :</label><br>
      <span>{{ date('d-m-Y',strtotime($pinjam->tgl_pinjam)) }}</span>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">List Buku</label><br>
      <div class="table-responsive">
    <table class="table table-bordered table-striped" id="mainTable">
      <thead class="thead-dark">
          <tr>
            <th>No.</th>
            <th>Buku</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
      </thead>
      <tbody style="width: 200px;" id="tabelutama" name="data_tabel">
          @foreach($pinjaman as $pjn)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $pjn->buku->judul }}</td>
              <td>{{ $pjn->buku->penulis }}</td>
              <td>{{ $pjn->buku->tahun }}</td>
              <td>
                <form action="{{ route('buku.info',$pjn->buku_id) }}">
                  @csrf
                  <button class="btn btn-outline-primary"><i class="fas fa-info"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Hari Peminjaman :</label><br>
      <span>{{ $pinjam->lama_pinjam.' hari' }}</span>
    </div>
    @php
      $jumlah = 0;
      foreach($pinjaman as $data_pinjam)
      {
        if($data_pinjam->pinjam_id == $pinjam->id)
        {
          $jumlah++; 
        }
      }
    @endphp
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Buku Dipinjam :</label><br>
      <span>{{ $jumlah.' buku' }}</span>
    </div>
    @php
      $tanggal = $pinjam->tgl_kembali;
      $todays = date('Y-m-d');
      $tanggal_1 = strtotime($tanggal);
      $tanggal_2 = strtotime($todays);
      $range = $tanggal_2-$tanggal_1;
      $acumulate = $range / 60 / 60 / 24;

      if($acumulate > 0)
      {
        $denda = $acumulate * $denda->nominal;
        $jumlah_denda =  $denda * $jumlah;
      }else {
        $jumlah_denda = 0;
      }
    @endphp
    <div class="form-group">
      <label for="exampleInputEmail1">Jumlah Denda :</label><br>
      <span>{{ 'Rp '.number_format($jumlah_denda,0,',','.') }}</span>
    </div>
    <form action="{{ route('sirkulasi.kembalikan',$pinjam->id) }}" method="POST"
      onsubmit="return confirmback();">
      @csrf 
      <button type="submit" class="btn btn-success"><i class="fas fa-external-link-square-alt"></i><span> Pengembalian</span></button>
    </form>
  </div>
</div>
<script>
  function confirmback()
  {
      return confirm('Proses Pengembalian dilakukan ?')
  }
</script>
@endsection
