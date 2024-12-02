<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/icon/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BSIP RumBes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @role('Pengunjung')
          <li class="nav-item">
            <a href="{{ route('pengunjung.create') }}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Buku Pengunjung
              </p>
            </a>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pengguna
              </p>
            </a>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('pengunjung.index') }}" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>
                Pengunjung
              </p>
            </a>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('rak.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Rak Buku
              </p>
            </a>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Kategori Buku
              </p>
            </a>
          </li>
          @endrole
          <li class="nav-item">
            <a href="{{ route('buku.index') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Daftar Buku
              </p>
            </a>
          </li>
          @role('Petugas')
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-random"></i>
              <p>
                Sirkulasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sirkulasi.pinjam') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sirkulasi.kembali') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengembalian</p>
                </a>
              </li>
            </ul>
          </li>
          @endrole
          @role('Petugas')
          <li class="nav-item">
            <a href="{{ route('denda.index') }}" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Denda
              </p>
            </a>
          </li>
          @endrole
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>