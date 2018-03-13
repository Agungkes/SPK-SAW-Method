<!-- Column untuk daftar keseluruhan Guru -->
<div class="column" id="daftarGuru">
    <div class="row">
        <div class="column">
            <h4>Daftar Guru</h4>  
        </div>
        <div class="column">
            <a class="button button-blue float-right" href="#" id="tambahGuru">Tambah Guru</a>
        </div>
    </div>
      
    <table id="table-guru">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody id="dataGuru">
        <?php if (!empty($guru)):?>
            <?php foreach ($guru as $g):?>
                <tr data-id="<?php echo $g->id?>" class="barisDataGuru">
                    <td class="namaGuru"><?php echo $g->nama ?></td>
                    <td class="jabatanGuru"><?php echo $g->jabatan?></td>
                    <td class="alamatGuru"><?php echo $g->alamat?></td>
                </tr>
            <?php endforeach;?>
        <?php else: ?>
        <?php endif;?>    
        </tbody>
    </table>
</div>

<!-- Column untuk menambahkan guru baru -->
<div class="column" id='addGuru'>
    <div class="row">
        <div class="column">
            <h3>Tambah Guru</h3>
        </div>
        <div class="column">
            <a class="animated button button-red float-right" href="#" id="kembaliGuru">Kembali</a>
        </div>
    </div>
    <form id="formTambahGuru">
        <fieldset>
            <label for="nama">Nama</label>
            <input placeholder="Nama Guru" type="text" name="nama" id="addNamaGuru">
            <label for="jabatan">Jabatan</label>
            <input placeholder="Jabatan" type="text" name="jabatan" id="addJabatanGuru">
            <label for="alamat">Alamat</label>
            <input placeholder="Alamat" type="text" name="alamat" id="addAlamatGuru">
            </select>
                <a class="button button-blue button-small" href="#" id="submitGuru">Submit</a>
        </fieldset>
    </form>
</div>
