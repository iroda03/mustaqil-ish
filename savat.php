<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Buyurtma berish - Iroda Gullar do'koni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    :root {
        --primary: #ff7eb4;
        --secondary: #7afcff;
        --accent: #ff6b6b;
        --background: linear-gradient(45deg, #ff9a9e, #fad0c4);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: var(--background);
        min-height: 100vh;
        animation: gradientShift 15s ease infinite;
        margin: 0;
        padding: 8rem 2rem 2rem;
    }

    @keyframes gradientShift {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }

    .order-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .order-table th, .order-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .order-table th {
        background-color: #f7f7f7;
    }

    .order-table input, .order-table select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-family: 'Poppins', sans-serif;
    }

    .submit-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 25px;
        cursor: pointer;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        background: #ff6b6b;
        transform: scale(1.05);
    }

    .navcha {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        padding: 1rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    /* Popup stil */
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0,0,0,0.3);
        z-index: 9999;
        text-align: center;
        display: none;
        max-width: 400px;
        width: 90%;
    }

    .popup i {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .popup-btn {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .popup-btn:hover {
        background: #ff6b6b;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 9998;
        display: none;
    }

    @media (max-width: 768px) {
        body {
            padding: 6rem 1rem 1rem;
        }
        
        .order-table th, .order-table td {
            display: block;
            width: 100%;
        }
        
        .order-table tr {
            margin-bottom: 10px;
            display: block;
        }
    }
    </style>
</head>
<body>
    <nav class="navcha">
        <a href="index.html" class="logo">
            <i class="fas fa-store fa-2x"></i>
            <span class="brand-text">Asosiy oyna</span>
        </a>
    </nav>

    <div class="order-container">
        <h2>Buyurtma ma'lumotlari</h2>
        <form id="orderForm" action="process_order.php" method="post">
            <table class="order-table">
                <tr>
                    <th><label for="fio">Xaridorning F.I.O:</label></th>
                    <td><input type="text" id="fio" name="fio" required></td>
                </tr>
                <tr>
                    <th><label for="phone">Telefon raqami:</label></th>
                    <td><input type="tel" id="phone" name="phone" required></td>
                </tr>
                <tr>
                    <th><label for="address">Yashash manzili:</label></th>
                    <td><input type="text" id="address" name="address" required></td>
                </tr>
                <tr>
                    <th><label for="product">Mahsulot nomi:</label></th>
                    <td>
                        <select id="product" name="product" required>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM gullar");
                            while ($fetch = mysqli_fetch_assoc($sql)) {
                                if($_GET['id']==$fetch['id']){
                                    echo "<option selected value='{$fetch['id']}'>{$fetch['nomi']} - {$fetch['narx']} so'm</option>";
                                }
                                else{
                                    echo "<option value='{$fetch['id']}'>{$fetch['nomi']} - {$fetch['narx']} so'm</option>";
                                }
                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="quantity">Miqdori:</label></th>
                    <td><input type="number" id="quantity" name="quantity" min="1" value="1" required></td>
                </tr>
            </table>
            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Buyurtmani tasdiqlash
            </button>
        </form>
    </div>
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <i class="fas fa-check-circle"></i>
        <h3>Buyurtmangiz tasdiqlandi!</h3>
        <p>Sizning buyurtmangiz muvaffaqiyatli qabul qilindi. Tez orada siz bilan bog'lanamiz.</p>
        <button class="popup-btn" id="popupBtn">OK</button>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navcha');
            navbar.style.background = window.scrollY > 50 
                ? 'rgba(255, 255, 255, 0.9)'
                : 'rgba(255, 255, 255, 0.25)';
        });
        const orderForm = document.getElementById('orderForm');
        orderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        });

        document.getElementById('popupBtn').addEventListener('click', function() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
            window.location.href = 'gul.php';
        });
    });
    </script>
</body>
</html>