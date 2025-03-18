<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .logout {
            background-color: #dc3545;
            color: white;
            cursor: pointer;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard Admin</h2>
    <p>Halo, <strong>{{ auth()->user()->name }}</strong>! Anda adalah seorang <strong>Admin</strong>.</p>

    <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="submit" class="logout">Logout</button>
    </form>
</div>

</body>
</html>
