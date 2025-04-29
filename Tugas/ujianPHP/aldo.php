<table border="1">
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Gambar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include database connection
        include '../db/connection.php';

        // Fetch all products from the database
        $query = "SELECT * FROM products";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td>Rp. ' . htmlspecialchars(number_format($row['price'], 2, ',', '.')) . '</td>'; // Format price
                echo '<td><img src="../images' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '" style="width:100px;height:auto;"></td>'; // Display image
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="4">Tidak ada produk yang tersedia.</td></tr>';
        }
        ?>
    </tbody>
</table>

