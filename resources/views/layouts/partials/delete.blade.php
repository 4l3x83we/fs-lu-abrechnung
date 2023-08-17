@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
@endpush

@push('scripts')
    <!-- Deleted Modal -->
    <script type="module">
        document.addEventListener('DOMContentLoaded', function () {
            const swalWithTailwindButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'text-white bg-green-700 hover:bg-green-800 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700',
                    cancelButton: 'text-white bg-red-700 hover:bg-red-800 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700'
                },
                buttonsStyling: false
            });

            @this.on('triggerDelete', id => {
                swalWithTailwindButtons.fire({
                    title: '{{ __("Are you Sure?") }}',
                    text: '{{ __("Data will be deleted") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Delete!") }}',
                    cancelButtonText: '{{ __("Cancel!") }}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('destroy',id)
                        swalWithTailwindButtons.fire(
                            '{{ __("Deleted!") }}',
                            '{{ __("The data has been deleted.") }}',
                            'success'
                        );
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithTailwindButtons.fire(
                            '{{ __("Cancelled") }}',
                            '{{ __("Process aborted!") }}',
                            'error'
                        );
                    }
                });
            });

            @this.on('triggerDeleteProfilPicture', id => {
                swalWithTailwindButtons.fire({
                    title: '{{ __("Are you Sure?") }}',
                    text: '{{ __("Should the picture be deleted?") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Delete!") }}',
                    cancelButtonText: '{{ __("Cancel!") }}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('destroyPicture',id)
                        swalWithTailwindButtons.fire(
                            '{{ __("Deleted!") }}',
                            '{{ __("The data has been deleted.") }}',
                            'success'
                        );
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithTailwindButtons.fire(
                            '{{ __("Cancelled") }}',
                            '{{ __("Process aborted!") }}',
                            'error'
                        );
                    }
                });
            });

            @this.on('triggerDeletePicture', id => {
                swalWithTailwindButtons.fire({
                    title: '{{ __("Are you Sure?") }}',
                    text: '{{ __("Delete all images") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("Delete!") }}',
                    cancelButtonText: '{{ __("Cancel!") }}',
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('destroyAllPicture',id)
                        swalWithTailwindButtons.fire(
                            '{{ __("Deleted!") }}',
                            '{{ __("The data has been deleted.") }}',
                            'success'
                        );
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithTailwindButtons.fire(
                            '{{ __("Cancelled") }}',
                            '{{ __("Process aborted!") }}',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endpush
