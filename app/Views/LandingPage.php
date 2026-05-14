<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shippy Welcome</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;

        /* BACKGROUND IMAGE */
        background-image: url('https://images.unsplash.com/photo-1519213887655-a4f199e3015b?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        
    }
    body::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.64);
}

    .container {
        text-align: center;
        width: 100%;
        max-width: 600px;
        padding: 20px;

        /* OPTIONAL GLASS EFFECT */
        background: rgba(255,255,255,0.88);
        border-radius: 16px;
        backdrop-filter: blur(5px);
    }

    h1 {
        font-size: 3rem;
        color: #222;
        margin-bottom: 10px;
    }

    p {
        font-size: 1.2rem;
        color: #555;
        margin-bottom: 40px;
    }

    .card-wrapper {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .card {
        width: 250px;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        transition: 0.3s;
        background: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card h2 {
        margin-bottom: 10px;
        color: #222;
    }

    .card p {
        font-size: 1rem;
        margin-bottom: 20px;
        color: #666;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn {
        padding: 12px;
        border: none;
        border-radius: 6px;
        background-color: #007BFF;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .vendor-btn {
        background-color: #28a745;
    }

    .vendor-btn:hover {
        background-color: #1e7e34;
    }

    @media(max-width: 600px) {
        h1 {
            font-size: 2.2rem;
        }

        .card {
            width: 100%;
        }
    }
</style>
</head>

<body>

<div class="container">
    <h1>Welcome to Shippy</h1>
    <p>Your smart solution for product inventory management</p>

    <div class="card-wrapper">

        <!-- USER CARD -->
        <div class="card">
            <h2>User</h2>
            <div class="btn-group">
                <button class="btn" onclick="goToUserLogin()">
                    Login
                </button>

                <button class="btn" onclick="goToUserSignup()">
                    Sign Up
                </button>
            </div>
        </div>

        <!-- VENDOR CARD -->
        <div class="card">
            <h2>Vendor</h2>

            <div class="btn-group">
                <button class="btn vendor-btn" onclick="goToVendorLogin()">
                    Login
                </button>

                <button class="btn vendor-btn" onclick="goToVendorSignup()">
                    Sign Up
                </button>
            </div>
        </div>

    </div>
</div>

<script>

    // USER ROUTES
    function goToUserLogin() {
        window.location.href = "/loginUser";
    }

    function goToUserSignup() {
        window.location.href = "/registerUser";
    }

    // VENDOR ROUTES
    function goToVendorLogin() {
        window.location.href = "/login";
    }

    function goToVendorSignup() {
        window.location.href = "/register";
    }

</script>

</body>
</html>