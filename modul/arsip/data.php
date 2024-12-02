<div class="card mt-3">
  <div class="card-header" style="background-color: #FFFDD0; color: #333;">
    Data Arsip Surat
  </div>
  <div class="card-body">
    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn mb-3" style="background-color: #32CD32; color: #fff;">Tambah Data</a>
    <table class="table table-bordered table-hover">
      <thead style="background-color: #FFFDD0;">
        <tr>
          <th>No</th>
          <th>No Surat</th>
          <th>Tanggal Surat</th>
          <th>Tanggal Diterima</th>
          <th>Prihal</th>
          <th>Departemen</th>
          <th>Pengirim</th>
          <th>File</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $tampil = mysqli_query($koneksi, "
            SELECT tbl_arsip.*, tbl_departemen.nama_departemen, tbl_pengirim_surat.nama_pengirim, tbl_pengirim_surat.no_hp 
            FROM tbl_arsip
            JOIN tbl_departemen ON tbl_arsip.id_departemen = tbl_departemen.id_departemen
            JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim_surat = tbl_pengirim_surat.id_pengirim_surat
        ");

        $no = 1;
        while ($data = mysqli_fetch_array($tampil)): 
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($data['no_surat']) ?></td>
          <td><?= htmlspecialchars($data['tanggal_surat']) ?></td>
          <td><?= htmlspecialchars($data['tanggal_diterima']) ?></td>
          <td><?= htmlspecialchars($data['prihal']) ?></td>
          <td><?= htmlspecialchars($data['nama_departemen']) ?></td>
          <td><?= htmlspecialchars($data['nama_pengirim']) ?> / <?= htmlspecialchars($data['no_hp']) ?></td>
          <td>
            <?php if (empty($data['file'])): ?>
              <span>-</span>
            <?php else: ?>
              <a href="file/<?= htmlspecialchars($data['file']) ?>" target="_blank">Lihat File</a>
            <?php endif; ?>
          </td>
          <td>
            <a href="?halaman=arsip_surat&hal=edit&id=<?= $data['id_arsip'] ?>" class="btn btn-sm" style="background-color: #32CD32; color: #fff;">Edit</a>
            <a href="?halaman=arsip_surat&hal=hapus&id=<?= $data['id_arsip'] ?>" class="btn btn-sm"style="background-color:#f44336 ;color: #fff;" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
