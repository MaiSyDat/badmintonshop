document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from category name
    const categoryNameInput = document.getElementById('category_name');
    const categorySlugInput = document.getElementById('category_slug');
    
    categoryNameInput.addEventListener('input', function() {
        if (!categorySlugInput.value) {
            categorySlugInput.value = generateSlug(this.value);
        }
    });

    // Image preview
    const imageInput = document.getElementById('category_image');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewImg = imagePreview.querySelector('img');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreviewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form validation
    const form = document.getElementById('createCategoryForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset previous validation
        const invalidInputs = form.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
        
        let isValid = true;
        
        // Validate required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            }
        });
        
        // Validate file size
        if (imageInput.files && imageInput.files[0]) {
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (imageInput.files[0].size > maxSize) {
                imageInput.classList.add('is-invalid');
                const feedback = imageInput.nextElementSibling.nextElementSibling;
                feedback.textContent = 'Kích thước file không được vượt quá 2MB';
                isValid = false;
            }
        }
        
        if (isValid) {
            form.submit();
        }
    });
});

// Helper function to generate slug
function generateSlug(text) {
    return text
        .toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[đĐ]/g, 'd')
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();
} 