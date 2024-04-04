<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araçlar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="araclar.css">
    
</head>

<body>

    <div class="navbar">
        <a href="/OtoGaleri1/AnaSayfa/AnaSayfa.html">
            <img src="./Logo.png" alt="logo" class="logo" />
        </a>
        <nav>
            <ul>
                <li><a href="/OtoGaleri1/AnaSayfa/AnaSayfa.html">Ana Sayfa</a></li>
                <li><a href="http://localhost/OtoGaleri1/Araclar/Araclar.php">Araçlar</a></li>
                <li><a href="http://localhost/OtoGaleri1/Iletisim/Iletisim.php">İletişim</a></li>
                <li><a href="http://localhost/OtoGaleri1/Hakkinda/hakkinda.php">Hakkımızda</a></li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <section>
        <div class="filter-bar">
            
            <ul class="marka-listesi">
                <?php
                // Veritabanından markaları çek
                include("db_connection.php");
                $sql_marka = "SELECT DISTINCT Marka FROM araclar";
                $result_marka = $conn->query($sql_marka);

                if ($result_marka->num_rows > 0) {
                    echo "<li><a href='?marka=all'>TÜM ARAÇLAR</a></li>"; // Tüm Araçlar seçeneği
                    while ($row_marka = $result_marka->fetch_assoc()) {
                        $marka = $row_marka['Marka'];
                        echo "<li><a href='?marka=$marka'>$marka</a></li>";
                    }
                }
                ?>
            </ul>
        </div>

        <div class="ilanlar">
            <?php
            // Marka filtresi varsa
            $marka_filtre = isset($_GET['marka']) ? $_GET['marka'] : '';

            $sql = "SELECT * FROM araclar";
            // Eğer marka filtresi varsa, sadece seçilen markayı içeren araçları seç
            if (!empty($marka_filtre) && $marka_filtre !== 'all') {
                $sql .= " WHERE Marka = '$marka_filtre'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Çekilen bilgileri ekrana yazdırma kodları burada
                    $marka = $row['Marka'];
                    $model = $row['Model'];
                    $fiyat = $row['fiyat'];
                    $resim = $row['Resim'];
                    $aciklama = $row['Aciklama'];

                    // Çekilen bilgileri ekrana yazdırma
                    echo "<div class='ilan'>";
                    echo "<h1>$marka $model</h1>";
                    echo "<h3>Fiyat: $fiyat TL</h3>";
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($resim) . '" alt="' . $marka . ' ' . $model . '" />';
                    echo "<h4>$aciklama</h4>";
                    echo "</div>";
                }
            } else {
                echo "Araç bulunamadı.";
            }

            $conn->close();
            ?>
        </div>
    </section>

</body>

</html>
