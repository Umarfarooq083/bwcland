/*For Tooltip*/
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

function autoHideAlert(className) {
    function hideAlert() {
      const alertElement = document.querySelector(className);
      if (alertElement) {
        alertElement.style.opacity = 0;
        setTimeout(() => {
          alertElement.style.display = 'none';
        }, 500);
      }
    }
    setTimeout(hideAlert, 3000);
}

autoHideAlert('.custom_alert');

$(document).ready(function () {
    $('[data-tooltip_="tooltip"]').tooltip();
});

function customAlert(msg, type) {
    $('.customAlert').remove();
    $('body').append('<div class="customAlert alert alert-' + type + '">' + msg + '</div>');
    $('.customAlert').fadeOut(5000);
}

function addRemoveClass(ids, classs) {
    $("." + classs).find("li.active").removeClass('active');
    $('#' + ids).parent('li').addClass('active');
    $('#' + ids).parent('li').parent().parent('li').addClass('active');
}

$(document).on('hide.bs.modal', '.modal', function () {
    if (document.activeElement) {
        document.activeElement.blur();
    }
});

function formatMonth(dateString) {
    if (!dateString) return '';
    let d = new Date(dateString);
    if (isNaN(d)) return '';
    
    let year = d.getFullYear();
    let month = String(d.getMonth() + 1).padStart(2, '0');
    return `${year}-${month}`;
}

function formatDate(dateString) {
    if (!dateString) return '';
    return dateString.split('T')[0];
}

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('.single_form');

    forms.forEach(form => {
        $(form).parsley();

        form.addEventListener('submit', function (e) {
            e.preventDefault(); 
            const parsleyForm = $(form).parsley();
            parsleyForm.validate();

            if (parsleyForm.isValid()) {
                const submitBtn = form.querySelector('.submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const spinner = submitBtn.querySelector('.spinner-border');

                btnText.textContent = 'Submitting...';
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
                form.submit();
            } else {
            }
        });
    });
});



$(document).ready(function() {

    $(document).on('click', '[data-target-input]', function () {
        let id = $(this).data('id');
        let target = $(this).data('target-input');
        $(target).val(id);
    });


    var customButtons = [
        ['style', ['style', 'clear']],
        ['font', ['bold', 'italic', 'underline','strikethrough', 'superscript', 'subscript']],
        ['misc', ['undo', 'redo']],
        ['fontsize', ['fontsize','fontsizeunit']],
        ['height', ['height']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'hr']],
        ['view', ['fullscreen', 'codeview','help']],
    ];
    $('.summernote').summernote({
        placeholder: '',
        dialogsInBody: true,
        dialogsFade: true,
        disableDragAndDrop: true,
        tabsize: 2,
        height: 250,
        minHeight: null,
        maxHeight: null,
        focus: true ,
        fontSizeUnits: ['px', 'pt', 'in'],
        fontSizes: ['8', '9', '10', '11', '12', '14', '16','18', '20', '24', '36', '48' , '64', '72'],
        toolbar: customButtons,
    });
    
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Oops, something went wrong!'
        },
        error: {
            'fileExtension': 'Only image files (jpg, jpeg, png, gif, webp) are allowed!'
        }
    });


    $('.dropify').each(function () {
        var $input = $(this);

        $input.dropify({
            messages: {
                default: $input.data('default') || 'Drag and drop a file here or click',
                replace: $input.data('replace') || 'Drag and drop or click to replace',
            }
        });
    });


    $(document).on('change', '.dropify', function () {
        var file = this.files[0];
        var reader = new FileReader();

        var dropifyElement = $(this);

        reader.onload = function(e) {
            var img = new Image();
            img.src = e.target.result;
            if (file.type === 'image/webp') {
                img.onload = function() {
                    dropifyElement.closest('.dropify-wrapper').find('.dropify-render').html('<img src="' + img.src + '" />');
                };
            }
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    $('.dropify').each(function () {
        var defaultFile = $(this).attr('data-default-file');
        if (defaultFile && defaultFile.endsWith('.webp')) {
            var wrapper = $(this).closest('.dropify-wrapper');
            wrapper.find('.dropify-render').html('<img src="' + defaultFile + '" />');
        }
    });

});

// data-compressible & data-compressible-multiple
document.addEventListener('DOMContentLoaded', () => {
    const qualityRange = document.getElementById('quality-range');
    const qualityValue = document.getElementById('quality-value');
    const originalPreview = document.getElementById('original-preview');
    const compressedPreview = document.getElementById('compressed-preview');
    const originalSize = document.getElementById('original-size');
    const compressedSize = document.getElementById('compressed-size');
    const progressBar = document.getElementById('compressionProgress');
    const applyBtn = document.getElementById('apply-compression');
    const modal = $('#compressionModal');

    const multipleModal = $('#multipleCompressionModal');
    const multipleContainer = document.getElementById('multiple-preview-container');
    const applyMultipleBtn = document.getElementById('apply-multiple-compression');

    if (!qualityRange || !qualityValue || !originalPreview || !compressedPreview || !originalSize || !compressedSize || !progressBar || !applyBtn || !modal.length || !multipleModal.length) {
        return;
    }

    let originalFile = null;
    let compressedFile = null;
    let activeInput = null;
    let editingIndex = null;
    let multipleFiles = [];
    let multipleOriginals = [];


    document.querySelectorAll('input[type="file"][data-compressible]').forEach(input => {
        input.addEventListener('change', async function (event) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            const name = input.getAttribute('name');
            const toggle = document.getElementById(`enable-compression-${name}`);
            if (!toggle || !toggle.checked) return;

            const fileSizeKB = file.size / 1024;
            if (fileSizeKB < 100) {
                toggle.checked = false;
                customAlert('Image is already small (<100KB). Compression disabled.','warning');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            originalFile = file;
            activeInput = input;
            qualityValue.textContent = `${qualityRange.value}%`;
            await previewCompressedImage(file);
            modal.modal('show');
        });
    });


    document.querySelectorAll('input[type="file"][data-compressible-multiple]').forEach(input => {
        input.addEventListener('change', async function (event) {
            const files = Array.from(event.target.files);
            const name = input.getAttribute('name').replace(/\[\]$/, '');
            const toggle = document.getElementById(`enable-compression-${name}`);
            if (!toggle || !toggle.checked) return;

            activeInput = input;
            multipleFiles = [];
            multipleOriginals = [];
            multipleContainer.innerHTML = '';
            $('.cstm_loader').show();

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.startsWith('image/')) continue;
            
                const originalKB = file.size / 1024;
            
                let isCompressed = true;
                let compressed = file;
            
                if (originalKB < 100) {
                    isCompressed = false;
                    customAlert(`Image ${file.name} is already small (<100KB). Skipped compression.`, 'warning');
                } else {
                    compressed = await compressImage(file, parseFloat(qualityRange.value) / 100);
                }
            
                multipleFiles.push(compressed);
                multipleOriginals.push(file);
            
                const reader = new FileReader();
                reader.onload = function (e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 text-center mb-3';
            
                    const wrapper = document.createElement('div');
                    wrapper.className = 'img-thumbnail';
            
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid';
                    img.style.cursor = 'pointer';
                    img.style.objectFit = 'contain';
                    img.style.width = '100%';
                    img.style.height = '200px';
                    img.dataset.index = i;
            
                    const compressedKB = (compressed.size / 1024).toFixed(2);
                    const sizeInfo = document.createElement('p');
                    sizeInfo.className = 'image-size-info mt-2 font-weight-bold small mb-0';
            
                    if (isCompressed) {
                        const compressionPercent = ((1 - (compressed.size / file.size)) * 100).toFixed(1);
                        sizeInfo.textContent = `${originalKB.toFixed(2)} KB → ${compressedKB} KB (${compressionPercent}% smaller)`;
                    } else {
                        sizeInfo.textContent = `${originalKB.toFixed(2)} KB (No Compression)`;
                    }
                    
            
                    img.addEventListener('click', () => {
                        if (!isCompressed) {
                            customAlert('This image is already under 100KB and was not compressed.', 'info');
                            return;
                        }
                        editingIndex = i;
                        originalFile = multipleOriginals[i];
                        qualityValue.textContent = `${qualityRange.value}%`;
                        previewCompressedImage(originalFile).then(() => {
                            qualityRange.value = 70;
                            qualityValue.textContent = '70%';
                            modal.modal('show');
                            
                        });
                    });
            
                    wrapper.appendChild(img);
                    wrapper.appendChild(sizeInfo);
                    col.appendChild(wrapper);
                    multipleContainer.appendChild(col);
                };
                reader.readAsDataURL(compressed);
            }
            
            $('.cstm_loader').hide();
            multipleModal.modal('show');
        });
    });

    qualityRange.addEventListener('input', () => {
        qualityValue.textContent = `${qualityRange.value}%`;
        if (originalFile) previewCompressedImage(originalFile);
    });

    applyBtn.addEventListener('click', () => {
        if (editingIndex !== null) {
            multipleFiles[editingIndex] = compressedFile;
    
            const dt = new DataTransfer();
            multipleFiles.forEach(file => dt.items.add(file));
            activeInput.files = dt.files;
    
            const previewCol = multipleContainer.children[editingIndex];
            const wrapper = document.createElement('div');
            wrapper.className = 'img-thumbnail';
    
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid';
                img.style.cursor = 'pointer';
                img.style.objectFit = 'contain';
                img.style.width = '100%';
                img.style.height = '200px';
                img.dataset.index = editingIndex;
    
                const original = multipleOriginals[editingIndex];
                if (!original) {
                    console.warn('Original image missing for index', editingIndex);
                    return;
                }
    
                const originalKB = original.size / 1024;
                const compressedKB = (compressedFile.size / 1024).toFixed(2);
                const compressionPercentage = ((1 - compressedFile.size / original.size) * 100).toFixed(1);
    
                const sizeInfo = document.createElement('p');
                sizeInfo.className = 'image-size-info mt-2 font-weight-bold small mb-0';
                sizeInfo.textContent = `${originalKB.toFixed(2)} KB → ${compressedKB} KB (${compressionPercentage}% smaller)`;
    
                img.addEventListener('click', () => {
                    originalFile = original;
                    editingIndex = parseInt(img.dataset.index);
                    qualityValue.textContent = `${qualityRange.value}%`;
                    previewCompressedImage(originalFile).then(() => {
                        modal.modal('show');
                    });
                });
    
                wrapper.appendChild(img);
                wrapper.appendChild(sizeInfo);
                previewCol.innerHTML = '';
                previewCol.appendChild(wrapper);
                editingIndex = null;
            };
            reader.readAsDataURL(compressedFile);
        } else if (compressedFile && activeInput) {
            const dt = new DataTransfer();
            dt.items.add(compressedFile);
            activeInput.files = dt.files;
        }
    
        modal.modal('hide');
    });
    

    applyMultipleBtn.addEventListener('click', () => {
        if (activeInput) {
            const dt = new DataTransfer();
            multipleFiles.forEach(file => dt.items.add(file));
            activeInput.files = dt.files;
            multipleModal.modal('hide');
        }
    });

    async function previewCompressedImage(file) {
        $('.cstm_loader').show();
        progressBar.style.width = '0%';
        progressBar.textContent = '0%';
        progressBar.classList.add('progress-bar-animated');

        const originalReader = new FileReader();
        originalReader.onload = function (e) {
            originalPreview.src = e.target.result;
            originalSize.textContent = `${(file.size / 1024).toFixed(2)} KB`;
        };
        originalReader.readAsDataURL(file);

        compressedFile = await compressImage(file, parseFloat(qualityRange.value) / 100);
        console.log(parseFloat(qualityRange.value) / 100);

        compressedPreview.src = '';
        compressedSize.textContent = '';
        animateProgressBar(0, 100, progressBar, 1500, () => {
            const reader = new FileReader();
            reader.onload = function (e) {
                compressedPreview.src = e.target.result;
                const compressionPercentage = ((1 - compressedFile.size / file.size) * 100).toFixed(1);
                compressedSize.textContent = `${(compressedFile.size / 1024).toFixed(2)} KB (${compressionPercentage}% smaller)`;
                progressBar.textContent = 'Compression Completed.';
                progressBar.classList.remove('progress-bar-animated');
                $('.cstm_loader').hide();
            };
            reader.readAsDataURL(compressedFile);
        });
    }

    function compressImage(file, quality = 0.7, maxWidth = 1200) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = function (event) {
                const img = new Image();
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    const scale = Math.min(1, maxWidth / img.width);
                    canvas.width = img.width * scale;
                    canvas.height = img.height * scale;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    canvas.toBlob(blob => {
                        const newFile = new File(
                            [blob],
                            file.name.replace(/\.[^/.]+$/, "") + '.webp',
                            { type: 'image/webp', lastModified: Date.now() }
                        );
                        resolve(newFile);
                    }, 'image/webp', quality);
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    function animateProgressBar(start, end, bar, duration, onComplete) {
        let current = start;
        const range = end - start;
        const stepTime = duration / range;

        bar.style.transition = 'none';
        bar.style.width = `${start}%`;
        bar.textContent = `${start}%`;

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                bar.style.transition = `width ${duration}ms linear`;
                bar.style.width = `${end}%`;

                const interval = setInterval(() => {
                    if (current >= end) {
                        clearInterval(interval);
                        if (typeof onComplete === 'function') onComplete();
                    } else {
                        current++;
                        bar.textContent = `${current}%`;
                    }
                }, stepTime);
            });
        });
    }

    $('#compressionModal').on('show.bs.modal', async function () {
        if (!originalFile) return;
        qualityRange.value = 70;
        qualityValue.textContent = '70%';
        await previewCompressedImage(originalFile);
    });
});


// data-auto-compress & data-auto-compress-multiple
function attachAutoCompress(input) {
    const qualityDefault = 0.7; // 70%

    input.addEventListener('change', async function (event) {
        const file = event.target.files[0];
        if (!file || !file.type.startsWith('image/')) return;

        const compressedFile = await compressImage(file, qualityDefault);

        // Replace input file with compressed version
        const dt = new DataTransfer();
        dt.items.add(compressedFile);
        input.files = dt.files;

        // console.log(`Compressed ${file.name}: ${(file.size/1024).toFixed(2)}KB → ${(compressedFile.size/1024).toFixed(2)}KB`);
    });
}


function compressImage(file, quality = 0.7, maxWidth = 1200) {
    return new Promise((resolve) => {
        const reader = new FileReader();
        reader.onload = function (event) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const scale = Math.min(1, maxWidth / img.width);
                canvas.width = img.width * scale;
                canvas.height = img.height * scale;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                canvas.toBlob(blob => {
                    const newFile = new File(
                        [blob],
                        file.name.replace(/\.[^/.]+$/, "") + '.webp',
                        { type: 'image/webp', lastModified: Date.now() }
                    );
                    resolve(newFile);
                }, 'image/webp', quality);
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type="file"][data-auto-compress]').forEach(input => {
        attachAutoCompress(input);
    });
});

// End data-auto-compress & data-auto-compress-multiple

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll('.single_form');

    forms.forEach(form => {
        form.addEventListener('submit', function () {
            const submitBtn = form.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const spinner = submitBtn.querySelector('.spinner-border');

            if (submitBtn && btnText && spinner) {
                btnText.textContent = 'Submitting...';
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
            }
        });
    });
});

