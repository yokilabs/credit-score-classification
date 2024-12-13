<!-- BEGIN OFFCANVAS LEFT -->
<div class="offcanvas">
</div><!--end .offcanvas-->

<div id="content">
    <section class="style-default-bright">

<?php
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');
include "config.php";
include "functions.php";

// print_r($_FILES);
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['filename'])) {
    $file = $_FILES['filename'];

    // Periksa error upload
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']); // Nama file asli
        $targetFilePath = $upload_dir . $fileName;

        // Validasi tipe file
        $allowedMimeTypes = ['text/csv'];
        if (!in_array($file['type'], $allowedMimeTypes)) {
            // echo "Tipe file tidak diizinkan. Hanya CSV yang diperbolehkan.";
            exit;
        }

        // Pindahkan file ke lokasi penyimpanan
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // echo "File berhasil diunggah: " . htmlspecialchars($fileName);

            // Kirim file ke server FastAPI
            $url = 'http://127.0.0.1:8000/cresco/upload_csv/';
            $send_file = sendFile($url, $targetFilePath, $fileName);
            $result = json_decode($send_file);
            // print_r($result);
        } else {
            // echo "Terjadi kesalahan saat mengunggah file.";
        }
    } else {
        // echo "Error upload: " . $file['error'];
    }
?>
        <div class="section-header">
            <h2 class="text-primary">Credit Score</h2>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>occupation</th>
                                    <th>Type Of Loan(s)</th>
                                    <th>Month</th>
                                    <th class="sort-numeric">Age</th>
                                    <th class="sort-numeric">Monthly Salary</th>
                                    <th class="sort-alpha">Credit Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($result->result as $i => $res) {
                                $cresco = str_replace([0,1,2],['Poor','Standard','Good'],$res->credit_score);
                                // $grd = ['A','C','X'];
                                // shuffle($grd);
                                if($res->credit_score == 0) {
                                    $sp='text-warning';
                                } elseif($res->credit_score == 1) {
                                    $sp='text-info';
                                } else {
                                    $sp='text-success';
                                }
                            ?>
                                <tr class="cresco-<?= $cresco; ?>">
                                    <td><?= $res->name; ?></td>
                                    <td><?= $res->occupation; ?></td>
                                    <td><?= $res->type_of_loan; ?></td>
                                    <td><?= $res->month; ?></td>
                                    <td><?= $res->age; ?></td>
                                    <td><?= $res->monthly_inhand_salary; ?></td>
                                    <td><span class="<?= $sp; ?>"><?= $cresco; ?></span></td>
                                </tr>
                            <?php 
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php
} else {
?>

        <div class="row" style="margin-top:25px;">
            <div class="col-lg-12">
                <h4>Upload File</h4>
            </div>
            <div class="col-lg-3 col-md-4">
                <article class="margin-bottom-xxl">
                    <p>
                        Upload your CSV file.
                    </p>
                </article>
            </div><!--end .col -->
            <div class="col-lg-offset-1 col-md-8" style="margin-left:0px;">
                <form class="form" id="frm" method="POST" action="<?= $base_url; ?>credit-score-classification/web/upload" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">
                            <label for="file">Filename:</label>
                            <input type="file" id="file" class="btn btn-default-bright btn-block" name="filename">
                            <button type="submit" name="submit" value="submit" class="btn btn-default-bright btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<?php
}
?>

    </section>
</div>