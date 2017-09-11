<?php
if($page == 'yearly')
  { ?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">  
        <h2 class="panel-title"> <b>Laporan Penjualan Tahunan (<?=$year?>)</b></h2> 
        <ul class="panel-controls" style="margin-top: 2px;">
         <li>
           <a href="<?= base_url().'print/penjualan/yearly/'.$year;?>" title="Print Laporan"><span class="fa fa-print"></span></a>
         </li>                                    
       </ul>                              
     </div>
     <div class="panel-body">

      <form role="form" method="POST" action="<?=base_url().'laporan/penjualan/yearly'?>">
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
       <th>ID Transaksi</th>
       <th>ID Pelanggan</th>
       <th>Nama Pelanggan</th>
       <th>Status</th>
       <th>Total Harga</th>
       <th>Bayar</th>
     </tr>
   </thead>
   <tbody>
    <?php

    $no = 1;
    foreach($trx as $field_trx){ 
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $field_trx->id_transaksi; ?></td>
        <td><?php echo $field_trx->id_pelanggan;?></td>
        <td><?php echo $field_trx->nama_pelanggan;?></td>
        <td><?php echo $field_trx->status;?></td>
        <td><?php echo $field_trx->total_harga;?></td>
        <td><?php echo "Rp. "; echo number_format($field_trx->bayar,2,',','.');?></td>
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
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">  
          <h2 class="panel-title"> <b>Laporan Penjualan Bulanan (<?=$month_title?>)</b></h2> 
          <ul class="panel-controls" style="margin-top: 2px;">
           <li>
             <a href="<?= base_url().'print/penjualan/monthly/'.$bulantahun;?>" title="Print Laporan"><span class="fa fa-print"></span></a>
           </li>                                    
         </ul>                              
       </div>
       <div class="panel-body">

         <form role="form" method="POST" action="<?=base_url().'laporan/penjualan/monthly'?>">

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
       <th>ID Transaksi</th>
       <th>ID Pelanggan</th>
       <th>Nama Pelanggan</th>
       <th>Status</th>
       <th>Total Harga</th>
       <th>Bayar</th>
     </tr>
   </thead>
   <tbody>
    <?php

    $no = 1;
    foreach($trx_month as $field_trx_month){ 
      ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $field_trx_month->id_transaksi; ?></td>
        <td><?php echo $field_trx_month->id_pelanggan;?></td>
        <td><?php echo $field_trx_month->nama_pelanggan;?></td>
        <td><?php echo $field_trx_month->status;?></td>
        <td><?php echo $field_trx_month->total_harga;?></td>
        <td><?php echo "Rp. "; echo number_format($field_trx_month->bayar,2,',','.');?></td>
      </tr>
      <?php } ?>
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
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">  
          <h2 class="panel-title"> <b>Laporan Penjualan Harian (<?=$date?>)</b></h2> 
          <ul class="panel-controls" style="margin-top: 2px;">
           <li>
             <a href="<?= base_url().'print/penjualan/daily/'.$date?>" title="Print Laporan"><span class="fa fa-print"></span></a>
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
           <th>ID Transaksi</th>
           <th>ID Pelanggan</th>
           <th>Nama Pelanggan</th>
           <th>Status</th>
           <th>Total Harga</th>
           <th>Bayar</th>
         </tr>
       </thead>
       <tbody>
        <?php

        $no = 1;
        foreach($trx_day as $field_trx){ 
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $field_trx->id_transaksi; ?></td>
            <td><?php echo $field_trx->id_pelanggan;?></td>
            <td><?php echo $field_trx->nama_pelanggan;?></td>
            <td><?php echo $field_trx->status;?></td>
            <td><?php echo $field_trx->total_harga;?></td>
            <td><?php echo "Rp. "; echo number_format($field_trx->bayar,2,',','.');?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php
}
?>