<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - ReuseMart</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
        }
        
        /* Header styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .logo {
            display: flex;
            align-items: center;
        }
        
        .logo img {
            height: 40px;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            font-weight: 500;
        }
        
        .nav-links a:hover {
            color: #18594a;
        }
        
        /* Sidebar styles */
        .sidebar {
            background-color: #18594a;
            color: white;
            min-height: calc(100vh - 76px);
            padding-top: 20px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        
        .sidebar-menu li {
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .sidebar-menu li:hover,
        .sidebar-menu li.active {
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
        
        /* Main content styles */
        .main-content {
            padding: 20px;
        }
        
        .content-section {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .section-title {
            color: #18594a;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 24px;
        }
        
        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 12px;
        }
        
        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .btn-view {
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .search-container {
            margin-bottom: 20px;
        }
        
        .search-box {
            position: relative;
            max-width: 400px;
        }
        
        .search-input {
            width: 100%;
            padding: 8px 40px 8px 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }
        
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        .table-header {
            background-color: #18594a;
            color: white;
        }
        
        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        
        .badge-approved {
            background-color: #28a745;
        }
        
        .badge-rejected {
            background-color: #dc3545;
        }
        
        .badge-completed {
            background-color: #6c757d;
        }
        
        .no-data-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }
        
        .filter-container {
            margin-bottom: 20px;
        }
        
        .filter-select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#">Dashboard Owner</a>
            <a href="#">Profil Akun</a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">
                <ul class="sidebar-menu">
                    <li class="active" data-section="requests">
                        <a href="#" onclick="showSection('requests')">
                            <i class="fas fa-list"></i>
                            Request Donasi
                        </a>
                    </li>
                    <li data-section="history">
                        <a href="#" onclick="showSection('history')">
                            <i class="fas fa-history"></i>
                            History Donasi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <!-- Request Donasi Section -->
                <div id="requestsSection" class="content-section">
                    <h2 class="section-title">Daftar Request Donasi</h2>
                    
                    <!-- Search and Filter -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="search-container">
                            <div class="search-box">
                                <input type="text" class="search-input" id="searchRequests" placeholder="Cari request donasi...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                        <div class="filter-container">
                            <select class="filter-select" id="statusFilter">
                                <option value="">Semua Status</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Request Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="table-header">
                                    <th scope="col">Organisasi</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal Request</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="requestsTableBody">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                        <div id="noRequestsMessage" class="no-data-message">Belum ada request donasi</div>
                    </div>
                </div>

                <!-- History Donasi Section -->
                <div id="historySection" class="content-section" style="display: none;">
                    <h2 class="section-title">History Donasi</h2>
                    
                    <!-- Search only (no filter dropdown) -->
                    <div class="mb-3">
                        <div class="search-container">
                            <div class="search-box">
                                <input type="text" class="search-input" id="searchHistory" placeholder="Cari history donasi...">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- History Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="table-header">
                                    <th scope="col">Organisasi</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Tanggal Donasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                <!-- Data will be populated here -->
                            </tbody>
                        </table>
                        <div id="noHistoryMessage" class="no-data-message">Belum ada history donasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Request/Donasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailModalBody">
                    <!-- Detail content will be populated here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data for requests
            let requests = [
                {
                    id: 1,
                    organization: "Yayasan Peduli Anak",
                    itemName: "Buku Pelajaran",
                    description: "Membutuhkan buku pelajaran untuk anak-anak kurang mampu",
                    requestDate: "15 Mei 2024",
                    status: "Menunggu",
                    contact: "081234567890",
                    address: "Jl. Pendidikan No. 123, Jakarta"
                },
                {
                    id: 2,
                    organization: "Panti Asuhan Harapan",
                    itemName: "Pakaian Anak",
                    description: "Membutuhkan pakaian untuk anak usia 5-15 tahun",
                    requestDate: "12 Mei 2024",
                    status: "Disetujui",
                    contact: "081234567891",
                    address: "Jl. Kasih Sayang No. 456, Bandung"
                },
                {
                    id: 3,
                    organization: "Komunitas Berbagi",
                    itemName: "Alat Tulis",
                    description: "Membutuhkan alat tulis untuk program belajar mengajar",
                    requestDate: "10 Mei 2024",
                    status: "Ditolak",
                    contact: "081234567892",
                    address: "Jl. Berbagi No. 789, Surabaya"
                }
            ];

            // Sample data for donation history
            let donationHistory = [
                {
                    id: 1,
                    organization: "Yayasan Peduli Anak",
                    itemName: "Buku Cerita",
                    donationDate: "20 April 2024",
                    status: "Selesai",
                    notes: "Donasi 50 buku cerita berhasil diserahkan"
                },
                {
                    id: 2,
                    organization: "Panti Asuhan Harapan",
                    itemName: "Mainan Edukasi",
                    donationDate: "18 April 2024",
                    status: "Selesai",
                    notes: "Donasi mainan edukasi untuk 30 anak"
                },
                {
                    id: 3,
                    organization: "Komunitas Berbagi",
                    itemName: "Komputer Bekas",
                    donationDate: "15 April 2024",
                    status: "Selesai",
                    notes: "Donasi 5 unit komputer untuk lab komputer"
                }
            ];

            // Get DOM elements
            const requestsTableBody = document.getElementById('requestsTableBody');
            const historyTableBody = document.getElementById('historyTableBody');
            const noRequestsMessage = document.getElementById('noRequestsMessage');
            const noHistoryMessage = document.getElementById('noHistoryMessage');
            const searchRequests = document.getElementById('searchRequests');
            const searchHistory = document.getElementById('searchHistory');
            const statusFilter = document.getElementById('statusFilter');

            // Function to show/hide sections
            window.showSection = function(section) {
                // Hide all sections
                document.getElementById('requestsSection').style.display = 'none';
                document.getElementById('historySection').style.display = 'none';

                // Remove active class from all menu items
                document.querySelectorAll('.sidebar-menu li').forEach(li => {
                    li.classList.remove('active');
                });

                // Show selected section and add active class
                if (section === 'requests') {
                    document.getElementById('requestsSection').style.display = 'block';
                    document.querySelector('[data-section="requests"]').classList.add('active');
                } else if (section === 'history') {
                    document.getElementById('historySection').style.display = 'block';
                    document.querySelector('[data-section="history"]').classList.add('active');
                }
            };

            // Function to render requests table
            function renderRequestsTable(data = requests) {
                requestsTableBody.innerHTML = '';

                if (data.length === 0) {
                    noRequestsMessage.style.display = 'block';
                    return;
                } else {
                    noRequestsMessage.style.display = 'none';
                }

                data.forEach(function(request) {
                    const row = document.createElement('tr');
                    
                    let badgeClass = '';
                    switch(request.status) {
                        case 'Menunggu':
                            badgeClass = 'badge-pending';
                            break;
                        case 'Disetujui':
                            badgeClass = 'badge-approved';
                            break;
                        case 'Ditolak':
                            badgeClass = 'badge-rejected';
                            break;
                        default:
                            badgeClass = 'badge-pending';
                    }

                    row.innerHTML = `
                        <td>${request.organization}</td>
                        <td>${request.itemName}</td>
                        <td>${request.description.substring(0, 50)}...</td>
                        <td>${request.requestDate}</td>
                        <td><span class="badge ${badgeClass}">${request.status}</span></td>
                        <td>
                            <button class="btn btn-view me-1" onclick="showDetail('request', ${request.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            ${request.status === 'Menunggu' ? `
                                <button class="btn btn-approve me-1" onclick="approveRequest(${request.id})">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-reject" onclick="rejectRequest(${request.id})">
                                    <i class="fas fa-times"></i>
                                </button>
                            ` : ''}
                        </td>
                    `;

                    requestsTableBody.appendChild(row);
                });
            }

            // Function to render history table
            function renderHistoryTable(data = donationHistory) {
                historyTableBody.innerHTML = '';

                if (data.length === 0) {
                    noHistoryMessage.style.display = 'block';
                    return;
                } else {
                    noHistoryMessage.style.display = 'none';
                }

                data.forEach(function(history) {
                    const row = document.createElement('tr');
                    
                    row.innerHTML = `
                        <td>${history.organization}</td>
                        <td>${history.itemName}</td>
                        <td>${history.donationDate}</td>
                        <td><span class="badge badge-completed">${history.status}</span></td>
                        <td>${history.notes.substring(0, 50)}...</td>
                        <td>
                            <button class="btn btn-view" onclick="showDetail('history', ${history.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    `;

                    historyTableBody.appendChild(row);
                });
            }

            // Function to show detail modal
            window.showDetail = function(type, id) {
                let item;
                if (type === 'request') {
                    item = requests.find(r => r.id === id);
                    document.getElementById('detailModalLabel').textContent = 'Detail Request Donasi';
                    document.getElementById('detailModalBody').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Organisasi</h6>
                                <p><strong>Nama:</strong> ${item.organization}</p>
                                <p><strong>Kontak:</strong> ${item.contact}</p>
                                <p><strong>Alamat:</strong> ${item.address}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Detail Request</h6>
                                <p><strong>Nama Barang:</strong> ${item.itemName}</p>
                                <p><strong>Tanggal Request:</strong> ${item.requestDate}</p>
                                <p><strong>Status:</strong> ${item.status}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Deskripsi</h6>
                                <p>${item.description}</p>
                            </div>
                        </div>
                    `;
                } else {
                    item = donationHistory.find(h => h.id === id);
                    document.getElementById('detailModalLabel').textContent = 'Detail History Donasi';
                    document.getElementById('detailModalBody').innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Donasi</h6>
                                <p><strong>Organisasi:</strong> ${item.organization}</p>
                                <p><strong>Nama Barang:</strong> ${item.itemName}</p>
                                <p><strong>Tanggal Donasi:</strong> ${item.donationDate}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Status</h6>
                                <p><strong>Status:</strong> ${item.status}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Keterangan</h6>
                                <p>${item.notes}</p>
                            </div>
                        </div>
                    `;
                }

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            };

            // Function to approve request
            window.approveRequest = function(id) {
                if (confirm('Apakah Anda yakin ingin menyetujui request ini?')) {
                    const request = requests.find(r => r.id === id);
                    request.status = 'Disetujui';
                    renderRequestsTable(filterRequests());
                    alert('Request berhasil disetujui!');
                }
            };

            // Function to reject request
            window.rejectRequest = function(id) {
                if (confirm('Apakah Anda yakin ingin menolak request ini?')) {
                    const request = requests.find(r => r.id === id);
                    request.status = 'Ditolak';
                    renderRequestsTable(filterRequests());
                    alert('Request berhasil ditolak!');
                }
            };

            // Function to filter requests
            function filterRequests() {
                let filteredRequests = requests;

                // Filter by search term
                const searchTerm = searchRequests.value.toLowerCase();
                if (searchTerm) {
                    filteredRequests = filteredRequests.filter(request =>
                        request.organization.toLowerCase().includes(searchTerm) ||
                        request.itemName.toLowerCase().includes(searchTerm) ||
                        request.description.toLowerCase().includes(searchTerm)
                    );
                }

                // Filter by status
                const statusValue = statusFilter.value;
                if (statusValue) {
                    filteredRequests = filteredRequests.filter(request =>
                        request.status === statusValue
                    );
                }

                return filteredRequests;
            }

            // Function to filter history (only by search, no organization filter)
            function filterHistory() {
                let filteredHistory = donationHistory;

                // Filter by search term only
                const searchTerm = searchHistory.value.toLowerCase();
                if (searchTerm) {
                    filteredHistory = filteredHistory.filter(history =>
                        history.organization.toLowerCase().includes(searchTerm) ||
                        history.itemName.toLowerCase().includes(searchTerm) ||
                        history.notes.toLowerCase().includes(searchTerm)
                    );
                }

                return filteredHistory;
            }

            // Event listeners for search and filter
            searchRequests.addEventListener('keyup', function() {
                renderRequestsTable(filterRequests());
            });

            searchHistory.addEventListener('keyup', function() {
                renderHistoryTable(filterHistory());
            });

            statusFilter.addEventListener('change', function() {
                renderRequestsTable(filterRequests());
            });

            // Initial render
            renderRequestsTable();
            renderHistoryTable();
        });

    </script>
</body>
</html>