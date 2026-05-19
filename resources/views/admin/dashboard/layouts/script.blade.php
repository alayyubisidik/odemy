<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    function confirmLogout(event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout!"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }

    function previewImage(inputSelector, previewSelector) {
        const input = document.querySelector(inputSelector);
        const preview = document.querySelector(previewSelector);

        if (!input || !preview) return;

        input.addEventListener('change', function() {
            const file = this.files[0];

            if (!file) {
                preview.src = "";
                preview.style.display = "none";
                return;
            }

            if (!file.type.startsWith("image/")) {
                alert("Please select an image file.");
                input.value = "";
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(file);
        });
    }

    // init
    document.addEventListener("DOMContentLoaded", function() {
        previewImage("#image-upload-one", "#image-preview-one");
        previewImage("#image-upload-two", "#image-preview-two");
        previewImage("#image-upload-three", "#image-preview-three");
        previewImage("#image-upload-four", "#image-preview-four");
        previewImage("#image-upload-five", "#image-preview-five");
    });

    $(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();

            const form = $(this).closest('form'); // closest form to the button

            Swal.fire({
                title: 'Are you sure?',
                text: 'This data will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit the form if confirmed
                }
            });
        });

        // slug auto-generate
        $('#name').on('input', function() {
            $('#slug').val(slugify($(this).val()));
        });

        // slug auto-generate
        $('#title').on('input', function() {
            $('#slug').val(slugify($(this).val()));
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^a-z0-9\-\.]/g, '') // Remove all non-alphanumeric chars except hyphens and dots
                .replace(/\-\-+/g, '-') // Replace multiple hyphens with a single one
                .replace(/^\-+|\-$/g, ''); // Trim hyphens from start and end
        }
    })
</script>
