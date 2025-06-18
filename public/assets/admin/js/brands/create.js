document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from brand name
    const brandNameInput = document.getElementById('brand_name');
    const brandSlugInput = document.getElementById('brand_slug');
    
    brandNameInput.addEventListener('input', function() {
        if (!brandSlugInput.value) {
            brandSlugInput.value = generateSlug(this.value);
        }
    });

    // Logo preview
    const logoInput = document.getElementById('brand_logo');
    const logoPreview = document.getElementById('logoPreview');
    const logoPreviewImg = logoPreview.querySelector('img');

    logoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                logoPreviewImg.src = e.target.result;
                logoPreview.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Form validation
    const form = document.getElementById('createBrandForm');
    
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
        if (logoInput.files && logoInput.files[0]) {
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (logoInput.files[0].size > maxSize) {
                logoInput.classList.add('is-invalid');
                const feedback = logoInput.nextElementSibling.nextElementSibling;
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