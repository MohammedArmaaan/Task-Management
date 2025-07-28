<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="{{ url('images/job-search.png') }}" type="image/png"/>
    <title>My Assigned Tasks</title>
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

        /* Table Styling (Card-Like) */
        .table {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            animation: cardBounceIn 0.8s ease forwards;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            border: none;
            width: 100%;
        }

        .table:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border-left: 6px solid #2d54d4;
        }

        .table thead {
            background: linear-gradient(90deg, #2dd4bf, #4f46e5);
            color: #ffffff;
            font-weight: 600;
        }

        .table th, .table td {
            padding: 1rem;
            vertical-align: middle;
            border: none;
            position: relative;
            transition: background 0.3s ease;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: all 0.3 station ease;
        }

        .table tbody tr:hover {
            background: rgba(45, 212, 191, 0.1);
            transform: scale(1.01);
        }

        .table tbody tr:hover td {
            color: #000000;
        }

        /* Completed Task Styling */
        .task-completed {
            background: rgba(16, 185, 129, 0.2) !important; /* Light green */
        }

        .task-completed td {
            color: #006810 !important; /* Darker green for text */
        }

        /* Due Date Highlight Classes */
        .due-soon-yellow {
            background: rgb(232, 239, 38) !important; /* Softer yellow */
        }

        .due-soon-orange {
            background: rgb(223, 123, 42) !important; /* Softer orange */
        }

        .due-soon-red {
            background: rgb(219, 66, 66) !important; /* Softer red */
        }

        /* Update Status Form Styling */
        .update-status-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Form Styling */
        .form-control {
            width: 150px;
            padding: 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 0.85rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: rgba(45, 212, 191, 0.1);
            color: #1e293b;
        }

        .form-control:focus {
            border-color: #2dd4bf;
            box-shadow: 0 0 8px rgba(45, 212, 191, 0.3);
            outline: none;
        }

        .btn-success {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: all 0.4s ease;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #059669, #047857);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* Alert Styling */
        .alert-success, .alert-info {
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

        .alert-info {
            border-color: #3b82f6;
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

        /* Search Bar Styling */
        .task-list-wrapper {
            width: 100%;
        }

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
            background: rgba(45, 212, 191, 0.15);
            outline: none;
        }

        .search-form .fa-search, .search-form .clear-search {
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

        .search-form .fa-search:hover, .search-form .clear-search:hover {
            transform: translateY(-50%) scale(1.2);
            color: #1e293b;
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

            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.8rem;
            }

            .form-control, .btn-success {
                font-size: 0.8rem;
                padding: 0.4rem;
            }

            .search-form .form-control {
                font-size: 0.85rem;
            }

            .search-form .fa-search, .search-form .clear-search {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 992px) {
            .table {
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

            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .table thead, .table tbody, .table tr, .table th, .table td {
                display: table-cell;
            }

            .form-control {
                width: 120px;
            }

            .btn-success {
                padding: 0.4rem 0.8rem;
            }

            .search-form .form-control {
                height: 38px;
            }

            .search-form .fa-search, .search-form .clear-search {
                font-size: 0.85rem;
            }

            .update-status-form {
                gap: 0.4rem;
            }

            .update-status-form .form-control {
                width: 100px;
            }

            .update-status-form .btn-success {
                padding: 0.4rem 0.6rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.4rem;
            }

            .table th, .table td {
                font-size: 0.8rem;
                padding: 0.6rem;
            }

            .form-control, .btn-success {
                font-size: 0.75rem;
                padding: 0.3rem;
            }

            .alert-success, .alert-info {
                font-size: 0.9rem;
                padding: 0.8rem;
            }

            .search-form .form-control {
                height: 36px;
                font-size: 0.8rem;
            }

            .search-form .fa-search, .search-form .clear-search {
                font-size: 0.8rem;
            }

            .update-status-form {
                gap: 0.3rem;
            }

            .update-status-form .form-control {
                width: 90px;
            }

            .update-status-form .btn-success {
                padding: 0.3rem 0.5rem;
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
                        <div class="menu-title">Create Tasks</div>
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
                <h2>My Assigned Tasks</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="task-list-wrapper">
                    <form class="search-form">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="task-search" placeholder="Search tasks...">
                        <i class="fas fa-times clear-search" style="display: none;"></i>
                    </form>

                    @if ($tasks->count())
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Due Date</th>
                                        <th>Summary Notes</th>
                                        <th>Priority</th>
                                        <th>Assigned By</th>
                                        <th>Status</th> 
                                        <th>Update Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr class="task-item {{ $task->task_status == 'completed' ? 'task-completed' : '' }}" data-due-date="{{ $task->task_due_date }}">
                                            <td>{{ $task->task_title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($task->task_due_date)->format('d M Y') }}</td>
                                            <td>{{ $task->task_description ?? 'No summary notes provided' }}</td>
                                            <td>{{ ucfirst($task->task_priority) }}</td>
                                            <td>{{ $task->creator->user_name ?? 'N/A' }}</td>
                                            <td><strong>{{ ucfirst($task->task_status) }}</strong></td>
                                            <td>
                                                <form action="{{ route('employee.task.update', $task->id) }}" method="POST" class="update-status-form">
                                                    @csrf
                                                    <select name="task_status" class="form-control d-inline-block text-dark">
                                                        <option value="pending" {{ $task->task_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="process" {{ $task->task_status == 'process' ? 'selected' : '' }}>Process</option>
                                                        <option value="completed" {{ $task->task_status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">You have no assigned tasks.</div>
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
            if ($('.alert-info').length > 0) {
                $('.alert-info').delay(3000).fadeOut('slow');
            }

            // Toggle sidebar on mobile
            $('.mobile-toggle-menu').on('click', function() {
                $('.sidebar-wrapper').toggleClass('active');
            });

            // Highlight rows based on due date
            function highlightDueDates() {
                $('.task-item').each(function() {
                    // Skip completed tasks for due date highlights
                    if ($(this).hasClass('task-completed')) {
                        return;
                    }
                    let dueDateStr = $(this).data('due-date');
                    let dueDate = new Date(dueDateStr);
                    let today = new Date();
                    today.setHours(0, 0, 0, 0); // Normalize to midnight
                    dueDate.setHours(0, 0, 0, 0); // Normalize to midnight

                    // Calculate difference in days
                    let timeDiff = dueDate - today;
                    let daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                    // Remove existing highlight classes
                    $(this).removeClass('due-soon-yellow due-soon-orange due-soon-red');

                    // Apply highlight class based on days remaining
                    if (daysDiff === 5) {
                        $(this).addClass('due-soon-yellow');
                    } else if (daysDiff === 4) {
                        $(this).addClass('due-soon-orange');
                    } else if (daysDiff <= 3 && daysDiff >= 0) {
                        $(this).addClass('due-soon-red');
                    }
                });
            }

            // Call highlight function on page load
            highlightDueDates();

            // Search functionality
            $('#task-search').on('input', function() {
                let searchValue = $(this).val().toLowerCase();
                $('.task-item').each(function() {
                    let title = $(this).find('td').eq(0).text().toLowerCase();
                    let dueDate = $(this).find('td').eq(1).text().toLowerCase();
                    let description = $(this).find('td').eq(2).text().toLowerCase();
                    let priority = $(this).find('td').eq(3).text().toLowerCase();
                    let assignedBy = $(this).find('td').eq(4).text().toLowerCase();
                    let status = $(this).find('td').eq(5).text().toLowerCase();
                    if (
                        title.includes(searchValue) ||
                        dueDate.includes(searchValue) ||
                        description.includes(searchValue) ||
                        priority.includes(searchValue) ||
                        assignedBy.includes(searchValue) ||
                        status.includes(searchValue)
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Toggle alert based on search results
                if ($('.task-item:visible').length === 0 && searchValue !== '') {
                    $('.alert-info').text('No tasks match your search.').show();
                } else if ($('.task-item').length === $('.task-item:hidden').length && searchValue === '') {
                    $('.alert-info').text('You have no assigned tasks.').show();
                } else {
                    $('.alert-info').hide();
                }

                // Toggle clear button visibility
                $('.clear-search').toggle(searchValue !== '');

                // Reapply due date highlights after search
                highlightDueDates();
            });

            // Clear search input
            $('.clear-search').on('click', function() {
                $('#task-search').val('').trigger('input');
            });
        });
    </script>
</body>

</html>