{{-- SweetAlert must be loaded before this partial --}}
<script>
    {{-- Added to cart --}}
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

    {{-- Already in cart --}}
    @if (session('already_in_cart'))
        Swal.fire({
            icon: 'info',
            title: 'Already in Cart',
            text: 'This product is already in your cart.',
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

    @if (request()->get('login_required'))
        Swal.fire({
            icon: 'warning',
            title: 'Login Required',
            text: 'You must be logged in to add items to your cart.',
            confirmButtonText: 'Login Now',
            showCancelButton: true,
            cancelButtonText: 'Continue Browsing',
            confirmButtonColor: '#00378f',
            cancelButtonColor: '#6c757d',
        }).then((result) => {
            // Always clean URL first
            const url = new URL(window.location.href);
            url.searchParams.delete('login_required');
            history.replaceState(null, '', url.pathname + (url.search || ''));

            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    @endif

    {{-- Success --}}
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

    {{-- Error --}}
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: "{{ session('error') }}"
        });
    @endif

    {{-- Delete confirmation function --}}

    function confirmDelete(formId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
