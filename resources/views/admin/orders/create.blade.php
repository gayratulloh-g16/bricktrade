<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Order</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Global Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Order</h5>
                            <form action="{{ route('admin.orders.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-4">
                                    <label for="user_id" class="form-label">User</label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="driver_id" class="form-label">Driver</label>
                                    <select name="driver_id" id="driver_id" class="form-select" required>
                                        <option value="">Select Driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->first_name }} {{ $driver->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" class="form-control" id="order_date" name="order_date" value="{{ old('order_date') }}" required>
                                    @error('order_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="total_amount" class="form-label">Total Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="{{ old('total_amount') }}" readonly>
                                    @error('total_amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="order_status" class="form-label">Order Status</label>
                                    <select name="order_status" id="order_status" class="form-select" required>
                                        <option value="">Select Order Status</option>
                                        <option value="new" {{ old('order_status') == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="processing" {{ old('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ old('order_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('order_status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="shipping_address" class="form-label">Shipping Address</label>
                                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required>
                                    @error('shipping_address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Order Items Section -->
                                <div class="col-12">
                                    <h6>Order Items</h6>
                                    <table class="table" id="order-items-table">
                                        <thead>
                                            <tr>
                                                <th>Brick</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Subtotal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- New order items will be appended here -->
                                        </tbody>
                                    </table>
                                    <button type="button" id="add-order-item" class="btn btn-secondary btn-sm">Add Order Item</button>
                                    @error('order_items')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Order</button>
                                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
    
    <!-- Pass Brick Prices to JavaScript -->
    <script>
        const brickPrices = {
            @foreach($bricks as $brick)
                "{{ $brick->id }}": {{ $brick->price }},
            @endforeach
        };
    </script>
    
    <script>
        // Function to recalculate the subtotal for each row and overall total
        function recalcTotal() {
            let total = 0;
            document.querySelectorAll('#order-items-table tbody tr').forEach(function(row) {
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
                const subtotalElem = row.querySelector('.subtotal-display');
                const hiddenSubtotal = row.querySelector('.subtotal-input');
                const subtotal = quantity * unitPrice;
                subtotalElem.textContent = subtotal.toFixed(2);
                hiddenSubtotal.value = subtotal.toFixed(2);
                total += subtotal;
            });
            document.getElementById('total_amount').value = total.toFixed(2);
        }
    
        // Attach events to a given row's inputs for recalculation
        function attachEvents(row) {
            row.querySelector('.brick-select').addEventListener('change', function() {
                const brickId = this.value;
                const rowEl = this.closest('tr');
                const unitPriceInput = rowEl.querySelector('.unit-price');
                // Automatically set unit price if brick is selected
                if(brickPrices[brickId] !== undefined) {
                    unitPriceInput.value = brickPrices[brickId];
                } else {
                    unitPriceInput.value = '';
                }
                recalcTotal();
            });
            row.querySelector('.quantity').addEventListener('input', recalcTotal);
            row.querySelector('.unit-price').addEventListener('input', recalcTotal);
        }
    
        // Event listener for adding a new order item row
        document.getElementById('add-order-item').addEventListener('click', function(){
            const tbody = document.querySelector('#order-items-table tbody');
            const index = tbody.children.length; // Use current row count as index
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select name="order_items[${index}][brick_id]" class="form-select brick-select" required>
                        <option value="">Select Brick</option>
                        @foreach($bricks as $brick)
                            <option value="{{ $brick->id }}">{{ $brick->name_en }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="order_items[${index}][quantity]" class="form-control quantity" value="1" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="order_items[${index}][unit_price]" class="form-control unit-price" required>
                </td>
                <td>
                    <span class="subtotal-display">0.00</span>
                    <input type="hidden" name="order_items[${index}][subtotal]" class="subtotal-input" value="0.00">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-order-item">Remove</button>
                </td>
            `;
            tbody.appendChild(newRow);
            attachEvents(newRow);
            recalcTotal();
        });
    
        // Remove order item row on click
        document.addEventListener('click', function(e) {
            if(e.target && e.target.classList.contains('remove-order-item')) {
                e.target.closest('tr').remove();
                recalcTotal();
            }
        });
    
        // Attach events to any existing rows on page load (if any)
        document.querySelectorAll('#order-items-table tbody tr').forEach(function(row) {
            attachEvents(row);
        });
    
        // Initial recalculation in case there are any pre-loaded rows
        recalcTotal();
    </script>
</x-layouts.admin>
