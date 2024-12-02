@extends('.layout.main')
@section('title')
Nominal Denda
@endsection
@section('judul')
Nominal Denda Peminjaman
@endsection
@section('content')
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Nominal</th>
      <th>Aksi</th>
		</tr>	
	</thead>
	<tbody>
    @foreach ($denda as $dn)
		<tr>
			<td>{{ $loop->iteration }}</td>
      <td>{{ $dn->nominal }}</td>
      <td>
        <button class="btn icon icon-left btn-outline-warning" data-toggle="modal"
            data-target="#update_modal{{ $dn->id }}"><i
                data-feather="alert-triangle" class="fas fa-edit"></i></button>
      </td>
    </tr>
    {{-- modal  update rak --}}
    <div class="modal" id="update_modal{{ $dn->id }}">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Header Modal -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit denda</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body">
                    <!-- Form Input -->
                    <form action="{{ route('denda.update', $dn->id ) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama denda: </label>
                            <input type="text" name="denda"
                                value="{{ $dn->nominal }}" id="denda"
                                class="form-control" placeholder="Masukkan Nominal denda"
                                required>
                        </div>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
{{-- End modal --}}
		</tr> 
    @endforeach
	</tbody>
</table>

@endsection
