<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Admin Dashboard (Data Alamat)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        
        /* Header styles (same as previous file) */
        header {
            background-color: white;
            padding: 10px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        
        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
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
                <div class="search-container">
                    <div class="search-box">
                        <input type="text" class="search-input" placeholder="Cari data alamat...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr class="table-header">
                                <th scope="col">Nama Pembeli</th>
                                <th scope="col">Label Alamat</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody id="addressTableBody">
                            <!-- Data will be added dynamically here -->
                        </tbody>
                    </table>
                    <div id="noDataMessage" class="no-data-message">Belum ada data alamat</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script dimulai setelah DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Array untuk menyimpan data alamat
            let addresses = [];
            
            // Elemen-elemen yang diperlukan
            const noDataMessage = document.getElementById('noDataMessage');
            const addressTableBody = document.getElementById('addressTableBody');
            const searchInput = document.querySelector('.search-input');
            
            // Fungsi untuk memeriksa visibilitas tabel
            function updateTableVisibility() {
                if (addresses.length > 0) {
                    noDataMessage.style.display = 'none';
                } else {
                    noDataMessage.style.display = 'block';
                }
            }
            
            // Fungsi untuk menampilkan tabel alamat
            function renderAddressTable() {
                // Kosongkan tbody terlebih dahulu
                addressTableBody.innerHTML = '';
                
                // Tampilkan data alamat
                addresses.forEach(function(address) {
                    // Buat elemen baris baru
                    const row = document.createElement('tr');
                    
                    // Tambahkan sel untuk setiap data
                    row.innerHTML = `
                        <td>${address.buyerName}</td>
                        <td>${address.addressLabel}</td>
                        <td>${address.address}</td>
                    `;
                    
                    // Tambahkan baris ke dalam tabel
                    addressTableBody.appendChild(row);
                });
                
                // Perbarui visibilitas tabel
                updateTableVisibility();
            }
            
            // Inisialisasi visibilitas tabel
            updateTableVisibility();
            
            // Event listener untuk pencarian
            searchInput.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                const rows = addressTableBody.querySelectorAll('tr');
                
                rows.forEach(function(row) {
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