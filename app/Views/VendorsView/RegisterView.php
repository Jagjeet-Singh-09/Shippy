<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ffffff;
        }

        .register-container {
            width: 420px;
            background: white;
            padding: 40px;
            border-radius: 22px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
        }

        .register-container h1 {
            text-align: center;
            color: #1565ff;
            margin-bottom: 10px;
            font-size: 34px;
        }

        .register-container p {
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
            box-shadow: 0 0 8px rgba(21, 101, 255, 0.2);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 47px;
            cursor: pointer;
            color: #1565ff;
            font-size: 16px;
        }

        .register-btn {
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

        .register-btn:hover {
            background: #0d47d9;
        }

        .login-btn {
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

        .login-btn:hover {
            background: #1565ff;
            color: white;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        @media(max-width:450px) {

            .register-container {
                width: 90%;
                padding: 30px;
            }

        }
    </style>

</head>

<body>

    <div class="register-container">

        <h1>Create Account</h1>

        <p>Register to continue</p>

        <form id="registerForm" autocomplete="off">

            <div class="input-group">

                <label>Phone Number</label>

                <input
                    type="tel"
                    id="phoneNumber"
                    name="phoneNumber"
                    placeholder="Enter your mobile number"
                    autocomplete="off"
                    maxlength="10"
                    required>

            </div>

            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autocomplete="off"
                    required>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create password"
                    autocomplete="new-password"
                    required>

                <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>

            </div>

            <div class="input-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Confirm password"
                    autocomplete="new-password"
                    required>

                <span class="toggle-password" onclick="togglePassword('confirmPassword', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>

            </div>

            <button type="submit" class="register-btn">
                Register
            </button>

        </form>

        <button class="login-btn" onclick="goToLogin()">
            Already Registered? Login
        </button>

        <div class="message" id="message"></div>

    </div>

    <script>

        // ONLY NUMBERS ALLOWED
        $("#phoneNumber").on("input", function() {

            this.value = this.value.replace(/[^0-9]/g, '');

        });


        $("#registerForm").submit(function(e) {

            e.preventDefault();

            let phoneNumber = $("#phoneNumber").val().trim();

            let email = $("#email").val().trim();

            let password = $("#password").val();

            let confirmPassword = $("#confirmPassword").val();


            // PHONE REGEX
            let phoneRegex = /^[6-9]\d{9}$/;

            // EMAIL REGEX
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


            // PHONE VALIDATION
            if (!phoneRegex.test(phoneNumber)) {

                $("#message").css("color", "red");

                $("#message").html("Enter valid 10 digit phone number");

                return;
            }


            // EMAIL VALIDATION
            if (!emailRegex.test(email)) {

                $("#message").css("color", "red");

                $("#message").html("Enter valid email address");

                return;
            }


            // PASSWORD MATCH CHECK
            if (password !== confirmPassword) {

                $("#message").css("color", "red");

                $("#message").html("Passwords do not match");

                return;
            }


            $.ajax({

                url: "/api/register",

                type: "POST",

                data: {

                    phoneNumber: phoneNumber,

                    email: email,

                    password: password

                },

                success: function(response) {

                    $("#message").css("color", "green");

                    $("#message").html("Registration Successful!");

                    window.location.href = "/profileCreation";

                },

                error: function(xhr) {

                    $("#message").css("color", "red");

                    if (xhr.responseJSON && xhr.responseJSON.message) {

                        $("#message").html(xhr.responseJSON.message);

                    } else {

                        $("#message").html("Something went wrong");
                    }

                }

            });

        });


        // PASSWORD SHOW / HIDE
        function togglePassword(inputId, element) {

            let input = document.getElementById(inputId);

            let icon = element.querySelector("i");

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


        function goToLogin() {

            window.location.href = "/login";
        }

    </script>

</body>

</html>