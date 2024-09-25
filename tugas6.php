<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Pembayaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .result-container {
            text-align: center;
            margin-top: 20px;
        }
        .result-container h3 {
            font-size: 18px;
            color: #333;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Hitung Total Pembayaran</h2>
        <form method="post">
            <div class="form-group">
                <label for="total_bayar">Total Bayar:</label>
                <input type="number" id="total_bayar" name="total_bayar" placeholder="Masukkan total bayar..." required>
            </div>

            <div class="form-group">
                <label for="diskon">Diskon (%):</label>
                <input type="number" id="diskon" name="diskon" placeholder="Masukkan diskon dalam persen..." required>
            </div>

            <input type="submit" value="Hitung Total Bersih">
        </form>

        <?php
        // Konsep OOP untuk perhitungan total bersih pembayaran
        class Pembayaran {
            private $totalBayar;
            private $diskon;

            public function __construct($totalBayar, $diskon) {
                $this->totalBayar = $totalBayar;
                $this->diskon = $diskon;
            }

            public function hitungTotalBersih() {
                $potongan = ($this->diskon / 100) * $this->totalBayar;
                return $this->totalBayar - $potongan;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $totalBayar = $_POST['total_bayar'];
            $diskon = $_POST['diskon'];

            // Membuat objek dari kelas Pembayaran
            $pembayaran = new Pembayaran($totalBayar, $diskon);

            // Menampilkan hasil perhitungan
            echo '<div class="result-container">';
            echo "<h3>Total Bayar: Rp " . number_format($totalBayar, 2) . "</h3>";
            echo "<h3>Diskon: " . $diskon . "%</h3>";
            echo "<h3>Total Bersih: Rp " . number_format($pembayaran->hitungTotalBersih(), 2) . "</h3>";
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>
