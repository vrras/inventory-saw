<?php

if($page=='awal')
{
  foreach ($criteria1 as $field_criteria1) {
    $id_member[]      = $field_criteria1->id_pelanggan;
    $alternatif[]     = $field_criteria1->nama_pelanggan;
    $total_belanja[]  = $field_criteria1->total_belanja;
    $status_belanja[] = $field_criteria1->status;
  }

  foreach ($totbel_sub as $field_totbel_sub) {
    $nilai1[]          = $field_totbel_sub->nilai;
  }

  foreach ($stats_sub as $field_status) {
    $nilai2[]          = $field_status->nilai;
  }

  foreach ($loyal_sub as $field_loyal_sub) {
    $nilai3[]          = $field_loyal_sub->nilai;
  }

    // === Periode 1 ===
  if(!empty($id_member))
  {
    $count = count($id_member);
  }
  else
  {
    $count = 0;
  }

  for($i = 0; $i < $count; $i++)
  {
    $cash[]   = $this->M_Penilaian->criteria_one_cash($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
    $credit[] = $this->M_Penilaian->criteria_one_credit($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
    $loyal[]  = $this->M_Penilaian->criteria_one_loyal($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
  }

  if(!empty($alternatif))
  {
    $count_alt = count($alternatif);
  }
  else
  {
    $count_alt = 0;
  }

  for ($j=0; $j < $count_alt ; $j++) {
    if($total_belanja[$j]/$loyal[$j]>1500000)
    {
      $tot_belanja = $nilai1[0];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=1500000) AND ($total_belanja[$j]/$loyal[$j]>1000000))
    {
      $tot_belanja = $nilai1[1];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=1000000) AND ($total_belanja[$j]/$loyal[$j]>500000))
    {
      $tot_belanja = $nilai1[2];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=500000) AND ($total_belanja[$j]/$loyal[$j]>100000))
    {
      $tot_belanja = $nilai1[3];
    }
    elseif(($total_belanja[$j]/$loyal[$j]<=100000) AND ($total_belanja[$j]/$loyal[$j]>1000))
    {
      $tot_belanja = $nilai1[4];
    }

    $tott[]   = $tot_belanja;

    if($cash[$j]>=$credit[$j])
    {
      $cc = $nilai2[0];
    }
    else
    {
      $cc = $nilai2[1];
    }

    $belanja[] = $cc;

    if($loyal[$j]>=10)
    {
      $loyl = $nilai3[0];
    }
    elseif (($loyal[$j]<=9) AND ($loyal[$j]>=8))
    {
      $loyl = $nilai3[1];
    }
    elseif (($loyal[$j]<=7) AND ($loyal[$j]>=6))
    {
      $loyl = $nilai3[2];
    }
    elseif (($loyal[$j]<=5) AND ($loyal[$j]>=4))
    {
      $loyl = $nilai3[3];
    }
    elseif(($loyal[$j]<=3) AND ($loyal[$j]>=1))
    {
      $loyl = $nilai3[4];
    }

    $loyaltas[] = $loyl;
  }
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title"> <b><?=$title?> Periode (<?=$month_title?>)</b></h2>
          <ul class="panel-controls" style="margin-top: 2px;">
          </ul>
        </div>
        <div class="panel-body">
          <form role="form" method="POST" action="<?=base_url().'laporan/pelanggan'?>">

            <div>
             <div class="form-group">
              <div class="col-md-2">
                <select name="form_month_awal" class="select2_month form-control" required="">
                  <option value="Month">Month</option>
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
              </div>

              <div class="col-md-1">
                <select name="form_year_awal" class="select2_year form-control" required="">
                  <option value="Year">Year</option>
                  <?php
                  for ($i=2016; $i <= date('Y'); $i++) {
                    ?>
                    <option value="<?=$i?>"><?=$i?></option>
                    <?php
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-1" style="margin-right: -60px;">-</div>

              <div class="form-group">
                <div class="col-md-2">
                  <select name="form_month_akhir" class="select2_month form-control" required="">
                    <option value="Month">Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>

                <div class="col-md-1">
                  <select name="form_year_akhir" class="select2_year form-control" required="">
                    <option value="Year">Year</option>
                    <?php
                    for ($i=2016; $i <= date('Y'); $i++) {
                      ?>
                      <option value="<?=$i?>"><?=$i?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-1"><button type="submit" class="btn btn-primary">Search</button></div>
            </div>
          </form>
        </div>

        <div class="panel-body">
          <form name="alternatif_form" method="post" action="<?=base_url().'laporan/pelanggan/normalisasi'?>">
            <input type="hidden" name="form_last_month" value="<?=$bulanawal?>">
            <input type="hidden" name="form_today" value="<?=$bulanakhir?>">
            <table id="sampleTable3" class="table datatable">
             <thead>
              <tr>
                <th width="60px" style="text-align: center;" rowspan="2">#</th>
                <th rowspan="2" style="text-align: center;">Alternatif</th>
                <th colspan="3" style="text-align: center;">Kriteria</th>
              </tr>
              <tr>
                <th style="text-align: center;">C1</th>
                <th style="text-align: center;">C2</th>
                <th style="text-align: center;">C3</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              for ($i=0; $i < $count_alt ; $i++) {
                ?>
                <tr>
                  <td widtd="60px" style="text-align: center;"><?=$no++?></td>
                  <input type="hidden" name="form_id_alternatif[]" value="<?=$id_member[$i]?>">
                  <td style="text-align: left;">
                    <?=$alternatif[$i]?>
                    <input type="hidden" name="form_nama_alternatif[]" value="<?=$alternatif[$i]?>">
                  </td>
                  <td style="text-align: center;">
                    <?=$tott[$i]?>
                    <input type="hidden" name="form_criteria1[]" value="<?=$tott[$i]?>">
                  </td>
                  <td style="text-align: center;">
                    <?=$belanja[$i]?>
                    <input type="hidden" name="form_criteria2[]" value="<?=$belanja[$i]?>">
                  </td>
                  <td style="text-align: center;">
                    <?=$loyaltas[$i]?>
                    <input type="hidden" name="form_criteria3[]" value="<?=$loyaltas[$i]?>">
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
          <div class="col-md-4"></div>
          <button type="submit" class="col-md-4 btn btn-info">Next <i class='fa fa-chevron-circle-right'></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
}
elseif ($page=='tengah')
{
  // === AWAL ===
  foreach ($criteria1 as $field_criteria1) {
    $id_member[]      = $field_criteria1->id_pelanggan;
    $alternatif[]     = $field_criteria1->nama_pelanggan;
    $total_belanja[]  = $field_criteria1->total_belanja;
    $status_belanja[] = $field_criteria1->status;
  }

  $count = count($id_member);
  $last_month = date("Y-m", mktime(0,0, date("Y"), date("m")-6));
  $today    = date('Y-m');

  for($i = 0; $i < $count; $i++)
  {
    $cash[]   = $this->M_Penilaian->criteria_one_cash($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
    $credit[] = $this->M_Penilaian->criteria_one_credit($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
    $loyal[]  = $this->M_Penilaian->criteria_one_loyal($bulanawal,$bulanakhir,$id_member[$i])->num_rows();
  }

// === TENGAH ===
  foreach ($row_alternatif as $field_rowalt) {
    $id_alternatif2[]   = $field_rowalt->id_alternatif;
    $nama_alternatif2[] = $field_rowalt->nama_alternatif;
    $criteria12[]       = $field_rowalt->criteria1;
    $criteria22[]       = $field_rowalt->criteria2;
    $criteria32[]       = $field_rowalt->criteria3;
  }

  foreach ($benefitcost as $field_benefitcost) {
    $cost1[]   = $field_benefitcost->cost1;
    $cost2[]   = $field_benefitcost->cost2;
    $cost3[]   = $field_benefitcost->cost3;
    $benefit1[]   = $field_benefitcost->benefit1;
    $benefit2[]   = $field_benefitcost->benefit2;
    $benefit3[]   = $field_benefitcost->benefit3;
  }

  foreach ($kriteria as $field_kriteria) {
    $atribut[]  = $field_kriteria->atribut;
    $bobot[]    = $field_kriteria->bobot;
  }

  foreach ($totbel_sub as $field_totbel_sub) {
    $nilai1[]          = $field_totbel_sub->nilai;
  }

  foreach ($stats_sub as $field_status) {
    $nilai2[]          = $field_status->nilai;
  }

  foreach ($loyal_sub as $field_loyal_sub) {
    $nilai3[]          = $field_loyal_sub->nilai;
  }

  $count_alt = count($alternatif);
  for ($j=0; $j < $count_alt ; $j++) {
    if($total_belanja[$j]/$loyal[$j]>1500000)
    {
      $tot_belanja = $nilai1[0];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=1500000) AND ($total_belanja[$j]/$loyal[$j]>1000000))
    {
      $tot_belanja = $nilai1[1];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=1000000) AND ($total_belanja[$j]/$loyal[$j]>500000))
    {
      $tot_belanja = $nilai1[2];
    }
    elseif (($total_belanja[$j]/$loyal[$j]<=500000) AND ($total_belanja[$j]/$loyal[$j]>100000))
    {
      $tot_belanja = $nilai1[3];
    }
    elseif(($total_belanja[$j]/$loyal[$j]<=100000) AND ($total_belanja[$j]/$loyal[$j]>1000))
    {
      $tot_belanja = $nilai1[4];
    }

    $tott[]   = $tot_belanja;

    if($cash[$j]>=$credit[$j])
    {
      $cc = $nilai2[0];
    }
    else
    {
      $cc = $nilai2[1];
    }

    $belanja[] = $cc;

    if($loyal[$j]>=10)
    {
      $loyl = $nilai3[0];
    }
    elseif (($loyal[$j]<=9) AND ($loyal[$j]>=8))
    {
      $loyl = $nilai3[1];
    }
    elseif (($loyal[$j]<=7) AND ($loyal[$j]>=6))
    {
      $loyl = $nilai3[2];
    }
    elseif (($loyal[$j]<=5) AND ($loyal[$j]>=4))
    {
      $loyl = $nilai3[3];
    }
    elseif(($loyal[$j]<=3) AND ($loyal[$j]>=1))
    {
      $loyl = $nilai3[4];
    }

    $loyaltas[] = $loyl;
  }

  $count_tengah = count($id_alternatif2);
  for ($b=0; $b < $count_tengah; $b++) {
    if($atribut[0]=='cost')
    {
      $r1[] = $cost1[0]/$tott[$b];
    }
    else
    {
      $r1[] = $tott[$b]/$benefit[0];
    }

    if($atribut[1]=='cost')
    {
      $r2[] = $cost2[0]/$belanja[$b];
    }
    else
    {
      $r2[] = $belanja[$b]/$benefit2[0];
    }

    if($atribut[2]=='cost')
    {
      $r3[] = $cost3[0]/$loyaltas[$b];
    }
    else
    {
      $r3[] = $loyaltas[$b]/$benefit3[0];
    }

    $hasil1[] = $bobot[0]*$r1[$b];
    $hasil2[] = $bobot[1]*$r2[$b];
    $hasil3[] = $bobot[2]*$r3[$b];

    $sum_total[] = $hasil1[$b]+$hasil2[$b]+$hasil3[$b];
  }
/*
print_r($hasil1); echo "<br>";
print_r($hasil2); echo "<br>";
print_r($hasil3); echo "<br><br>";

print_r($sum_total); echo "<br>";
print_r($atribut); echo "<br><br>";

print_r($tott); echo "<br>";
print_r($belanja); echo "<br>";
print_r($loyaltas); echo "<br><br>";

print_r($r1); echo "<br>";
print_r($r2); echo "<br>";
print_r($r3); echo "<br><br>";

print_r($id_alternatif2); echo "<br>";
print_r($nama_alternatif2); echo "<br>";
print_r($criteria12); echo "<br>";
print_r($criteria22); echo "<br>";
print_r($criteria32); echo "<br>";

print_r($cost1); echo "<br>";
print_r($cost2); echo "<br>";
print_r($cost3); echo "<br>";
print_r($benefit1); echo "<br>";
print_r($benefit2); echo "<br>";
print_r($benefit3); echo "<br>";
*/

?>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="panel-title"> <b>Nilai Alternatif Kriteria Periode (<?=$month_title?>)</b></h2>
        <ul class="panel-controls" style="margin-top: 2px;">
        </ul>
      </div>
      <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
            <th width="60px" style="text-align: center;" rowspan="2">#</th>
            <th rowspan="2" style="text-align: center;">Alternatif</th>
            <th colspan="3" style="text-align: center;">Kriteria</th>
          </tr>
          <tr>
            <th style="text-align: center;">C1</th>
            <th style="text-align: center;">C2</th>
            <th style="text-align: center;">C3</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;

          for ($i=0; $i < $count_tengah ; $i++) {
            ?>
            <tr>
              <td widtd="60px" style="text-align: center;"><?=$no++?></td>
              <input type="hidden" name="form_id_alternatif[]" value="<?=$id_member[$i]?>">
              <td style="text-align: left;">
                <?=$alternatif[$i]?>
              </td>
              <td style="text-align: center;">
                <?=$tott[$i]?>
              </td>
              <td style="text-align: center;">
                <?=$belanja[$i]?>
              </td>
              <td style="text-align: center;">
                <?=$loyaltas[$i]?>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title"> <b>Normalisasi R</b></h2>
      <ul class="panel-controls" style="margin-top: 2px;">
      </ul>
    </div>
    <div class="panel-body">
     <table id="sampleTable3" class="table datatable">
       <thead>
        <tr>
          <th width="60px" style="text-align: center;" rowspan="2">#</th>
          <th rowspan="2" style="text-align: center;">Alternatif</th>
          <th colspan="3" style="text-align: center;">Kriteria</th>
        </tr>
        <tr>
          <th style="text-align: center;">C1</th>
          <th style="text-align: center;">C2</th>
          <th style="text-align: center;">C3</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        for ($i=0; $i < $count_tengah ; $i++) {
          ?>
          <tr>
            <td widtd="60px" style="text-align: center;"><?=$no++?></td>
            <input type="hidden" name="form_id_alternatif[]" value="<?=$id_member[$i]?>">
            <td style="text-align: left;">
              <?=$alternatif[$i]?>
            </td>
            <td style="text-align: center;">
              <?=$r1[$i]?>
            </td>
            <td style="text-align: center;">
              <?=$r2[$i]?>
            </td>
            <td style="text-align: center;">
              <?=$r3[$i]?>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="panel-title"> <b>Hasil Akhir</b></h2>
      <ul class="panel-controls" style="margin-top: 2px;">
      </ul>
    </div>
    <div class="panel-body">
      <form name="alternatif_form" method="post" action="<?=base_url().'laporan/pelanggan/rangking'?>">
        <input type="hidden" name="periode_terbaik" value="<?=$month_title?>">
        <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
            <th width="60px" style="text-align: center;">#</th>
            <th style="text-align: center;">Alternatif</th>
            <th style="text-align: center;">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          for ($i=0; $i < $count_tengah ; $i++) {
            ?>
            <tr>
              <td><?=$no++?></td>
              <input type="hidden" name="form_id_alternatif[]" value="<?=$id_alternatif2[$i]?>">
              <td><?=$alternatif[$i]?></td>
              <td style="text-align: center">
                <?=$sum_total[$i]?>
                <input type="hidden" name="form_nilai[]" value="<?=$sum_total[$i]?>">
                <input type="hidden" name="form_kunjungan[]" value="<?=$loyal[$i]?>">
                <input type="hidden" name="form_total_blanja[]" value="<?=$total_belanja[$i]/$loyal[$i];?>">
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <div class="col-md-4"></div>
      <button type="submit" class="col-md-4 btn btn-info">Perangkingan <i class='fa fa-chevron-circle-right'></i></button>
    </form>
  </div>
</div>
</div>
</div>
<?php
}
elseif($page=='akhir')
{
  foreach ($alter as $field_alter) {
    $id[]           = $field_alter->id_alternatif;
    $nama_alter[]   = $field_alter->nama_alternatif;
    $nilai[]        = $field_alter->hasil_alternatif;
    $kunjungan[]    = $field_alter->jum_kunjungan;
    $criteria2[]    = $field_alter->criteria2;
    $avg_belanja[]  = $field_alter->avg_belanja;
  }

  foreach ($double as $field_double) {
    $hasil_red[]          = $field_double->hasil_alternatif;
  }

  foreach ($hadiahalt as $field_hadiahalt) {
    $id_hadiah[] = $field_hadiahalt->id_hadiah;
  }
  $id_hadiah = $id_hadiah[0];

  foreach ($hadiah as $field_hadiah) {
    $nama_hadiah[] = $field_hadiah->nama_hadiah;
  }

  $count_alter = count($id);
  ?>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="panel-title"> <b>Hasil Akhir Periode (<?=$month_titlea?>)</b></h2>
          <ul class="panel-controls" style="margin-top: 2px;">
          </ul>
        </div>
        <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="text-align: center;" colspan="2">Hasil</th>
              <th style="text-align: center;" rowspan="2">Rangking</th>
            </tr>
            <tr>
              <th style="text-align: center;">Alternatif</th>
              <th style="text-align: center;">Nilai</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($count_alter>4)
            {
              $rank = 1;
              for ($i=0; $i < 5 ; $i++) {
                ?>
                <tr>
                  <td><?=$nama_alter[$i]?></td>
                  <td style="text-align: center">
                    <?=$nilai[$i]?>
                  </td>
                  <td style="text-align: center">
                    <?=$rank++?>
                  </td>
                </tr>
                <?php
              }
            }
            else
            {
              $rank = 1;
              for ($i=0; $i < $count_alter; $i++) {
                ?>
                <tr>
                  <td><?=$nama_alter[$i]?></td>
                  <td style="text-align: center">
                    <?=$nilai[$i]?>
                  </td>
                  <td style="text-align: center">
                    <?=$rank++?>
                  </td>
                </tr>
                <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><b>Keterangan:</b></h4>
        <?php
        for($i=1; $i < $count_alter-1; $i++){
          if(($nilai[$i-1]==$nilai[$i]) OR ($nilai[$i]==$nilai[$i+1]))
          {
            $nama_baru[] = $nama_alter[$i];
            $nilai_baru[] = $nilai[$i];
            $kunjungan_baru[] = $kunjungan[$i];
            $criteria2_baru[] = $criteria2[$i];
            $avgbelanja_baru[] = $avg_belanja[$i];
          }
          else{}
        }
        if(!empty($nama_baru))
        {
          $count_sama = count($nama_baru);
        }
        else
        {
          $count_sama = 0;
        }
        ?>

        <?php
            if($count_sama==2)
            {
              if($kunjungan_baru[0]==$kunjungan_baru[1])
              {
                if($criteria2_baru[0]==$criteria2_baru[1])
                {
                  ?>
                  <h5 class="panel-content"> *Karena <?=$nama_baru[0]?> dan <?=$nama_baru[1]?> memiliki nilai, jumlah kunjungan, dan hasil kriteria 2 (pembayaran) yang sama maka dilakukan perbandingan berdasarkan rata - rata total belanja, dengan rata - rata total belanja masing - masing adalah <?=$avgbelanja_baru[0]?> dan <?=$avgbelanja_baru[1]?>. Jadi, <b><?php echo $criteria2_baru[0] > $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $criteria2_baru[0] < $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                  <?php
                }
                else
                {
                  ?>
                  <h5 class="panel-content"> *Karena <?=$nama_baru[0]?> dan <?=$nama_baru[1]?> memiliki nilai dan jumlah kunjungan yang sama maka dilakukan perbandingan berdasarkan hasil kriteria 2 (pembayaran), dengan hasil kriteria 2 (pembayaran) masing - masing adalah <?=$criteria2_baru[0]?> dan <?=$criteria2_baru[1]?>. Jadi, <b><?php echo $criteria2_baru[0] > $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $criteria2_baru[0] < $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                  <?php
                }
              }
              else
              {
                ?>
                <h5 class="panel-content"> *Karena <?=$nama_baru[0]?> dan <?=$nama_baru[1]?> memiliki nilai yang sama maka dilakukan perbandingan berdasarkan jumlah kunjungan, dengan jumlah kunjungan masing - masing adalah <?=$kunjungan_baru[0]?> dan <?=$kunjungan_baru[1]?>. Jadi, <b><?php echo $kunjungan_baru[0] > $kunjungan_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $kunjungan_baru[0] < $kunjungan_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                <?php
              }
            }/*
            elseif($count_sama==3)
            {
              if(($kunjungan_baru[0]==$kunjungan_baru[1]) AND ($kunjungan_baru[1]==$kunjungan_baru[2]) )
              {
                if(($criteria2_baru[0]==$criteria2_baru[1]) AND ($criteria2_baru[1]==$criteria2_baru[2]) )
                {
                  ?>
                  <h5 class="panel-content"> *Karena <?=$nama_baru[0]?>, <?=$nama_baru[1]?> dan <?=$nama_baru[2]?> memiliki nilai, jumlah kunjungan, dan hasil kriteria 2 (pembayaran) yang sama maka dilakukan perbandingan berdasarkan rata - rata total belanja, dengan rata - rata total belanja masing - masing adalah <?=$avgbelanja_baru[0]?>, <?=$avgbelanja_baru[1]?> dan <?=$avgbelanja_baru[2]?>. Jadi, <b><?php echo ($criteria2_baru[0] > $criteria2_baru[1]) AND ($criteria2_baru[0] > $criteria2_baru[2]) ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $criteria2_baru[0] < $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                  <?php
                }
                else
                {
                  ?>
                  <h5 class="panel-content"> *Karena <?=$nama_baru[0]?> dan <?=$nama_baru[1]?> memiliki nilai dan jumlah kunjungan yang sama maka dilakukan perbandingan berdasarkan hasil kriteria 2 (pembayaran), dengan hasil kriteria 2 (pembayaran) masing - masing adalah <?=$criteria2_baru[0]?> dan <?=$criteria2_baru[1]?>. Jadi, <b><?php echo $criteria2_baru[0] > $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $criteria2_baru[0] < $criteria2_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                  <?php
                }
              }
              else
              {
                ?>
                <h5 class="panel-content"> *Karena <?=$nama_baru[0]?> dan <?=$nama_baru[1]?> memiliki nilai yang sama maka dilakukan perbandingan berdasarkan jumlah kunjungan, dengan jumlah kunjungan masing - masing adalah <?=$kunjungan_baru[0]?> dan <?=$kunjungan_baru[1]?>. Jadi, <b><?php echo $kunjungan_baru[0] > $kunjungan_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b> memiliki rangking diatas <b><?php echo $kunjungan_baru[0] < $kunjungan_baru[1] ? $nama_baru[0] : $nama_baru[1]?></b>.</h5>
                <?php
              }
            }*/
        ?>
        <h5 class="panel-content"> *Pelanggan Terbaik Periode <?=$month_title?> adalah <b><?=$nama_alter[0]?></b> dan berhak mendapatkan hadiah <b><?=$nama_hadiah[$id_hadiah];?></b>.</h5>
      </div>
    </div>
  </div>
</div>
<?php
}
?>