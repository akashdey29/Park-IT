<main>
    <h3 class="no-print">Vehicle Parking Report</h3>
    <hr class="no-print">
    <button type="button" onclick="window.print()" class="btn btn-info btn-sm no-print">
        <i class="bi bi-printer"></i>
    </button>
    <div class="d-flex align-items-center gap-4 mb-4">
        <img src="./assets/image/SIPARK.png" alt="SIPARK" width="60" class="no-screen">
        <span class="no-screen">SIPARK</span>
    </div>
    <?php
        $monday = strtotime('last monday', strtotime('tomorrow'));
        $sunday = strtotime('+6 days', $monday);
        // echo "<P>". date('d-F-Y', $monday) . " to " . date('d-F-Y', $sunday) . "</P>";
    ?>
    <?php if ($_SESSION['role'] == 0): ?>
    <form action="" method="post" class="no-print">
        <div class="input-group input-group-sm mb-2">
            <select class="form-select" name="bulan" id="bulan" required>
                <option disabled value="">-- Filter by month --</option>
                <?php date_default_timezone_set("Asia/Jakarta") ?>
                <?php if (!isset($_REQUEST['bulan'])): ?>
                    <option value="semua">All</option>
                    <option value="01" <?= date('m') == '01' ? 'selected' : '' ?>>January</option>
                    <option value="02" <?= date('m') == '02' ? 'selected' : '' ?>>February</option>
                    <option value="03" <?= date('m') == '03' ? 'selected' : '' ?>>March</option>
                    <option value="04" <?= date('m') == '04' ? 'selected' : '' ?>>April</option>
                    <option value="05" <?= date('m') == '05' ? 'selected' : '' ?>>May</option>
                    <option value="06" <?= date('m') == '06' ? 'selected' : '' ?>>June</option>
                    <option value="07" <?= date('m') == '07' ? 'selected' : '' ?>>July</option>
                    <option value="08" <?= date('m') == '08' ? 'selected' : '' ?>>August</option>
                    <option value="09" <?= date('m') == '09' ? 'selected' : '' ?>>September</option>
                    <option value="10" <?= date('m') == '10' ? 'selected' : '' ?>>October</option>
                    <option value="11" <?= date('m') == '11' ? 'selected' : '' ?>>November</option>
                    <option value="12" <?= date('m') == '12' ? 'selected' : '' ?>>December</option>
                <?php else: ?>
                    <option value="semua" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == 'semua' ? 'selected' : '' ?>>All</option>
                    <option value="01" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '01' ? 'selected' : '' ?>>January</option>
                    <option value="02" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '02' ? 'selected' : '' ?>>February</option>
                    <option value="03" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '03' ? 'selected' : '' ?>>March</option>
                    <option value="04" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '04' ? 'selected' : '' ?>>April</option>
                    <option value="05" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '05' ? 'selected' : '' ?>>May</option>
                    <option value="06" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '06' ? 'selected' : '' ?>>June</option>
                    <option value="07" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '07' ? 'selected' : '' ?>>July</option>
                    <option value="08" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '08' ? 'selected' : '' ?>>August</option>
                    <option value="09" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '09' ? 'selected' : '' ?>>September</option>
                    <option value="10" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '10' ? 'selected' : '' ?>>October</option>
                    <option value="11" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '11' ? 'selected' : '' ?>>November</option>
                    <option value="12" <?= isset($_REQUEST['bulan']) && $_REQUEST['bulan'] == '12' ? 'selected' : '' ?>>December</option>
                <?php endif; ?>
            </select>
            <select name="tahun" id="tahun" class="form-select" required>
                <?php if (!isset($_REQUEST['tahun'])): ?>
                    <option value="<?= date("Y", strtotime("last year")) ?>" <?= date("Y") == date("Y") ? 'selected' : '' ?>><?= date("Y", strtotime("last year")) ?></option>
                    <option value="<?= date("Y") ?>" <?= date("Y") == date("Y") ? 'selected' : '' ?>><?= date("Y") ?></option>
                <?php else: ?>
                    <option value="<?= date("Y", strtotime("last year")) ?>" <?= isset($_REQUEST['tahun']) && $_REQUEST['tahun'] == date("Y", strtotime("last year")) ? 'selected' : '' ?>><?= date("Y", strtotime("last year")) ?></option>
                    <option value="<?= date("Y") ?>" <?= isset($_REQUEST['tahun']) && $_REQUEST['tahun'] == date("Y") ? 'selected' : '' ?>><?= date("Y") ?></option>
                <?php endif; ?>
            </select>
            <button type="submit" name="filter" class="btn btn-outline-success"><i class="bi bi-funnel"></i></button>
        </div>
    </form>
    <?php endif; ?>

    <?php require('./veh.report.output.php') ?>

</main>