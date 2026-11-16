<?php
// admin/index.php - Dashboard Administrator
require_once __DIR__ . '/../includes/functions.php';

$admin_title = 'Dashboard Administrator | Simulasi SNBP/SNBT';
$admin_heading = 'Dashboard Utama';
$admin_active = 'dashboard';

$stats = getStatistikPeserta();
$recent_peserta = array_slice(getAllPeserta(), 0, 8);

require_once __DIR__ . '/header.php';
?>

<div class="container-fluid" style="padding: 0 30px;">

    <!-- Stat Cards Row -->
    <div class="row" style="margin-bottom: 25px;">
        
        <!-- Total Peserta -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #181D37; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#64748B; font-weight:700; text-transform:uppercase;">Total Peserta</span>
                <div style="font-size:32px; font-weight:700; color:#181D37; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['total']; ?>
                </div>
                <div style="font-size:12px; color:#64748B; margin-top:2px;">Terdaftar di sistem</div>
            </div>
        </div>

        <!-- SNBP -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #2563EB; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#2563EB; font-weight:700; text-transform:uppercase;">Jalur SNBP</span>
                <div style="font-size:32px; font-weight:700; color:#1D4ED8; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['snbp']; ?>
                </div>
                <div style="font-size:12px; color:#64748B; margin-top:2px;">Berdasarkan prestasi</div>
            </div>
        </div>

        <!-- SNBT -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #7E22CE; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#7E22CE; font-weight:700; text-transform:uppercase;">Jalur SNBT</span>
                <div style="font-size:32px; font-weight:700; color:#6B21A8; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['snbt']; ?>
                </div>
                <div style="font-size:12px; color:#64748B; margin-top:2px;">Berdasarkan tes UTBK</div>
            </div>
        </div>

        <!-- Lulus -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #15803D; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#15803D; font-weight:700; text-transform:uppercase;">Status: Lulus</span>
                <div style="font-size:32px; font-weight:700; color:#15803D; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['lulus']; ?>
                </div>
                <div style="font-size:12px; color:#166534; margin-top:2px;">Diterima di prodi</div>
            </div>
        </div>

        <!-- Tidak Lulus -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #B91C1C; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#B91C1C; font-weight:700; text-transform:uppercase;">Tidak Lulus</span>
                <div style="font-size:32px; font-weight:700; color:#B91C1C; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['tidak_lulus']; ?>
                </div>
                <div style="font-size:12px; color:#991B1B; margin-top:2px;">Belum memenuhi syarat</div>
            </div>
        </div>

        <!-- Menunggu -->
        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-bottom: 15px;">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-top:4px solid #D97706; border-radius:8px; padding:18px; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
                <span style="font-size:12px; color:#D97706; font-weight:700; text-transform:uppercase;">Menunggu</span>
                <div style="font-size:32px; font-weight:700; color:#B45309; font-family:'Rasa',serif; margin-top:4px;">
                    <?php echo $stats['menunggu']; ?>
                </div>
                <div style="font-size:12px; color:#92400E; margin-top:2px;">Proses seleksi</div>
            </div>
        </div>

    </div>

    <!-- Quick Shortcuts & Guidelines -->
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-md-12">
            <div style="background:#FFFFFF; border:1px solid #E2E8F0; border-radius:8px; padding:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
                <div style="display:flex; align-items:center; gap:15px;">
                    <div style="width:44px; height:44px; background:#EFF6FF; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="fa fa-sliders" style="color:#181D37; font-size:20px;"></i>
                    </div>
                    <div>
                        <strong style="color:#181D37; font-size:15px; display:block;">Pusat Tindakan Cepat Administrator</strong>
                        <span style="font-size:13px; color:#64748B;">Kelola pendaftar baru, perbarui hasil seleksi peserta, atau ekspor data simulasi.</span>
                    </div>
                </div>
                <div style="display:inline-flex; gap:10px; flex-wrap:wrap;">
                    <a href="peserta.php?action=tambah" class="btn-admin-warning">
                        <i class="fa fa-user-plus"></i> Tambah Peserta Baru
                    </a>
                    <a href="pengumuman.php" class="btn-admin-primary">
                        <i class="fa fa-bullhorn"></i> Kelola Kelulusan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations Table Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3><i class="fa fa-list-alt" style="color:#F8B239; margin-right:8px;"></i> Pendaftar Terbaru</h3>
                <span style="font-size:13px; color:#64748B;">Menampilkan pendaftaran terakhir yang tercatat di sistem</span>
            </div>
            <a href="peserta.php" class="btn btn-sm btn-default" style="font-weight:600;">
                Lihat Semua Peserta (<?php echo $stats['total']; ?>) &rarr;
            </a>
        </div>
        <div class="admin-card-body" style="padding:0;">
            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th style="width:50px; text-align:center;">#</th>
                            <th>Nomor Peserta</th>
                            <th>Nama Lengkap</th>
                            <th>NISN</th>
                            <th>Asal Sekolah</th>
                            <th>Jalur</th>
                            <th>Pilihan Prodi 1</th>
                            <th>Status Seleksi</th>
                            <th style="text-align:center;">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_peserta)): ?>
                            <tr>
                                <td colspan="9" style="text-align:center; padding:30px; color:#64748B;">
                                    Belum ada data pendaftar simulasi yang tercatat.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($recent_peserta as $p): ?>
                                <tr>
                                    <td style="text-align:center; color:#64748B; font-weight:600;"><?php echo $no++; ?></td>
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
                                    <td><?php echo htmlspecialchars($p['pilihan_1']); ?></td>
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
                                    <td style="text-align:center; white-space:nowrap;">
                                        <a href="pengumuman.php?edit_id=<?php echo $p['id']; ?>" class="btn btn-xs btn-warning" title="Ubah Status Kelulusan" style="background:#F8B239; color:#181D37; border-color:#F8B239; font-weight:700; margin-right:4px;">
                                            <i class="fa fa-flag"></i> Status
                                        </a>
                                        <a href="peserta.php?action=edit&id=<?php echo $p['id']; ?>" class="btn btn-xs btn-default" title="Edit Data Peserta" style="border-radius:3px;">
                                            <i class="fa fa-pencil"></i> Edit
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

<?php require_once __DIR__ . '/footer.php'; ?>

