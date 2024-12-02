@extends('.layout.main')
@section('title')
Pengembalian Buku
@endsection
@section('judul')
Daftar Pengembalian Buku
@endsection
@section('content')
<div class="table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Peminjam</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Jumlah Buku</th>
        <th>Denda</th>
        <th>Tanggal Pengembalian</th>
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
        <td>{{ 'Rp '.number_format($pjm->denda,0,',','.') }}</td>
        <td>{{ date('d-m-Y',strtotime($pjm->tgl_kembali)) }}</td>
        <td>
          <div class="d-flex center-content-between">
            <form action="{{ route('kembali.info',$pjm->id) }}">
              @csrf
              <button class="btn btn-outline-primary"><i class="fas fa-eye"></i></button>
            </form>
            <form action="{{ route('pinjam.destroy',$pjm->id) }}" method="post"
              onsubmit="return confirmDelete();">
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
<script>
  function confirmDelete()
  {
      return confirm('Apakaha yakin menghapus pengembalian ini ?')
  }
</script>
@endsection
