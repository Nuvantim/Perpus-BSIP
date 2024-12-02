@extends('.layout.main')
@section('title')
Tambah Peminjaman
@endsection
@section('judul')
Tambah Peminjaman
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <form action="{{ route('sirkulasi.store') }}" method="POST">
        @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Peminjam : </label>
                <input class="form-control" type="text" placeholder="Nama Peminjam" autofocus name="nama" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Pinjam : </label>
                <input class="form-control" type="date" id="tanggal_pinjam" placeholder="Tanggal Pinjam" name="tanggal_pinjam" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Lama Peminjaman :</label>
                <input class="form-control" type="number" placeholder="Lama Pinjam" name="lama" required>
              </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tableModal"
                    title="Open User Selection Modal"><i class="fas fa-book-medical"></i>
                     Pilih Buku
                </button>
            </div>
            <br>
            <div class="col-md-8">
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
                            <!-- Main table content will be populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="hidden" id="data_tabel_input" name="data_tabel">
            <button type="submit" class="btn btn-primary">Simpan</button>
            {{-- <button type="button" class="btn btn-primary" onclick="ambilData()">Simpan</button> --}}
        </div>
    </form>
    
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="tableModal"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableModalLabel">Pemilihan Audhitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Penuli</th>
                                <th>Tahun Terbit</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($buku as $bk)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $bk->judul }}</td>
                              <td>{{ $bk->penulis }}</td>
                              <td>{{ $bk->tahun }}</td>
                              <td>{{ $bk->jumlah }}</td>
                              <td>
                                  <button class="btn btn-success"
                                      onclick="pilihData('{{ $bk->id }}//{{ $bk->judul }}//{{ $bk->penulis }}//{{ $bk->tahun }}')">Pilih</button>
                                      <input type="hidden" name="data[{{ $bk->id }}][id]" value="{{ $bk->id }}">   
                              </td>
                          </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pilihData(namaData) {
            // Periksa apakah data sudah ada di tabel utama
            if (!isDataExists(namaData)) {
                namaDatas = namaData.split('//');

                // Buat baris HTML untuk data terpilih
                var newRow = "<tr><td>" + (document.getElementById("mainTable").rows.length + 0) +
                    "</td><td class='id_users' hidden>"+ namaDatas[0] +"</td><td>" + namaDatas[1] + "</td><td>" +
                    namaDatas[2] + "</td><td>" + namaDatas[3] +
                    "</td><td><button class='btn btn-danger' onclick='hapusData(this)'>Hapus</button></td></tr>";

                // Tambahkan baris ke tabel utama
                $("#mainTable").append(newRow);
                updateFormData();
            } else {
                // Data sudah ada, mungkin berikan pesan atau lakukan tindakan lain
                alert("Data sudah ada");
            }

            // Tutup modal
            $("#tableModal").modal("hide");
        }

        // Fungsi untuk memeriksa apakah data sudah ada di tabel utama
        function isDataExists(namaData) {
            var exists = false;
            $("#mainTable td:nth-child(2)").each(function() {
                if ($(this).text().trim() === namaData.split('//')[0].trim()) {
                    exists = true;
                    return false; // Keluar dari loop jika data sudah ditemukan
                }
            });
            return exists;
        }

        // Fungsi untuk menghapus baris data dari tabel utama
        function hapusData(button) {
            var row = button.closest("tr");
            row.remove();
            updateFormData();
        }

        function updateFormData() {
            var array_data = [];
            // Ambil data dari setiap baris tabel
            $("#mainTable tbody tr").each(function() {
                var id_users = $(this).find('td:eq(1)').text().trim();
                // Konversi nilai id_users ke integer
                // var id_users_integer = parseInt(id_users, 10);

                // Pastikan bahwa ID yang diambil sesuai dengan struktur yang diharapkan
                array_data.push(id_users);
            });

            // Perbarui nilai input tersembunyi dengan data sebagai array langsung
            $("#data_tabel_input").val(JSON.stringify(array_data));
        }
        
    </script>
    <script>
        document.getElementById('tanggal_pinjam').valueAsDate = new Date();
    </script>
@endsection