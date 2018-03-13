<style>
.dataTable-table th, .dataTable-table > tfoot > tr > th, .dataTable-table > thead > tr > th {text-align:center}td,th{text-align:center;}/*.dataTable-info{display:none;}*/
</style>
<div class="column" id="bHasilPerangkingan">
    <div class="row">
        <h3>Hasil Perangkingan</h3>
    </div>
    
    <table id="hasilPerangkingan">
    <thead>
        <tr>
            <th>Alternatif</th>
            <th>Hasil Perangkingan</th>
        </tr>
    </thead>
    <tbody>
        <?php $a=1;foreach ($guru as $g) {
            $total=0;
            echo '<tr>
                  <td>'.$g->nama.'</td>';
                  foreach ($kriteria as $k) {

                      /**
                       * Rating  @param : id_guru,id_kriteria
                       * Matriks @param : id_kriteria
                       * Bobot   @param : id_kriteria
                       */
                      $rating   = $this->rk->rating($g->id, $k->id);
                      $matriks  = $this->rk->where('id_kriteria', $k->id)->get_all();
                      $bobot    = $this->bk->where('id_kriteria', $k->id)->get_all();
                      
                      if (!empty($matriks)) {
                        /**
                         * Membuat Array Untuk Mencari Max Kriteria dari tabel Rating Kecocokan
                         */
                        $matrik   = array();
                        foreach ($matriks as $m) {
                            $matrik[]=$m->nilai;
                        }

                        /**
                         * Perangkingan bobot x matrik_normalisasi(i,j)
                         */
                        
                        foreach ($rating->result() as $r) {
                            foreach ($bobot as $b) {
                                //Total dari perangkingan untuk hasil rangking
                                $total += ($r->nilai/max($matrik))*($b->id_bobot/10);
                            }
                        }
                      }
                  }
                  // Memasukkan ke dalam tabel perangkingan
                  echo '<td>'.$total.'</td>';
            echo '</tr>';
        }?>
    </tbody>
</table>
</div>