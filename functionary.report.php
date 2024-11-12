<?php require('./functions/session.php') ?>
<?php require('./functions/connection.php') ?>

<!-- View -->
<?php require('./template/header.php') ?>
<?php require('./template/navigation.php') ?>

<main>
    <h3 class="no-print">Laporan Data Petugas</h3>
    <hr class="no-print">
    <?php
        $SQL = "SELECT id, nama_lengkap, username, created, login_history, logout_history
                FROM data_user
                WHERE kode_status != 0;";
        $query = mysqli_query($connection, $SQL);

        if (!$query) {
            die("Database query failed: " . mysqli_error($connection));
        }
    ?>
    <div class="table-responsive custom-height-print">
        <button type="button" onclick="window.print()" class="btn btn-info btn-sm no-print">
            <i class="bi bi-printer"></i>
        </button>
        <div class="d-flex align-items-center gap-4 mb-4">
            <img src="./assets/image/SIPARK.png" alt="SIPARK" width="60" class="no-screen">
            <span class="no-screen">SIPARK</span>
        </div>
        <?php if (mysqli_num_rows($query) > 0): ?>
            <div class="table-responsive" style="max-height: 420px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Waktu Cetak Akun</th>
                            <th>Riwayat Masuk Sistem</th>
                            <th>Riwayat Keluar Sistem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= date("d-m-Y H:i:s", strtotime($row['created'])) ?></td>
                                <td><?= empty($row['login_history']) ? '-' : date("d-m-Y H:i:s", strtotime($row['login_history'])) ?></td>
                                <td><?= empty($row['logout_history']) ? '-' : date("d-m-Y H:i:s", strtotime($row['logout_history'])) ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No data available</p>
        <?php endif; ?>
    </div>
</main>

<?php require('./template/footer.php') ?>
