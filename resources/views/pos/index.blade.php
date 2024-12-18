@extends('layouts.master')

@section('title', 'Penjualan')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-0" ><strong>Penjualan</strong></h5>
    <span class="text-secondary">Transaksi <i class="fa fa-angle-right"></i> Penjualan</span>
    
    <div class="row mt-3">
        <div class="col-sm-12">
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                
                <div class="container">
                    <div class="row mb-2">
                        <div class="col">
                            <form class="d-flex" id="barcode-form">
                                <input type="text" class="form-control" id="barcode-input" placeholder="Scan Barcode" autocomplete="off">
                            </form>
                        </div>
                    </div>
                
                    <div class="user-cart">
                        <div class="card">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50%;" class="text-center">Nama Product</th>
                                        <th style="width: 20%;" class="text-center">Quantity</th>
                                        <th style="width: 15%;" class="text-center">Harga</th>
                                        <th style="width: 15%;" class="text-center">Aksi</th> <!-- Cancel column -->
                                    </tr>
                                </thead>
                                <tbody id="cart-products"></tbody>
                            </table>
                        </div>
                    </div>
                
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col">Nama:</div>
                            <div class="col text-right">
                                <input type="text" name="nama_customer" value="Pelanggan Umum" class="form-control nama_customer">
                            </div>
                        </div>
                    
                        <div class="row mt-2">
                            <div class="col">Metode Bayar:</div>
                            <div class="col text-right">
                                <select name="metode_bayar" class="form-control metode_bayar">
                                    <option value="Tunai">Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                    <option value="Kartu Debit">Kartu Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">Total:</div>
                            <div class="col text-right">
                                <input type="number" value="" name="total" readonly class="form-control total">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">Diterima:</div>
                            <div class="col text-right">
                                <input type="number" value="" name="accept" class="form-control received">
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col">Kembali:</div>
                            <div class="col text-right"> 
                                <input type="number" value="" name="return" readonly class="form-control return">
                            </div>
                        </div>
                    
                        <!-- Cart products will be dynamically added as hidden fields -->
                        <div id="cart-products-hidden"></div> <!-- Hidden container to store products -->
                    
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-danger btn-block" id="cancel-cart">Cancel</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                    
                </div>
                                            
                
            </div>
            <!--/Datatable-->

        </div>
    </div>
    <script>
        document.getElementById('cancel-cart').addEventListener('click', function() {
            // Refresh halaman ketika tombol Cancel diklik
            window.location.reload();
        });
    </script>
    <script>
        document.getElementById('barcode-input').addEventListener('keyup', function(event) {
    let barcode = event.target.value.trim();

    if (barcode.length >= 3) {
        let foundProduct = null;

        @foreach($products as $product)
            if ("{{ $product->kode }}" === barcode) {
                foundProduct = {
                    id: "{{ $product->id }}",
                    name: "{{ $product->nama_produk }}",
                    price: "{{ $product->harga_produk }}",
                    quantity: 1,
                    stock: "{{ $product->detailProduct->sum('stok') }}" // Sum of all stock from the 'detail_product' table
                };
            }
        @endforeach

        if (foundProduct) {
            let cartProducts = document.getElementById('cart-products');
            let cartProductsHidden = document.getElementById('cart-products-hidden');
            let existingRow = document.getElementById(`cart-product-${foundProduct.id}`);

            if (existingRow) {
                // If product is already in the cart, increase the quantity
                let quantityInput = existingRow.querySelector('input');
                let newQuantity = parseInt(quantityInput.value) + 1; // Increase quantity
                quantityInput.value = newQuantity;

                // Update the hidden input field for quantity
                let hiddenInput = document.querySelector(`input[name='products[${foundProduct.id}][quantity]']`);
                hiddenInput.value = newQuantity; // Update hidden input with the new quantity
            } else {
                // Jika produk belum ada di keranjang, tambahkan baris baru
                let row = document.createElement('tr');
                row.setAttribute('id', `cart-product-${foundProduct.id}`);
                row.innerHTML = `
                    <td>${foundProduct.name}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="updateQuantity(${foundProduct.id}, -1)">
                                <i class="fas fa-minus"></i> <!-- Ikon minus -->
                            </button>
                            <input type="number" name="products[${foundProduct.id}][quantity]" value="${foundProduct.quantity}" class="form-control mx-2" onchange="updateHiddenInput(${foundProduct.id})" style="width: 60px;">
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="updateQuantity(${foundProduct.id}, 1)">
                                <i class="fas fa-plus"></i> <!-- Ikon plus -->
                            </button>
                        </div>
                    </td>
                    <td class="text-right">${foundProduct.price}</td>
                    <td><button type="button" class="btn btn-danger btn-sm cancel-btn" data-id="${foundProduct.id}">Cancel</button></td>
                `;
                cartProducts.appendChild(row);

                // Add hidden input for backend processing
                let hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `products[${foundProduct.id}][quantity]`;
                hiddenInput.value = foundProduct.quantity;
                cartProductsHidden.appendChild(hiddenInput);
            }
            document.getElementById('barcode-input').value = ''; // Clear barcode input
            updateTotal(); // Update the total after adding/updating the product
        } else {
            alert('Product with this barcode not found!');
        }
    }
});

// Update quantity manually or by button click
function updateQuantity(productId, change) {
    let quantityInput = document.querySelector(`#cart-product-${productId} input`);
    let hiddenInput = document.querySelector(`input[name='products[${productId}][quantity]']`);
    
    let currentQuantity = parseInt(quantityInput.value) || 1;
    let newQuantity = currentQuantity + change;

    if (newQuantity >= 1) {
        quantityInput.value = newQuantity;
        hiddenInput.value = newQuantity;
        updateTotal(); // Update total setelah perubahan
    }
}

// Update hidden input when quantity is manually changed
function updateHiddenInput(productId) {
    let quantityInput = document.querySelector(`#cart-product-${productId} input`);
    let hiddenInput = document.querySelector(`input[name='products[${productId}][quantity]']`);
    
    let quantityValue = parseInt(quantityInput.value) || 1;
    if (quantityValue < 1) quantityValue = 1;
    
    quantityInput.value = quantityValue; // Perbarui input form
    hiddenInput.value = quantityValue; // Perbarui input hidden
}




        // Update total calculation function
        function updateTotal() {
            let total = 0;
            let rows = document.querySelectorAll('#cart-products tr');
            rows.forEach(function(row) {
                let quantity = row.querySelector('input').value;
                let price = row.querySelector('td:nth-child(3)').innerText.replace('Rp ', '').replace(',', '');
                total += quantity * price;
            });
            document.querySelector('.total').value = total;

            // Update kembali (change based on 'accept' value)
            let received = parseFloat(document.querySelector('.received').value) || 0;
            let kembali = received - total;
            document.querySelector('.return').value = kembali;
        }

        // Add event listener for 'Diterima' (Accept)
        document.querySelector('.received').addEventListener('input', function() {
            updateTotal(); // Recalculate total and kembali when 'Diterima' is changed
        });

        // Cancel cart item function
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('cancel-btn')) {
                let productId = event.target.getAttribute('data-id');
                let row = document.getElementById(`cart-product-${productId}`);
                if (row) {
                    row.remove();
                    updateTotal(); // Update total after removing item
                }
            }
        });

    </script>

@endsection