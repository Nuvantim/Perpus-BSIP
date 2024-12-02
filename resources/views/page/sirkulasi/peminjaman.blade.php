@extends('.layout.main')
@section('title')
Peminjaman Buku
@endsection
@section('judul')
Daftar Peminjaman Buku
@endsection
@section('button')
<a href="{{ route('sirkulasi.tambah') }}" class="btn btn-primary">
	<i class="fas fa-plus"></i><span>Tambah Peminjaman</span>
</a>
@endsection
@section('content')
<div class="row table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah Buku</th>
        <th>Denda</th>
        <th>Aksi</th>
      </tr>	
    </thead>
    <tbody>
      @foreach($pinjam as $pjm)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $pjm->nama }}</td>
        <td>{{ date('d-m-Y',strtotime($pjm->tgl_pinjam)) }}</td>
        <td>{{ date('d-m-Y',strtotime($pjm->tgl_kembali)) }}</td>
        {{-- menghitung jumlah buku --}}
        @php
          $jumlah = 0;
          foreach($pinjaman as $data_pinjam)
          {
            if($data_pinjam->pinjam_id == $pjm->id)
            {
              $jumlah++; 
            }
          }
        @endphp
        <td>{{ $jumlah }}</td>
        {{-- menghitung jumlah hari dengan denda --}}
        @php
          $tanggal = $pjm->tgl_kembali;
          $todays = date('Y-m-d');
          $tanggal_1 = strtotime($tanggal);
          $tanggal_2 = strtotime($todays);
          $range = $tanggal_2-$tanggal_1;
          $acumulate = $range / 60 / 60 / 24;

          if($acumulate > 0)
          {
            $hitung_denda = $acumulate * $denda->nominal;
            $jumlah_denda =  $hitung_denda * $jumlah;
          }else {
            $jumlah_denda = 0;
          }
        @endphp
        <td>{{ 'Rp '.number_format($jumlah_denda,0,',','.') }}</td>
        <td>
          <div class="d-flex center-content-between">
            <form action="{{ route('pinjam.info',$pjm->id) }}">
              @csrf
              <button class="btn btn-outline-primary"><i class="fas fa-eye"></i> Detail</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
