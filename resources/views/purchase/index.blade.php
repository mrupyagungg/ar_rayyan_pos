@extends('layouts.master')

@section('title', 'Pembelian')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0"><strong>Pembelian</strong></h5>
    <span class="text-secondary">Transaksi <i class="fa fa-angle-right"></i> Pembelian</span>

    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Form Input Data Pembelian-->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Input Data Pembelian</h5>
                    <form action="{{ route('purchase.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <select class="form-control" id="supplier" name="supplier_id" required>
                                        <option value="">--</option>
                                        @foreach ($supplier as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="purchase_date">Tanggal Pembelian</label>
                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_method">Metode Pembayaran</label>
                                    <select class="form-control" id="payment_method" name="payment_method" required>
                                        <option value="">--</option>
                                        <option value="Tunai">Tunai</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="barcode">Scan Barcode</label>
                                    <input type="text" class="form-control" id="barcode" placeholder="Scan atau input barcode" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

           <!--Table Data Pembelian-->
           <!--Table Data Pembelian-->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Daftar Barang yang Dibeli</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Supplier</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Metode Pembayaran</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="purchase-products">
                    <!-- Dynamic rows -->
                </tbody>
            </table>
        </div>
    </div>
</div>

            <form action="{{ route('purchase.store') }}" method="POST">
                @csrf
                <div class="row mt-3">
                    <div class="col">Total:</div>
                    <div class="col text-right">
                        <input type="text" id="total" name="total" readonly class="form-control total">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk memformat angka menjadi Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Fungsi untuk menghitung total dari semua subtotal
    function calculateTotal() {
        let total = 0;
        const subtotals = document.querySelectorAll('.subtotal');
        subtotals.forEach((subtotalCell) => {
            let subtotalValue = parseInt(subtotalCell.getAttribute('data-value'), 10);
            total += isNaN(subtotalValue) ? 0 : subtotalValue;
        });
        document.getElementById('total').value = formatRupiah(total);
    }

    // Event listener untuk memproses input barcode secara langsung
    document.getElementById('barcode').addEventListener('input', function (event) {
        let barcode = event.target.value.trim();
        if (barcode.length < 3) return; // Tidak memproses jika barcode terlalu pendek

        let supplierSelect = document.getElementById('supplier');
        let selectedSupplier = supplierSelect.options[supplierSelect.selectedIndex]?.text;
        let purchaseDate = document.getElementById('purchase_date').value;
        let paymentMethodSelect = document.getElementById('payment_method');
        let selectedPaymentMethod = paymentMethodSelect.options[paymentMethodSelect.selectedIndex]?.text;

        // Validasi data Supplier, Tanggal, dan Metode Pembayaran
        if (!supplierSelect.value || !purchaseDate || !paymentMethodSelect.value) {
            alert("Lengkapi data Supplier, Tanggal, dan Metode Pembayaran terlebih dahulu!");
            return;
        }

        let foundProduct = null;
        @foreach($products as $product)
            if ("{{ $product->kode_produk }}" === barcode) {
                foundProduct = {
                    id: "{{ $product->id_produk }}",
                    name: "{{ $product->nama_produk }}",
                    price: parseInt("{{ $product->harga_produk }}", 10),
                    stok: 1
                };
            }
        @endforeach

        if (foundProduct) {
            let purchaseProducts = document.getElementById('purchase-products');
            let existingRow = document.getElementById(`purchase-product-${foundProduct.id}`);

            if (existingRow) {
                let stokInput = existingRow.querySelector('.stok');
                let newStok = parseInt(stokInput.value, 10) + 1;
                stokInput.value = newStok;

                let subtotalCell = existingRow.querySelector('.subtotal');
                let newSubtotal = newStok * foundProduct.price;
                subtotalCell.textContent = formatRupiah(newSubtotal);
                subtotalCell.setAttribute('data-value', newSubtotal);
            } else {
                let row = document.createElement('tr');
                row.setAttribute('id', `purchase-product-${foundProduct.id}`);
                row.innerHTML = `
                    <td>${foundProduct.name}</td>
                    <td>${selectedSupplier}</td>
                    <td>${purchaseDate}</td>
                    <td>${selectedPaymentMethod}</td>
                    <td>
                        <input type="number" name="products[${foundProduct.id}][stok]" value="${foundProduct.stok}" class="form-control stok" style="width: 80px;" min="1">
                    </td>
                    <td>${formatRupiah(foundProduct.price)}</td>
                    <td class="subtotal text-right" data-value="${foundProduct.price}">${formatRupiah(foundProduct.price)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm cancel-btn" data-id="${foundProduct.id}">Cancel</button>
                    </td>
                `;
                purchaseProducts.appendChild(row);
            }

            document.getElementById('barcode').value = '';
            calculateTotal();
        } else {
            alert('Produk tidak ditemukan!');
        }
    });

    // Event listener untuk memperbarui subtotal berdasarkan stok
    document.addEventListener('input', function (event) {
        if (event.target.classList.contains('stok')) {
            let stok = parseInt(event.target.value, 10);
            let row = event.target.closest('tr');
            let price = parseInt(row.querySelector('.subtotal').getAttribute('data-value'), 10) / event.target.defaultValue;

            let newSubtotal = price * stok;
            let subtotalCell = row.querySelector('.subtotal');
            subtotalCell.textContent = formatRupiah(newSubtotal);
            subtotalCell.setAttribute('data-value', newSubtotal);

            calculateTotal();
        }
    });

    // Event listener untuk menghapus produk dari tabel
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('cancel-btn')) {
            let rowId = event.target.getAttribute('data-id');
            let row = document.getElementById(`purchase-product-${rowId}`);
            if (row) {
                row.remove();
                calculateTotal();
            }
        }
    });
</script>



@endsection
