// Xử lý form thêm sản phẩm
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addProductForm');
    const attributeTableBody = document.getElementById('attributeTableBody');
    const addAttributeBtn = document.getElementById('addAttributeBtn');
    const generateVariantsBtn = document.getElementById('generateVariantsBtn');
    const variantList = document.getElementById('variantList');
    const noAttributesWarning = document.getElementById('noAttributesWarning');
    const shortDescriptionCount = document.getElementById('short_description_count');
    const shortDescription = document.getElementById('short_description');
    const mainImagePreview = document.getElementById('mainImagePreview');
    const mainImageInput = document.getElementById('main_image');

    // Xử lý đếm ký tự mô tả ngắn
    shortDescription.addEventListener('input', function() {
        const count = this.value.length;
        shortDescriptionCount.textContent = count;
        if (count > 500) {
            this.value = this.value.substring(0, 500);
            shortDescriptionCount.textContent = 500;
        }
    });

    // Xử lý preview ảnh đại diện
    mainImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                mainImagePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Thêm thuộc tính mới
    addAttributeBtn.addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select class="form-select attribute-select">
                    <option value="">Chọn thuộc tính</option>
                    <option value="1">Màu sắc</option>
                    <option value="2">Kích thước</option>
                    <option value="3">Bộ nhớ</option>
                    <option value="4">RAM</option>
                    <option value="new">+ Thêm thuộc tính mới</option>
                </select>
            </td>
            <td>
                <input type="text" class="form-control attribute-values" placeholder="Nhập các giá trị, phân cách bằng dấu phẩy">
                <div class="mt-2 attribute-value-container"></div>
            </td>
            <td>
                <button type="button" class="btn btn-outline-danger btn-sm remove-attribute">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;
        attributeTableBody.appendChild(newRow);
        initializeAttributeRow(newRow);
    });

    // Khởi tạo xử lý cho một dòng thuộc tính
    function initializeAttributeRow(row) {
        const select = row.querySelector('.attribute-select');
        const valuesInput = row.querySelector('.attribute-values');
        const removeBtn = row.querySelector('.remove-attribute');
        const valueContainer = row.querySelector('.attribute-value-container');

        // Xử lý chọn thuộc tính
        select.addEventListener('change', function() {
            if (this.value === 'new') {
                const attributeName = prompt('Nhập tên thuộc tính mới:');
                if (attributeName) {
                    // Gửi request tạo thuộc tính mới
                    fetch('/admin/attributes', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ attribute_name: attributeName })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const option = new Option(attributeName, data.id);
                        select.insertBefore(option, select.lastElementChild);
                        select.value = data.id;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi tạo thuộc tính mới');
                    });
                }
                this.value = '';
            }
        });

        // Xử lý nhập giá trị thuộc tính
        valuesInput.addEventListener('input', function() {
            const values = this.value.split(',').map(v => v.trim()).filter(v => v);
            valueContainer.innerHTML = values.map(value => `
                <span class="badge bg-primary me-2 mb-2">
                    ${value}
                    <button type="button" class="btn-close btn-close-white ms-1" data-value="${value}"></button>
                </span>
            `).join('');

            // Xử lý xóa giá trị
            valueContainer.querySelectorAll('.btn-close').forEach(btn => {
                btn.addEventListener('click', function() {
                    const valueToRemove = this.dataset.value;
                    const currentValues = valuesInput.value.split(',').map(v => v.trim());
                    valuesInput.value = currentValues.filter(v => v !== valueToRemove).join(', ');
                    this.parentElement.remove();
                });
            });
        });

        // Xử lý xóa dòng thuộc tính
        removeBtn.addEventListener('click', function() {
            row.remove();
            updateVariantGenerator();
        });
    }

    // Khởi tạo các dòng thuộc tính hiện có
    attributeTableBody.querySelectorAll('tr').forEach(initializeAttributeRow);

    // Cập nhật trạng thái nút tạo biến thể
    function updateVariantGenerator() {
        const hasAttributes = attributeTableBody.querySelectorAll('tr').length > 0;
        generateVariantsBtn.disabled = !hasAttributes;
        noAttributesWarning.classList.toggle('d-none', hasAttributes);
        variantList.classList.toggle('d-none', true);
    }

    // Xử lý tạo biến thể
    generateVariantsBtn.addEventListener('click', function() {
        const attributes = [];
        attributeTableBody.querySelectorAll('tr').forEach(row => {
            const select = row.querySelector('.attribute-select');
            const valuesInput = row.querySelector('.attribute-values');
            if (select.value && valuesInput.value) {
                attributes.push({
                    name: select.options[select.selectedIndex].text,
                    values: valuesInput.value.split(',').map(v => v.trim()).filter(v => v)
                });
            }
        });

        if (attributes.length === 0) {
            alert('Vui lòng thêm ít nhất một thuộc tính và giá trị');
            return;
        }

        // Tạo tất cả các tổ hợp có thể
        const combinations = generateCombinations(attributes);
        
        // Hiển thị các biến thể
        variantList.innerHTML = combinations.map((combo, index) => `
            <div class="variant-item mb-3 p-3 border rounded">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Biến thể #${index + 1}</h6>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-variant">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" name="variants[${index}][sku]" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Giá thêm</label>
                        <input type="number" class="form-control" name="variants[${index}][additional_price]" value="0" min="0" step="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="variants[${index}][stock_quantity]" value="0" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ảnh biến thể</label>
                        <input type="file" class="form-control" name="variants[${index}][image]" accept="image/*">
                    </div>
                    ${Object.entries(combo).map(([attr, value]) => `
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">${attr}:</span>
                                <span class="badge bg-primary">${value}</span>
                            </div>
                            <input type="hidden" name="variants[${index}][attributes][${attr}]" value="${value}">
                        </div>
                    `).join('')}
                </div>
            </div>
        `).join('');

        variantList.classList.remove('d-none');

        // Xử lý xóa biến thể
        variantList.querySelectorAll('.remove-variant').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.variant-item').remove();
            });
        });
    });

    // Hàm tạo tổ hợp các giá trị thuộc tính
    function generateCombinations(attributes) {
        if (attributes.length === 0) return [];
        if (attributes.length === 1) {
            return attributes[0].values.map(value => ({
                [attributes[0].name]: value
            }));
        }

        const first = attributes[0];
        const rest = attributes.slice(1);
        const restCombinations = generateCombinations(rest);
        const combinations = [];

        first.values.forEach(value => {
            restCombinations.forEach(combo => {
                combinations.push({
                    [first.name]: value,
                    ...combo
                });
            });
        });

        return combinations;
    }

    // Xử lý submit form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Kiểm tra các trường bắt buộc
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('Vui lòng điền đầy đủ thông tin bắt buộc');
            return;
        }

        // Tạo FormData để gửi file
        const formData = new FormData(form);
        
        // Gửi request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Có lỗi xảy ra khi tạo sản phẩm');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tạo sản phẩm');
        });
    });
}); 