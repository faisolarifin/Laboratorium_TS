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

    <title>Dashboard | Laboratorium TS</title>

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

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

            <nav class="navbar navbar-expand-lg py-3 navbar-light bg-white sticky-top">
                <div class="container">
                    <div class="navbar-nav align-items-center">
                        <a href="/" class="app-brand-link">
                  <span class="app-brand-logo demo">
                    <img src="{{asset('assets/img/logo/logo.png')}}" width="45" alt="..">
                  </span>
                            <div class="d-flex flex-column ms-2">
                                <h5 class="mb-0">Laboratorium Teknik Sipil</h5>
                                <h6 class="mb-0">Universitas Wiraraja</h6>
                            </div>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-sm-flex align-items-sm-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('mhs.dashboard')}}">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Praktikum
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('mhs.listmatkum')}}">Daftar Praktikum</a></li>
                                    <li><a class="dropdown-item" href="{{route('mhs.rencana')}}">Rencana Praktikum</a></li>
                                    <li><a class="dropdown-item" href="{{route('mhs.kel')}}">Pembagian Kelompok</a></li>
                                    <li><a class="dropdown-item" href="{{route('mhs.jad')}}">Jadwal Pelaksanaan</a></li>
                                    <li><a class="dropdown-item" href="{{route('mhs.nilai')}}">Nilai Praktikum</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sewa Alat
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('usr.alat')}}">Daftar Alat</a></li>
                                    <li><a class="dropdown-item" href="{{route('usr.sewa.f')}}">Form Penyewaan</a></li>
                                    <li><a class="dropdown-item" href="{{route('usr.sewa.r')}}">Penyewaan</a></li>
                                    <li><a class="dropdown-item" href="{{route('usr.sewa.h')}}">History Penyewaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Penelitian
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{route('usr.permohonan')}}">Form Permohonan</a></li>
                                    <li><a class="dropdown-item" href="{{route('usr.listpermohonan')}}">Permohonan</a></li>
                                    <li><a class="dropdown-item" href="{{route('usr.penelitian.kegiatan')}}">Kegiatan Penelitian</a></li>
                                </ul>
                            </li>
                            <li class="nav-item navbar-dropdown dropdown-user dropdown ms-sm-3">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{Storage::url(Auth::user()->foto)}}" alt class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{Storage::url(Auth::user()->foto)}}" alt class="rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{Auth::user()->nama}}</span>
                                                    <small class="text-muted">{{Auth::user()->role}}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('mhs.profile')}}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('mhs.password')}}">
                                            <i class="bx bx-key me-2"></i>
                                            <span class="align-middle">Ubah Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('auth.logout')}}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container flex-grow-1 container-p-y mt-sm-4">

              @yield('content')

            </div>
            <!-- / Content -->

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
    </div>
    <!-- / Layout wrapper -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
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
