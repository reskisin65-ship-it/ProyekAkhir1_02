{{-- resources/views/masyarakat/surat/partials/berkas-pendukung-upload.blade.php --}}
@php
    $existingBerkas = $existingBerkas ?? [];
    $maxTotalBytes = 10485760; // 10 MB
@endphp

<style>
    .berkas-upload-wrap { margin-top: 0.5rem; }
    .berkas-existing-list { display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem; }
    .berkas-existing-item,
    .berkas-file-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }
    .berkas-existing-item span,
    .berkas-file-name {
        flex: 1;
        font-size: 0.85rem;
        color: #334155;
        word-break: break-all;
    }
    .berkas-file-size {
        font-size: 0.75rem;
        color: #64748b;
        white-space: nowrap;
    }
    .berkas-btn-remove,
    .berkas-btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .berkas-btn-remove {
        width: 32px;
        height: 32px;
        background: #fee2e2;
        color: #dc2626;
        flex-shrink: 0;
    }
    .berkas-btn-remove:hover { background: #fecaca; }
    .berkas-btn-add {
        padding: 0.6rem 1.2rem;
        background: #ecfdf5;
        color: #059669;
        border: 1px dashed #6ee7b7;
        margin-top: 0.5rem;
    }
    .berkas-btn-add:hover:not(:disabled) { background: #d1fae5; }
    .berkas-btn-add:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #f1f5f9;
        color: #94a3b8;
        border-color: #e2e8f0;
    }
    .berkas-progress-wrap {
        margin-top: 1rem;
        padding: 0.75rem 1rem;
        background: #f1f5f9;
        border-radius: 12px;
    }
    .berkas-progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 0.4rem;
    }
    .berkas-progress-bar {
        height: 8px;
        background: #e2e8f0;
        border-radius: 99px;
        overflow: hidden;
    }
    .berkas-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #10b981, #059669);
        border-radius: 99px;
        transition: width 0.3s;
    }
    .berkas-progress-fill.warning { background: linear-gradient(90deg, #f59e0b, #d97706); }
    .berkas-progress-fill.full { background: linear-gradient(90deg, #ef4444, #dc2626); }
    .berkas-limit-msg {
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 0.5rem;
        display: none;
    }
    .berkas-file-input { flex: 1; font-size: 0.85rem; }
</style>

<div class="berkas-upload-wrap" id="berkasUploadWrap"
     data-max-bytes="{{ $maxTotalBytes }}"
     data-existing='@json($existingBerkas)'>

    <div id="berkasExistingList" class="berkas-existing-list"></div>
    <div id="berkasNewList"></div>

    <button type="button" id="berkasBtnAdd" class="berkas-btn-add">
        <i class="fa-solid fa-plus"></i> Tambah Berkas
    </button>

    <div class="berkas-progress-wrap">
        <div class="berkas-progress-label">
            <span>Penggunaan ruang</span>
            <span id="berkasSizeLabel">0 MB / 10 MB</span>
        </div>
        <div class="berkas-progress-bar">
            <div id="berkasProgressFill" class="berkas-progress-fill" style="width: 0%"></div>
        </div>
        <p id="berkasLimitMsg" class="berkas-limit-msg">
            <i class="fa-solid fa-circle-exclamation"></i> Batas 10 MB telah tercapai. Hapus berkas untuk menambah file lain.
        </p>
    </div>

    <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, PDF. Total maksimal 10 MB untuk semua berkas. Klik + untuk menambah file.</p>
</div>

<script>
(function () {
    const wrap = document.getElementById('berkasUploadWrap');
    if (!wrap) return;

    const MAX_BYTES = parseInt(wrap.dataset.maxBytes, 10);
    const existingList = document.getElementById('berkasExistingList');
    const newList = document.getElementById('berkasNewList');
    const btnAdd = document.getElementById('berkasBtnAdd');
    const sizeLabel = document.getElementById('berkasSizeLabel');
    const progressFill = document.getElementById('berkasProgressFill');
    const limitMsg = document.getElementById('berkasLimitMsg');

    let existingFiles = JSON.parse(wrap.dataset.existing || '[]');
    let newFileCounter = 0;

    function formatSize(bytes) {
        if (bytes < 1024) return bytes + ' B';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(2) + ' MB';
    }

    function getNewFilesSize() {
        let total = 0;
        newList.querySelectorAll('input[type="file"]').forEach(function (input) {
            if (input.files && input.files[0]) {
                total += input.files[0].size;
            }
        });
        return total;
    }

    function getExistingSize() {
        return existingFiles.reduce(function (sum, f) { return sum + (f.size || 0); }, 0);
    }

    function getTotalSize() {
        return getExistingSize() + getNewFilesSize();
    }

    function updateUI() {
        const total = getTotalSize();
        const pct = Math.min(100, (total / MAX_BYTES) * 100);
        const totalMb = (total / 1048576).toFixed(2);
        const maxMb = (MAX_BYTES / 1048576).toFixed(0);

        sizeLabel.textContent = totalMb + ' MB / ' + maxMb + ' MB';
        progressFill.style.width = pct + '%';
        progressFill.classList.remove('warning', 'full');

        if (pct >= 100) {
            progressFill.classList.add('full');
            btnAdd.disabled = true;
            limitMsg.style.display = 'block';
        } else if (pct >= 80) {
            progressFill.classList.add('warning');
            btnAdd.disabled = false;
            limitMsg.style.display = 'none';
        } else {
            btnAdd.disabled = false;
            limitMsg.style.display = 'none';
        }
    }

    function renderExisting() {
        existingList.innerHTML = '';
        existingFiles.forEach(function (file) {
            const row = document.createElement('div');
            row.className = 'berkas-existing-item';
            row.innerHTML =
                '<i class="fa-regular fa-file" style="color:#059669"></i>' +
                '<span>' + file.name + '</span>' +
                '<span class="berkas-file-size">' + formatSize(file.size) + '</span>' +
                '<input type="hidden" name="berkas_pendukung_keep[]" value="' + file.path + '">' +
                '<button type="button" class="berkas-btn-remove" title="Hapus"><i class="fa-solid fa-xmark"></i></button>';
            row.querySelector('.berkas-btn-remove').addEventListener('click', function () {
                existingFiles = existingFiles.filter(function (f) { return f.path !== file.path; });
                renderExisting();
                updateUI();
            });
            existingList.appendChild(row);
        });
        updateUI();
    }

    function addNewFileRow() {
        if (getTotalSize() >= MAX_BYTES) return;

        const id = 'berkasNew_' + (++newFileCounter);
        const row = document.createElement('div');
        row.className = 'berkas-file-row';
        row.id = id;
        row.innerHTML =
            '<i class="fa-solid fa-file-arrow-up" style="color:#059669"></i>' +
            '<input type="file" name="berkas_pendukung[]" class="berkas-file-input" accept=".jpg,.jpeg,.png,.pdf">' +
            '<span class="berkas-file-name berkas-file-size">Belum dipilih</span>' +
            '<button type="button" class="berkas-btn-remove" title="Hapus"><i class="fa-solid fa-xmark"></i></button>';

        const input = row.querySelector('input[type="file"]');
        const nameSpan = row.querySelector('.berkas-file-name');

        input.addEventListener('change', function () {
            if (!input.files || !input.files[0]) {
                nameSpan.textContent = 'Belum dipilih';
                updateUI();
                return;
            }

            const file = input.files[0];
            const otherSize = getTotalSize() - file.size;
            if (otherSize + file.size > MAX_BYTES) {
                alert('File ini melebihi batas total 10 MB. Pilih file yang lebih kecil atau hapus berkas lain.');
                input.value = '';
                nameSpan.textContent = 'Belum dipilih';
                updateUI();
                return;
            }

            nameSpan.textContent = file.name + ' (' + formatSize(file.size) + ')';
            updateUI();
        });

        row.querySelector('.berkas-btn-remove').addEventListener('click', function () {
            row.remove();
            updateUI();
        });

        newList.appendChild(row);
        updateUI();
    }

    btnAdd.addEventListener('click', addNewFileRow);

    if (existingFiles.length > 0) {
        renderExisting();
    } else {
        addNewFileRow();
        updateUI();
    }
})();
</script>
