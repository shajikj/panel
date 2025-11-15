<?php
include "includes/config.php";
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $check_user_data = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
  $count_data = mysqli_num_rows($check_user_data);
  if ($count_data >= 1) {
    $fetch_data = mysqli_fetch_assoc($check_user_data);
    $_SESSION['is_logged_in'] = 1;
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $fetch_data['id'];
    header("Location: dashboard.php");
  } else {
    echo "Password is wrong";
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Login</title>
  <style>
    :root {
      --bg: #f5f7fb;
      --card: #ffffff;
      --accent: #4b7cff;
      --muted: #666
    }

    * {
      box-sizing: border-box
    }

    body {
      margin: 0;
      font-family: Inter, system-ui, Segoe UI, Arial;
      background: linear-gradient(180deg, var(--bg), #eef2fb);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px
    }

    .card {
      width: 100%;
      max-width: 400px;
      background: var(--card);
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(30, 40, 80, 0.07);
      padding: 28px
    }

    h1 {
      margin: 0 0 12px;
      font-size: 20px
    }

    p.lead {
      margin: 0 0 20px;
      color: var(--muted);
      font-size: 14px
    }

    label {
      display: block;
      font-size: 13px;
      margin: 10px 0 6px
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #e3e7f0;
      border-radius: 8px;
      font-size: 15px;
    }

    .row {
      display: flex;
      gap: 10px;
      align-items: center
    }

    .remember {
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 10px 0
    }

    .btn {
      display: inline-block;
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 0;
      font-weight: 600;
      background: var(--accent);
      color: #fff;
      font-size: 15px;
      cursor: pointer;
    }

    .small {
      font-size: 13px;
      color: var(--muted);
      margin-top: 10px;
      text-align: center
    }

    .error {
      color: #b00;
      font-size: 13px;
      margin-top: 10px;
      display: none
    }

    .pwd-toggle {
      cursor: pointer;
      font-size: 13px;
      color: var(--muted);
      user-select: none
    }

    .footer-links {
      display: flex;
      justify-content: space-between;
      margin-top: 12px;
      font-size: 13px;
      color: var(--muted)
    }

    @media (max-width:420px) {
      .card {
        padding: 18px
      }

      h1 {
        font-size: 18px
      }
    }
  </style>
</head>

<body>
  <main class="card" role="main" aria-labelledby="title">
    <h1 id="title">Admin Login</h1>
    <p class="lead">Sign in to access the admin dashboard.</p>

    <form id="loginForm" method="post">
      <label for="username">Username</label>
      <input id="username" name="username" type="text" autocomplete="username" required maxlength="100" />

      <label for="password">Password</label>
      <div class="row" style="margin-bottom:0.5rem">
        <input id="password" name="password" type="password" autocomplete="current-password" required style="flex:1" />
        <div id="togglePwd" class="pwd-toggle" aria-hidden="true" title="Show / hide password" style="padding-left:8px">
          Show</div>
      </div>

      <div class="remember">
        <input id="remember" name="remember" type="checkbox" />
        <label for="remember" style="margin:0;font-size:13px">Remember me</label>
      </div>

      <button type="submit" name=submit class="btn">Submit</button>

      <div id="error" class="error" role="alert"></div>

      <div class="footer-links">
        <a href="#" style="text-decoration:none;color:inherit">Forgot password?</a>
      </div>

    </form>
  </main>
  <script>
    (function () {
      const form = document.getElementById('loginForm');
      const username = document.getElementById('username');
      const password = document.getElementById('password');
      const error = document.getElementById('error');
      const toggle = document.getElementById('togglePwd');
      toggle.addEventListener('click', () => {
        if (password.type === 'password') {
          password.type = 'text';
          toggle.textContent = 'Hide';
        } else {
          password.type = 'password';
          toggle.textContent = 'Show';
        }
      });

      form.addEventListener('submit', (e) => {
        error.style.display = 'none';
        error.textContent = '';

        if (username.value.trim().length < 3) {
          e.preventDefault();
          showError('Username must be at least 6 characters.');
          username.focus();
          return;
        }
        if (password.value.length < 4) {
          e.preventDefault();
          showError('Password must be at least 4 characters.');
          password.focus();
          return;
        }
      });

      function showError(msg) {
        error.textContent = msg;
        error.style.display = 'block';
      }
    })();
  </script>
</body>

</html>