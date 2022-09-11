


<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets/')}}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard | Laboratorium TS Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables/dataTables.bootstrap5.min.css')}}" />

    <!-- Page CSS -->
      <style>
          #layout-menu .menu-header {
              margin-top: 0;
              margin-bottom: 0;
          }
          .content-wrapper table td {
              font-size: .88em;
              padding-top: .21rem;
              padding-bottom: .21rem;
          }
          .content-wrapper button {
              font-size: .8em;
              padding: .2em .45em;
          }
      </style>

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{asset('assets/img/logo/logo.png')}}" width="50" alt="..">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><h4 class="mb-0">Laboratorium</h4><h6 class="mb-0">Teknik Sipil</h6></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="{{route('adm.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Master Data -->
              <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">Master</span>
              </li>
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-copy-alt"></i>
                      <div data-i18n="Account Settings">Master Data</div>
                  </a>
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="{{route('adm.master.user')}}" class="menu-link">
                              <div data-i18n="Account">Data Pengguna</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('adm.master.dsn')}}" class="menu-link">
                              <div data-i18n="Account">Data Dosen</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('adm.master.matkum')}}" class="menu-link">
                              <div data-i18n="Account">Data Praktikum</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('adm.master.periode')}}" class="menu-link">
                              <div data-i18n="Account">Data Periode</div>
                          </a>
                      </li>
                  </ul>
              </li>
            <!-- Praktikum -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Praktikum</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-check"></i>
                <div data-i18n="Account Settings">Praktikum</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('adm.prak.pendaftar')}}" class="menu-link">
                    <div data-i18n="Account">Pendaftar Menunggu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('adm.prak.acc')}}" class="menu-link">
                    <div data-i18n="Notifications">Pendaftar Diterima</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('adm.prak.kel')}}" class="menu-link">
                    <div data-i18n="Notifications">Kelompok Praktikum</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('adm.prak.hist')}}" class="menu-link">
                    <div data-i18n="Notifications">History Pendaftar</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Keuangan</span></li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar"></i>
                <div data-i18n="Account Settings">Kas</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{route('adm.keu.kode')}}" class="menu-link">
                    <div data-i18n="Account">Kode Kas</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('adm.keu.kasp')}}" class="menu-link">
                    <div data-i18n="Account">Kas Periode</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{route('adm.keu.kas')}}" class="menu-link">
                    <div data-i18n="Notifications">Administrasi Kas</div>
                  </a>
                </li>
              </ul>
            </li>

              <li class="menu-header small text-uppercase"><span class="menu-header-text">Sewa Alat</span></li>
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-paint"></i>
                      <div data-i18n="Account Settings">Penyewaan</div>
                  </a>
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="{{route('adm.sewa.alat.i')}}" class="menu-link">
                              <div data-i18n="Account">Daftar Alat</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('adm.sewa.i')}}" class="menu-link">
                              <div data-i18n="Account">Daftar Penyewaan</div>
                          </a>
                      </li>
                  </ul>
              </li>

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Inventaris</span></li>
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-git-pull-request"></i>
                      <div data-i18n="Account Settings">Inventaris</div>
                  </a>
                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="{{route('adm.inv.bahan')}}" class="menu-link">
                              <div data-i18n="Account">Alat Bahan</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('adm.inv.permohon')}}" class="menu-link">
                              <div data-i18n="Account">Permohonan</div>
                          </a>
                      </li>
                  </ul>
              </li>

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
            <li class="menu-item">
              <a
                href="{{route('adm.setting')}}"
                class="menu-link">
                <i class="bx bx-cog me-2"></i>
                <div data-i18n="Support">Pengaturan</div>
              </a>
            </li>
            <li class="menu-item">
              <a
                href="{{route('auth.logout')}}"
                class="menu-link">
                <i class="bx bx-power-off me-2"></i>
                <div data-i18n="Documentation">Log Out</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{Storage::url(Auth::user()->foto)}}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{Storage::url(Auth::user()->foto)}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">
                              {{Auth::user()->nama}}
                            </span>
                            <small class="text-muted">{{Auth::user()->role}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Profile Saya</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('adm.setting')}}">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Pengaturan</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('auth.logout')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            @yield('content')
          </div>


           <!-- Footer -->
           <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                Laboratorium TS Unija
              </div>
            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{asset('assets/vendor/libs/jquery/jquery-3.5.1.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

  <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('assets/vendor/libs/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables/dataTables.bootstrap5.min.js')}}"></script>

  <!-- Main JS -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <!-- Page JS -->
  <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
  <script>
      $(document).ready(function () {
          $('#mytable').DataTable();
      });
  </script>

  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
