<?php include_once 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gul ma'lumotlari</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            padding: 30px;
        }

        .gul-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .gul-header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .gul-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .gul-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            height: 400px;
        }

        .gul-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gul-info {
            padding: 20px;
        }

        .info-item {
            margin-bottom: 25px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .info-item:hover {
            transform: translateX(10px);
        }

        .info-label {
            color: #3498db;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        .info-value {
            color: #2c3e50;
            font-size: 1.2em;
            font-weight: 500;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 30px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52,152,219,0.3);
        }

        @media (max-width: 768px) {
            .gul-body {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = mysqli_query($conn, "SELECT * FROM gullar WHERE id='$id'");
        $gul = mysqli_fetch_assoc($sql);
        
        if($gul) {
    ?>
        <div class="container">
            <div class="gul-header">
                <h1><?php echo $gul['nomi']; ?></h1>
                <div class="info-value" style="font-size: 1.5em; color: #e74c3c;">
                    <?php echo number_format($gul['narx'], 0, ',', ' '); ?> so&lsquo;m
                </div>
            </div>
            
            <div class="gul-body">
                <div class="gul-image">
                    <img src="img/<?php echo $gul['rasm']; ?>" alt="<?php echo $gul['nomi']; ?>">
                </div>
                
                <div class="gul-info">
                    <?php 
                    foreach($gul as $key => $value) {
                        if(!in_array($key, array('id', 'rasm'))) {
                    ?>
                            <div class="info-item">
                                <div class="info-label"><?php echo ucfirst($key); ?></div>
                                <div class="info-value">
                                    <?php 
                                        if($key === 'narx') {
                                            echo number_format($value, 0, ',', ' ') . ' so&lsquo;m';
                                        } else {
                                            echo htmlspecialchars($value);
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            
            <a href="gul.php" class="back-btn">
                &larr; Bosh sahifaga qaytish
            </a>
        </div>
    <?php
        } else {
    ?>
            <div class="container" style="text-align: center; padding: 50px;">
                <h2 style="color: #e74c3c;">Xatolik!</h2>
                <p>Ushbu IDga tegishli ma'lumot topilmadi</p>
                <a href="gul.php" class="back-btn">Orqaga qaytish</a>
            </div>
    <?php
        }
    } else {
    ?>
        <div class="container" style="text-align: center; padding: 50px;">
            <h2 style="color: #e74c3c;">ID parametri kiritilmagan!</h2>
            <a href="gul.php" class="back-btn">Bosh sahifa</a>
        </div>
    <?php
    }
    ?>
</body>
</html>