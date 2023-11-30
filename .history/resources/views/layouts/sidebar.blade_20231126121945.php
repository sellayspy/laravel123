<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLTE-2/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li>
          <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="header">MASTER</li>
        <li class="active treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i>
                <span>Master</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li>
        <a href="{{ route('produk.index') }}">
          <i class="fa fa-cubes"></i> <span>Barang</span>
          </a>
        </li>
       <li>
       <a href="{{ route('kategori.index') }}">
          <i class="fa fa-cube"></i> <span>Kategori</span>
          </a>
       </li>
          <li>
          <a href="{{ route('customer.index') }}">
          <i class="fa fa-users"></i> <span>Customer</span>
          </a>
          </li>
         <li>
         <a href="{{ route('suplier.index') }}">
          <i class="fa fa-truck"></i> <span>Suplier</span>
          </a>
         </li>
            </ul>
        </li>
         <li class="header">TRANSAKSI</li>
         <li>
         <a href="{{ route('pembelian.index') }}">
          <i class="fa fa-download"></i> <span>Pembelian</span>
          </a>
         </li>
         <li>
         <a href="{{ route('transaksi.index') }}">
          <i class="fa fa-upload"></i> <span>Transaksi Lama</span>
          </a>
         </li>
         <li>
         <a href="{{ route('transaksi.baru') }}">
          <i class="fa fa-upload"></i> <span>Transaksi Baru</span>
          </a>
         </li>
         <li class="header">LAPORAN</li>
         <li>
         <a href="#">
          <i class="fa fa-file-pdf-o"></i> <span>Laporan Penjualan</span>
          </a>
         </li>
         <li class="header">System</li>
         <li>
         <a href="#">
          <i class="fa fa-user"></i> <span>User</span>
          </a>
         </li>
         <li>
         <a href="#">
          <i class="fa fa-cogs"></i> <span>Pengaturan</span>
          </a>
         </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
