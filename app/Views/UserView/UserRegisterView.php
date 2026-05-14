<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vendor Register</title>

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

        .register-container {
            width: 450px;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .register-container h1 {
            text-align: center;
            color: #1565ff;
            margin-bottom: 10px;
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

        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        @media(max-width:500px) {

            .register-container {
                width: 100%;
                padding: 30px;
            }

        }

    </style>

</head>

<body>

    <div class="register-container">

        <h1>Vendor Register</h1>

        <p>Create your User account</p>

        <form id="registerForm" autocomplete="off">

            <!-- FIRST NAME -->
            <div class="input-group">

                <label>First Name</label>

                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    placeholder="Enter first name"
                    required>

            </div>

            <!-- LAST NAME -->
            <div class="input-group">

                <label>Last Name</label>

                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    placeholder="Enter last name"
                    required>

            </div>

            <!-- EMAIL -->
            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter email"
                    required>

            </div>

            <!-- PHONE -->
            <div class="input-group">

                <label>Phone Number</label>

                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="Enter phone number"
                    maxlength="10"
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
                    required>

                <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>

            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="input-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    placeholder="Confirm password"
                    required>

                <span class="toggle-password" onclick="togglePassword('confirm_password', this)">
                    <i class="fa-solid fa-eye"></i>
                </span>

            </div>

            <button type="submit" class="register-btn">
                Register
            </button>

        </form>

        <div class="message" id="message"></div>

    </div>

    <script>

        // ONLY NUMBERS ALLOWED
        $("#phone").on("input", function () {

            this.value = this.value.replace(/[^0-9]/g, '');

        });


        $("#registerForm").submit(function (e) {

            e.preventDefault();

            let first_name = $("#first_name").val().trim();

            let last_name = $("#last_name").val().trim();

            let email = $("#email").val().trim();

            let phone = $("#phone").val().trim();

            let password = $("#password").val();

            let confirm_password = $("#confirm_password").val();


            // EMAIL REGEX
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // PHONE REGEX
            let phoneRegex = /^[6-9]\d{9}$/;


            // EMAIL VALIDATION
            if (!emailRegex.test(email)) {

                $("#message").css("color", "red");

                $("#message").html("Enter valid email address");

                return;
            }


            // PHONE VALIDATION
            if (!phoneRegex.test(phone)) {

                $("#message").css("color", "red");

                $("#message").html("Enter valid 10 digit phone number");

                return;
            }


            // PASSWORD MATCH
            if (password !== confirm_password) {

                $("#message").css("color", "red");

                $("#message").html("Passwords do not match");

                return;
            }


            $.ajax({

                url: "/api/user/register",

                type: "POST",

                data: {

                    first_name: first_name,

                    last_name: last_name,

                    email: email,

                    phone: phone,

                    password: password

                },

                success: function (response) {

                    $("#message").css("color", "green");

                    $("#message").html("Registration Successful");

                    window.location.href = "/userDashboard";

                    console.log(response);

                },

                error: function (xhr) {

                    $("#message").css("color", "red");

                    if (xhr.responseJSON && xhr.responseJSON.message) {

                        $("#message").html(xhr.responseJSON.message);

                    } else {

                        $("#message").html("Something went wrong");
                    }

                }

            });

        });


        // SHOW / HIDE PASSWORD
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

    </script>

</body>

</html>