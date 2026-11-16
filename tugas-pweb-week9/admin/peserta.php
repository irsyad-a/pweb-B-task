<?php
// admin/peserta.php - Kelola Data Peserta Simulasi (CRUD)
require_once __DIR__ . '/../includes/functions.php';

$admin_title = 'Kelola Data Peserta | Panel Administrator';
$admin_heading = 'Kelola Data Peserta Simulasi';
$admin_active = 'peserta';

$prodi_list = getProgramStudiList();
$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$msg = $_GET['msg'] ?? '';
$error = '';

// Handle Ekspor Data CSV
if ($action === 'export') {
    $all = getAllPeserta();
    $filename = 'peserta_simulasi_' . date('Ymd_His') . '.csv';
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $output = fopen('php://output', 'w');
    fputs($output, "\xEF\xBB\xBF");
    fputcsv($output, [
        'ID',
        'Nomor Peserta',
        'Nama Lengkap',
        'NISN',
        'Asal Sekolah',
        'Email',
        'Jalur Seleksi',
        'Pilihan 1',
        'Pilihan 2',
        'Status Hasil',
        'Prodi Diterima',
        'Waktu Pendaftaran'
    ], ',', '"', '\\');
    foreach ($all as $row) {
        fputcsv($output, [
            $row['id'] ?? '',
            $row['nomor_peserta'] ?? '',
            $row['nama_lengkap'] ?? '',
            $row['nisn'] ?? '',
            $row['asal_sekolah'] ?? '',
            $row['email'] ?? '',
            $row['jalur_seleksi'] ?? '',
            $row['pilihan_1'] ?? '',
            $row['pilihan_2'] ?? '',
            $row['status_hasil'] ?? 'Menunggu',
            $row['prodi_diterima'] ?? '-',
            $row['created_at'] ?? ''
        ], ',', '"', '\\');
    }
    fclose($output);
    exit;
}

// Handle Hapus Peserta
if ($action === 'hapus' && $id > 0) {
    if (deletePesertaData($id)) {
        header('Location: peserta.php?msg=deleted');
        exit;
    } else {
        $error = 'Gagal menghapus data peserta.';
        $action = 'list';
    }
}

// Handle Tambah Peserta (POST)
if ($action === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_data = [
        'nama_lengkap' => sanitize($_POST['nama_lengkap'] ?? ''),
        'nisn' => sanitize($_POST['nisn'] ?? ''),
        'asal_sekolah' => sanitize($_POST['asal_sekolah'] ?? ''),
        'email' => sanitize($_POST['email'] ?? ''),
        'jalur_seleksi' => sanitize($_POST['jalur_seleksi'] ?? ''),
        'pilihan_1' => sanitize($_POST['pilihan_1'] ?? ''),
        'pilihan_2' => sanitize($_POST['pilihan_2'] ?? ''),
        'pernyataan_simulasi' => true
    ];

    $validation_errors = validatePendaftaran($input_data);
    if (!empty($validation_errors)) {
        $error = reset($validation_errors);
    } else {
        $saved = simpanPendaftaran($input_data);
        if ($saved) {
            header('Location: peserta.php?msg=added');
            exit;
        } else {
            $error = 'Terjadi kesalahan saat menyimpan data peserta.';
        }
    }
}

// Handle Edit Peserta (POST)
$edit_peserta = null;
if ($action === 'edit' && $id > 0) {
    $edit_peserta = getPesertaById($id);
    if (!$edit_peserta) {
        header('Location: peserta.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $update_data = [
            'nama_lengkap' => sanitize($_POST['nama_lengkap'] ?? ''),
            'nisn' => sanitize($_POST['nisn'] ?? ''),
            'asal_sekolah' => sanitize($_POST['asal_sekolah'] ?? ''),
            'email' => sanitize($_POST['email'] ?? ''),
            'jalur_seleksi' => sanitize($_POST['jalur_seleksi'] ?? ''),
            'pilihan_1' => sanitize($_POST['pilihan_1'] ?? ''),
            'pilihan_2' => sanitize($_POST['pilihan_2'] ?? ''),
            'pernyataan_simulasi' => true
        ];

        $validation_errors = validatePendaftaran($update_data);
        if (!empty($validation_errors)) {
            $error = reset($validation_errors);
            $edit_peserta = array_merge($edit_peserta, $update_data);
        } else {
            if (updatePesertaData($id, $update_data)) {
                header('Location: peserta.php?msg=updated');
                exit;
            } else {
                $error = 'Gagal memperbarui data peserta.';
            }
        }
    }
}

// Data untuk Tampilan List
$search_query = sanitize($_GET['search'] ?? '');
$filter_jalur = sanitize($_GET['jalur'] ?? '');
$daftar_peserta = getAllPeserta($search_query, $filter_jalur);

require_once __DIR__ . '/header.php';
?>

<div class="container-fluid" style="padding: 0 30px;">

    <!-- Alerts Notification -->
    <?php if ($msg === 'added'): ?>
        <div style="background:#DCFCE7; border-left:4px solid #15803D; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#166534; font-size:14px;">
            <i class="fa fa-check-circle"></i> <strong>Berhasil!</strong> Data peserta simulasi baru berhasil ditambahkan dan nomor peserta telah digenerate.
        </div>
    <?php elseif ($msg === 'updated'): ?>
        <div style="background:#DCFCE7; border-left:4px solid #15803D; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#166534; font-size:14px;">
            <i class="fa fa-check-circle"></i> <strong>Berhasil!</strong> Perubahan data peserta telah disimpan.
        </div>
    <?php elseif ($msg === 'deleted'): ?>
        <div style="background:#FEF3C7; border-left:4px solid #D97706; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#92400E; font-size:14px;">
            <i class="fa fa-trash"></i> <strong>Dihapus!</strong> Data peserta simulasi telah berhasil dihapus dari sistem.
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div style="background:#FEE2E2; border-left:4px solid #B91C1C; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#991B1B; font-size:14px;">
            <i class="fa fa-exclamation-triangle"></i> <strong>Perhatian:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <?php if ($action === 'tambah' || $action === 'edit'): ?>
        <!-- FORM TAMBAH / EDIT PESERTA -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h3>
                            <i class="fa <?php echo ($action === 'tambah') ? 'fa-user-plus' : 'fa-pencil'; ?>" style="color:#F8B239; margin-right:8px;"></i>
                            <?php echo ($action === 'tambah') ? 'Form Tambah Peserta Baru' : 'Edit Data Peserta: ' . htmlspecialchars($edit_peserta['nomor_peserta'] ?? ''); ?>
                        </h3>
                        <a href="peserta.php" class="btn btn-sm btn-default">
                            &larr; Kembali ke Daftar
                        </a>
                    </div>
                    <div class="admin-card-body">
                        <form action="peserta.php?action=<?php echo $action; ?><?php echo ($action === 'edit') ? '&id='.$id : ''; ?>" method="POST">
                            
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:18px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">Nama Lengkap Peserta <span style="color:#B91C1C;">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control" required
                                               value="<?php echo htmlspecialchars($edit_peserta['nama_lengkap'] ?? $_POST['nama_lengkap'] ?? ''); ?>"
                                               placeholder="Contoh: Muhammad Farhan">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:18px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">NISN Simulasi (10 Digit) <span style="color:#B91C1C;">*</span></label>
                                        <input type="text" name="nisn" class="form-control" maxlength="10" required
                                               value="<?php echo htmlspecialchars($edit_peserta['nisn'] ?? $_POST['nisn'] ?? ''); ?>"
                                               placeholder="Contoh: 0051234567">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:18px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">Asal Sekolah <span style="color:#B91C1C;">*</span></label>
                                        <input type="text" name="asal_sekolah" class="form-control" required
                                               value="<?php echo htmlspecialchars($edit_peserta['asal_sekolah'] ?? $_POST['asal_sekolah'] ?? ''); ?>"
                                               placeholder="Contoh: SMAN 1 Jakarta">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:18px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">Alamat Email Aktif <span style="color:#B91C1C;">*</span></label>
                                        <input type="email" name="email" class="form-control" required
                                               value="<?php echo htmlspecialchars($edit_peserta['email'] ?? $_POST['email'] ?? ''); ?>"
                                               placeholder="contoh@sekolah.sch.id">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom:18px;">
                                <label style="font-weight:600; font-size:13.5px; color:#181D37;">Jalur Seleksi <span style="color:#B91C1C;">*</span></label>
                                <?php $current_jalur = $edit_peserta['jalur_seleksi'] ?? $_POST['jalur_seleksi'] ?? 'SNBP'; ?>
                                <div>
                                    <label class="radio-inline" style="font-weight:600; margin-right:20px; font-size:14px;">
                                        <input type="radio" name="jalur_seleksi" value="SNBP" <?php echo ($current_jalur === 'SNBP') ? 'checked' : ''; ?>>
                                        SNBP (Seleksi Prestasi)
                                    </label>
                                    <label class="radio-inline" style="font-weight:600; font-size:14px;">
                                        <input type="radio" name="jalur_seleksi" value="SNBT" <?php echo ($current_jalur === 'SNBT') ? 'checked' : ''; ?>>
                                        SNBT (Seleksi Tes UTBK)
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:22px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">Pilihan Program Studi 1 <span style="color:#B91C1C;">*</span></label>
                                        <select name="pilihan_1" class="form-control" required>
                                            <option value="">-- Pilih Program Studi 1 --</option>
                                            <?php 
                                            $sel1 = $edit_peserta['pilihan_1'] ?? $_POST['pilihan_1'] ?? '';
                                            foreach ($prodi_list as $pr): 
                                            ?>
                                                <option value="<?php echo htmlspecialchars($pr['nama_prodi']); ?>" <?php echo ($sel1 === $pr['nama_prodi']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($pr['nama_prodi'] . ' (' . $pr['jenjang'] . ' - ' . $pr['kategori'] . ')'); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" style="margin-bottom:22px;">
                                        <label style="font-weight:600; font-size:13.5px; color:#181D37;">Pilihan Program Studi 2 <span style="color:#B91C1C;">*</span></label>
                                        <select name="pilihan_2" class="form-control" required>
                                            <option value="">-- Pilih Program Studi 2 --</option>
                                            <?php 
                                            $sel2 = $edit_peserta['pilihan_2'] ?? $_POST['pilihan_2'] ?? '';
                                            foreach ($prodi_list as $pr): 
                                            ?>
                                                <option value="<?php echo htmlspecialchars($pr['nama_prodi']); ?>" <?php echo ($sel2 === $pr['nama_prodi']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($pr['nama_prodi'] . ' (' . $pr['jenjang'] . ' - ' . $pr['kategori'] . ')'); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div style="border-top:1px solid #E2E8F0; padding-top:20px; display:flex; justify-content:flex-end; gap:10px;">
                                <a href="peserta.php" class="btn btn-default" style="font-weight:600; border-radius:4px;">Batal</a>
                                <button type="submit" class="btn-admin-warning" style="font-weight:700; padding:10px 24px;">
                                    <i class="fa fa-save" style="margin-right:6px;"></i> <?php echo ($action === 'tambah') ? 'Simpan Peserta' : 'Perbarui Peserta'; ?>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- DAFTAR PESERTA & FILTER (LIST VIEW) -->

        <!-- Action & Search Bar -->
        <div class="admin-card" style="margin-bottom:20px;">
            <div class="admin-card-body" style="padding:16px 20px;">
                <div class="row" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
                    
                    <!-- Search & Filter Form -->
                    <div class="col-md-8 col-sm-12">
                        <form action="peserta.php" method="GET" class="form-inline" style="display:flex; gap:10px; flex-wrap:wrap;">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, nomor, atau NISN..." 
                                       value="<?php echo htmlspecialchars($search_query); ?>" style="min-width:240px; height:40px;">
                            </div>
                            <div class="form-group">
                                <select name="jalur" class="form-control" style="height:40px;">
                                    <option value="">-- Semua Jalur --</option>
                                    <option value="SNBP" <?php echo ($filter_jalur === 'SNBP') ? 'selected' : ''; ?>>Jalur SNBP</option>
                                    <option value="SNBT" <?php echo ($filter_jalur === 'SNBT') ? 'selected' : ''; ?>>Jalur SNBT</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default" style="height:40px; font-weight:600;">
                                <i class="fa fa-search"></i> Cari
                            </button>
                            <?php if (!empty($search_query) || !empty($filter_jalur)): ?>
                                <a href="peserta.php" class="btn btn-link" style="color:#B91C1C; height:40px; line-height:30px;">
                                    Reset Filter
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Tombol Aksi Tambah & Ekspor -->
                    <div class="col-md-4 col-sm-12 text-right">
                        <a href="peserta.php?action=export" class="btn btn-default" style="height:40px; line-height:26px; font-weight:600; margin-right:8px; border-radius:4px;">
                            <i class="fa fa-download"></i> Ekspor CSV
                        </a>
                        <a href="peserta.php?action=tambah" class="btn-admin-warning" style="height:40px; line-height:26px;">
                            <i class="fa fa-user-plus"></i> Tambah Peserta
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Tabel Peserta -->
        <div class="admin-card">
            <div class="admin-card-header">
                <div>
                    <h3><i class="fa fa-users" style="color:#F8B239; margin-right:8px;"></i> Daftar Peserta Simulasi</h3>
                    <span style="font-size:13px; color:#64748B;">Total ditemukan: <strong><?php echo count($daftar_peserta); ?></strong> data</span>
                </div>
            </div>
            <div class="admin-card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th style="width:40px; text-align:center;">#</th>
                                <th>Nomor Peserta</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>Asal Sekolah</th>
                                <th>Jalur</th>
                                <th>Pilihan 1 & 2</th>
                                <th>Status Hasil</th>
                                <th style="text-align:center; width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftar_peserta)): ?>
                                <tr>
                                    <td colspan="9" style="text-align:center; padding:35px; color:#64748B;">
                                        Tidak ditemukan data peserta sesuai kata kunci pencarian.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($daftar_peserta as $p): ?>
                                    <tr>
                                        <td style="text-align:center; font-weight:600; color:#64748B;"><?php echo $no++; ?></td>
                                        <td>
                                            <code style="font-size:13px; font-weight:700; color:#181D37; background:#F1F5F9; padding:2px 6px; border-radius:4px;">
                                                <?php echo htmlspecialchars($p['nomor_peserta']); ?>
                                            </code>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($p['nama_lengkap']); ?></strong>
                                            <div style="font-size:12px; color:#64748B;"><?php echo htmlspecialchars($p['email']); ?></div>
                                        </td>
                                        <td><?php echo htmlspecialchars($p['nisn']); ?></td>
                                        <td><?php echo htmlspecialchars($p['asal_sekolah']); ?></td>
                                        <td>
                                            <span class="badge-status <?php echo ($p['jalur_seleksi'] === 'SNBP') ? 'badge-snbp' : 'badge-snbt'; ?>">
                                                <?php echo htmlspecialchars($p['jalur_seleksi']); ?>
                                            </span>
                                        </td>
                                        <td style="font-size:12.5px;">
                                            <div>1. <?php echo htmlspecialchars($p['pilihan_1']); ?></div>
                                            <div style="color:#64748B;">2. <?php echo htmlspecialchars($p['pilihan_2']); ?></div>
                                        </td>
                                        <td>
                                            <?php 
                                            $st = $p['status_hasil'] ?? 'Menunggu';
                                            $cls = 'badge-menunggu';
                                            if ($st === 'Lulus') $cls = 'badge-lulus';
                                            elseif ($st === 'Tidak Lulus') $cls = 'badge-tidak-lulus';
                                            ?>
                                            <span class="badge-status <?php echo $cls; ?>">
                                                <?php echo htmlspecialchars($st); ?>
                                            </span>
                                            <?php if ($st === 'Lulus' && !empty($p['prodi_diterima'])): ?>
                                                <div style="font-size:11.5px; color:#15803D; margin-top:2px; font-weight:600;">
                                                    <i class="fa fa-check"></i> <?php echo htmlspecialchars($p['prodi_diterima']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align:center; white-space:nowrap;">
                                            <a href="../ringkasan.php?nomor=<?php echo urlencode($p['nomor_peserta']); ?>" target="_blank" class="btn btn-xs btn-info" title="Cetak Kartu Peserta" style="margin-right:3px;">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="pengumuman.php?edit_id=<?php echo $p['id']; ?>" class="btn btn-xs btn-warning" title="Kelola Kelulusan" style="font-weight:600; margin-right:3px;">
                                                <i class="fa fa-flag"></i>
                                            </a>
                                            <a href="peserta.php?action=edit&id=<?php echo $p['id']; ?>" class="btn btn-xs btn-default" title="Edit Peserta" style="margin-right:3px;">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="peserta.php?action=hapus&id=<?php echo $p['id']; ?>" class="btn btn-xs btn-danger" title="Hapus Peserta"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data peserta <?php echo htmlspecialchars(addslashes($p['nama_lengkap'])); ?> (<?php echo htmlspecialchars($p['nomor_peserta']); ?>)?');">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/footer.php'; ?>

