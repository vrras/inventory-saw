<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">  
        <h2 class="panel-title"> <b>Data Barang Masuk</b></h2> 
        <ul class="panel-controls" style="margin-top: 2px;">
         <li>
         <a href="<?= base_url().'data/barang/input/';?>" title="Tambah Barang"><span class="glyphicon glyphicon-plus"></span></a>
         </li>                                    
       </ul>                              
     </div>
     <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
           <th>Nomor</th>
           <th>Nama Barang</th>
           <th>Quantity</th>
           <th>Harga</th>
           <th>Aksi</th>
         </tr>
       </thead>
       <tbody>
        <?php

        $no = 1;
        foreach($barang as $field_barang){ 
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $field_barang->nm_barang; ?></td>
            <td><?php echo $field_barang->quantity; echo " unit"; ?></td>
            <td><?php echo "Rp. "; echo number_format($field_barang->harga,2,',','.');?></td>
            <td><center><a href="<?=base_url().'data/barang/delete/'.$field_barang->id_barang;?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a><a href="<?=base_url().'data/barang/edit/'.$field_barang->id_barang;?>" class="btn btn-default"><i class="fa fa-edit"></i></a></center> </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
