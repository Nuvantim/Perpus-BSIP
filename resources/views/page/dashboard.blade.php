@extends('.layout.main')
@section('title')
Dashboard
@endsection
@section('judul')
Dashboard
@endsection
@section('content')
<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h3>{{ $pengunjung }}</h3>

				<p>Pengunjung</p>
			</div>
			<div class="icon">
				<i class="fas fa-address-card"></i>
			</div>
			<a href="{{ route('pengunjung.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h3>{{ $buku }}</h3>

				<p>Buku</p>
			</div>
			<div class="icon">
				<i class="fas fa-book"></i>
			</div>
			<a href="{{ route('buku.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-danger">
			<div class="inner">
				<h3>{{ $pinjam }}</h3>

				<p>Peminjaman</p>
			</div>
			<div class="icon">
				<i class="fas fa-sign-out-alt"></i>
			</div>
			<a href="{{ route('sirkulasi.pinjam') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h3>{{ $pengembalian }}</h3>

				<p>Pengembalian</p>
			</div>
			<div class="icon">
				<i class="fas fa-sign-in-alt"></i>
			</div>
			<a href="{{ route('sirkulasi.kembali') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
@endsection