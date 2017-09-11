<?php
if($page == 'yearly')
  { ?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">  
        <h2 class="panel-title"> <b>Laporan Barang Tahunan (<?=$year?>)</b></h2> 
        <ul class="panel-controls" style="margin-top: 2px;">
         <li>
           <a href="<?= base_url().'print/barang/yearly/'.$year;?>" title="Print Laporan"><span class="fa fa-print"></span></a>
         </li>                                    
       </ul>                              
     </div>
     <div class="panel-body">

      <form role="form" method="POST" action="<?=base_url().'laporan/barang/yearly'?>">
        <div class="form-group">
          <div class="col-md-1">
            <select name="form_year" class="select2_year form-control" required>
              <option value="<?=date('Y')?>">Year</option>
              <?php
              for ($i=2016; $i <= date('Y'); $i++) { 
                ?>
                <option value="<?=$i?>"><?=$i?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="col-md-1"><button type="submit" class="btn btn-primary">Search</button></div>
        </div>
      </form>

      <!--
      <div class="form-group" id="data_1">
        <div class="col-md-2">
          <div class="input-group date">
            <input type="text" class="form-control" value="<?=date('d-m-Y')?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
      </div>
    -->

  </div>
  <div class="panel-body">
   <table id="sampleTable3" class="table datatable">
     <thead>
      <tr>
       <th>#</th>
       <th>ID Barang</th>
       <th>Nama Barang</th>
       <th>Stok</th>
       <th>Terjual</th>
       <th>Sisa</th>
     </tr>
   </thead>
   <tbody>
    <?php

    $no = 1;
    foreach($trx as $field_trx){ 
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $field_trx->id_barang; ?></td>
        <td><?php echo $field_trx->nm_barang;?></td>
        <td><?php echo $field_trx->quantity+$field_trx->qty;?></td>
        <td><?php echo $field_trx->qty;?></td>
        <td><?php echo $field_trx->quantity;?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
</div>
</div>

<?php
}elseif ($page == "monthly") {

  foreach ($trx_stok as $field_stok) {
    $id_barang[]  = $field_stok->id_barang;
    $nm_barang[]  = $field_stok->nm_barang;
    $quantity[]   = $field_stok->quantity;
  }

  foreach ($trx_month as $field_trx) {
    $id_barang1[]  = $field_trx->id_barang;
    $nm_barang1[]  = $field_trx->nm_barang;
    $qty[]         = $field_trx->qty;
  }

  if(!empty($id_barang1))
  {
    $tampung = array_intersect($id_barang, $id_barang1);

    foreach ($tampung as $key => $value) {
      $a[]  = $key;
    }
  }
  else
  {

  }
  
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">  
          <h2 class="panel-title"> <b>Laporan Penjualan Bulanan (<?=$month_title?>)</b></h2> 
          <ul class="panel-controls" style="margin-top: 2px;">
           <li>
             <a href="<?= base_url().'print/barang/monthly/'.$bulantahun;?>" title="Print Laporan"><span class="fa fa-print"></span></a>
           </li>                                    
         </ul>                              
       </div>
       <div class="panel-body">

         <form role="form" method="POST" action="<?=base_url().'laporan/barang/monthly'?>">

          <div class="form-group">
            <div class="col-md-2">
              <select name="form_month" class="select2_month form-control" required>
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
              <select name="form_year" class="select2_year form-control" required>
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
            <div class="col-md-1"><button type="submit" class="btn btn-primary">Search</button></div>
          </div>
        </form>

      <!--
      <div class="form-group" id="data_1">
        <div class="col-md-2">
          <div class="input-group date">
            <input type="text" class="form-control" value="<?=date('d-m-Y')?>">
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
      </div>
    -->

  </div>
  <div class="panel-body">
   <table id="sampleTable3" class="table datatable">
     <thead>
      <tr>
       <th>#</th>
       <th>ID Barang</th>
       <th>Nama Barang</th>
       <th>Stok</th>
       <th>Terjual</th>
       <th>Sisa</th>
     </tr>
   </thead>
   <tbody>
     <?php

     if(!empty($id_barang1))
     {
      $no = 1;
      $j  = 0;
      for($i = $a[$j]; $i <= end($a); $i++){ 
        ?>

        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $id_barang[$i]; ?></td>
          <td><?php echo $nm_barang[$i];?></td>
          <td><?php echo $quantity[$i];?></td>
          <td><?php echo !empty($qty[$i])? $qty[$i] : $qty[$j]?></td>
          <td><?php echo !empty($qty[$i])? $quantity[$i]-$qty[$i] : $quantity[$i]-$qty[$j]?></td>
        </tr>

        <?php
      }
    }
    else
    {
      ?>


      <?php
    }

    ?>

  </tbody>
</table>
</div>
</div>
</div>
</div> 

<?php

}
else
{

  foreach ($trx_stok as $field_stok) {
    $id_barang[]  = $field_stok->id_barang;
    $nm_barang[]  = $field_stok->nm_barang;
    $quantity[]   = $field_stok->quantity;
  }

  foreach ($trx_day as $field_trx) {
    $id_barang1[]  = $field_trx->id_barang;
    $nm_barang1[]  = $field_trx->nm_barang;
    $qty[]         = $field_trx->qty;
  }

  if(!empty($id_barang1))
  {
    $tampung = array_intersect($id_barang, $id_barang1);

    foreach ($tampung as $key => $value) {
      $a[]  = $key;
    }
  }
  else
  {

  }

  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">  
          <h2 class="panel-title"> <b>Laporan Barang Harian (<?=$date?>)</b></h2> 
          <ul class="panel-controls" style="margin-top: 2px;">
           <li>
             <a href="<?= base_url().'print/barang/daily/'.$date?>" title="Print Laporan"><span class="fa fa-print"></span></a>
           </li>                                    
         </ul>                              
       </div>

       <div class="panel-body">

         <form role="form" method="POST" action="">
          <div class="form-group" id="data_3">
            <div class="col-md-2">
              <div class="input-group date">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="form_date" class="form-control" value="<?=substr($date,0,4).'-'.substr($date,5,2).'-'.substr($date,-2)?>">

              </div>
            </div>
            <div class="col-md-1"><button type="submit" class="btn btn-primary">Search</button></div>
          </div>
        </form>

      </div>

      <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
           <th>#</th>
           <th>ID Barang</th>
           <th>Nama Barang</th>
           <th>Stok</th>
           <th>Terjual</th>
           <th>Sisa</th>
         </tr>
       </thead>
       <tbody>
         <?php

         if(!empty($id_barang1))
         {
          $no = 1;
          $j  = 0;

          for($i = $a[$j]; $i <= end($a); $i++){ 
            if($i!=$a[$j])
            {
              continue;
            }
            ?>

            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $id_barang[$i]; ?></td>
              <td><?php echo $nm_barang[$i];?></td>
              <td><?php echo $quantity[$i];?></td>
              <td><?php echo !empty($qty[$i])? $qty[$j] : $qty[$j]?></td>
              <td><?php echo !empty($qty[$i])? $quantity[$i]-$qty[$j] : $quantity[$i]-$qty[$j]?></td>
            </tr>

            <?php
            $j = $j+1;
          }
        }
        else
        {
          ?>


          <?php
        }

        ?>

      </tbody>
    </table>
  </div>
</div>
</div>
</div>

<?php
}
?>