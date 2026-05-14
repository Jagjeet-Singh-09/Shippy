<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor Login</title>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f4f7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 30px;
        }

        .login-container {
            width: 420px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .login-container h1 {
            text-align: center;
            color: #1565ff;
            margin-bottom: 10px;
        }

        .login-container p {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
            outline: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #1565ff;
            box-shadow: 0 0 8px rgba(21,101,255,0.2);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 47px;
            cursor: pointer;
            color: #1565ff;
            font-size: 16px;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #1565ff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #0d47d9;
        }

        .register-btn {
            width: 100%;
            padding: 15px;
            border: 2px solid #1565ff;
            border-radius: 12px;
            background: white;
            color: #1565ff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .register-btn:hover {
            background: #1565ff;
            color: white;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        @media(max-width:500px) {

            .login-container {
                width: 100%;
                padding: 30px;
            }

        }

    </style>

</head>

<body>

    <div class="login-container">

        <h1>User Login</h1>

        <p>Login to continue</p>

        <form id="loginForm" autocomplete="off">

            <!-- EMAIL -->
            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter email"
                    autocomplete="off"
                    required>

            </div>

            <!-- PASSWORD -->
            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    autocomplete="off"
                    required>

                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye"></i>
                </span>

            </div>

            <button type="submit" class="login-btn">
                Login
            </button>

        </form>

        <button class="register-btn" onclick="goToRegister()">
            Create New Account
        </button>

        <div class="message" id="message"></div>

    </div>

    <script>

        $("#loginForm").submit(function (e) {

            e.preventDefault();

            let email = $("#email").val().trim();

            let password = $("#password").val();


            // EMAIL REGEX
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


            // EMAIL VALIDATION
            if (!emailRegex.test(email)) {

                $("#message").css("color", "red");

                $("#message").html("Enter valid email address");

                return;
            }


            $.ajax({

                url: "/api/user/login",

                type: "POST",

                data: {

                    email: email,

                    password: password

                },

                success: function (response) {

                    $("#message").css("color", "green");

                    $("#message").html("Login Successful");

                    console.log(response);

                    // REDIRECT PAGE
                    window.location.href = "/userDashboard";

                },

                error: function (xhr) {

                    $("#message").css("color", "red");

                    if (xhr.responseJSON && xhr.responseJSON.message) {

                        $("#message").html(xhr.responseJSON.message);

                    } else {

                        $("#message").html("Invalid Email or Password");
                    }

                }

            });

        });


        // SHOW / HIDE PASSWORD
        function togglePassword() {

            let input = document.getElementById("password");

            let icon = document.querySelector(".toggle-password i");

            if (input.type === "password") {

                input.type = "text";

                icon.classList.remove("fa-eye");

                icon.classList.add("fa-eye-slash");

            } else {

                input.type = "password";

                icon.classList.remove("fa-eye-slash");

                icon.classList.add("fa-eye");
            }
        }


        // REGISTER PAGE REDIRECT
        function goToRegister() {

            window.location.href = "/registerUser";
        }

    </script>

</body>

</html>