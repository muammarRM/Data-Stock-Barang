<?php
require 'db.php';

if (isset($_POST['inputbarang'])) {
    // Mengambil data dari form
    $Id_brg = $_POST['Id_brg'];
    $Nama_brg = $_POST['Nama_brg'];
    $Stok = $_POST['Stok'];
    $Jenis_brg = $_POST['Jenis_brg'];
    $Tgl_expired = $_POST['Tgl_expired'];

    // Menyusun query insert
    $sql = "INSERT INTO tb_muammarramadhanimaulizidan_brg (Id_brg, Nama_brg, Stok, Jenis_brg, Tgl_expired) VALUES (?, ?, ?, ?, ?)";

    // Menyiapkan statement
    $stmt = $conn->prepare($sql);

    // Mengikat parameter
    $stmt->bind_param("ssiss", $Id_brg, $Nama_brg, $Stok, $Jenis_brg, $Tgl_expired);

    // Menjalankan statement
    if($stmt->execute()){
        $errorMsg = "Data berhasil ditambahkan";
    } else {
        $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
//edit index
if (isset($_POST['editbarang'])) {
    if (isset($_POST['editbarang'])) {
        $Id_brg = $_POST['Id_brg'];
        $Nama_brg = $_POST['Nama_brg'];
        $Stok = $_POST['Stok'];
        $Jenis_brg = $_POST['Jenis_brg'];
        $Tgl_expired = $_POST['Tgl_expired'];
    
        // Menyusun kueri SQL untuk pembaruan data
        $sql = "UPDATE tb_muammarramadhanimaulizidan_brg SET Nama_brg=?, Stok=?, Jenis_brg=?, Tgl_expired=? WHERE Id_brg=?";
    
        // Menyiapkan statement
        $stmt = $conn->prepare($sql);
    
        // Mengikat parameter ke statement
        $stmt->bind_param("sisss", $Nama_brg, $Stok, $Jenis_brg, $Tgl_expired, $Id_brg);
    
        // Menjalankan statement
        if($stmt->execute()){
            // Jika berhasil, alihkan ke halaman ini lagi
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan
            echo "Error: " . $stmt->error;
        }
    
        // Menutup statement
        $stmt->close();
    }
    
}

//delete index
if (isset($_POST['deletebarang'])) {
    $deleteId = $_POST['deleteId'];
    mysqli_query($conn, "DELETE FROM tb_muammarramadhanimaulizidan_brg WHERE Id_brg='$deleteId'");
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock Barang</title>
    <link rel="stylesheet" href="style.css">
    <script src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="datatables-simple-demo.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="mx-auto">
        <div class="card ">
            <p class="h1 text-center p-3">Stock Barang</p>

            <div class="card-body">
                <form class="needs-validation " novalidate action="index.php" method="POST">

                <div class= "mb-3">
                    <label for="Id_brg" class="form-label">ID Barang</label>
                    <input type="text" class="form-control" id="Id_brg" name="Id_brg" required>
                    <div class="invalid-feedback">
                        Please enter a valid ID Barang.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="Nama_brg" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="Nama_brg" name="Nama_brg" required>
                    <div class="invalid-feedback">
                        Please enter a valid Nama Barang.
                    </div>
                </div>


                <div class="mb-3">
                    <label for="Stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="Stok" name="Stok" required>
                    <div class="invalid-feedback">
                        Please enter a valid Stok (number).
                    </div>
                </div>

                <div class="mb-3">
                    <label for="Jenis_brg" class="form-label">Jenis Barang</label>
                    <select class="form-select" id="Jenis_brg" name="Jenis_brg" required>
                        <option value="Pecah Belah">Pecah Belah</option>
                        <option value="Mainan">Mainan</option>
                        <option value="Perabotan">Perabotan</option>
                        <option value="Mebel">Mebel</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>

                    <div class= "invalid-feedback">
                        Please select a Jenis Barang.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="Tgl_expired" class="form-label">Tanggal Expired</label>
                    <input type="date" class="form-control" id="Tgl_expired" name="Tgl_expired" required>
                    <div class="invalid-feedback">
                        Please enter a valid Tanggal Expired.

                </div>

                <div class="container text-center mt-3">
                    <button type="submit" class="btn btn-primary text-center" name="inputbarang">Submit</button>
                </div>
                </div>
                </form>
        
            </div>
        </div>
        <div class="card">
    <div class="card-body">
    <div class="mt-5">
            <p class="text-center h1 p-3">Data Barang</p>

            <!-- Formulir Filter -->
            <form action="index.php" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col">
                                <select class="form-select" name="jenis_brg">
                                    <option value="">Semua Jenis</option>
                                    <option value="Pecah Belah">Pecah Belah</option>
                                    <option value="Mainan">Mainan</option>
                                    <option value="Perabotan">Perabotan</option>
                                    <option value="Mebel">Mebel</option>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                <!-- Header tabel... -->
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Jenis Barang</th>
                        <th>Tanggal Expired</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Menentukan apakah filter diterapkan
                $filter = isset($_GET['jenis_brg']) && !empty($_GET['jenis_brg']);
                $sql = "SELECT * FROM tb_muammarramadhanimaulizidan_brg";
                if ($filter) {
                    $jenis_brg = $_GET['jenis_brg'];
                    // Gunakan prepared statement untuk mencegah SQL Injection
                    $sql .= " WHERE Jenis_brg = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $jenis_brg);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    $result = $conn->query($sql);
                }

                if ($result->num_rows > 0) {
                    // output data of each row
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $Id_brg = htmlspecialchars($row['Id_brg']);
                        $Nama_brg = htmlspecialchars($row['Nama_brg']);
                        $Stok = htmlspecialchars($row['Stok']);
                        $Jenis_brg = htmlspecialchars($row['Jenis_brg']);
                        $Tgl_expired = htmlspecialchars($row['Tgl_expired']);

                        echo "<tr>";
                        echo "<td>$Id_brg</td>";
                        echo "<td>$Nama_brg</td>";
                        echo "<td>$Stok</td>";
                        echo "<td>$Jenis_brg</td>";
                        echo "<td>$Tgl_expired</td>";
                        echo "<td>
                                <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editModal$Id_brg'>Edit</button>
                            </td>";
                        echo "<td>
                                <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteModal$Id_brg'>Delete</button>
                            </td>";
                        echo "</tr>";

                        // Edit Modal
                        echo "<div class='modal fade' id='editModal$Id_brg'>";
                        echo "    <div class='modal-dialog'>";
                        echo "        <div class='modal-content'>";
                        echo "            <div class='modal-header'>";
                        echo "                <h4 class='modal-title'>Edit Barang</h4>";
                        echo "                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
                        echo "            </div>";
                        echo "            <form method='post'>";
                        echo "                <div class='modal-body'>";
                        echo "                    <input type='hidden' name='Id_brg' value='$Id_brg'>";
                        echo "                    <input type='text' name='Nama_brg' value='$Nama_brg' class='form-control' required>";
                        echo "                    <br>";
                        echo "                    <input type='number' name='Stok' value='$Stok' class='form-control' required>";
                        echo "                    <br>";
                        echo "                    <select name='Jenis_brg' class='form-select' required>";
                        echo "                        <option value='$Jenis_brg'>$Jenis_brg</option>";
                        echo "                        <option value='Pecah Belah'>Pecah Belah</option>";
                        echo "                        <option value='Mainan'>Mainan</option>";
                        echo "                        <option value='Perabotan'>Perabotan</option>";
                        echo "                        <option value='Mebel'>Mebel</option>";
                        echo "<option value='Makanan'>Makanan</option>";
                        echo " <option value='Lainnya'>Lainnya</option>";
                        // Add other options as needed...
                        echo "                    </select>";
                        echo "                    <br>";
                        echo "                    <input type='date' name='Tgl_expired' value='$Tgl_expired' class='form-control' required>";
                        echo "                    <br>";
                        echo "                    <button type='submit' class='btn btn-primary' name='editbarang'>Submit</button>";
                        echo "                </div>";
                        echo "            </form>";
                        echo "            <div class='modal-footer'>";
                        echo "                <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>";
                        echo "            </div>";
                        echo "        </div>";
                        echo "    </div>";
                        echo "</div>";

                        // Delete Modal
                        echo "<div class='modal fade' id='deleteModal$Id_brg'>";
                        echo "    <div class='modal-dialog'>";
                        echo "        <div class='modal-content'>";
                        echo "            <div class='modal-header'>";
                        echo "                <h4 class='modal-title'>Delete Barang</h4>";
                        echo "                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
                        echo "            </div>";
                        echo "            <form method='post'>";
                        echo "                <div class='modal-body'>";
                        echo "                    <input type='hidden' name='deleteId' value='$Id_brg'>";
                        echo "                    <p>Are you sure you want to delete $Nama_brg?</p>";
                        echo "                    <button type='submit' class='btn btn-danger' name='deletebarang'>Delete</button>";
                        echo "                </div>";
                        echo "            </form>";
                        echo "            <div class='modal-footer'>";
                        echo "                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
                        echo "            </div>";
                        echo "        </div>";
                        echo "    </div>";
                        echo "</div>";
                    }

                }
                
                ?>
            </div>
    </div>
        </div>
    </div>
</body>
</html>