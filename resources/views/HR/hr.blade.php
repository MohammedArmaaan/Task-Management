<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Dashboard</title>

    <!-- Include CSS framework and icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(135deg, #e0f2fe, #f9e2d9);
        font-family: 'Poppins', sans-serif;
        width: 100%;
        height: 100vh;
        margin: 0;
        overflow-x: hidden;
        color: #1e293b;
      }

      .wrapper {
        display: flex;
        width: 100%;
        height: 100%;
      }

      /* Sidebar Styling */
      .sidebar-wrapper {
        width: 270px;
        height: 100vh;
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
        padding: 2.5rem 1rem;
        width: calc(100% - 270px);
        background: #ffffff;
        height: 100%;
      }

      .container {
        max-width: 1400px;
        padding: 2rem 1rem;
      }

      h1 {
        font-weight: 700;
        color: #1e293b;
        letter-spacing: -0.8px;
        text-align: left;
        margin-bottom: 2rem;
        margin-top: 0;
        margin-left: 1rem;
        animation: fadeInDown 0.8s ease;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .card {
        margin: 12px;
        border-radius: 20px;
        border: none;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        overflow: hidden;
        position: relative;
        animation: cardBounceIn 0.8s ease forwards;
        animation-delay: calc(var(--card-index) * 0.2s);
      }

      .card:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        border-left: 8px solid;
      }

      .card.border-info:hover {
        border-left-color: #2dd4bf;
      }

      .card.border-danger:hover {
        border-left-color: #f43f5e;
      }

      .card.border-warning:hover {
        border-left-color: #f59e0b;
      }

      .card.border-success:hover {
        border-left-color: #10b981;
      }

      .card-body {
        padding: 2rem;
        position: relative;
        z-index: 1;
      }

      .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.05), transparent);
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 0;
      }

      .card:hover::before {
        opacity: 1;
      }

      .widgets-icons-2 {
        width: 65px;
        height: 65px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        border-radius: 50%;
        transition: all 0.5s ease;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.1));
      }

      .card:hover .widgets-icons-2 {
        transform: rotateY(360deg) scale(1.15);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        animation: pulseIcon 1s infinite;
      }

      .text-secondary {
        color: #6b7280 !important;
        font-size: 1rem;
        font-weight: 500;
        transition: color 0.3s ease;
      }

      .card:hover .text-secondary {
        color: #2dd4bf !important;
      }

      .btn-danger {
        border-radius: 10px;
        padding: 0.8rem 2.5rem;
        font-weight: 600;
        background: #f43f5e;
        border: none;
        transition: all 0.4s ease;
      }

      .btn-danger:hover {
        background: #e11d48;
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      }

      .alert {
        border-radius: 12px;
        margin-bottom: 2rem;
        animation: slideIn 0.7s ease;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
      }

      .border-info {
        border-left: 8px solid #2dd4bf !important;
      }

      .border-danger {
        border-left: 8px solid #f43f5e !important;
      }

      .border-warning {
        border-left: 8px solid #f59e0b !important;
      }

      .border-success {
        border-left: 8px solid #10b981 !important;
      }

      /* Animations */
      @keyframes slideIn {
        from {
          opacity: 0;
          transform: translateY(-40px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes slideInLeft {
        from {
          opacity: 0;
          transform: translateX(-120%);
        }
        to {
          opacity: 1;
          transform: translateX(0);
        }
      }

      @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-50px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes cardBounceIn {
        0% {
          opacity: 0;
          transform: scale(0.8) translateY(30px);
        }
        50% {
          opacity: 0.7;
          transform: scale(1.1) translateY(-10px);
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

      @keyframes pulseIcon {
        0% {
          transform: rotateY(360deg) scale(1.15);
          box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
        }
        50% {
          transform: rotateY(360deg) scale(1.2);
          box-shadow: 0 0 15px 5px rgba(255, 255, 255, 0.4);
        }
        100% {
          transform: rotateY(360deg) scale(1.15);
          box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
      }

      /* Two cards per row */
      .row-cols-custom-2 {
        display: flex;
        flex-wrap: wrap;
      }

      .row-cols-custom-2 > .col {
        flex: 0 0 50%;
        max-width: 50%;
      }

      @media (max-width: 992px) {
        .card {
          margin: 10px;
        }

        h1 {
          font-size: 1.9rem;
        }
      }

      @media (max-width: 768px) {
        .row-cols-custom-2 > .col {
          flex: 0 0 100%;
          max-width: 100%;
        }

        .btn-danger {
          width: 100%;
        }

        .sidebar-wrapper {
          position: fixed;
          width: 270px;
          transform: translateX(-100%);
          transition: transform 0.5s ease;
        }

        .sidebar-wrapper.active {
          transform: translateX(0);
        }

        .main-content {
          margin-left: 0;
          width: 100%;
        }

        .mobile-toggle-menu {
          display: block;
          cursor: pointer;
          font-size: 2rem;
          padding: 0.6rem;
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
        <!-- Navigation -->
        <ul class="metismenu" id="menu">
           <li>
        <a href="{{ route('tasks.create') }}">
            <div class="parent-icon"><i class='bx bx-plus-circle'></i></div>
            <div class="menu-title">Create Task</div>
        </a>
    </li>
    <li>
        <a href="{{ route('tasks.index') }}">
            <div class="parent-icon"><i class='bx bx-task'></i></div>
            <div class="menu-title">Assign Task</div>
        </a>
    </li>
    <li>
        <a href="{{ route('viewManager') }}">
            <div class="parent-icon"><i class='bx bx-user-check'></i></div>
            <div class="menu-title">View Manager</div>
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
        <!-- End Navigation -->
      </div>
      <!-- End Sidebar -->

      <!-- Main Content -->
      <div class="main-content">
        <div class="container">
          <div class="mobile-toggle-menu d-block d-md-none"><i class='bx bx-menu'></i></div>
          <h1>HR Dashboard</h1>

          <!-- Success and Error Messages -->
          @if (session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
          @endif
          @if (session('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
          @endif

          <!-- Dashboard Cards -->
          <div class="row row-cols-custom-2">
            <div class="col" style="--card-index: 1;">
              <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="mb-0 text-secondary">Total Users</p>
                    {{-- <h4 class="my-1 text-info">{{ $user_data }}</h4> --}}
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-info text-white">
                    <i class='bx bxs-group'></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col" style="--card-index: 2;">
              <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="mb-0 text-secondary">Employee List</p>
                    {{-- <h4 class="my-1 text-warning">{{ $employer_data }}</h4> --}}
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-danger text-white">
                    <i class="fa-solid fa-circle-info"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col" style="--card-index: 3;">
              <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="mb-0 text-secondary">Manager List</p>
                    {{-- <p class="my-1 text-danger">{{ $seeker_data }}</p> --}}
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-warning text-white">
                    <i class='bx bxs-wallet'></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col" style="--card-index: 4;">
              <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <p class="mb-0 text-secondary">Task List</p>
                  </div>
                  <div class="widgets-icons-2 rounded-circle bg-success text-white">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- end row -->
        </div> <!-- end container -->
      </div> <!-- end main-content -->
    </div> <!-- end wrapper -->
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Toggle sidebar on mobile
      document.querySelector('.mobile-toggle-menu').addEventListener('click', function() {
        document.querySelector('.sidebar-wrapper').classList.toggle('active');
      });
    </script>
  </body>
</html>