 <div class="row">
   <div class="col-lg-12">
    <div class="row">
     <div class="col-md-12"> 
       <div class="panel panel-default">
         <div class="panel-heading">         
          <h2 class="panel-title"> <b>Data Kriteria</b></h2>   
          <ul class="panel-controls" style="margin-top: 2px;">
            <li><a href="<?=base_url().'penilaian/kriteria/edit/1';?>" title="Batalkan Transaksi"><span class="fa fa-edit"></span></a></li>                                       
          </ul>                              
        </div>
        <div class="panel-body">
         <table id="sampleTable3" class="table datatable">
           <thead>
            <tr>
             <th style="text-align: center;"> #</th>
             <th>Nama Kriteria</th>
             <th>Atribut</th>
             <th>Bobot</th>
           </tr>
         </thead>
         <tbody>
           <?php $no=1;?>
           <?php foreach ($kriteria as $field_kriteria) { ?>
           <tr>
            <td style="text-align: center;"><?php echo $no; ?></td>
            <td><?php echo $field_kriteria->nm_kriteria;?></td>
            <td><?php echo $field_kriteria->atribut;?></td>
            <td><?php echo $field_kriteria->bobot; ?></td>
          </tr>
          <?php $no++;} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
