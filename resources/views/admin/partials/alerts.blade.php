<script>
    // ─────────────────────────────────────────
    // Success message
    // ─────────────────────────────────────────
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

    // ─────────────────────────────────────────
    // Error message
    // ─────────────────────────────────────────
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    @endif

    // ─────────────────────────────────────────
    // Delete confirmation
    // ─────────────────────────────────────────
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
