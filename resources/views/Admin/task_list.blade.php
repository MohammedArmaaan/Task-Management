<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ url('images/eggs.jpg') }}" type="image/png" />
    <title>Task List</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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

        /* Task List Wrapper */
        .task-list-wrapper {
            width: 100%;
        }

        /* Search Bar Styling */
        .search-form {
            margin-bottom: 1.5rem;
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            animation: fadeInDown 0.8s ease;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .search-form:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .search-form .form-control {
            font-size: 0.95rem;
            border-radius: 10px;
            background: rgba(45, 212, 191, 0.1);
            border: 1px solid #2dd4bf;
            color: #1e293b;
            padding-left: 2.75rem;
            padding-right: 2.75rem;
            height: 44px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus {
            border-color: #2dd4bf;
            box-shadow: 0 0 10px rgba(45, 212, 191, 0.4);
            outline: none;
            background: rgba(45, 212, 191, 0.15);
        }

        .search-form .fa-search,
        .search-form .clear-search {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #2dd4bf;
            font-size: 1rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .search-form .fa-search {
            left: 0.75rem;
        }

        .search-form .clear-search {
            right: 0.75rem;
            cursor: pointer;
            display: none;
        }

        .search-form .fa-search:hover,
        .search-form .clear-search:hover {
            transform: translateY(-50%) scale(1.2);
            color: #1e293b;
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
            margin-bottom: 1.5rem;
            min-height: 350px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-left: 6px solid #2dd4bf;
        }

        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            transition: color 0.3s ease;
            padding-right: 100px;
        }

        .card:hover .card-title {
            color: #2dd4bf;
        }

        /* Edit Button Styling */
        .edit-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #f59e0b, #d97706);
            color: #ffffff;
            text-decoration: none;
            transition: all 0.4s ease;
        }

        .edit-btn:hover {
            background: linear-gradient(90deg, #d97706, #b45309);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        /* Two-Part Card Layout */
        .card-row {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        .card-left,
        .card-right {
            flex: 1;
            min-width: 0;
            padding: 0 0.5rem;
        }

        /* Form Styling */
        .task-form .form-group {
            margin-bottom: 1rem;
        }

        .task-form label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.9rem;
        }

        .task-form .form-control {
            font-size: 0.9rem;
            border-radius: 8px;
            background: rgba(45, 212, 191, 0.1);
            border: 1px solid #e5e7eb;
            color: #1e293b;
        }

        .task-form textarea.form-control {
            resize: none;
            height: 80px;
        }

        .task-form .form-control[readonly] {
            background: rgba(45, 212, 191, 0.1);
            opacity: 1;
        }

        .task-form .form-control:focus {
            border-color: #2dd4bf;
            box-shadow: 0 0 8px rgba(45, 212, 191, 0.3);
            outline: none;
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
            width: 100%;
        }

        .alert-success {
            border-color: #10b981;
        }

        .alert-danger {
            border-color: #ef4444;
        }

        /* No Tasks Message */
        .no-tasks {
            font-size: 1rem;
            color: #1e293b;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            margin-bottom: 1.5rem;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            animation: slideIn 0.7s ease;
            border-left: 6px solid #3b82f6;
            width: 100%;
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

            .card-title {
                font-size: 1.1rem;
            }

            .task-form label,
            .task-form .form-control,
            .search-form .form-control {
                font-size: 0.85rem;
            }

            .edit-btn {
                font-size: 0.75rem;
                padding: 0.3rem 0.6rem;
            }

            .search-form .fa-search,
            .search-form .clear-search {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 992px) {
            .card {
                margin: 0.5rem 0;
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

            .task-list-wrapper {
                width: 100%;
            }

            .card {
                min-height: auto;
            }

            .card-row {
                flex-direction: column;
            }

            .card-left,
            .card-right {
                padding: 0;
            }

            .edit-btn {
                top: 0.5rem;
                right: 0.5rem;
            }

            .search-form .form-control {
                height: 38px;
            }

            .search-form .fa-search,
            .search-form .clear-search {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
            }

            .card-title {
                font-size: 1rem;
                padding-right: 80px;
            }

            .task-form label,
            .task-form .form-control,
            .search-form .form-control {
                font-size: 0.8rem;
            }

            .edit-btn {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            .alert-success,
            .alert-danger {
                font-size: 0.9rem;
                padding: 0.8rem;
            }

            .no-tasks {
                font-size: 0.9rem;
                padding: 0.8rem;
            }

            .search-form .form-control {
                height: 36px;
            }

            .search-form .fa-search,
            .search-form .clear-search {
                font-size: 0.8rem;
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
                    <a href="{{ route('viewEmployee') }}">
                        <div class="parent-icon"><i class='bx bx-user'></i></div>
                        <div class="menu-title">View Employee</div>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="border: none; background: none; padding: 0; width: 100%;">
                            <a href="#"
                                style="display: flex; align-items: center; color: #fef3c7; text-decoration: none;">
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
                <h2>Task List</h2>

                @if (session('success'))
                    <div class="alert alert-success task-list-wrapper">{{ session('success') }}</div>
                @endif

                <div class="task-list-wrapper">
                    <form class="search-form">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="task-search"
                            placeholder="Search tasks by title...">
                        <i class="fas fa-times clear-search" style="display: none;"></i>
                    </form>

                    @if ($tasks->isEmpty())
                        <p class="no-tasks">No tasks available.</p>
                    @else
                        <div class="row task-list">
                            @foreach ($tasks as $task)
                                <div class="col-12 mb-4 task-item">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h5 class="card-title">{{ $task->task_title }}</h5>
                                                <div>
                                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                                        class="btn btn-sm btn-primary me-2">
                                                        <i class="fas fa-edit"></i> {{-- Edit --}}
                                                    </a>
                                                    <form action="{{ route('tasks.destroy', $task->id) }}"
                                                        method="POST" style="display: inline;"
                                                        onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> {{-- Delete --}}
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="card-row">
                                                <div class="card-left">
                                                    <form class="task-form">
                                                        <div class="form-group">
                                                            <label>Assignee</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $task->assignee->user_name ?? 'N/A' }}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Creator</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $task->creator->user_name ?? 'N/A' }}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Priority</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ ucfirst($task->task_priority) }}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ ucfirst($task->task_status) }}" readonly>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-right">
                                                    <form class="task-form">
                                                        <div class="form-group">
                                                            <label>Assigned Date</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($task->created_at)->format('d M, Y') }}"
                                                                readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Summary Notes</label>
                                                            <textarea class="form-control" readonly>{{ $task->task_description ?? 'No summary notes provided' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Due Date</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ \Carbon\Carbon::parse($task->task_due_date)->format('d M, Y') }}"
                                                                readonly>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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

            // Search functionality
            $('#task-search').on('input', function() {
                let searchValue = $(this).val().toLowerCase();
                $('.task-item').each(function() {
                    let title = $(this).find('.card-title').text().toLowerCase();
                    let assignee = $(this).find('.task-form input').eq(0).val().toLowerCase();
                    let creator = $(this).find('.task-form input').eq(1).val().toLowerCase();
                    let priority = $(this).find('.task-form input').eq(2).val().toLowerCase();
                    let status = $(this).find('.task-form input').eq(3).val().toLowerCase();
                    let dueDate = $(this).find('.task-form input').eq(4).val().toLowerCase();

                    if (
                        title.includes(searchValue) ||
                        assignee.includes(searchValue) ||
                        creator.includes(searchValue) ||
                        priority.includes(searchValue) ||
                        status.includes(searchValue) ||
                        dueDate.includes(searchValue)
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Show "No tasks available" if no tasks match
                if ($('.task-item:visible').length === 0 && searchValue !== '') {
                    $('.no-tasks').text('No tasks match your search.').show();
                } else if ($('.task-item').length === $('.task-item:hidden').length && searchValue === '') {
                    $('.no-tasks').text('No tasks available.').show();
                } else {
                    $('.no-tasks').hide();
                }

                // Toggle clear button visibility
                $('.clear-search').toggle(searchValue !== '');
            });

            // Clear search input
            $('.clear-search').on('click', function() {
                $('#task-search').val('').trigger('input');
            });
        });
    </script>
</body>

</html>
