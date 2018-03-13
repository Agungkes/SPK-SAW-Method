<center><h1>Selamat datang di Sistem Pemilihan Guru Terbaik!</h1></center>
<div class="row">
    <?php echo Modules::run('guru',0); ?>
    <?php echo Modules::run('kriteria',0); ?>
</div>

<div class="row">
    <?php echo Modules::run('hasil/Ratingkecocokan',0); ?>
</div>
<div class="row">
    <?php echo Modules::run('hasil/normalisasi',0); ?>
</div>
<div class="row">
    <?php echo Modules::run('hasil/perangkingan',0); ?>
</div>
<div class="row">
    <?php echo Modules::run('hasil/HasilPerangkingan',0); ?>
</div>