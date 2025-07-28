```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ url('images/job-search.png') }}" type="image/png"/>
    <title>Assign Task to Employee</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            flex-direction: column;
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
        }

        /* Card Styling */
        .card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            position: relative;
            animation: cardBounceIn 0.8s ease forwards;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            border: none;
            width: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-left: 6px solid #2dd4bf;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            max-width: 500px;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #2dd4bf;
            box-shadow: 0 0 8px rgba(45, 212, 191, 0.3);
            outline: none;
        }

        .btn-primary {
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            transition: all 0.4s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8, #1e3a8a);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* Alert Styling */
        .alert-success, .alert-danger {
            border-radius: 10px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.7s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-left: 6px solid;
            color: #1e293b;
            font-weight: 500;
            padding: 1rem;
        }

        .alert-success {
            border-color: #10b981;
        }

        .alert-danger {
            border-color: #ef4444;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
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
            transition: transform 0.3s ease;
        }

        .mobile-toggle-menu:hover {
            transform: scale(1.1);
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
                padding: 1rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            .form-control {
                font-size: 0.85rem;
                padding: 0.6rem;
            }

            .btn-primary {
                font-size: 0.85rem;
                padding: 0.6rem 1.2rem;
            }
        }

        @media (max-width: 992px) {
            .card {
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
                transition: transform 0.5s ease;
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

            .card-body {
                padding: 1rem;
            }

            .form-control {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
            }

            .form-control {
                font-size: 0.8rem;
                padding: 0.5rem;
            }

            .btn-primary {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }

            .alert-success, .alert-danger {
                font-size: 0.9rem;
                padding: 0.8rem;
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
            </div>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard.employee') }}">
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
                        <div class="menu-title">Task List</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tasks.assigned') }}">
                        <div class="parent-icon"><i class='bx bx-task'></i></div>
                        <div class="menu-title">Assigned Tasks</div>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="border: none; background: none; padding: 0; width: 100%;">
                            <a href="#" style="display: flex; align-items: center; color: #fef3c7; text-decoration: none;">
                                <div class="parent-icon"><i class='bx bx-log-out-circle'></i></div>
                                <div class="menu-title">Logout</div>
                            </a>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="mobile-toggle-menu d-block d-md-none"><i class='bx bx-menu'></i></div>
            <div class="container mt-3">
                <h2>Assign Task to Employee</h2>

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mt-4">
                    <div class="card-body">
                        <form action="{{ route('tasks.assign') }}" method="POST">
    @csrf
    <!-- Add select dropdown for employee -->
    <div class="mb-3">
        <label for="employee_id" class="form-label">Assign To</label>
        <select name="employee_id" id="employee_id" class="form-select" required>
            @foreach($tasks as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Add select/dropdown/input for task -->
    <div class="mb-3">
        <label for="task_id" class="form-label">Select Task</label>
        <select name="task_id" id="task_id" class="form-select" required>
            @foreach($tasks as $task)
                <option value="{{ $task->id }}">{{ $task->title }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Assign Task</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fade out alerts after 3 seconds
            if ($('.alert-success').length > 0) {
                $('.alert-success').delay(3000).fadeOut('slow');
            }
            if ($('.alert-danger').length > 0) {
                $('.alert-danger').delay(3000).fadeOut('slow');
            }

            // Toggle sidebar on mobile
            $('.mobile-toggle-menu').on('click', function() {
                $('.sidebar-wrapper').toggleClass('active');
            });
        });
    </script>
</body>

</html>