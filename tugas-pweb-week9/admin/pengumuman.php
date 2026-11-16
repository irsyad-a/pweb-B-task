<?php
// admin/pengumuman.php - Kelola Status Kelulusan & Hasil Pengumuman
require_once __DIR__ . '/../includes/functions.php';

$admin_title = 'Kelola Pengumuman | Panel Administrator';
$admin_heading = 'Kelola Hasil Pengumuman Seleksi';
$admin_active = 'pengumuman';

$prodi_list = getProgramStudiList();
$edit_id = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : 0;
$msg = $_GET['msg'] ?? '';
$error = '';

// Handle Simpan Perubahan Status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_pengumuman'])) {
    $target_id = (int)($_POST['peserta_id'] ?? 0);
    $new_status = sanitize($_POST['status_hasil'] ?? 'Menunggu');
    $prodi_diterima = sanitize($_POST['prodi_diterima'] ?? '');
    $pesan_hasil = sanitize($_POST['pesan_hasil'] ?? '');

    if ($target_id <= 0) {
        $error = 'ID peserta tidak valid.';
    } elseif (!in_array($new_status, ['Lulus', 'Tidak Lulus', 'Menunggu'], true)) {
        $error = 'Status kelulusan tidak valid.';
    } else {
        if ($new_status === 'Lulus' && empty($prodi_diterima)) {
            $error = 'Peserta yang Lulus wajib ditentukan program studi yang diterima.';
        } else {
            $prodi_final = ($new_status === 'Lulus') ? $prodi_diterima : null;
            if (updateStatusPengumuman($target_id, $new_status, $prodi_final, $pesan_hasil)) {
                header('Location: pengumuman.php?msg=updated');
                exit;
            } else {
                $error = 'Gagal memperbarui status pengumuman.';
            }
        }
    }
}

// Data Peserta yang Sedang Diedit (jika ada edit_id)
$peserta_to_edit = null;
if ($edit_id > 0) {
    $peserta_to_edit = getPesertaById($edit_id);
}

// Filter & Pencarian Daftar Pengumuman
$search_query = sanitize($_GET['search'] ?? '');
$filter_status = sanitize($_GET['status'] ?? '');
$all_peserta = getAllPeserta($search_query);

if (!empty($filter_status)) {
    $all_peserta = array_filter($all_peserta, function($p) use ($filter_status) {
        return ($p['status_hasil'] ?? 'Menunggu') === $filter_status;
    });
}

require_once __DIR__ . '/header.php';
?>

<div class="container-fluid" style="padding: 0 30px;">

    <!-- Alerts Notification -->
    <?php if ($msg === 'updated'): ?>
        <div style="background:#DCFCE7; border-left:4px solid #15803D; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#166534; font-size:14px;">
            <i class="fa fa-check-circle"></i> <strong>Berhasil!</strong> Status hasil pengumuman peserta berhasil diperbarui.
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div style="background:#FEE2E2; border-left:4px solid #B91C1C; padding:14px 18px; border-radius:6px; margin-bottom:20px; color:#991B1B; font-size:14px;">
            <i class="fa fa-exclamation-triangle"></i> <strong>Peringatan:</strong> <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- JIKA SEDANG MENGEDIT STATUS PESERTA TERTENTU -->
    <?php if ($peserta_to_edit): ?>
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="admin-card" style="border-top:4px solid #F8B239;">
                    <div class="admin-card-header">
                        <h3>
                            <i class="fa fa-flag" style="color:#F8B239; margin-right:8px;"></i>
                            Ubah Status Kelulusan: <?php echo htmlspecialchars($peserta_to_edit['nama_lengkap']); ?>
                        </h3>
                        <a href="pengumuman.php" class="btn btn-sm btn-default">
                            &larr; Tutup / Kembali
                        </a>
                    </div>
                    <div class="admin-card-body">
                        
                        <!-- Ringkasan Info Peserta -->
                        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:16px; margin-bottom:24px;">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div style="font-size:12px; color:#64748B;">Nomor Peserta:</div>
                                    <strong style="font-size:14px; color:#181D37;"><?php echo htmlspecialchars($peserta_to_edit['nomor_peserta']); ?></strong>
                                </div>
                                <div class="col-sm-4">
                                    <div style="font-size:12px; color:#64748B;">Jalur Seleksi:</div>
                                    <strong style="font-size:14px; color:#181D37;"><?php echo htmlspecialchars($peserta_to_edit['jalur_seleksi']); ?></strong>
                                </div>
                                <div class="col-sm-4">
                                    <div style="font-size:12px; color:#64748B;">NISN / Sekolah:</div>
                                    <strong style="font-size:14px; color:#181D37;"><?php echo htmlspecialchars($peserta_to_edit['nisn']); ?> (<?php echo htmlspecialchars($peserta_to_edit['asal_sekolah']); ?>)</strong>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px; border-top:1px dashed #CBD5E1; padding-top:10px;">
                                <div class="col-sm-6">
                                    <div style="font-size:12px; color:#64748B;">Pilihan 1:</div>
                                    <strong><?php echo htmlspecialchars($peserta_to_edit['pilihan_1']); ?></strong>
                                </div>
                                <div class="col-sm-6">
                                    <div style="font-size:12px; color:#64748B;">Pilihan 2:</div>
                                    <strong><?php echo htmlspecialchars($peserta_to_edit['pilihan_2']); ?></strong>
                                </div>
                            </div>
                        </div>

                        <!-- Form Update Status -->
                        <form action="pengumuman.php" method="POST" id="formStatusPengumuman">
                            <input type="hidden" name="update_pengumuman" value="1">
                            <input type="hidden" name="peserta_id" value="<?php echo $peserta_to_edit['id']; ?>">

                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="font-weight:700; font-size:14px; color:#181D37; display:block; margin-bottom:8px;">
                                    Tentukan Status Kelulusan <span style="color:#B91C1C;">*</span>
                                </label>
                                <?php $current_status = $peserta_to_edit['status_hasil'] ?? 'Menunggu'; ?>
                                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                                    <label class="radio-inline" style="font-weight:600; font-size:14px; color:#15803D;">
                                        <input type="radio" name="status_hasil" value="Lulus" id="statusLulus" <?php echo ($current_status === 'Lulus') ? 'checked' : ''; ?>>
                                        <i class="fa fa-check-circle"></i> LULUS SELEKSI
                                    </label>
                                    <label class="radio-inline" style="font-weight:600; font-size:14px; color:#B91C1C;">
                                        <input type="radio" name="status_hasil" value="Tidak Lulus" id="statusTidakLulus" <?php echo ($current_status === 'Tidak Lulus') ? 'checked' : ''; ?>>
                                        <i class="fa fa-times-circle"></i> TIDAK LULUS
                                    </label>
                                    <label class="radio-inline" style="font-weight:600; font-size:14px; color:#B45309;">
                                        <input type="radio" name="status_hasil" value="Menunggu" id="statusMenunggu" <?php echo ($current_status === 'Menunggu') ? 'checked' : ''; ?>>
                                        <i class="fa fa-clock-o"></i> MENUNGGU PENGUMUMAN
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" id="groupProdiDiterima" style="margin-bottom:20px; <?php echo ($current_status !== 'Lulus') ? 'display:none;' : ''; ?>">
                                <label style="font-weight:700; font-size:14px; color:#181D37;">
                                    Program Studi Diterima <span style="color:#B91C1C;">*</span>
                                </label>
                                <select name="prodi_diterima" id="selectProdiDiterima" class="form-control" style="height:44px;">
                                    <option value="">-- Pilih Program Studi yang Diterima --</option>
                                    <optgroup label="Pilihan Pendaftar">
                                        <option value="<?php echo htmlspecialchars($peserta_to_edit['pilihan_1']); ?>" <?php echo (($peserta_to_edit['prodi_diterima'] ?? '') === $peserta_to_edit['pilihan_1']) ? 'selected' : ''; ?>>
                                            Pilihan 1: <?php echo htmlspecialchars($peserta_to_edit['pilihan_1']); ?>
                                        </option>
                                        <option value="<?php echo htmlspecialchars($peserta_to_edit['pilihan_2']); ?>" <?php echo (($peserta_to_edit['prodi_diterima'] ?? '') === $peserta_to_edit['pilihan_2']) ? 'selected' : ''; ?>>
                                            Pilihan 2: <?php echo htmlspecialchars($peserta_to_edit['pilihan_2']); ?>
                                        </option>
                                    </optgroup>
                                    <optgroup label="Semua Program Studi Tersedia">
                                        <?php foreach ($prodi_list as $pr): ?>
                                            <option value="<?php echo htmlspecialchars($pr['nama_prodi']); ?>" <?php echo (($peserta_to_edit['prodi_diterima'] ?? '') === $pr['nama_prodi']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($pr['nama_prodi'] . ' (' . $pr['jenjang'] . ')'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom:24px;">
                                <label style="font-weight:700; font-size:14px; color:#181D37;">
                                    Pesan / Motivasi Hasil Seleksi
                                </label>
                                <textarea name="pesan_hasil" id="textareaPesanHasil" class="form-control" rows="3" 
                                          style="resize:vertical; font-size:13.5px;"><?php echo htmlspecialchars($peserta_to_edit['pesan_hasil'] ?? ''); ?></textarea>
                                <div style="display:flex; gap:8px; margin-top:8px;">
                                    <button type="button" class="btn btn-xs btn-default" onclick="templatePesan('lulus')">Gunakan Format Lulus</button>
                                    <button type="button" class="btn btn-xs btn-default" onclick="templatePesan('tidaklulus')">Gunakan Format Tidak Lulus</button>
                                    <button type="button" class="btn btn-xs btn-default" onclick="templatePesan('menunggu')">Gunakan Format Menunggu</button>
                                </div>
                            </div>

                            <div style="border-top:1px solid #E2E8F0; padding-top:20px; display:flex; justify-content:flex-end; gap:10px;">
                                <a href="pengumuman.php" class="btn btn-default" style="font-weight:600; border-radius:4px;">Batal</a>
                                <button type="submit" class="btn-admin-warning" style="font-weight:700; padding:10px 24px;">
                                    <i class="fa fa-save" style="margin-right:6px;"></i> Simpan Status Pengumuman
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Filter & Pencarian Pengumuman -->
    <div class="admin-card" style="margin-bottom:20px;">
        <div class="admin-card-body" style="padding:16px 20px;">
            <form action="pengumuman.php" method="GET" class="form-inline" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau nomor peserta..." 
                           value="<?php echo htmlspecialchars($search_query); ?>" style="min-width:260px; height:40px;">
                </div>
                <div class="form-group">
                    <select name="status" class="form-control" style="height:40px;">
                        <option value="">-- Semua Status Kelulusan --</option>
                        <option value="Lulus" <?php echo ($filter_status === 'Lulus') ? 'selected' : ''; ?>>Lulus</option>
                        <option value="Tidak Lulus" <?php echo ($filter_status === 'Tidak Lulus') ? 'selected' : ''; ?>>Tidak Lulus</option>
                        <option value="Menunggu" <?php echo ($filter_status === 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                    </select>
                </div>
                <button type="submit" class="btn-admin-primary" style="height:40px;">
                    <i class="fa fa-filter"></i> Saring Data
                </button>
                <?php if (!empty($search_query) || !empty($filter_status)): ?>
                    <a href="pengumuman.php" class="btn btn-link" style="color:#B91C1C; height:40px; line-height:30px;">
                        Reset Filter
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Tabel Kelola Pengumuman -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3><i class="fa fa-bullhorn" style="color:#F8B239; margin-right:8px;"></i> Daftar Hasil Pengumuman Peserta</h3>
                <span style="font-size:13px; color:#64748B;">Klik tombol "Ubah Status" untuk menentukan kelulusan siswa</span>
            </div>
            <span style="font-size:13px; font-weight:600; color:#181D37;">
                Total: <?php echo count($all_peserta); ?> Peserta
            </span>
        </div>
        <div class="admin-card-body" style="padding:0;">
            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th style="width:40px; text-align:center;">#</th>
                            <th>Nomor Peserta</th>
                            <th>Nama Lengkap</th>
                            <th>Jalur</th>
                            <th>Pilihan Prodi 1 & 2</th>
                            <th>Status Kelulusan</th>
                            <th>Prodi Diterima</th>
                            <th>Pesan Pengumuman</th>
                            <th style="text-align:center; width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($all_peserta)): ?>
                            <tr>
                                <td colspan="9" style="text-align:center; padding:35px; color:#64748B;">
                                    Tidak ada data peserta yang cocok dengan filter yang dipilih.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($all_peserta as $p): ?>
                                <tr>
                                    <td style="text-align:center; font-weight:600; color:#64748B;"><?php echo $no++; ?></td>
                                    <td>
                                        <code style="font-size:13px; font-weight:700; color:#181D37; background:#F1F5F9; padding:2px 6px; border-radius:4px;">
                                            <?php echo htmlspecialchars($p['nomor_peserta']); ?>
                                        </code>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($p['nama_lengkap']); ?></strong>
                                        <div style="font-size:12px; color:#64748B;"><?php echo htmlspecialchars($p['asal_sekolah']); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge-status <?php echo ($p['jalur_seleksi'] === 'SNBP') ? 'badge-snbp' : 'badge-snbt'; ?>">
                                            <?php echo htmlspecialchars($p['jalur_seleksi']); ?>
                                        </span>
                                    </td>
                                    <td style="font-size:12px;">
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
                                    </td>
                                    <td>
                                        <?php if (!empty($p['prodi_diterima'])): ?>
                                            <strong style="color:#15803D; font-size:13px;">
                                                <i class="fa fa-graduation-cap"></i> <?php echo htmlspecialchars($p['prodi_diterima']); ?>
                                            </strong>
                                        <?php else: ?>
                                            <span style="color:#94A3B8; font-style:italic;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="max-width:280px;">
                                        <div style="font-size:12.5px; color:#475569; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?php echo htmlspecialchars($p['pesan_hasil'] ?? ''); ?>">
                                            <?php echo htmlspecialchars($p['pesan_hasil'] ?? '-'); ?>
                                        </div>
                                    </td>
                                    <td style="text-align:center; white-space:nowrap;">
                                        <a href="../pengumuman.php?nomor=<?php echo urlencode($p['nomor_peserta']); ?>" target="_blank" class="btn btn-xs btn-info" title="Lihat & Cetak Pengumuman" style="margin-right:4px;">
                                            <i class="fa fa-print"></i>
                                        </a>
                                        <a href="pengumuman.php?edit_id=<?php echo $p['id']; ?>" class="btn-admin-warning" style="font-size:12px; padding:4px 10px;">
                                            <i class="fa fa-flag"></i> Ubah Status
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

</div>

<script>
// Dynamic show/hide prodi diterima selector
document.addEventListener('DOMContentLoaded', function() {
    var radioLulus = document.getElementById('statusLulus');
    var radioTidakLulus = document.getElementById('statusTidakLulus');
    var radioMenunggu = document.getElementById('statusMenunggu');
    var groupProdi = document.getElementById('groupProdiDiterima');

    function checkVisibility() {
        if (!groupProdi) return;
        if (radioLulus && radioLulus.checked) {
            groupProdi.style.display = 'block';
        } else {
            groupProdi.style.display = 'none';
        }
    }

    if (radioLulus) radioLulus.addEventListener('change', checkVisibility);
    if (radioTidakLulus) radioTidakLulus.addEventListener('change', checkVisibility);
    if (radioMenunggu) radioMenunggu.addEventListener('change', checkVisibility);
});

function templatePesan(type) {
    var ta = document.getElementById('textareaPesanHasil');
    if (!ta) return;
    if (type === 'lulus') {
        ta.value = 'Selamat! Anda dinyatakan LULUS Seleksi Nasional. Segera lakukan verifikasi berkas dan registrasi ulang di perguruan tinggi penerima.';
        var rL = document.getElementById('statusLulus');
        if (rL) { rL.checked = true; document.getElementById('groupProdiDiterima').style.display = 'block'; }
    } else if (type === 'tidaklulus') {
        ta.value = 'Mohon maaf, Anda dinyatakan BELUM LULUS pada seleksi ini. Tetap semangat dan persiapkan diri Anda untuk kesempatan jalur penerimaan berikutnya.';
        var rTL = document.getElementById('statusTidakLulus');
        if (rTL) { rTL.checked = true; document.getElementById('groupProdiDiterima').style.display = 'none'; }
    } else if (type === 'menunggu') {
        ta.value = 'Pendaftaran Anda telah tercatat. Pengumuman hasil seleksi akan diumumkan sesuai jadwal.';
        var rM = document.getElementById('statusMenunggu');
        if (rM) { rM.checked = true; document.getElementById('groupProdiDiterima').style.display = 'none'; }
    }
}
</script>

<?php require_once __DIR__ . '/footer.php'; ?>

