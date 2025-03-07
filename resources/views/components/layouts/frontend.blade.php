<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Standart Brick</title>
    <!-- Stylesheets -->
    <link href="/frontend/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="/frontend/assets/css/style.css" rel="stylesheet" />
    <link href="/frontend/assets/css/responsive.css" rel="stylesheet" />

    <link
        href="/frontend/assets/css/css2?family=Inter:wght@100;300;400;500;600;700;800;900&family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet" />

    <!-- Color Switcher Mockup -->
    <link href="/frontend/assets/css/color-switcher-design.css" rel="stylesheet" />

    <!-- Color Themes -->
    <link id="theme-color-file" href="/frontend/assets/css/color-themes/default-color.css" rel="stylesheet" />

    <link rel="shortcut icon" href="/frontend/assets/images/favicon.png" type="image/x-icon" />
    <link rel="icon" href="/frontend/assets/images/favicon.png" type="image/x-icon" />

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!--[if lt IE 9
      ]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]>
      <script src="js/respond.js"></script><![endif]-->
    <style>
/* Dropdown Container */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Toggle Button */
#userDropdown {
  cursor: pointer;
  color: #fff;
  padding: 10px 15px;
  font-size: 16px;
  user-select: none;
  transition: background-color 0.3s ease;
}

#userDropdown:hover {
  background-color: rgba(255, 255, 255, 0.1);
}

/* Dropdown Menu */
.dropdown-menu {
  display: none;
  position: absolute;
  right: 0;
  background-color: #fff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  min-width: 200px;
  z-index: 9999;
  border-radius: 8px;
  padding: 0;
  margin-top: 5px;
  opacity: 0;
  transform: translateY(10px);
  transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Show dropdown menu on hover */
.dropdown:hover .dropdown-menu {
  display: block;
  opacity: 1;
  transform: translateY(0);
}

/* Dropdown Menu Items */
.dropdown-menu li {
  list-style: none;
}

.dropdown-menu a {
  display: block;
  padding: 10px 15px;
  color: #333;
  text-decoration: none;
  transition: background-color 0.3s ease;
  font-size: 14px;
}

.dropdown-menu a:hover {
  background-color: #f8f8f8;
}


/* Social Box */
.social-box {
    display: flex;
}

.social-box li {
    margin-right: 10px;
}

    </style>
</head>

<body class="hidden-bar-wrapper">
    <div class="page-wrapper">
        <!-- Preloader -->
        {{-- <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close">x</div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="B" class="letters-loading"> B </span>
                            <span data-text-preloader="R" class="letters-loading"> R </span>
                            <span data-text-preloader="I" class="letters-loading"> I </span>
                            <span data-text-preloader="C" class="letters-loading"> C </span>
                            <span data-text-preloader="K" class="letters-loading"> K </span>
                            <span data-text-preloader="S" class="letters-loading"> S </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Preloader End -->

        <x-frontend-header></x-frontend-header>

        <x-frontend-sidebar></x-frontend-sidebar>

        {{ $slot }}

        <x-frontend-footer></x-frontend-footer>
    </div>
    <!-- End PageWrapper -->

    <!-- Search Popup -->
    <div class="search-popup">
        <button class="close-search style-two">
            <span class="flaticon-cancel-1"></span>
        </button>
        <button class="close-search">
            <span class="flaticon-up-arrow"></span>
        </button>
        <form method="post" action="blog.html">
            <div class="form-group">
                <input type="search" name="search-field" value="" placeholder="Search Here" required="" />
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Header Search -->



    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="fa fa-arrow-up"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the user dropdown and menu
            var userDropdown = document.getElementById('userDropdown');
            var dropdownMenu = document.getElementById('dropdownMenu');

            Toggle the dropdown menu when the user name is clicked
            userDropdown.addEventListener('click', function() {
                dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
            });

            // Close the dropdown menu if clicked outside
            document.addEventListener('click', function(event) {
                if (!userDropdown.contains(event.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Optionally include Toastify for notifications -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- Include Toastify JS and CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.add-to-cart').on('click', function(e){
        e.preventDefault();
        var productId = $(this).data('product-id');
        // Get the quantity value from the spinner input (adjust the selector as needed)
        var quantity = $('#productQuantity').val();

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity,
            },
            success: function(response) {
                // Update the cart widget's HTML and total count
                $('#cartPanel').html(response.cart_html);
                $('#cartCount').text(response.total_count);

                // Display success toast at the top right corner
                Toastify({
                    text: response.message,
                    duration: 3000,
                    gravity: "top",       // Display at the top
                    position: "right",    // Display on the right side
                    backgroundColor: "#28a745",
                }).showToast();
            },
            error: function(xhr) {
                Toastify({
                    text: xhr.responseJSON.message || "Error adding product to cart.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#dc3545",
                }).showToast();
            }
        });
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<!-- jQuery and Toastify -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
$(document).ready(function() {

// Function to recalculate each row's subtotal and overall totals
function updateCartTotals() {
    let total = 0;
    $('#cartTable tbody tr').each(function() {
        // Get the price text from the price cell and remove non-numeric characters
        let priceText = $(this).find('.price').text().trim();
        let price = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;
        
        // Get the quantity from the input field
        let qty = parseInt($(this).find('.quantity-input').val()) || 0;
        
        // Calculate the row subtotal and update its cell
        let rowTotal = price * qty;
        $(this).find('.sub-total').text(rowTotal.toFixed(2) + " So'm");
        
        total += rowTotal;
    });
    // Update overall totals
    $('#cartSubtotal').text(total.toFixed(2) + " So'm");
    $('#orderTotal').text(total.toFixed(2) + " So'm");
}

// Function to send AJAX request for updating all cart items at once
$('#updateCart').on('click', function(e) {
    e.preventDefault();
    let quantities = {};
    // Collect quantities for each product from the table
    $('#cartTable tbody tr').each(function() {
        let productId = $(this).data('product-id');
        let qty = $(this).find('.quantity-input').val();
        if(productId) {
            quantities[productId] = qty;
        }
    });
    $.ajax({
        url: "{{ route('cart.update') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            quantities: quantities,
        },
        success: function(response) {
            // Update the cart panel with new HTML (if provided)
            if(response.cart_html) {
                $('#cartPanel').html(response.cart_html);
            }
            // Update overall cart count and totals
            $('#cartCount').text(response.total_count);
            $('#cartSubtotal').text(response.subtotal + " So'm");
            $('#orderTotal').text(response.order_total + " So'm");
            Toastify({
                text: response.message,
                duration: 3000,
                gravity: "top",
                position: "right",
                style: { background: "#28a745" }
            }).showToast();
        },
        error: function(xhr) {
            Toastify({
                text: xhr.responseJSON.message || "Error updating cart.",
                duration: 3000,
                gravity: "top",
                position: "right",
                style: { background: "#dc3545" }
            }).showToast();
        }
    });
});

// Plus button handler
$(document).on('click', '.qty-plus', function(e) {
    e.preventDefault();
    let productId = $(this).data('product-id');
    let input = $('.quantity-input[data-product-id="' + productId + '"]');
    let currentQty = parseInt(input.val()) || 0;
    let newQty = currentQty + 1;
    input.val(newQty);
    updateCartTotals();
    // Optionally update the server for a single item
    updateCartItem(productId, newQty);
});

// Minus button handler
$(document).on('click', '.qty-minus', function(e) {
    e.preventDefault();
    let productId = $(this).data('product-id');
    let input = $('.quantity-input[data-product-id="' + productId + '"]');
    let currentQty = parseInt(input.val()) || 0;
    let newQty = currentQty - 1;
    if (newQty < 1) { newQty = 0; }
    input.val(newQty);
    updateCartTotals();
    // Optionally update the server for a single item
    updateCartItem(productId, newQty);
});
$(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        let productId = $(this).data('product-id');
        $.ajax({
            url: "{{ route('cart.remove') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
            },
            success: function(response) {
                // Remove the corresponding row from the DOM
                $('#cartTable tbody tr[data-product-id="' + productId + '"]').remove();

                // Update the totals on the page
                updateCartTotals();

                // Optionally update the cart count and show a notification
                $('#cartCount').text(response.total_count);
                Toastify({
                    text: response.message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#28a745"
                    }
                }).showToast();
            },
            error: function(xhr) {
                Toastify({
                    text: xhr.responseJSON.message || "Error removing item.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "#dc3545"
                    }
                }).showToast();
            }
        });
    });

// Function to update a single cart item on the server (optional)
function updateCartItem(productId, newQty) {
    $.ajax({
        url: "{{ route('cart.update.single') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            product_id: productId,
            quantity: newQty,
        },
        success: function(response) {
            $('#cartCount').text(response.total_count);
            Toastify({
                text: response.message,
                duration: 3000,
                gravity: "top",
                position: "right",
                style: { background: "#28a745" }
            }).showToast();
        },
        error: function(xhr) {
            Toastify({
                text: xhr.responseJSON.message || "Error updating cart.",
                duration: 3000,
                gravity: "top",
                position: "right",
                style: { background: "#dc3545" }
            }).showToast();
        }
    });
}

// Initial totals calculation on page load
updateCartTotals();
});
</script>


</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#viewCartButton').on('click', function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ route('cart.view') }}",
            method: 'GET',
            success: function(response) {
                // For example, load the returned HTML into a modal or a container:
                $('#cartContainer').html(response);
                // Optionally, display the container as a modal
                $('#cartContainer').modal('show');
            },
            error: function(xhr) {
                console.error('Error loading cart.');
            }
        });
    });
});
</script>




    <script src="/frontend/assets/js/jquery.js"></script>
    <script src="/frontend/assets/js/popper.min.js"></script>
    <script src="/frontend/assets/js/bootstrap.min.js"></script>
    <script src="/frontend/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/frontend/assets/js/jquery.fancybox.js"></script>
    <script src="/frontend/assets/js/appear.js"></script>
    <script src="/frontend/assets/js/parallax.min.js"></script>
    <script src="/frontend/assets/js/tilt.jquery.min.js"></script>
    <script src="/frontend/assets/js/jquery.paroller.min.js"></script>
    <script src="/frontend/assets/js/owl.js"></script>
    <script src="/frontend/assets/js/wow.js"></script>
    <script src="/frontend/assets/js/mixitup.js"></script>
    <script src="/frontend/assets/js/validate.js"></script>
    <script src="/frontend/assets/js/nav-tool.js"></script>
    <script src="/frontend/assets/js/jquery-ui.js"></script>
    <script src="/frontend/assets/js/script.js"></script>
    <script src="/frontend/assets/js/color-settings.js"></script>
</body>

</html>
