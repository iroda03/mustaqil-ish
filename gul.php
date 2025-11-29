<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Iroda - Gullar do'koni</title>
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
    }

    @keyframes gradientShift {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
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

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        padding: 8rem 2rem 2rem;
    }

    .product-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        opacity: 0;
        transform: translateY(50px);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .price-bubble {
        position: absolute;
        bottom: 50px;
        right: 20px;
        background: var(--accent);
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
    }

    .add-to-cart {
        background: var(--primary);
        color: white;
        border: none;
        padding: 12px 25px;
        width: 100%;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
            padding-top: 6rem;
        }
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    .fa-store {
        animation: float 3s ease-in-out infinite;
    }
    </style>
</head>
<body>
    <nav class="navcha">
        <a href="index.html" class="logo">
            <i class="fas fa-store fa-2x"></i>
            <span class="brand-text">Asosiy oyna</span>
        </a>
        <div class="search-container">
            <input type="text" placeholder="Gul qidirish..." class="search-input">
            <button class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </nav>

    <div class="product-grid">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM gullar");
        while ($fetch = mysqli_fetch_assoc($sql)) {
        ?>
        <div class="product-card">
            <a href="batafsil.php?id=<?= $fetch['id'] ?>">
                <img src="img/<?=$fetch['rasm']?>" class="product-image" alt="<?=$fetch['nomi']?>">
                <div class="price-bubble"><?=$fetch['narx']?> so'm</div>
                <h3 class="product-title"><?=$fetch['nomi']?></h3>
            </a>
            
            <a href="savat.php?id=<?= $fetch['id'] ?>" class="add-to-cart"> Buyurtma berish</a>
        </div> 
        <?php } ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navcha');
            navbar.style.background = window.scrollY > 50 
                ? 'rgba(255, 255, 255, 0.9)'
                : 'rgba(255, 255, 255, 0.25)';
        });

    
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('mouseover', () => {
                button.style.transform = 'scale(1.05)';
                button.style.background = '#ff6b6b';
            });
            button.addEventListener('mouseout', () => {
                button.style.transform = 'scale(1)';
                button.style.background = '#ff7eb4';
            });
        });

    
        const logo = document.querySelector('.logo');
        logo.style.transform = 'scale(0)';
        setTimeout(() => {
            logo.style.transition = 'all 0.5s ease';
            logo.style.transform = 'scale(1)';
        }, 300);
    });
    </script>
</body>
</html>