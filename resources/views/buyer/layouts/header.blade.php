<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header cải tiến</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS cải tiến */
        /* Header chính */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 30px;
            /* Tăng khoảng cách trong header */
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Logo */
        .logo img {
            height: 80px;
            padding-left: 100px;
            /* Tạo khoảng cách với thanh tìm kiếm */
        }

        /* Thanh tìm kiếm */
        .search-bar {
            flex: 1;
            display: flex;
            margin: 0 20px;
            /* Khoảng cách giữa logo và icons */
            max-width: 500px;
            /* Đảm bảo không quá dài */
        }

        .search-bar input {
            flex: 1;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px 0 0 8px;
            /* Bo góc nhẹ */
            font-size: 14px;
        }

        .search-bar button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 0 8px 8px 0;
            /* Bo góc nhẹ */
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        /* Icons */
        .icons {
            display: flex;
            align-items: center;
        }

        .icons>div {
            margin-left: 15px;
            margin-right: 50px;
            /* Khoảng cách giữa các icons */
            position: relative;
            font-size: 30px;
            color: #333;
            cursor: pointer;
        }

        .icons .badge {
            position: absolute;
            top: -8px;
            right: -12px;
            background-color: red;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            padding: 2px 6px;
        }

        .icons .cart:hover,
        .icons .user:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="images/logo.jpg" alt="Logo" class="img-fluid">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm sản phẩm..." />
            <button><i class="fas fa-search"></i></button>
        </div>
        <div class="icons">
            <div class="cart">
                <i class="fas fa-cart-plus"></i>
                <span class="badge">3</span>
            </div>
            <div class="user">
                <a href="{{ route('login') }}">
                    <i class="fas fa-user-circle"></i>
                </a>
            </div>
        </div>
    </header>
</body>

</html>
