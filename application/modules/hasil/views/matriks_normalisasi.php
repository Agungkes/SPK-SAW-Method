<style>
.dataTable-table th, .dataTable-table > tfoot > tr > th, .dataTable-table > thead > tr > th {text-align:center}td,th{text-align:center;}/*.dataTable-info{display:none;}*/
</style>
<div class="column" id="matriksNormalisasi">
    <div class="row">
        <h3>Matriks Normalisasi</h3>
    </div>
    
    <table id="TmatriksNormalisasi">
    <thead>
        <tr>
            <th rowspan="2" style="margin:2px">Alternatif</th>
            <th colspan="7" class="text-center">Kriteria</th>
        </tr>
        <tr>
         <?php $i=1; foreach($kriteria as $k):?>
            <th data-id="<?php echo $k->id ?>"><?php echo $k->nama.' (C'.$i.')';$i++?> </th>
        <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php $a=1;foreach ($guru as $g){
            echo '<tr>
                  <td>'.$g->nama.' (A'.$a.')</td>';
                  foreach ($kriteria as $k) {
                      $rating   = $this->rk->rating($g->id,$k->id);
                      $matriks  = $this->rk->where('id_kriteria',$k->id)->get_all();
                      
                      
                      if (!empty($matriks)) {
                        
                        /**
                         * Membuat Array Untuk Mencari Max Kriteria dari tabel Rating Kecocokan
                         */
                        $matrik   = array();
                        foreach ($matriks as $m) {
                            $matrik[]=$m->nilai;
                        }

                        /**  
                         * Membuat matriks normalisasi nilai/max dari semuanya
                        */
                        foreach ($rating->result() as $r) {
                            echo '<td>'.$r->nilai/max($matrik).'</td>';
                        }  
                         
                      }
                  }
                $a++;
            echo '</tr>';
        }?>
    </tbody>
</table>
</div>