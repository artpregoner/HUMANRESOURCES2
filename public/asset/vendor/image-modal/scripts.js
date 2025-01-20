document.addEventListener("DOMContentLoaded", function () {
    // Get modal elements
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImg");
    const closeBtn = document.querySelector(".close-btn");

    // Add click event to all message images
    document.querySelectorAll(".modalThisImage").forEach((img) => {
        img.addEventListener("click", function () {
            modal.classList.add("show");
            modalImg.src = this.src;
        });
    });

    // Close modal when clicking X button
    closeBtn.addEventListener("click", function () {
        modal.classList.remove("show");
    });

    // Close modal when clicking outside the image
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });

    // Close modal when pressing ESC key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && modal.classList.contains("show")) {
            modal.classList.remove("show");
        }
    });
});

// @push('scripts')
//     <script src="{{ asset('asset/vendor/image-modal/scripts.js')}}"></script>
// @endpush


// ipasok mo ito sa specific page na merong view modal
