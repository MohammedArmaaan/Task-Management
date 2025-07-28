<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ url('images/eggs.jpg') }}" type="image/png"/>
    <title>Employee List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* General Styling */
        body {
            background: linear-gradient(135deg, #e0f2fe, #f9e2d9);
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            width: 100vw;
            min-height: 100vh;
            overflow-x: hidden;
            color: #1e293b;
            box-sizing: border-box;
        }

        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar-wrapper {
            width: 270px;
            min-height: 100vh;
            overflow-y: auto;
            background: linear-gradient(180deg, rgba(45, 212, 191, 0.95), rgba(79, 70, 229, 0.95));
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            animation: slideInLeft 0.7s ease-out;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-wrapper::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-wrapper::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }

        .sidebar-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            animation: pulse 1.5s infinite ease-in-out;
            color: #ffffff;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.8px;
            transition: transform 0.3s ease, text-shadow 0.3s ease;
        }

        .sidebar-header:hover .logo-text {
            transform: scale(1.1);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        .sidebar-close {
            display: none;
            font-size: 1.5rem;
            color: #ffffff;
            cursor: pointer;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .sidebar-close:hover {
            transform: scale(1.2);
            color: #fef3c7;
        }

        .metismenu .menu-title {
            font-weight: 500;
            font-size: 1rem;
            color: #e5e7eb;
        }

        .metismenu li a {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.5rem;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.1);
        }

        .metismenu li a:hover {
            background: #f43f5e;
            transform: translateX(10px) scale(1.02);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        .metismenu li a::before {
            content: '';
            position: absolute;
            left: -100%;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.4s ease;
            z-index: 0;
        }

        .metismenu li a:hover::before {
            left: 100%;
        }

        .parent-icon {
            margin-right: 12px;
            font-size: 1.4rem;
            transition: transform 0.4s ease, color 0.4s ease;
        }

        .metismenu li a:hover .parent-icon {
            transform: rotate(360deg) scale(1.2);
            color: #fef3c7;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 270px;
            padding: 1.5rem;
            width: calc(100% - 270px);
            background: #ffffff;
            min-height: 100vh;
            box-sizing: border-box;
            transition: margin-left 0.5s ease, width 0.5s ease;
        }

        .container {
            max-width: 1200px;
            padding: 1.5rem;
            margin: 0 auto;
        }

        h2 {
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.8px;
            text-align: left;
            margin-bottom: 1.5rem;
            margin-top: 0;
            font-size: 2rem;
            animation: fadeInDown 0.8s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #2dd4bf, #4f46e5);
            animation: expandLine 1s ease forwards;
        }

        /* Employee Records Styling */
        .employee-records {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            animation: cardBounceIn 0.8s ease forwards;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            margin-top: 1rem;
        }

        .employee-records:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .employee-records.table-container .table {
            margin-bottom: 0;
            width: 100%;
        }

        .employee-records.table-container thead {
            background: linear-gradient(90deg, #2dd4bf, #4f46e5);
            color: #ffffff;
            font-weight: 600;
        }

        .employee-records.table-container th,
        .employee-records.table-container td {
            padding: 1rem;
            vertical-align: middle;
            border: none;
            position: relative;
            transition: background 0.3s ease, color 0.3s ease;
            font-size: 0.9rem;
        }

        .employee-records.table-container tbody tr {
            transition: all 0.3s ease;
        }

        .employee-records.table-container tbody tr:hover {
            background: rgba(45, 212, 191, 0.1);
            transform: scale(1.01);
        }

        .employee-records.table-container tbody tr:hover td {
            color: #2dd4bf;
        }

        /* Vertical Records Styling (Mobile) */
        .employee-records.vertical-container {
            display: none;
            padding: 0.5rem;
        }

        .employee-record {
            padding: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .employee-record:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .employee-record:hover {
            background: rgba(45, 212, 191, 0.15);
            transform: scale(1.02) translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .employee-record:hover .record-value {
            color: #2dd4bf;
        }

        .record-label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
        }

        .record-value {
            font-size: 0.9rem;
            color: #1e293b;
            transition: color 0.3s ease;
        }

        .no-records {
            padding: 1rem;
            text-align: center;
            font-size: 0.9rem;
            color: #6b7280;
        }

        /* Alert Styling */
        .alert-success,
        .alert-danger {
            border-radius: 10px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.7s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-left: 6px solid;
            color: #1e293b;
            font-weight: 500;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        .alert-success {
            border-left-color: #10b981;
        }

        .alert-success::before,
        .alert-danger::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.2), transparent);
            animation: alertShine 3s infinite;
        }

        .alert-danger {
            border-left-color: #f43f5e;
        }

        /* Mobile Toggle Menu */
        .mobile-toggle-menu {
            display: none;
            cursor: pointer;
            font-size: 1.8rem;
            padding: 0.5rem;
            color: #2dd4bf;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mobile-toggle-menu:hover {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* Overlay for Sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.5s ease;
            opacity: 0;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes cardBounceIn {
            0% {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.05) translateY(-5px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(45, 212, 191, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px 10px rgba(45, 212, 191, 0.3);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(45, 212, 191, 0);
            }
        }

        @keyframes expandLine {
            from {
                width: 0;
            }
            to {
                width: 60px;
            }
        }

        @keyframes alertShine {
            0% {
                left: -100%;
            }
            50% {
                left: 100%;
            }
            100% {
                left: 100%;
            }
        }

        @keyframes slideInRow {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
                padding: 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            .employee-records.table-container th,
            .employee-records.table-container td,
            .record-label,
            .record-value {
                font-size: 0.85rem;
                padding: 0.8rem;
            }
        }

        @media (max-width: 992px) {
            .sidebar-wrapper {
                width: 250px;
            }

            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }

            .employee-records {
                margin: 0.5rem;
            }

            h2 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar-wrapper {
                width: 100%;
                max-width: 250px;
                transform: translateX(-100%);
                transition: transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            }

            .sidebar-wrapper.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .mobile-toggle-menu {
                display: block;
            }

            .sidebar-close {
                display: block;
            }

            .sidebar-overlay {
                display: none;
            }

            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }

            .employee-records.table-container {
                display: none;
            }

            .employee-records.vertical-container {
                display: block;
            }

            .record-label,
            .record-value {
                font-size: 0.8rem;
            }

            .employee-record {
                padding: 0.8rem;
            }

            h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            .alert-success,
            .alert-danger {
                font-size: 0.9rem;
                padding: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar-wrapper {
                max-width: 220px;
            }

            .sidebar-header {
                padding: 1.5rem 1rem;
            }

            .logo-text {
                font-size: 1.5rem;
            }

            .sidebar-close {
                font-size: 1.3rem;
            }

            .metismenu li a {
                padding: 0.7rem 1rem;
                font-size: 0.9rem;
            }

            .parent-icon {
                font-size: 1.2rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            .record-label,
            .record-value {
                font-size: 0.75rem;
            }

            .employee-record {
                padding: 0.6rem;
            }

            .alert-success,
            .alert-danger {
                font-size: 0.8rem;
                padding: 0.6rem;
            }

            .container {
                padding: 0.5rem;
            }
        }

        @media (max-width: 400px) {
            .sidebar-wrapper {
                max-width: 200px;
            }

            .logo-text {
                font-size: 1.3rem;
            }

            .sidebar-close {
                font-size: 1.2rem;
            }

            .metismenu li a {
                padding: 0.5rem 0.8rem;
                font-size: 0.8rem;
            }

            .parent-icon {
                font-size: 1rem;
            }

            h2 {
                font-size: 1rem;
            }

            .record-label,
            .record-value {
                font-size: 0.7rem;
            }

            .employee-record {
                padding: 0.5rem;
            }

            .alert-success,
            .alert-danger {
                font-size: 0.7rem;
                padding: 0.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <h4 class="logo-text">Task Manager</h4>
                </div>
                <i class="fas fa-times sidebar-close"></i>
            </div>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard.admin') }}">
                        <div class="parent-icon"><i class='bx bx-home'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.create') }}">
                        <div class="parent-icon"><i class='bx bx-plus-circle'></i></div>
                        <div class="menu-title">Create Task</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.index') }}">
                        <div class="parent-icon"><i class='bx bx-task'></i></div>
                        <div class="menu-title">Tasks List</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('viewEmployee') }}">
                        <div class="parent-icon"><i class='bx bx-user'></i></div>
                        <div class="menu-title">View Employee</div>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100" style="border: none; background: none; padding: 0;">
                            <a href="#" style="display: flex; align-items: center; color: #fef3c7; text-decoration: none;">
                                <div class="parent-icon"><i class='bx bx-log-out-circle'></i></div>
                                <div class="menu-title">Logout</div>
                            </a>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div class="main-content">
            <div class="mobile-toggle-menu d-block d-md-none"><i class='bx bx-menu'></i></div>
            <div class="container mt-3">
                <h2>Employee List</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Employee Records -->
                @if (isset($employees))
                    <div class="employee-records table-container">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    {{-- <th>Phone</th> --}}
                                    {{-- <th>Assigned Task</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr class="animate-row">
                                        <td>{{ $employee->user_name }}</td>
                                        <td>{{ $employee->user_email }}</td>
                                        <td>{{ ucfirst($employee->user_role) }}</td>
                                        {{-- <td>{{ $employee->user_phone ?? 'N/A' }}</td> --}}
                                        {{-- <td>
                                            <a href="{{ route('assigned.tasks', $employee->id) }}" class="btn btn-sm btn-info">
                                                View Assigned Tasks
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Vertical Layout -->
                    <div class="employee-records vertical-container">
                        @forelse ($employees as $employee)
                            <div class="employee-record animate-row">
                                <div class="record-label">Name</div>
                                <div class="record-value">{{ $employee->user_name }}</div>
                                <div class="record-label">Email</div>
                                <div class="record-value">{{ $employee->user_email }}</div>
                                <div class="record-label">Role</div>
                                <div class="record-value">{{ ucfirst($employee->user_role) }}</div>
                            </div>
                        @empty
                            <div class="no-records">No employees found.</div>
                        @endforelse
                    </div>
                @else
                    <div class="no-records">No employees found.</div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fade out alerts after 3 seconds with a smooth slide-up effect
            $('.alert-success').length && $('.alert-success').delay(3000).slideUp('slow', function() {
                $(this).remove();
            });
            $('.alert-danger').length && $('.alert-danger').delay(3000).slideUp('slow', function() {
                $(this).remove();
            });

            // Toggle sidebar on mobile with smooth animation
            $('.mobile-toggle-menu').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('.sidebar-wrapper').toggleClass('active');
                $('.sidebar-overlay').toggleClass('active');
            });

            // Close sidebar on close button click
            $('.sidebar-close').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('.sidebar-wrapper').removeClass('active');
                $('.sidebar-overlay').removeClass('active');
            });

            // Close sidebar on overlay click
            $('.sidebar-overlay').on('click', function(e) {
                e.preventDefault();
                $('.sidebar-wrapper').removeClass('active');
                $('.sidebar-overlay').removeClass('active');
            });

            // Close sidebar on menu item click in mobile view
            $('.metismenu li a').on('click', function() {
                if (window.innerWidth <= 768) {
                    $('.sidebar-wrapper').removeClass('active');
                    $('.sidebar-overlay').removeClass('active');
                }
            });

            // Prevent sidebar from closing when clicking inside it
            $('.sidebar-wrapper').on('click', function(e) {
                e.stopPropagation();
            });

            // Animate table rows and vertical records on load
            $('.employee-records.table-container tbody tr, .employee-records.vertical-container .employee-record').each(function(index) {
                $(this).css('animation-delay', `${index * 0.1}s`).addClass('animate-row');
            });
        });

        // Add class for row animation
        document.styleSheets[0].insertRule(`
            .animate-row {
                animation: slideInRow 0.6s ease forwards;
            }
        `, 0);
    </script>
</body>

</html>