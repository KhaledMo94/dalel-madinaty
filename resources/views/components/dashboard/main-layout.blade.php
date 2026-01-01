<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@php
    $rev_locale = app()->getLocale() == 'en' ? 'ar' : 'en';
@endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('app/app_logo.png') }}">
    <title>{{ __('Admin Panel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @livewireStyles
    @if (app()->getLocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:slnt,wght@-11..11,200..1000&display=swap"
            rel="stylesheet">
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.my-slider').forEach(function(slider) {
                tns({
                    container: slider,
                    loop: true,
                    autoplay: true,
                    autoplayButtonOutput: false, // Hide the autoplay button
                    controls: false, // Hide the navigation controls
                    nav: false, // Hide the navigation dots
                    autoplayTimeout: 2000, // Set autoplay interval (in ms)
                    autoplayHoverPause: true, // Pause autoplay on hover
                });
            });
        });
    </script>
    <style>
        .tns-outer {
            width: 200px !important
        }

        .image-preview-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 10px;
        }

        .image-preview-box {
            position: relative;
            display: inline-block;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            background: #f9f9f9;
        }

        .image-preview-box img {
            max-width: 200px;
            max-height: 200px;
            display: block;
        }

        .image-preview-remove {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 10;
        }

        .image-preview-remove:hover {
            background: #c82333;
        }

        .image-preview-container {
            margin-top: 10px;
        }
    </style>

    <x-dashboard.styles />
    <style>
        .select2-search__field{
            margin-top: 0 !important;
            height: 25px !important;
        }
    </style>
    <x-dashboard.scripts-header />

</head>

<body id="page-top" @if (app()->getLocale() == 'ar') dir="rtl" @endif style="overflow-x: hidden;">

    <div id="wrapper">

        <x-dashboard.side-bar />

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="mb-4 bg-white shadow navbar navbar-expand navbar-light topbar static-top">
                    <button id="sidebarToggleTop" class="mr-3 btn btn-link d-md-none rounded-circle">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form action="{{ route('admins.language.switch') }}" method="POST">
                        @csrf
                        <select name="locale" onchange="this.form.submit()" class="form-control">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                            <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                        </select>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="ml-auto navbar-nav">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 text-gray-600 d-none d-lg-inline">
                                    {{ Auth::user()->name ?? __('Admin') }}
                                </span>
                                <img class="img-profile rounded-circle" width="50" height="50"
                                    src="{{ asset('storage/' . Auth::user()->image) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="shadow dropdown-menu dropdown-menu-right animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="{{ route('admins.profile.edit') }}">
                                    <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i> {{ __('Edit Profile') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admins.password.edit') }}">
                                    <i class="mr-2 text-gray-400 fas fa-user fa-sm fa-fw"></i>
                                    {{ __('Change Password') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="mr-2 text-gray-400 fas fa-sign-out-alt fa-sm fa-fw"></i>
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    {{-- <a class="rounded scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> --}}


    <x-dashboard.scripts-footer />

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script>

        function initImagePreview(input) {
            if (!input || input.tagName !== 'INPUT' || input.type !== 'file') return;

            const container = input.closest('.form-group');
            if (!container) return;

            // Remove existing preview container if any
            const existingPreview = container.querySelector('.image-preview-container');
            if (existingPreview) {
                existingPreview.remove();
            }

            // Create preview container
            const previewContainer = document.createElement('div');
            previewContainer.className = 'image-preview-container';
            container.appendChild(previewContainer);

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.innerHTML = `
                            <div class="image-preview-wrapper">
                                <div class="image-preview-box">
                                    <img src="${e.target.result}" alt="Preview">
                                    <button type="button" class="image-preview-remove" onclick="removeImagePreview(this)">×</button>
                                </div>
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removeImagePreview(button) {
            const container = button.closest('.image-preview-container');
            const formGroup = container.closest('.form-group');
            const fileInput = formGroup.querySelector('input[type="file"]');

            if (fileInput) {
                fileInput.value = '';
            }
            container.innerHTML = '';
        }

        // Initialize all image inputs on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input[type="file"][name="image"], input[type="file"][name="banner_image"], input[type="file"][name*="image"]').forEach(function(input) {
                initImagePreview(input);
            });
        });
    </script>

    @livewireStyles
</body>

</html>
