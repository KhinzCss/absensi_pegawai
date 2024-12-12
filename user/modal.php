<!-- Modal untuk alasan -->
<div class="modal fade" id="alasanModal" tabindex="-1" aria-labelledby="alasanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alasanModalLabel">Input Alasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="alasanForm" method="post" action="proses_absensi.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="alasanText">Alasan:</label>
                        <textarea id="alasanText" name="alasan_text" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alasanImage">Unggah Gambar (Opsional):</label>
                        <input type="file" id="alasanImage" name="alasan_image" class="form-control">
                    </div>
                    <input type="hidden" name="ID_pns" value="<?php echo $ID_pns; ?>">
                    <input type="hidden" name="kehadiran" value="<?php echo $kehadiran; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="alasanForm">Kirim Alasan</button>
            </div>
        </div>
    </div>
</div>
