<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReuseMart - Login</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0D5C4F;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background-color: #E5E5E5;
            width: 80%;
            max-width: 900px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            height: 100%;
        }

        .left-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-section {
            flex: 1;
            background-color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .right-section .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-image {
            height: 60px;
            margin-right: 10px;
        }

        .right-section .logo-text {
            color: #0D5C4F;
            font-size: 22px;
            font-weight: bold;
        }

        .right-section .fast-easy {
            color: #666;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .input-with-icon {
            position: relative;
            width: 100%;
        }

        .input-with-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #AAA;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #DDD;
            border-radius: 5px;
            font-size: 16px;
            color: #666;
        }

        .form-control::placeholder {
            color: #AAA;
        }

        .role-dropdown {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #DDD;
            border-radius: 5px;
            font-size: 16px;
            color: #666;
            background-color: white;
            appearance: none;
        }

        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #AAA;
            pointer-events: none;
        }

        .login-btn {
            width: 100%;
            background-color: #8BC34A;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 14px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover {
            background-color: #7CB342;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-password a {
            color: #333;
            text-decoration: none;
        }

        .register {
            text-align: center;
            margin-top: 20px;
        }

        .register a {
            color: #8BC34A;
            text-decoration: none;
            font-weight: bold;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            padding: 30px;
            position: relative;
            animation: modalFadeIn 0.3s ease-out;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .modal-header h2 {
            color: #0D5C4F;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .modal-header p {
            color: #666;
            font-size: 14px;
        }

        .close-modal {
            position: absolute;
            right: 15px;
            top: 15px;
            font-size: 24px;
            color: #999;
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: #333;
        }

        .register-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .register-option {
            border: 2px solid #DDD;
            border-radius: 8px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .register-option:hover {
            border-color: #8BC34A;
            background-color: #f9f9f9;
        }

        .option-icon {
            width: 50px;
            height: 50px;
            background-color: #E8F5E9;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .option-icon svg {
            width: 24px;
            height: 24px;
            fill: #0D5C4F;
        }

        .option-text {
            flex-grow: 1;
        }

        .option-text h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }

        .option-text p {
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 95%;
            }

            .left-section {
                height: 200px;
            }

            .right-section {
                padding: 20px;
            }

            .modal-content {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="/img/Login Page Left.png" alt="Left Section">
        </div>

        <div class="right-section">
            <div class="logo-container">
                <img src="/img/Logo ReuseMart.jpg" alt="ReuseMart Logo" class="logo-image">
            </div>

            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                        </i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                            required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                            </svg>
                        </i>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan Password">
                    </div>
                </div>

                <div class="form-group">
                    <div style="display: flex; width: 100%;">
                        <button type="submit" class="login-btn"
                            style="margin-top: 0; margin-bottom: 15px; margin-top: 17px;">LOGIN</button>
                    </div>

                    <div style="display: flex; width: 100%;">
                        <button type="button" id="guest-login" name="guest_login" style="
                        width: 100%;
                        background-color: transparent;
                        color: #0D5C4F;
                        border: 1px solid #0D5C4F;
                        border-radius: 5px;
                        padding: 14px;
                        font-size: 16px;
                        font-weight: bold;
                        cursor: pointer;
                        transition: background-color 0.3s, color 0.3s;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16" style="margin-right: 8px;">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg>
                            MASUK SEBAGAI TAMU
                        </button>
                    </div>

                    <div style="font-size: 12px; color: #888; margin-top: 5px; text-align: center;">
                        Login sebagai tamu memiliki fitur terbatas
                    </div>
                </div>

                <div class="forgot-password">
                    <a href="/password/reset">Lupa Password?</a>
                </div>

                <div class="register">
                    Belum Punya Akun? <a href="#" id="register-link">Daftar Disini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <button class="close-modal">&times;</button>
            <div class="modal-header">
                <h2>Daftar Akun</h2>
                <p>Pilih jenis akun yang ingin Anda daftarkan</p>
            </div>
            <div class="register-options">
                <a href="/register" class="register-option">
                    <div class="option-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </div>
                    <div class="option-text">
                        <h3>Pembeli / Individu</h3>
                        <p>Mendaftar sebagai pengguna perorangan untuk membeli barang</p>
                    </div>
                </a>
                <a href="/registerOrganisasi" class="register-option">
                    <div class="option-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                        </svg>
                    </div>
                    <div class="option-text">
                        <h3>Organisasi / Komunitas</h3>
                        <p>Mendaftar sebagai organisasi untuk melakukan request barang donasi</p>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <script>
        // JavaScript untuk mengatur modal
        const registerLink = document.getElementById('register-link');
        const registerModal = document.getElementById('register-modal');
        const closeModal = document.querySelector('.close-modal');

        // Membuka modal saat link daftar diklik
        registerLink.addEventListener('click', function (e) {
            e.preventDefault();
            registerModal.style.display = 'flex';
        });

        // Menutup modal saat tombol close diklik
        closeModal.addEventListener('click', function () {
            registerModal.style.display = 'none';
        });

        // Menutup modal saat mengklik di luar modal
        window.addEventListener('click', function (e) {
            if (e.target === registerModal) {
                registerModal.style.display = 'none';
            }
        });

        document.getElementById("guest-login").addEventListener("click", function () {
        window.location.href = "/";
    });
    </script>
</body>

</html>