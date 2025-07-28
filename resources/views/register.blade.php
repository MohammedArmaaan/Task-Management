<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(45deg, #ffffff, #2dd4bf, #1e293b);
        background-size: 400%;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        height: 100vh;
        margin: 0;
        overflow-x: hidden;
        color: #1e293b;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: gradientShift 12s ease infinite;
      }

      .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 2rem 1rem;
      }

      .register-box {
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.9), rgba(243, 244, 246, 0.9));
        backdrop-filter: blur(12px);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 420px;
        animation: scaleIn 0.8s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
      }

      .register-box:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      }

      h2 {
        font-weight: 700;
        color: #1e293b;
        letter-spacing: -0.8px;
        text-align: center;
        margin-bottom: 2rem;
        animation: fadeInDown 0.8s ease;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .form-group {
        margin-bottom: 20px;
        opacity: 0;
        animation: bounceIn 0.6s ease-out forwards;
        animation-delay: calc(0.2s * var(--i));
      }

      .form-group:nth-child(1) { --i: 1; }
      .form-group:nth-child(2) { --i: 2; }
      .form-group:nth-child(3) { --i: 3; }
      .form-group:nth-child(4) { --i: 4; }

      label {
        display: block;
        font-size: 0.875rem;
        color: #4a5568;
        font-weight: 500;
        margin-bottom: 8px;
        transition: transform 0.3s ease, color 0.3s ease;
      }

      label:hover {
        transform: translateX(6px);
        color: #2dd4bf;
      }

      input[type="text"],
      input[type="email"],
      input[type="password"],
      select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        background: rgba(255, 255, 255, 0.95);
        color: #2d3748;
        transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
      }

      input:focus,
      select:focus {
        border-color: #2dd4bf;
        box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.2);
        outline: none;
        transform: translateY(-2px);
      }

      input::placeholder,
      select::placeholder {
        color: #a0aec0;
        transition: opacity 0.3s ease;
      }

      input:focus::placeholder,
      select:focus::placeholder {
        opacity: 0.5;
      }

      select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%234a5568' width='16' height='16'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        cursor: pointer;
      }

      select:hover {
        transform: translateY(-2px);
      }

      select option {
        padding: 10px;
        background: #ffffff;
        color: #2d3748;
        animation: fadeInSlide 0.3s ease-out forwards;
      }

      button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(90deg, #2dd4bf, #4f46e5);
        border: none;
        border-radius: 10px;
        color: #ffffff;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.4s ease;
        animation: slideIn 0.7s ease forwards;
        animation-delay: 0.8s;
        position: relative;
        overflow: hidden;
      }

      button:hover {
        background: linear-gradient(90deg, #26a69a, #3730a3);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(45, 212, 191, 0.4);
        animation: pulseButton 1.2s infinite ease-in-out;
      }

      button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
      }

      button:hover::before {
        left: 100%;
      }

      button:active {
        transform: translateY(0);
      }

      p.error {
        color: #f43f5e;
        font-size: 0.875rem;
        text-align: center;
        margin-bottom: 16px;
        animation: fadeInSlide 0.5s ease;
      }

      p.success {
        color: #10b981;
        font-size: 0.875rem;
        text-align: center;
        margin-bottom: 16px;
        animation: fadeInSlide 0.5s ease;
      }

      p.message {
        text-align: center;
        font-size: 0.875rem;
        color: #4a5568;
        margin-top: 20px;
        opacity: 0;
        animation: fadeInSlide 0.7s ease forwards;
        animation-delay: 1s;
      }

      a {
        color: #2dd4bf;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
      }

      a:hover {
        color: #26a69a;
        text-decoration: underline;
      }

      /* Animations */
      @keyframes gradientShift {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

      @keyframes scaleIn {
        0% {
          opacity: 0;
          transform: scale(0.8);
        }
        50% {
          opacity: 0.7;
          transform: scale(1.05);
        }
        100% {
          opacity: 1;
          transform: scale(1);
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

      @keyframes bounceIn {
        0% {
          opacity: 0;
          transform: scale(0.8) translateY(20px);
        }
        50% {
          opacity: 0.7;
          transform: scale(1.1) translateY(-5px);
        }
        100% {
          opacity: 1;
          transform: scale(1) translateY(0);
        }
      }

      @keyframes fadeInSlide {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @keyframes pulseButton {
        0% {
          transform: translateY(-2px);
          box-shadow: 0 8px 20px rgba(45, 212, 191, 0.4);
        }
        50% {
          transform: translateY(-2px) scale(1.02);
          box-shadow: 0 12px 24px rgba(45, 212, 191, 0.6);
        }
        100% {
          transform: translateY(-2px);
          box-shadow: 0 8px 20px rgba(45, 212, 191, 0.4);
        }
      }

      @media (max-width: 480px) {
        .register-box {
          padding: 1.5rem;
          max-width: 95%;
        }

        h2 {
          font-size: 1.5rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="register-box">
        <h2>Register</h2>
        @if(session('error'))
          <p class="error">{{ session('error') }}</p>
        @endif
        @if(session('success'))
          <p class="success">{{ session('success') }}</p>
        @endif
        <form method="POST" action="{{ route('register.post') }}">
          @csrf
          <div class="form-group">
            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name" required placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="user_email">Email:</label>
            <input type="email" id="user_email" name="user_email" required placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label for="user_password">Password:</label>
            <input type="password" id="user_password" name="user_password" required placeholder="Enter your password">
          </div>
          <div class="form-group">
            <label for="user_role">Role:</label>
            <select id="user_role" name="user_role" required>
              <option value="">Select a role</option>
              <option value="admin">Admin</option>
              {{-- <option value="hr">HR</option> --}}
              <option value="employee">Employee</option>
            </select>
          </div>
          <button type="submit">Register</button>
          <p class="message">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </form>
      </div>
    </div>
  </body>
</html>