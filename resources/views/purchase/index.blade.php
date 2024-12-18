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

    // Pilih semua elemen dengan class 'subtotal' dalam tabel
    const subtotals = document.querySelectorAll('.subtotal');

    // Loop untuk menjumlahkan nilai semua subtotal
    subtotals.forEach((subtotalCell) => {
        let subtotalValue = parseInt(subtotalCell.getAttribute('data-value'), 10); // Ambil nilai asli (tanpa format Rupiah)
        total += isNaN(subtotalValue) ? 0 : subtotalValue; // Tambahkan ke total, hindari NaN
    });

    // Tampilkan hasil dalam input total dengan format Rupiah
    document.getElementById('total').value = formatRupiah(total);
}

// Event listener untuk memproses input barcode
document.getElementById('barcode').addEventListener('keyup', function (event) {
    let barcode = event.target.value.trim();
    let supplierSelect = document.getElementById('supplier');
    let selectedSupplier = supplierSelect.options[supplierSelect.selectedIndex]?.text;
    let purchaseDate = document.getElementById('purchase_date').value;
    let paymentMethodSelect = document.getElementById('payment_method');
    let selectedPaymentMethod = paymentMethodSelect.options[paymentMethodSelect.selectedIndex]?.text;

    // Validasi Supplier, Tanggal, dan Metode Pembayaran
    if (!supplierSelect.value) {
        alert("Pilih Supplier terlebih dahulu!");
        return;
    }
    if (!purchaseDate) {
        alert("Masukkan Tanggal Pembelian!");
        return;
    }
    if (!paymentMethodSelect.value) {
        alert("Pilih Metode Pembayaran terlebih dahulu!");
        return;
    }

    if (barcode.length >= 3) {
        let foundProduct = null;

        @foreach($products as $product)
            if ("{{ $product->kode }}" === barcode) {
                foundProduct = {
                    id: "{{ $product->id }}",
                    name: "{{ $product->nama_produk }}",
                    price: parseInt("{{ $product->harga_produk }}", 10),
                    quantity: 1
                };
            }
        @endforeach

        if (foundProduct) {
            let purchaseProducts = document.getElementById('purchase-products');
            let existingRow = document.getElementById(`purchase-product-${foundProduct.id}`);

            if (existingRow) {
                // Update quantity jika produk sudah ada di daftar
                let quantityInput = existingRow.querySelector('.quantity');
                let newQuantity = parseInt(quantityInput.value, 10) + 1;
                quantityInput.value = newQuantity;

                // Update subtotal
                let subtotalCell = existingRow.querySelector('.subtotal');
                let newSubtotal = newQuantity * foundProduct.price;
                subtotalCell.textContent = formatRupiah(newSubtotal);
                subtotalCell.setAttribute('data-value', newSubtotal); // Simpan nilai asli
            } else {
                // Tambahkan baris baru ke tabel
                let row = document.createElement('tr');
                row.setAttribute('id', `purchase-product-${foundProduct.id}`);
                row.innerHTML = `
                    <td>${foundProduct.name}</td>
                    <td>${selectedSupplier}</td>
                    <td>${purchaseDate}</td>
                    <td>${selectedPaymentMethod}</td>
                    <td>
                        <input type="number" name="products[${foundProduct.id}][quantity]" value="${foundProduct.quantity}" class="form-control quantity" style="width: 80px;" min="1">
                    </td>
                    <td>${formatRupiah(foundProduct.price)}</td>
                    <td class="subtotal text-right" data-value="${foundProduct.price}">${formatRupiah(foundProduct.price)}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm cancel-btn" data-id="${foundProduct.id}">Cancel</button>
                    </td>
                `;
                purchaseProducts.appendChild(row);
            }

            // Kosongkan input barcode dan refocus
            document.getElementById('barcode').value = '';
            document.getElementById('barcode').focus();

            // Hitung total setelah menambahkan produk
            calculateTotal();
        } else {
            alert('Product not found!');
        }
    }
});

// Event listener untuk memperbarui subtotal jika jumlah barang diubah
document.addEventListener('change', function (event) {
    if (event.target.classList.contains('quantity')) {
        let quantity = parseInt(event.target.value, 10);
        let row = event.target.closest('tr');
        let price = parseInt(row.querySelector('.subtotal').getAttribute('data-value'), 10) / parseInt(event.target.defaultValue, 10);

        let newSubtotal = price * quantity;
        let subtotalCell = row.querySelector('.subtotal');
        subtotalCell.textContent = formatRupiah(newSubtotal);
        subtotalCell.setAttribute('data-value', newSubtotal);

        calculateTotal(); // Hitung ulang total
    }
});

// Event listener untuk menghapus produk dari tabel
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('cancel-btn')) {
        let rowId = event.target.getAttribute('data-id');
        let row = document.getElementById(`purchase-product-${rowId}`);
        if (row) {
            row.remove();
            calculateTotal(); // Hitung ulang total setelah menghapus produk
        }
    }
});

</script>
@endsection
