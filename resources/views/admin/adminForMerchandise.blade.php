<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        /* Header styles */
        header {
            background-color: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logo img {
            height: 40px;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 18px;
        }

        .sidebar {
            background-color: #18594a;
            color: white;
            min-height: calc(100vh - 56px);
            padding-top: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 15px 20px;
        }

        .sidebar-menu li:hover {
            background-color: #124035;
        }

        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 20px;
        }

        .main-content {
            padding: 20px;
        }

        .btn-add {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: left;
        }

        .search-box {
            width: 400px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 8px 40px 8px 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        .data-table {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
        }

        .table-header {
            background-color: #18594a;
            color: white;
            font-weight: 500;
        }

        .table td {
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .modal-header {
            background-color: #18594a;
            color: white;
        }

        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .merchandise-img-wrapper {
            width: 80px;
            height: 80px;
            overflow: hidden;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .merchandise-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .img-preview {
            width: 100%;
            height: 150px;
            border: 1px dashed #ccc;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .img-preview img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>
    <!-- Header with navigation -->
    <header>
        <div class="logo">
            <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="/admin/adminForJabatan" class="admin-jabatan">
                            <i class="fas fa-users"></i>
                            Data Jabatan
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForPegawai" class="admin-pegawai">
                            <i class="fas fa-user"></i>
                            Data Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForOrganisasi" class="admin-organisasi">
                            <i class="fas fa-building"></i>
                            Data Organisasi
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForMerchandise" class="admin-merchandise">
                            <i class="fas fa-gift"></i>
                            Data Merchandise
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForAlamat" class="admin-alamat">
                            <i class="fas fa-directions"></i>
                            Data Alamat
                        </a>
                    </li>
                    <li>
                        <a href="/admin/adminForReset" class="admin-reset">
                            <i class="fas fa-key"></i>
                            Reset Password
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addMerchandiseModal">
                    <i class="fas fa-plus"></i> Tambah Merchandise
                </button>

                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data merchandise...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Merchandise</th>
                                <th scope="col">Stok Merchandise</th>
                                <th scope="col">Poin Diperlukan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="merchandiseTableBody">
                            <!-- Data will be added dynamically here -->
                        </tbody>
                    </table>
                    <div id="noDataMessage" class="no-data-message">Belum ada data merchandise</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Merchandise Modal -->
    <div class="modal fade" id="addMerchandiseModal" tabindex="-1" aria-labelledby="addMerchandiseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMerchandiseModalLabel">Tambah Data Merchandise</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addMerchandiseForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Merchandise</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Merchandise</label>
                            <input type="number" min="0" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="points" class="form-label">Poin Diperlukan</label>
                            <input type="number" min="0" class="form-control" id="points" name="points" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Merchandise</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            <div class="img-preview" id="imagePreview">
                                <span>Preview gambar</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="saveMerchandise">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Merchandise Modal -->
    <div class="modal fade" id="editMerchandiseModal" tabindex="-1" aria-labelledby="editMerchandiseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMerchandiseModalLabel">Edit Data Merchandise</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editMerchandiseForm">
                        <input type="hidden" id="editMerchandiseIndex">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Merchandise</label>
                            <input type="text" class="form-control" id="editName" name="editName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStock" class="form-label">Stok Merchandise</label>
                            <input type="number" min="0" class="form-control" id="editStock" name="editStock" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPoints" class="form-label">Poin Diperlukan</label>
                            <input type="number" min="0" class="form-control" id="editPoints" name="editPoints"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Gambar Merchandise</label>
                            <input type="file" class="form-control" id="editImage" name="editImage" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            <div class="img-preview" id="editImagePreview">
                                <img id="currentImage" src="" alt="Merchandise Preview">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="updateMerchandise">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script dimulai setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Array untuk menyimpan data merchandise
            let merchandises = [];

            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const merchandiseTableBody = document.getElementById('merchandiseTableBody');
            const addMerchandiseForm = document.getElementById('addMerchandiseForm');
            const editMerchandiseForm = document.getElementById('editMerchandiseForm');
            const saveMerchandiseBtn = document.getElementById('saveMerchandise');
            const updateMerchandiseBtn = document.getElementById('updateMerchandise');
            const searchInput = document.querySelector('.search-input');

            // Inisialisasi modals
            const addModal = new bootstrap.Modal(document.getElementById('addMerchandiseModal'));
            const editModal = new bootstrap.Modal(document.getElementById('editMerchandiseModal'));

            // Preview gambar untuk form tambah
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.innerHTML = `<span>Preview gambar</span>`;
                }
            });

            // Preview gambar untuk form edit
            const editImageInput = document.getElementById('editImage');
            const editImagePreview = document.getElementById('editImagePreview');
            const currentImage = document.getElementById('currentImage');

            editImageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        currentImage.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (merchandises.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }

            // Fungsi untuk menampilkan tabel merchandise
            function renderMerchandiseTable() {
                // Kosongkan tbody terlebih dahulu
                merchandiseTableBody.innerHTML = '';

                // Tampilkan data merchandise
                merchandises.forEach(function (merchandise, index) {
                    // Buat elemen baris baru
                    const row = document.createElement('tr');

                    // Tambahkan sel untuk setiap data
                    row.innerHTML = `
                        <td>
                            <div class="merchandise-img-wrapper">
                                <img src="${merchandise.image}" alt="${merchandise.name}" class="merchandise-img">
                            </div>
                        </td>
                        <td>${merchandise.name}</td>
                        <td>${merchandise.stock}</td>
                        <td>${merchandise.points}</td>
                        <td>
                            <button class="btn btn-edit me-2"><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-delete"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    `;

                    // Tambahkan event listener untuk tombol edit
                    const editButton = row.querySelector('.btn-edit');
                    editButton.addEventListener('click', function () {
                        openEditModal(index);
                    });

                    // Tambahkan event listener untuk tombol delete
                    const deleteButton = row.querySelector('.btn-delete');
                    deleteButton.addEventListener('click', function () {
                        if (confirm('Yakin ingin menghapus merchandise ini?')) {
                            merchandises.splice(index, 1);
                            renderMerchandiseTable();
                            updateTableVisibility();
                        }
                    });

                    // Tambahkan baris ke dalam tabel
                    merchandiseTableBody.appendChild(row);
                });

                // Perbarui visibilitas tabel
                updateTableVisibility();
            }

            // Fungsi untuk membuka modal edit
            function openEditModal(index) {
                const merchandise = merchandises[index];

                // Isi form dengan data merchandise yang dipilih
                document.getElementById('editMerchandiseIndex').value = index;
                document.getElementById('editName').value = merchandise.name;
                document.getElementById('editStock').value = merchandise.stock;
                document.getElementById('editPoints').value = merchandise.points;
                document.getElementById('currentImage').src = merchandise.image;

                // Tampilkan modal edit
                editModal.show();
            }

            // Inisialisasi visibilitas tabel
            updateTableVisibility();

            // Event listener untuk tombol simpan di modal tambah
            saveMerchandiseBtn.addEventListener('click', function () {
                // Validasi form
                if (!addMerchandiseForm.checkValidity()) {
                    addMerchandiseForm.reportValidity();
                    return;
                }

                // Cek apakah gambar sudah dipilih
                if (!imageInput.files[0]) {
                    alert('Silakan pilih gambar untuk merchandise');
                    return;
                }

                // Ambil data dari form
                const reader = new FileReader();
                reader.onload = function (e) {
                    const formData = {
                        name: document.getElementById('name').value,
                        stock: document.getElementById('stock').value,
                        points: document.getElementById('points').value,
                        image: e.target.result
                    };

                    // Tambahkan data ke array merchandise
                    merchandises.push(formData);

                    // Reset form dan tutup modal
                    addMerchandiseForm.reset();
                    imagePreview.innerHTML = `<span>Preview gambar</span>`;
                    addModal.hide();

                    // Tampilkan data di tabel
                    renderMerchandiseTable();
                }
                reader.readAsDataURL(imageInput.files[0]);
            });

            // Event listener untuk tombol update di modal edit
            updateMerchandiseBtn.addEventListener('click', function () {
                // Validasi form
                if (!editMerchandiseForm.checkValidity()) {
                    editMerchandiseForm.reportValidity();
                    return;
                }

                // Ambil index merchandise yang sedang diedit
                const index = document.getElementById('editMerchandiseIndex').value;

                // Update data merchandise
                merchandises[index].name = document.getElementById('editName').value;
                merchandises[index].stock = document.getElementById('editStock').value;
                merchandises[index].points = document.getElementById('editPoints').value;

                // Cek apakah gambar diubah
                if (editImageInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        merchandises[index].image = e.target.result;

                        // Tutup modal
                        editModal.hide();

                        // Tampilkan data yang diperbarui di tabel
                        renderMerchandiseTable();
                    }
                    reader.readAsDataURL(editImageInput.files[0]);
                } else {
                    // Tutup modal
                    editModal.hide();

                    // Tampilkan data yang diperbarui di tabel
                    renderMerchandiseTable();
                }
            });

            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function () {
                const searchText = this.value.toLowerCase();
                const rows = merchandiseTableBody.querySelectorAll('tr');

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    if (text.indexOf(searchText) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>