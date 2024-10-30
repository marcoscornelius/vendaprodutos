@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="container mb-4">
    <h2>Sell products</h2>    
    <div class="form-group">
        <input type="text" id="productFilter" class="form-control" placeholder="Filter products by name">
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.sale') }}" method="POST" id="saleForm">
        @csrf
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity </th>
                </tr>
            </thead>

            <tbody id="productList">
                @foreach($products as $product)
                    <tr class="product-item" data-name="{{ strtolower($product->name) }}">

                        <td>{{ $product->name }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>
                            <input type="number" name="products[{{ $product->id }}]" id="quantity_{{ $product->id }}" class="form-control quantity" min="0" max="999" value="0">
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <p id="noProductsMessage"  style="display: none;">No products found</p>

        <div class="pagination d-flex justify-content-center align-items-center">
            <button type="button" id="prevPage" class="btn-secondary btn">Preview</button>
            <span id="pageInfo" class="">
                Page 1
            </span>
            <button id="nextPage" type="button" class="btn btn-secondary">Next</button>
        </div>

        <div class="form-group">
            <label for="client_id">Client (optional) </label>
            <select  id="client_id" name="client_id" class="form-control">
                <option value="">Do not bind client</option>
                @foreach($clients as $client)
                    <option  value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="num_installments">Number of installments</label>
            <select id="num_installments" class="form-control"  name="num_installments">
                <option value="1" selected>1x</option>
                <option value="2">2x</option>
                <option value="3">3x</option>
                <option value="4">4x</option>
                <option value="5">5x</option>
                <option value="6">6x</option>
            </select>
        </div>
        <div id="installment-fields"></div>

        <h4 id="totalPrice">Total price: R$ 0,00</h4>

        <button type="submit" class=" btn-primary btn">Complete Sale</button>
    </form>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            const products = @json($products);
            const itemsPerPage = 7;
            let currentPage = 1;
            let quantities = {};

            function renderProducts(page) {
                const start = (page - 1) * itemsPerPage;

                const end = start + itemsPerPage;
                
                const filteredProducts = products.filter(product => {
                    const search = $('#productFilter').val().toLowerCase();
                    return product.name.toLowerCase().includes(search);
                });
                const paginatedProducts = filteredProducts.slice(start, end);

                $('#productList').html('');
                paginatedProducts.forEach(product => {
                    const quantity = quantities[product.id] || 0;

                    $('#productList').append(`
                        <tr class="product-item" data-name="${product.name.toLowerCase()}">
                            <td>${product.name}</td>
                            <td>R$ ${parseFloat(product.price).toFixed(2).replace('.', ',')}</td>
                            <td>
                                <input type="number" name="products[${product.id}]" id="quantity_${product.id}" class="form-control quantity" min="0" max="999" value="${quantity}">
                            </td>
                        </tr>
                    `);
                });

                $('#noProductsMessage').toggle(filteredProducts.length === 0);
                $('#pageInfo').text(`Page ${currentPage} of ${Math.ceil(filteredProducts.length / itemsPerPage)}`);

                $('#prevPage').toggle(currentPage > 1);
                $('#nextPage').toggle(currentPage < Math.ceil(filteredProducts.length / itemsPerPage));
            }

            function calculateTotal() {
                let total = 0;
                for (let productId in quantities) {
                    const quantity = quantities[productId];
                    const product = products.find(product => product.id == productId);
                    if (product) {
                        total += product.price * quantity;
                    }
                }
                //console.log(quantities);
                $('#totalPrice').text(`Total: R$ ${total.toFixed(2).replace('.', ',')}`);
                return total;
            }

            $('#productFilter').on('input', function() {
                currentPage = 1; 
                renderProducts(currentPage);
            });

            $('#prevPage').on('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderProducts(currentPage);
                }
            });

            $('#nextPage').on('click', function() {
                const filteredProducts = products.filter(product => {
                    const search = $('#productFilter').val().toLowerCase();
                    return product.name.toLowerCase().includes(search);
                });
                if (currentPage < Math.ceil(filteredProducts.length / itemsPerPage)) {

                    currentPage++;
                    renderProducts(currentPage);
                }
            });

            function renderInstallmentFields(numInstallments) {

                $('#installment-fields').html('');
                for (let i = 1; i <= numInstallments; i++) {
                    $('#installment-fields').append(`
                        <div class="form-group">
                            <h5>Installment ${i}</h5>

                            <label for="installment_value_${i}">Installment Amount:</label>
                            <input type="number" min="0" step="0.01" name="installment_values[]" id="installment_value_${i}" class="form-control installment-value" required>
                            
                            <label for="due_date_${i}">Due Date:</label>
                            <input type="date" name="due_dates[]" id="due_date_${i}" class="form-control due-date" required>

                            <label for="payment_method_${i}">Payment Method:</label>
                            <select name="payment_methods[]" id="payment_method_${i}" class="form-control">
                                <option value="card">Card</option>
                                <option value="pix">Pix</option>
                                <option value="boleto">Boleto</option>
                            </select>
                        </div>
                    `);
                }
            }

            $('#num_installments').on('change', function() {
                const numInstallments = parseInt($(this).val());
                renderInstallmentFields(numInstallments);
            });


            renderInstallmentFields(1);

            $(document).on('input', '.quantity', function() {
                const productId = $(this).attr('name').split('[')[1].split(']')[0];
                const quantity = parseInt($(this).val()) || 0;

                quantities[productId] = quantity;
                calculateTotal(); 
                //console.log(quantities);

            });

            $('#saleForm').on('submit', function(event) {
                event.preventDefault();
                const total = calculateTotal();
                let installmentTotal = 0;
                let hasProductSelected = false;

                let productsToSend = {};
                for (let productId in quantities) {
                    if (quantities[productId] > 0) {
                        productsToSend[productId] = quantities[productId];
                        hasProductSelected = true; 
                    }
                }

                if (!hasProductSelected) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'You must select at least one product.',
                    });

                    return;
                }

                $(this).append($('<input>').attr('type', 'hidden').attr('name', 'products').val(JSON.stringify(productsToSend)));

              
                $('.installment-value').each(function() {
                    const installmentValue = parseFloat($(this).val()) || 0;
                    installmentTotal += installmentValue;
                });

                if (Math.abs(installmentTotal - total) > 0.01) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'The sum of the installments must be equal to the total value.',
                    });
                } else {

                    event.target.submit();
                }
            });
        
            renderProducts(currentPage);
            calculateTotal(); 
        });
    </script>
@endsection
@endsection
