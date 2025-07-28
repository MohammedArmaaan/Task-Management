<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Task Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f2fe, #f9e2d9);
            font-family: 'Poppins', sans-serif;
            width: 100%;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
            color: #1e293b;
        }

        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar-wrapper {
            width: 270px;
            height: 100vh;
            overflow-y: auto;
            background: linear-gradient(180deg, rgba(45, 212, 191, 0.95), rgba(79, 70, 229, 0.95));
            backdrop-filter: blur(12px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
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
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
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
            transform: scale(1.05);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        .close-sidebar {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #ffffff;
            transition: transform 0.3s ease;
        }

        .close-sidebar:hover {
            transform: scale(1.1);
        }

        .metismenu .menu-title {
            font-weight: 500;
            font-size: 1rem;
            color: #e5e7eb;
        }

        .metismenu li a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.2rem;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0.5rem 0.8rem;
            background: rgba(255, 255, 255, 0.1);
            font-size: 0.95rem;
        }

        .metismenu li a:hover {
            background: #f43f5e;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .parent-icon {
            margin-right: 10px;
            font-size: 1.3rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .metismenu li a:hover .parent-icon {
            transform: rotate(360deg);
            color: #fef3c7;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 270px;
            padding: 1.5rem;
            width: calc(100% - 270px);
            background: #ffffff;
            min-height: 100vh;
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .container {
            max-width: 1400px;
            padding: 1rem;
        }

        h1 {
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.8px;
            margin-bottom: 1.2rem;
            margin-top: 0;
            animation: fadeInDown 0.8s ease;
        }

        .card {
            margin: 8px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.95), rgba(243, 244, 246, 0.95));
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            border-left: 5px solid;
        }

        .card.border-warning:hover {
            border-left-color: #f59e0b;
        }

        .card-body {
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .btn {
            border-radius: 8px;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            touch-action: manipulation;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background: #10b981;
            border: none;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
        }

        .btn-warning:hover {
            background: #d97706;
        }

        .btn-dark {
            background: #1e293b;
            border: none;
        }

        .btn-dark:hover {
            background: #111827;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);
        }

        .border-warning {
            border-left: 5px solid #f59e0b !important;
        }

        /* Attendance Card */
        .attendance-card {
            background: linear-gradient(145deg, #ffffff, #e6f3ff);
            border-radius: 12px;
            padding: 1.2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .attendance-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.2), transparent);
            transform: rotate(45deg);
            z-index: 0;
        }

        .attendance-card .card-body {
            position: relative;
            z-index: 1;
        }

        .attendance-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin-bottom: 1rem;
        }

        .timer-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin: 0.3rem;
        }

        .timer-container h6 {
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 0.6rem;
        }

        .timer-container #checkInTimer,
        .timer-container #checkOutTimer,
        .timer-container #totalWorkingTime {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2dd4bf;
            letter-spacing: 1px;
        }

        .timer-section {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            justify-content: center;
        }

        /* Mobile Toggle */
        .mobile-toggle-menu {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0.5rem;
            color: #2dd4bf;
            position: fixed;
            top: 0.5rem;
            left: 0.5rem;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 6px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .mobile-toggle-menu:hover {
            transform: scale(1.05);
        }

        /* Sidebar Backdrop */
        .sidebar-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-backdrop.active {
            display: block;
            opacity: 1;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes cardBounceIn {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.02);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(45, 212, 191, 0.7);
            }

            50% {
                transform: scale(1.03);
                box-shadow: 0 0 10px 5px rgba(45, 212, 191, 0.3);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(45, 212, 191, 0);
            }
        }

        /* Media Queries */
        @media (max-width: 1200px) {
            .main-content {
                padding: 1.2rem;
            }

            .container {
                padding: 0.8rem;
            }

            h1 {
                font-size: 1.6rem;
            }

            .card-body {
                padding: 1.2rem;
            }

            .timer-container {
                padding: 0.8rem;
            }

            .timer-container #checkInTimer,
            .timer-container #checkOutTimer,
            .timer-container #totalWorkingTime {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 992px) {
            .sidebar-wrapper {
                width: 240px;
            }

            .main-content {
                margin-left: 240px;
                width: calc(100% - 240px);
            }

            .card,
            .attendance-card {
                margin: 6px;
            }

            h1 {
                font-size: 1.4rem;
            }

            .btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }

            .timer-container h6 {
                font-size: 0.9rem;
            }

            .timer-container #checkInTimer,
            .timer-container #checkOutTimer,
            .timer-container #totalWorkingTime {
                font-size: 1.3rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar-wrapper {
                width: 260px;
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar-wrapper.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 3rem 0.5rem 1rem;
            }

            .container {
                padding: 0.5rem;
            }

            .mobile-toggle-menu {
                display: block;
                z-index: 1001;
            }

            .sidebar-backdrop {
                display: none;
            }

            .sidebar-wrapper.active+.sidebar-backdrop {
                display: block;
            }

            .close-sidebar {
                display: block;
            }

            .attendance-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn {
                width: 100%;
                padding: 0.7rem;
                font-size: 0.9rem;
                min-height: 44px;
            }

            .timer-section {
                flex-direction: column;
                gap: 0.5rem;
            }

            .timer-container {
                margin: 0.3rem 0;
                padding: 0.7rem;
            }

            .timer-container h6 {
                font-size: 0.85rem;
            }

            .timer-container #checkInTimer,
            .timer-container #checkOutTimer,
            .timer-container #totalWorkingTime {
                font-size: 1.2rem;
            }

            h1 {
                font-size: 1.3rem;
                text-align: center;
            }

            .attendance-card {
                padding: 0.8rem;
            }

            .card-body {
                padding: 1rem;
            }

            .metismenu li a {
                padding: 0.7rem 1rem;
                font-size: 0.9rem;
            }

            .parent-icon {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .sidebar-wrapper {
                width: 220px;
            }

            .sidebar-header {
                padding: 1rem 0.8rem;
            }

            .logo-text {
                font-size: 1.4rem;
            }

            .metismenu li a {
                padding: 0.6rem 0.8rem;
                font-size: 0.85rem;
            }

            .parent-icon {
                font-size: 1.1rem;
            }

            h1 {
                font-size: 1.2rem;
            }

            .btn {
                padding: 0.6rem;
                font-size: 0.8rem;
            }

            .timer-container {
                padding: 0.6rem;
            }

            .timer-container h6 {
                font-size: 0.8rem;
            }

            .timer-container #checkInTimer,
            .timer-container #checkOutTimer,
            .timer-container #totalWorkingTime {
                font-size: 1.1rem;
            }

            .card,
            .attendance-card {
                margin: 4px;
            }

            .container {
                padding: 0.4rem;
            }
        }

        @media (max-width: 400px) {
            .sidebar-wrapper {
                width: 200px;
            }

            .logo-text {
                font-size: 1.2rem;
            }

            .metismenu li a {
                padding: 0.5rem 0.6rem;
                font-size: 0.8rem;
            }

            .parent-icon {
                font-size: 1rem;
            }

            h1 {
                font-size: 1rem;
            }

            .btn {
                padding: 0.5rem;
                font-size: 0.75rem;
            }

            .timer-container {
                padding: 0.5rem;
            }

            .timer-container h6 {
                font-size: 0.75rem;
            }

            .timer-container #checkInTimer,
            .timer-container #checkOutTimer,
            .timer-container #totalWorkingTime {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    @php
        use Illuminate\Support\Facades\Auth;
        $authUser = Auth::guard('user')->user();
    @endphp

    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <h4 class="logo-text">Task Manager</h4>
                </div>
                <i class="bx bx-x close-sidebar"></i>
            </div>

            <ul class="metismenu" id="menu">
                <li>
                    <a
                        href="{{ $authUser->user_role === 'admin' ? route('dashboard.admin') : route('dashboard.employee') }}">
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
                    <a
                        href="{{ $authUser->user_role === 'admin' ? route('tasks.assignedtask') : route('tasks.assigned') }}">
                        <div class="parent-icon"><i class='bx bx-task'></i></div>
                        <div class="menu-title">Assigned Tasks</div>
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100"
                            style="border: none; background: none; padding: 0;">
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

        <div class="sidebar-backdrop"></div>

        <div class="main-content">
            <div class="container">
                <div class="mobile-toggle-menu d-block d-md-none"><i class='bx bx-menu'></i></div>
                <h1>
                    {!! $authUser->user_role === 'admin' ? 'Admin Dashboard' : 'Welcome Back<br>' . e($authUser->user_name) !!}
                </h1>

                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="attendance-card border-warning">
                            <div class="card-body">
                                <h4 class="mb-4">Attendance Sheet</h4>
                                <div class="attendance-buttons">
                                    <form action="{{ route('attendance.present') }}" method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-success"
                                            onclick="checkLocationAndSubmit('present')">Present</button>
                                    </form>

                                    <form action="{{ route('attendance.checkin') }}" method="POST">
                                        @csrf
                                        <button type="button" class="btn btn-primary"
                                            onclick="checkLocationAndSubmit('checkin')">Check In</button>
                                    </form>

                                    <form action="{{ route('attendance.checkout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning" type="submit">Check Out</button>
                                    </form>

                                    <form id="goingHomeForm" action="{{ route('attendance.going') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="work_seconds" id="workSecondsInput" value="0">
                                        <input type="hidden" name="break_seconds" id="breakSecondsInput"
                                            value="0">
                                        <button class="btn btn-dark" type="submit">Going Home</button>
                                    </form>
                                </div>

                                <div class="timer-section">
                                    <div class="timer-container">
                                        <h6>Check-In Time</h6>
                                        <div id="checkInTimer">00:00:00</div>
                                    </div>
                                    <div class="timer-container">
                                        <h6>Break Time</h6>
                                        <div id="checkOutTimer">00:00:00</div>
                                    </div>
                                    <div class="timer-container">
                                        <h6>Total Working Time</h6>
                                        <div id="totalWorkingTime">{{ session('total_working_time') ?? '00:00:00' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- without auto checkout funcnality --}}
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.mobile-toggle-menu').addEventListener('click', () => {
            document.querySelector('.sidebar-wrapper').classList.toggle('active');
            document.querySelector('.sidebar-backdrop').classList.toggle('active');
        });

        // Close sidebar when clicking backdrop or close button
        document.querySelector('.sidebar-backdrop').addEventListener('click', () => {
            document.querySelector('.sidebar-wrapper').classList.remove('active');
            document.querySelector('.sidebar-backdrop').classList.remove('active');
        });

        document.querySelector('.close-sidebar').addEventListener('click', () => {
            document.querySelector('.sidebar-wrapper').classList.remove('active');
            document.querySelector('.sidebar-backdrop').classList.remove('active');
        });

        //Timer Logic
        let checkInSeconds = parseInt(localStorage.getItem('checkInSeconds')) || 0;
        let breakSeconds = parseInt(localStorage.getItem('breakSeconds')) || 0;
        let checkInRunning = localStorage.getItem('checkInRunning') === 'true';
        let breakRunning = localStorage.getItem('breakRunning') === 'true';

        function formatTime(seconds) {
            const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
            const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
            const s = String(seconds % 60).padStart(2, '0');
            return `${h}:${m}:${s}`;
        }

        function updateDisplay() {
            document.getElementById('checkInTimer').innerText = formatTime(checkInSeconds);
            document.getElementById('checkOutTimer').innerText = formatTime(breakSeconds);
            document.getElementById('workSecondsInput').value = checkInSeconds;
            document.getElementById('breakSecondsInput').value = breakSeconds;
        }

        function calculateElapsedTime() {
            const now = new Date();

            if (checkInRunning && localStorage.getItem('checkInTime')) {
                const start = new Date(localStorage.getItem('checkInTime'));
                const elapsed = Math.floor((now - start) / 1000);
                checkInSeconds = (parseInt(localStorage.getItem('checkInBaseSeconds')) || 0) + elapsed;
                localStorage.setItem('checkInSeconds', checkInSeconds);
            }

            if (breakRunning && localStorage.getItem('checkOutTime')) {
                const start = new Date(localStorage.getItem('checkOutTime'));
                const elapsed = Math.floor((now - start) / 1000);
                breakSeconds = (parseInt(localStorage.getItem('breakBaseSeconds')) || 0) + elapsed;
                localStorage.setItem('breakSeconds', breakSeconds);
            }

            updateDisplay();
        }

        function startCheckIn() {
            checkInRunning = true;
            breakRunning = false;
            localStorage.setItem('checkInRunning', 'true');
            localStorage.setItem('breakRunning', 'false');
            localStorage.setItem('checkInTime', new Date().toISOString());
            localStorage.removeItem('checkOutTime');
        }

        function startCheckOut() {
            if (!checkInRunning) {
                alert("Please check in first.");
                return false;
            }

            checkInRunning = false;
            breakRunning = true;
            localStorage.setItem('checkInRunning', 'false');
            localStorage.setItem('breakRunning', 'true');
            localStorage.setItem('checkOutTime', new Date().toISOString());
            localStorage.setItem('checkInBaseSeconds', checkInSeconds);
            localStorage.removeItem('checkInTime');
            return true;
        }

        function resetTimers() {
            checkInSeconds = 0;
            breakSeconds = 0;
            checkInRunning = false;
            breakRunning = false;

            localStorage.removeItem('checkInSeconds');
            localStorage.removeItem('breakSeconds');
            localStorage.removeItem('checkInRunning');
            localStorage.removeItem('breakRunning');
            localStorage.removeItem('checkInTime');
            localStorage.removeItem('checkOutTime');
            localStorage.removeItem('checkInBaseSeconds');
            localStorage.removeItem('breakBaseSeconds');
            localStorage.removeItem('isPresentMarked');

            updateDisplay();
        }

        window.addEventListener('DOMContentLoaded', () => {
            const checkOutForm = document.querySelector('form[action$="checkout"]');
            const goingForm = document.getElementById('goingHomeForm');

            if (checkInRunning && !localStorage.getItem('checkInTime')) {
                localStorage.setItem('checkInTime', new Date().toISOString());
            }

            if (breakRunning && !localStorage.getItem('checkOutTime')) {
                localStorage.setItem('checkOutTime', new Date().toISOString());
            }

            calculateElapsedTime();
            setInterval(calculateElapsedTime, 1000);

            if (checkOutForm) {
                checkOutForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    if (localStorage.getItem('isPresentMarked') !== 'true') {
                        alert("Please mark Present first.");
                        return;
                    }
                    localStorage.setItem('breakBaseSeconds', breakSeconds);
                    if (startCheckOut()) {
                        setTimeout(() => e.target.submit(), 100);
                    }
                });
            }

            if (goingForm) {
                goingForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    if (localStorage.getItem('isPresentMarked') !== 'true') {
                        alert("Please mark Present first.");
                        return;
                    }
                    calculateElapsedTime();
                    document.getElementById('workSecondsInput').value = checkInSeconds;
                    document.getElementById('breakSecondsInput').value = breakSeconds;

                    setTimeout(() => {
                        goingForm.submit();
                        resetTimers();
                    }, 100);
                });
            }

            updateDisplay();
        });

        // Geolocation Logic
        const officeLat = 23.008780;
        const officeLng = 72.581048;
        const allowedDistance = 300;

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3;
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function checkLocationAndSubmit(action) {
            if (!navigator.geolocation) {
                alert("Geolocation not supported.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    const distance = calculateDistance(userLat, userLng, officeLat, officeLng);
                    console.log("Your coordinates:", userLat, userLng);
                    console.log("Distance from office:", distance, "meters");

                    if (distance <= allowedDistance) {
                        if (action === 'present') {
                            localStorage.setItem('isPresentMarked', 'true');
                            document.querySelector('form[action$="present"]').submit();

                        } else if (action === 'checkin') {
                            if (localStorage.getItem('isPresentMarked') !== 'true') {
                                alert("Please mark Present first.");
                                return;
                            }
                            localStorage.setItem('checkInBaseSeconds', checkInSeconds);
                            startCheckIn();
                            setTimeout(() => {
                                document.querySelector('form[action$="checkin"]').submit();
                            }, 100);
                        }
                    } else {
                        alert(`You're ${Math.round(distance)} meters away from office. Please be within 200m range.`);
                    }
                },
                (error) => {
                    alert("Location error: " + error.message);
                }
            );
        }
    </script>
</body>

</html>
