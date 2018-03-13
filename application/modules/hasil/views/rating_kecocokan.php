<style>
.dataTable-table th, .dataTable-table > tfoot > tr > th,
.dataTable-table > thead > tr > th {text-align:center}td,
th{text-align:center;}/*.dataTable-info{display:none;}*/
</style>
<div class="column" id="hasilRatingKecocokan">
    <div class="row">
        <h3>Rating Kecocokan</h3>
    </div>
    
    <table id="ThasilRatingKecocokan">
    <thead>
        <tr>
            <th rowspan="2" style="margin:2px">Alternatif</th>
            <th colspan="7" class="text-center">Kriteria</th>
        </tr>
        <tr>
         <?php $i=1; foreach($kriteria as $k):?>
            <th data-id="<?php echo $k->id ?>">
                <?php echo $k->nama.' (C'.$i.')';$i++?> 
            </th>
        <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
    
        <?php 
        //Foreach data guru
        $a=1;foreach ($guru as $g):?>
        <tr>
            <td><?php echo $g->nama.' (A'.$a.')';$a++ ?></td>
            <?php foreach ($kriteria as $kk):
                    $aaa = $this->rk->rating($g->id,$kk->id);
                    $a2 = $aaa->num_rows();
                    if($a2<1): ?>
                          <td data-id="<?php echo $kk->id ?>" data-krit="<?php echo $kk->id ?>" data-guru="<?php echo $g->id?>" class="kriteriaRating">0</td>
            <?php   else:
                        foreach ($aaa->result() as $gac): ?>
                           <td data-id="<?php echo $kk->id ?>" data-krit="<?php echo $kk->id ?>" data-guru="<?php echo $g->id?>" class="kriteriaRating"><?php echo $gac->nilai ?></td>
            <?php       endforeach;
                    endif;
                endforeach;?>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>