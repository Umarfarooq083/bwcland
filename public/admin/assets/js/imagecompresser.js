const csrfToken = $('meta[name="csrf-token"]').attr('content');
let selectedFiles = [];
let compressedResults = [];
let $triggerInput = null;
let isMultiple = false;


$('#qualityRange').on('input', function () {
    $('#qualityValue').text($(this).val());
    $('#saveBtn').addClass('d-none');
});


// Detect image input change
$(document).on('change', '.image-input', function (e) {
    const input = $(this);
    $triggerInput = input;
    isMultiple = input.is('[multiple], [data-multiple]');
    $('#saveBtn').addClass('d-none');
    selectedFiles = Array.from(e.target.files);
    if (!selectedFiles.length) return;

    const smallFiles = selectedFiles.filter(file => file.size < 1024 * 100);
    if (smallFiles.length === selectedFiles.length) {
        customAlert('Selected image(s) are already below 100KB. No compression needed.', 'warning');
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
    }

    const $dialog = $('#compressModal');
    const $originalPreview = $('#originalPreview');
    const $compressedPreview = $('#compressedPreview');
    const $comparisonSection = $('#comparisonSection');

    if (isMultiple) {
        $dialog.removeClass('single_modal').addClass('multiple_modal');
    } else {
        $dialog.removeClass('multiple_modal').addClass('single_modal');
    }
    
    $originalPreview.empty();
    $compressedPreview.empty();
    $comparisonSection.addClass('d-none');

    selectedFiles.forEach(file => {
        const reader = new FileReader();
        reader.onload = ev => {
            $originalPreview.append(`
                <div class="image-box">
                    <img src="${ev.target.result}" alt="preview">
                    <div class="image-info flex-column">
                        <div class="w-100">${file.name}</div>
                        <span><b>Size:</b> ${(file.size / 1024).toFixed(2)} KB</span>
                    </div>
                </div>
            `);
        };
        reader.readAsDataURL(file);
    });

    $('#compressModal').modal('show');
    $comparisonSection.removeClass('d-none');
});


// Compress handler
$(document).on('submit', '#compressForm', function (e) {
    e.preventDefault();
    const $compressedPreview = $('#compressedPreview');
    const compressUrl = $('#saveBtn').data('url');
    const quality = $('#qualityRange').val();

    if (!selectedFiles.length) return customAlert('Please select image(s).', 'danger');

    const formData = new FormData();
    formData.append('quality', quality);
    selectedFiles.forEach(file => formData.append(isMultiple ? 'images[]' : 'image', file));

    $.ajax({
        url: compressUrl,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: { 'X-CSRF-TOKEN': csrfToken },
        beforeSend: () => {
            $compressedPreview.html('<div class="text-center w-100">Compressing...</div>');
        },
        success: res => {
            if (!res.success) return customAlert('Compression failed.', 'danger');

            const data = Array.isArray(res.data) ? res.data : [res.data];
            compressedResults = data;
            $compressedPreview.empty();

            data.forEach(item => {
                $compressedPreview.append(`
                    <div class="image-box">
                        <img src="${item.url}" alt="compressed">
                        <div class="image-info">
                            <div class="w-100">${item.original_name}</div>
                            <span><b>Size:</b> ${item.size_after} KB</span>
                            <span><b>Saved:</b> ${item.saved_percent}%</span>
                            <span><b>Quality:</b> ${item.quality}%</span>
                        </div>
                    </div>
                `);
            });

            $('#saveBtn').removeClass('d-none');
        },
        error: xhr => {
            console.error(xhr.responseText);
            customAlert('Error compressing image(s).', 'danger');
        }
    });
});


// Save compressed OR original images to hidden fields
$(document).on('click', '#saveBtn', function () {
    if (!$triggerInput) return customAlert('Please select an image first.',danger);
    $triggerInput.closest('.compressed_form').find('[name$="_choice"]').val('compressed');

    const $mainContainer = $triggerInput.closest('.compressed_form');
    const baseName = $triggerInput.attr('data-name').replace(/\[\]$/, '');
    const inputName = baseName + (isMultiple ? '[]' : '');

    $mainContainer.find(`input[data-temp="true"][data-for="${baseName}"]`).remove();
    if (compressedResults.length) {
        compressedResults.forEach(item => {
            $mainContainer.append(`
                <input type="hidden" name="${inputName}" value="${item.file_name}" data-temp="true" data-for="${baseName}">
            `);
        });
    }

    $('#compressModal').modal('hide');
});


$(document).on('click', '#useOriginalBtn', function () {
    $triggerInput.closest('.compressed_form').find('[name$="_choice"]').val('original');
    $('#compressModal').modal('hide');
});


$('#compressModal').on('hidden.bs.modal', function() {
    $('#originalPreview, #compressedPreview').empty();
    compressedResults = [];
    selectedFiles = [];
    $('#saveBtn').addClass('d-none');
});

