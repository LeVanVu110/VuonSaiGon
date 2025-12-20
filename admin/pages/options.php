<style>
    .fixed-plugin-button:hover svg {
        transform: rotate(180deg);
        transition: transform 0.4s ease-in-out;
    }
    </style>
<div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                style="pointer-events: none;" class="">
                <circle cx="12" cy="12" r="3" stroke="#344767" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                <path
                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"
                    stroke="#344767" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn btn-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="w-100 text-center">

                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- KHỞI TẠO CÁC BIẾN ---
        const sidenav = document.getElementById('sidenav-main');
        const body = document.getElementsByTagName('body')[0];
        const navbarFixedCheckbox = document.getElementById('navbarFixed');

        // --- 1. HÀM TẢI CẤU HÌNH ĐÃ LƯU ---
        function loadSavedConfig() {
            // Tải màu Sidebar
            const savedColor = localStorage.getItem('sidebarColor');
            if (savedColor) {
                applySidebarColor(savedColor);
            }

            // Tải loại Sidebar (White / Transparent)
            const savedType = localStorage.getItem('sidebarType');
            if (savedType) {
                applySidebarType(savedType);
            }

            // Tải trạng thái Navbar Fixed
            const isNavbarFixed = localStorage.getItem('navbarFixed') === 'true';
            if (isNavbarFixed) {
                applyNavbarFixed(true);
                if (navbarFixedCheckbox) navbarFixedCheckbox.checked = true;
            }
        }

        // --- 2. HÀM XỬ LÝ MÀU SẮC ---
        window.sidebarColor = function(el) {
            const color = el.getAttribute("data-color");
            applySidebarColor(color);
            localStorage.setItem('sidebarColor', color);
        };

        function applySidebarColor(color) {
            if (!sidenav) return;
            sidenav.setAttribute("data-color", color);

            // Cập nhật trạng thái active cho các nút badge trong UI
            document.querySelectorAll('.badge-colors .badge').forEach(badge => {
                badge.classList.remove('active');
                if (badge.getAttribute('data-color') === color) {
                    badge.classList.add('active');
                }
            });
        }

        // --- 3. HÀM XỬ LÝ LOẠI SIDEBAR (White/Transparent) ---
        window.sidebarType = function(el) {
            const type = el.getAttribute("data-class");
            applySidebarType(type);
            localStorage.setItem('sidebarType', type);
        };

        function applySidebarType(type) {
            if (!sidenav) return;

            // Template Soft UI thường sử dụng các class này
            if (type === 'bg-transparent') {
                sidenav.classList.remove('bg-white');
                sidenav.classList.add('bg-transparent');
            } else {
                sidenav.classList.remove('bg-transparent');
                sidenav.classList.add('bg-white');
            }

            // Cập nhật trạng thái active cho các nút bấm
            document.querySelectorAll('[onclick="sidebarType(this)"]').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-class') === type) {
                    btn.classList.add('active');
                }
            });
        }

        // --- 4. HÀM XỬ LÝ NAVBAR FIXED ---
        window.navbarFixed = function(el) {
            const isChecked = el.checked;
            applyNavbarFixed(isChecked);
            localStorage.setItem('navbarFixed', isChecked);
        };

        function applyNavbarFixed(fixed) {
            const navbar = document.getElementById('navbarBlur'); // ID mặc định của navbar trong Soft UI
            if (!navbar) return;

            if (fixed) {
                navbar.classList.add('navbar-fixed');
                navbar.setAttribute('navbar-scroll', 'true');
            } else {
                navbar.classList.remove('navbar-fixed');
                navbar.setAttribute('navbar-scroll', 'false');
            }
        }

        // CHẠY HÀM TẢI CẤU HÌNH KHI TRANG SẴN SÀNG
        loadSavedConfig();
    });
    </script>