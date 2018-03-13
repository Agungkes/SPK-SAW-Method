<!-- Column untuk daftar Kriteria -->
<div class="column" id='daftarKriteria'>
    <div class="row">
        <div class="column">
            <h4>Daftar Kriteria</h4>
        </div>
        <div class="column">
            <a class="animated button button-blue float-right" href="#" id="tambahKriteria">Tambah Kriteria</a>
        </div>
    </div>
    <table id="table-kriteria">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody id="dataKriteria">
            <?php if (!empty($main)): ?>
                <?php foreach ($main as $m):?>
                    <tr data-id="<?php echo $m->kriteria->id?>" class="abc">
                        <td class="namaKriteria"><?php echo $m->kriteria->nama ?></td>
                        <td class="bobotKriteria"><?php echo $m->bobot->nilai*10 ?></td>
                    </tr>
                <?php endforeach;?>
            <?php else: ?>
                
            <?php endif;?>
            
        </tbody>
    </table>
</div>

<!-- Column untuk form tambah kriteria baru -->
<div class="column" id='addKriteria'>
    <div class="row">
        <div class="column">
            <h3>Tambah Kriteria</h3>
        </div>
        <div class="column">
            <a class="animated button button-red float-right" href="#" id="kembaliKriteria">Kembali</a>
        </div>
    </div>
    <form>
        <fieldset>
            <label for="nama">Nama</label>
            <input placeholder="Nama Kriteria" id="nama" type="text" name="nama">
            <label for="bobot">Bobot Kriteria</label>
            <select id="pilihanBobot" name="pilihanBobot">
                <?php foreach ($bobot as $m):?>
                    <option value="<?php echo $m->id?>"><?php echo $m->nilai*10 ?></option>
                <?php endforeach;?>
                
            </select>
                <a class="button button-blue button-small" href="#" id="submitKriteria">Submit</a>
        </fieldset>
    </form>
</div>

