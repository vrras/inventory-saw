  <div class="row">
    <div class="col-md-12">       
     <div class="panel panel-default">
      <div class="panel-heading">                                
        <h2 class="panel-title"><b>Data Member</b></h2>                              
      </div>
      <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
           <th>Id_Pelanggan</th>
           <th>NIK</th>
           <th>Nama_Pelanggan</th>
           <th>Jenis Kelamin</th>
           <th>Alamat</th>
           <th>Nomor Telepon</th>
           <th style="text-align: center;">Aksi</th>
         </tr>
       </thead>
       <tbody> 
         <?php foreach ($member as $field_member) { ?>
         <tr>
          <td><?=$field_member->id_pelanggan?></td>
          <td><?=$field_member->NIK?></td>
          <td><?=$field_member->nama_pelanggan?></td>
          <td><?=$field_member->jenis_kelamin?></td>
          <td><?=$field_member->alamat?></td>
          <td><?=$field_member->no_telpon?></td>
          <td>
            <center>
              <a href="<?=base_url().'data/pelanggan/delete/'.$field_member->id_pelanggan;?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
              <a href="<?=base_url().'data/pelanggan/edit/'.$field_member->id_pelanggan;?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
            </center>
          </td>
        </tr>
        <?php } ?>                 
      </tbody>
    </table>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">                                
    <h2 class="panel-title"><b>Data Pelanggan</b></h2>                      
  </div>
  <div class="panel-body">
   <table id="sampleTable2" class="table datatable">
    <thead>  
      <tr>
        <th>Id_Pelanggan</th>
        <th>Nama_Pelanggan</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Nomor Telepon</th>
        <th style="text-align: center;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pelanggan as $field_member) { ?>
      <tr>
        <td><?=$field_member->id_pelanggan?></td>
        <td><?=$field_member->nama_pelanggan?></td>
        <td><?=$field_member->jenis_kelamin?></td>
        <td><?=$field_member->alamat?></td>
        <td><?=$field_member->no_telpon?></td>
        <td>
          <center>
            <a href="<?=base_url().'data/pelanggan/delete/'.$field_member->id_pelanggan;?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
            <a href="<?=base_url().'data/pelanggan/edit/'.$field_member->id_pelanggan;?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
          </center>
        </td>
      </tr>
      <?php } ?>  
    </tbody>
  </table>
</div>
</div>
</div>

</div>
