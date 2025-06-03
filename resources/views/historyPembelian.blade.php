<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pembelian - ReuseMart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: #334155;
        }
        
        /* Header styles */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 24px;
            color: #0f172a;
        }
        
        .logo img {
            height: 45px;
            border-radius: 8px;
        }
        
        nav {
            display: flex;
            gap: 32px;
        }
        
        nav a {
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        nav a:hover {
            color: #0f172a;
            background: rgba(15, 23, 42, 0.05);
            transform: translateY(-1px);
        }
        
        nav a.active {
            color: #0D5C4F;
            background: rgba(13, 92, 79, 0.1);
        }
        
        /* Main Container */
        .main-container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 24px;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 48px;
        }
        
        .page-title {
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 12px;
        }
        
        .page-subtitle {
            color: #64748b;
            font-size: 18px;
        }
        
        /* Cards */
        .card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }
        
        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .card-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }
        
        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        
        th {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 20px;
            text-align: left;
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }
        
        td {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        
        tr:hover {
            background: #f8fafc;
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .item-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }
        
        .item-description {
            font-size: 12px;
            color: #64748b;
        }
        
        .price-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .price-main {
            font-weight: 600;
            color: #059669;
            font-size: 16px;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            text-align: center;
        }
        
        .status-disiapkan {
            background: rgba(249, 191, 0, 0.1);
            color: #d97706;
        }
        
        .status-dikirim {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
        
        .status-diterima {
            background: rgba(34, 197, 94, 0.1);
            color: #166534;
        }
        
        /* Rating System */
        .rating-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .rating-button {
            padding: 8px 16px;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .rating-button:hover {
            background: linear-gradient(135deg, #134e4a, #0f766e);
            transform: translateY(-1px);
        }
        
        .rated-display {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #059669;
            font-weight: 500;
        }
        
        .rated-stars {
            display: flex;
            gap: 2px;
        }
        
        .rated-star {
            color: #fbbf24;
            font-size: 16px;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 32px;
            border-radius: 20px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .close {
            color: #9ca3af;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .close:hover {
            color: #374151;
        }
        
        .modal-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
        }
        
        .modal-item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .modal-rating-section {
            text-align: center;
            margin-bottom: 24px;
        }
        
        .modal-rating-label {
            font-size: 16px;
            color: #374151;
            margin-bottom: 16px;
        }
        
        .modal-star-rating {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        
        .modal-star {
            font-size: 32px;
            color: #d1d5db;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .modal-star:hover,
        .modal-star.active {
            color: #fbbf24;
            transform: scale(1.1);
        }
        
        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }
        
        .btn-cancel {
            padding: 12px 24px;
            background: #f1f5f9;
            color: #64748b;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            background: #e2e8f0;
        }
        
        .btn-submit {
            padding: 12px 24px;
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background: linear-gradient(135deg, #134e4a, #0f766e);
        }
        
        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1001;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 0 16px;
                margin: 24px auto;
            }
            
            .card {
                padding: 20px;
            }
            
            .page-title {
                font-size: 28px;
            }
            
            header {
                padding: 12px 16px;
                flex-direction: column;
                gap: 16px;
            }
            
            nav {
                gap: 20px;
            }
            
            .rating-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .table-container {
                font-size: 14px;
            }
            
            th, td {
                padding: 12px 8px;
            }
            
            .item-image {
                width: 60px;
                height: 60px;
            }
            
            .modal-content {
                margin: 15% auto;
                padding: 24px;
            }
            
            .modal-star {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img/Logo ReuseMart.jpg" alt="ReuseMart Logo">
        </div>
        <nav>
            <a href="/halamanPembeli" class="active">Halaman Pembelian</a>
            <a href="profilPembeli">Profil Akun</a>
        </nav>
    </header>
    
    <!-- Main Content -->
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">History Pembelian</h1>
            <p class="page-subtitle">Kelola dan pantau semua pembelian Anda di ReuseMart</p>
        </div>
        
        <!-- History Table Card -->
        <div class="card">
            <div class="card-header">
                <div class="card-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h2 class="card-title">Riwayat Pembelian Barang</h2>
            </div>
            
            <!-- Table -->
            <div class="table-container">
                <table id="historyTable">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Total Bayar</th>
                            <th>Status Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop" alt="Nike Air Max" class="item-image">
                            </td>
                            <td>
                                <div class="item-name">Sepatu Nike Air Max 270</div>
                                <div class="item-description">Ukuran 42, Warna Hitam</div>
                            </td>
                            <td>
                                <div class="price-info">
                                    <div class="price-main">Rp 850.000</div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-diterima">Diterima</span>
                            </td>
                            <td>
                                <div class="rating-container">
                                    <div class="rated-display">
                                        <span>Rating:</span>
                                        <div class="rated-stars">
                                            <i class="fas fa-star rated-star"></i>
                                            <i class="fas fa-star rated-star"></i>
                                            <i class="fas fa-star rated-star"></i>
                                            <i class="fas fa-star rated-star"></i>
                                            <i class="fas fa-star rated-star"></i>
                                        </div>
                                        <span>(5/5)</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=150&h=150&fit=crop" alt="Tas Kulit" class="item-image">
                            </td>
                            <td>
                                <div class="item-name">Tas Kulit Brown Leather</div>
                                <div class="item-description">Tas Tangan, Kondisi Sangat Baik</div>
                            </td>
                            <td>
                                <div class="price-info">
                                    <div class="price-main">Rp 320.000</div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-diterima">Diterima</span>
                            </td>
                            <td>
                                <div class="rating-container">
                                    <button class="rating-button" onclick="openRatingModal(2, 'Tas Kulit Brown Leather', 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=150&h=150&fit=crop')">
                                        <i class="fas fa-star"></i>
                                        Beri Rating
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=150&h=150&fit=crop" alt="Headphone" class="item-image">
                            </td>
                            <td>
                                <div class="item-name">Headphone Sony WH-1000XM4</div>
                                <div class="item-description">Noise Cancelling, Wireless</div>
                            </td>
                            <td>
                                <div class="price-info">
                                    <div class="price-main">Rp 2.100.000</div>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-dikirim">Dikirim</span>
                            </td>
                            <td>
                                <div class="rating-container">
                                    <span style="color: #64748b; font-size: 14px;">Belum dapat dirating</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div id="ratingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Beri Rating Produk</h3>
                <span class="close" onclick="closeRatingModal()">&times;</span>
            </div>
            
            <div class="modal-item" id="modalItem">
                <!-- Item details will be populated here -->
            </div>
            
            <div class="modal-rating-section">
                <div class="modal-rating-label">Berikan rating Anda untuk produk ini:</div>
                <div class="modal-star-rating" id="modalStarRating">
                    <i class="fas fa-star modal-star" data-rating="1"></i>
                    <i class="fas fa-star modal-star" data-rating="2"></i>
                    <i class="fas fa-star modal-star" data-rating="3"></i>
                    <i class="fas fa-star modal-star" data-rating="4"></i>
                    <i class="fas fa-star modal-star" data-rating="5"></i>
                </div>
            </div>
            
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeRatingModal()">Batal</button>
                <button class="btn-submit" onclick="submitRating()">Kirim Rating</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div id="notification" class="notification">
        <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
        <span id="notificationText">Rating berhasil dikirim!</span>
    </div>

    <script>
        let currentRating = 0;
        let currentItemId = null;
        let currentItemName = '';

        // Rating Modal Functions
        function openRatingModal(itemId, itemName, itemImage) {
            currentItemId = itemId;
            currentItemName = itemName;
            currentRating = 0;
            
            // Populate modal with item details
            const modalItem = document.getElementById('modalItem');
            modalItem.innerHTML = `
                <img src="${itemImage}" alt="${itemName}" class="modal-item-image">
                <div>
                    <div class="item-name">${itemName}</div>
                </div>
            `;
            
            // Reset stars
            resetModalStars();
            
            // Show modal
            document.getElementById('ratingModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeRatingModal() {
            document.getElementById('ratingModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            currentRating = 0;
            currentItemId = null;
            currentItemName = '';
        }

        function resetModalStars() {
            const stars = document.querySelectorAll('.modal-star');
            stars.forEach(star => {
                star.classList.remove('active');
            });
        }

        function setModalStarRating(rating) {
            const stars = document.querySelectorAll('.modal-star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function submitRating() {
            if (currentRating === 0) {
                alert('Silakan pilih rating terlebih dahulu!');
                return;
            }
            
            // Simulate API call
            setTimeout(() => {
                // Update the table row to show rated status
                updateTableRowAfterRating(currentItemId, currentRating);
                
                // Close modal
                closeRatingModal();
            }, 500);
        }

        function updateTableRowAfterRating(itemId, rating) {
            // Find the table row and update it
            const table = document.getElementById('historyTable');
            const rows = table.querySelectorAll('tbody tr');
            
            // For demo purposes, we'll update the row at index (itemId - 1)
            if (rows[itemId - 1]) {
                const actionCell = rows[itemId - 1].querySelector('td:last-child .rating-container');
                
                // Create rated display
                const ratedDisplay = document.createElement('div');
                ratedDisplay.className = 'rated-display';
                
                ratedDisplay.innerHTML = `
                    <span>Rating:</span>
                    <div class="rated-stars">
                        ${Array.from({length: rating}, () => '<i class="fas fa-star rated-star"></i>').join('')}
                        ${Array.from({length: 5 - rating}, () => '<i class="far fa-star" style="color: #d1d5db;"></i>').join('')}
                    </div>
                    <span>(${rating}/5)</span>
                `;
                
                // Replace the rating button with rated display
                actionCell.innerHTML = '';
                actionCell.appendChild(ratedDisplay);
            }
        }

        function showNotification(message) {
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notificationText');
            
            notificationText.textContent = message;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Modal star rating interaction
        document.addEventListener('DOMContentLoaded', function() {
            const modalStars = document.querySelectorAll('.modal-star');
            
            modalStars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    currentRating = index + 1;
                    setModalStarRating(currentRating);
                });
                
                star.addEventListener('mouseover', function() {
                    setModalStarRating(index + 1);
                });
            });
            
            document.getElementById('modalStarRating').addEventListener('mouseleave', function() {
                setModalStarRating(currentRating);
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('ratingModal');
            if (event.target === modal) {
                closeRatingModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeRatingModal();
            }
        });

        // Table row hover effects
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('#historyTable tbody tr');
            
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                    this.style.transition = 'transform 0.2s ease';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });

        // Smooth scrolling for any anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced button interactions
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.rating-button, .btn-submit, .btn-cancel');
            
            buttons.forEach(button => {
                button.addEventListener('mousedown', function() {
                    this.style.transform = 'scale(0.95)';
                });
                
                button.addEventListener('mouseup', function() {
                    this.style.transform = '';
                });
                
                button.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                });
            });
        });
    </script>
</body>
</html>