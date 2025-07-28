```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ url('images/job-search.png') }}" type="image/png"/>
    <title>Task Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            max-width: 800px; /* Adjusted for details width */
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

        /* Form Container Styling */
        .form-container {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 2rem;
            position: relative;
            animation: cardBounceIn 0.8s ease forwards;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }

        .form-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-left: 6px solid #2dd4bf;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1e293b;
            font-size: 1rem;
        }

        .form-group p {
            margin: 0;
            padding: 0.8rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            color: #1e293b;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .badge-danger {
            background: #f43f5e;
            color: #ffffff;
        }

        .badge-warning {
            background: #f59e0b;
            color: #ffffff;
        }

        .badge-success {
            background: #10b981;
            color: #ffffff;
        }

        .badge-secondary {
            background: #6b7280;
            color: #ffffff;
        }

        .btn-secondary, .btn-warning {
            padding: 0.8rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            transition: all 0.4s ease;
        }

        .btn-secondary {
            background: linear-gradient(90deg, #6b7280, #4b5563);
        }

        .btn-secondary:hover {
            background: linear-gradient(90deg, #4b5563, #374151);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .btn-warning {
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .btn-warning:hover {
            background: linear-gradient(90deg, #d97706, #b45309);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .btn-container {
            display: flex;
            gap: 1rem;
        }

        /* Alert Styling */
        .alert-success {
            border-radius: 10px;
            margin-bottom: 1.5rem;
            animation: slideIn 0.7s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-left: 6px solid #10b981;
            color: #1e293b;
            font-weight: 500;
            padding: 1rem;
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

            .form-group p, .badge {
                font-size: 0.85rem;
                padding: 0.7rem;
            }
        }

        @media (max-width: 992px) {
            .form-container {
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

            .form-container {
                padding: 1rem;
            }

            .btn-secondary, .btn-warning {
                width: 100%;
                padding: 0.8rem;
            }

            .btn-container {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
            }

            .form-group p, .badge {
                font-size: 0.8rem;
                padding: 0.6rem;
            }

            .alert-success {
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
        <a href="{{ route('dashboard.admin') }}">
            <div class="parent-icon"><i class='bx bx-plus-circle'></i></div>
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
            <div class="menu-title">Assign Task</div> {{-- You can rename if needed --}}
        </a>
    </li>
    <li>
        <a href="{{ route('tasks.index') }}">
            <div class="parent-icon"><i class='bx bx-user-check'></i></div>
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

        <!-- Main Content -->
        <div class="main-content">
            <div class="mobile-toggle-menu d-block d-md-none"><i class='bx bx-menu'></i></div>
            <div class="container mt-3">
                <h2>Task Details</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="form-container">
                    <div class="form-group">
                        <label><strong>Task Title:</strong></label>
                        <p>{{ $task->task_title }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Description:</strong></label>
                        <p>{{ $task->task_description }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Due Date:</strong></label>
                        <p>{{ \Carbon\Carbon::parse($task->task_due_date)->format('d M, Y') }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Priority:</strong></label>
                        <p class="badge badge-{{ $task->task_priority == 'high' ? 'danger' : ($task->task_priority == 'medium' ? 'warning' : 'success') }}">
                            {{ ucfirst($task->task_priority) }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p class="badge badge-{{ $task->task_status == 'completed' ? 'success' : ($task->task_status == 'ongoing' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($task->task_status) }}
                        </p>
                    </div>

                    <div class="form-group">
                        <label><strong>Assigned To:</strong></label>
                        <p>{{ $task->assignee->user_name ?? 'N/A' }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Created By:</strong></label>
                        <p>{{ $task->creator->user_name ?? 'N/A' }}</p>
                    </div>

                    <div class="btn-container">
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning mt-3">Edit Task</a>
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
