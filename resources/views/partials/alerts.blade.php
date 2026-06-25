{{-- Make sure SweetAlert2 is loaded once --}}
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>

<script>
    @if (session('added_to_cart'))
        Swal.fire({
            icon: 'success',
            title: 'Added to Cart!',
            text: 'The product has been added to your cart.',
            confirmButtonText: 'View Cart',
            showCancelButton: true,
            cancelButtonText: 'Continue Shopping',
            confirmButtonColor: '#00378f'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('cart.index') }}";
            }
        });
    @endif

    @if (session('already_in_cart'))
        Swal.fire({
            icon: 'info',
            title: 'Already in Cart',
            text: 'This product is already in your cart. Go to cart to increase the quantity.',
            confirmButtonText: 'View Cart',
            showCancelButton: true,
            cancelButtonText: 'OK',
            confirmButtonColor: '#00378f'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('cart.index') }}";
            }
        });
    @endif

    @if (session('guest_add_attempt'))
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof openAuthPopup === 'function') {
                openAuthPopup();
            }
        });
    @endif

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}'
        });
    @endif
</script>
