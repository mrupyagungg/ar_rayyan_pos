<!--Sidebar left-->
<div class="col-sm-3 col-xs-6 sidebar pl-0">
  <div class="inner-sidebar mr-3">
      <!--Image Avatar-->
      <div class="avatar text-center">
            <img src="{{ asset('style/assets/img/logo_sambeljerit.png') }}" alt="" class="rounded-circle" />
          <p><strong>AR RAYYAN</strong></p>
          <span class="text-primary small"><strong>POS</strong></span>
      </div>
      <!--Image Avatar-->

      <!--Sidebar Navigation Menu-->
      <div class="sidebar-menu-container">
        <ul class="sidebar-menu mt-4 mb-4">
            <li class="parent">
                <a href="{{ url('dashboard') }}" class=""><i class="fa fa-dashboard mr-3"> </i>
                    <span class="none">Dashboard </span>
                </a>

            </li>

            <li class="parent">
                <a href="#" onclick="toggle_menu('masterdata'); return false" class=""><i class="fa fa-th-large mr-3"></i>
                    <span class="none">Master Data <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                </a>
                <ul class="children" id="masterdata">
                    <li class="child"><a href="{{ url('coa') }}" class="ml-4"><i class="fa fa-pie-chart mr-3"></i> Chart Of Accounts</a></li>
                    <li class="child"><a href="{{ url('supplier') }}" class="ml-4"><i class="fa fa-link mr-3"></i> Suppliers</a></li>
                    <li class="child"><a href="{{ url('product') }}" class="ml-4"><i class="fa fa-tags mr-3"></i> Product</a></li>                    
                </ul>
            </li>
            <li class="parent">
                <a href="#" onclick="toggle_menu('transaction'); return false" class=""><i class="fa fa-pencil-square mr-3"></i>
                    <span class="none">Transaksi <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                </a>
                <ul class="children" id="transaction">
                <li class="child"><a href="{{ route('purchase.index') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Pembelian</a></li>
                    <li class="child"><a href="{{ url('pengeluaran') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Retur Pembelian</a></li>
                    <li class="child"><a href="{{ url('pos') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Penjualan</a></li>
                    <li class="child"><a href="{{ url('transactions') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Riwayat Penjualan</a></li>
                </ul>
            </li>
            <li class="parent">
                <a href="#" onclick="toggle_menu('laporan'); return false" class=""><i class="fa fa-file mr-3"></i>
                    <span class="none">Laporan <i class="fa fa-angle-down pull-right align-bottom"></i></span>
                </a>
                <ul class="children" id="laporan">
                    <li class="child"><a href="{{ url('reports/revenue') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Pendapatan</a></li>
                    <li class="child"><a href="{{ url('reports/product_terjual') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Penjualan Per Produk</a></li>
                    <li class="child"><a href="{{ url('reports/pengeluaran') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Pembelian</a></li>
                    <li class="child"><a href="{{ url('reports/pengeluaran') }}" class="ml-4"><i class="fa fa-angle-right mr-2"></i> Retur Pembelian</a></li>
                </ul>
            </li>

            <li class="parent">
                <a href="{{ url('jurnal/umum') }}" class=""><i class="fa fa-table mr-3"></i>
                    <span class="none">Jurnal Umum</span>
                </a>
            </li>
            <li class="parent">
                <a href="{{ url('jurnal/bukubesar') }}" class=""><i class="fa fa-list-alt mr-3"></i>
                    <span class="none">Buku Besar</span>
                </a>
            </li>
            <li class="parent">
                <a href="{{ url('logout') }}" class=""><i class="fa fa-sign-out mr-3"></i>
                    <span class="none">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <!--Sidebar Naigation Menu-->
  </div>
</div>
<!--Sidebar left-->