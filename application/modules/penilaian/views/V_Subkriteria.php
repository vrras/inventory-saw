<?php if($page=="kriteria"){ ?>
<div class="row">
 <div class="col-lg-12">
  <div class="row">
   <div class="col-md-12"> 
     <div class="panel panel-default">
       <div class="panel-heading">         
        <h2 class="panel-title"> <b>Data Kriteria</b></h2>                            
      </div>
      <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
           <th style="text-align: center;"> #</th>
           <th>Nama Kriteria</th>
           <th style="text-align: center"></th>
         </tr>
       </thead>
       <tbody> 
         <?php $no=1;?>
         <?php foreach ($kriteria as $field_kriteria) { ?>
         <tr>
          <td style="text-align: center;"><?php echo $no; ?></td>
          <td><?php echo $field_kriteria->nm_kriteria;?></td>
          <td style="text-align: center"><a href="<?=base_url().'penilaian/subkriteria/update/'.$field_kriteria->id_kriteria?>" class="btn btn-default"><i class="glyphicon glyphicon-chevron-right"></i></a></td>
        </tr>
        <?php $no++;} ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
<?php } elseif($page=="subkriteria"){ ?>

<div class="row">
 <div class="col-md-12"> 
   <div class="panel panel-default">
     <div class="panel-heading">         
       <h2 class="panel-title"> <b>Data Subkriteria <?=$judul?></b></h2> 
       <!--<ul class="panel-controls" style="margin-top: 2px;">
         <li><a href="<?=base_url().'penilaian/subkriteria/tambah/'.$field_kriteria;?>" title="Tambah Subkriteria"><span class="glyphicon glyphicon-plus"></span></a></li>                                    
       </ul>-->                            
     </div>
     <div class="panel-body">
       <table id="sampleTable3" class="table datatable">
         <thead>
          <tr>
           <th style="text-align: center;">#</th>
           <th>List</th>
           <th>Keterangan</th>
           <th>Nilai</th>
           <th style="text-align: center">Aksi</th>
         </tr>
       </thead>
       <tbody> 
         <?php $no=1;?>
         <?php foreach ($subkriteria as $field_subkriteria) { ?>
         <tr>
          <td style="text-align: center;"><?php echo $no; ?></td>
          <td><?php echo $field_subkriteria->list;?></td>
          <td><?php echo $field_subkriteria->keterangan;?></td>
          <td><?php echo $field_subkriteria->nilai;?></td>
          <td style="text-align: center">
            <!--<a href="<?=base_url().'penilaian/subkriteria/delete/'.$field_subkriteria->id_subkriteria.'/'.$field_subkriteria->id_kriteria?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>-->
            <a href="<?=base_url().'penilaian/subkriteria/edit/'.$field_subkriteria->id_subkriteria?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
        <?php $no++;} ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>

<?php } elseif($page=="tambah") { ?>

<div class="row">
 <div class="col-md-12"> 
   <div class="panel panel-default">
     <div class="panel-heading">         
       <h2 class="panel-title"> <b>Tambah Subkriteria</b></h2>                            
     </div>
     <div class="panel-body">
       <div class="col-md-4"></div>
       <div class="col-md-4">
        <form action="<?=base_url().'penilaian/subkriteria/action/'.$id_kriteria?>" name="form1" method="POST" onsubmit="return validasi(this)" >
          <div class="form-group">
            <label class="control-label">List</label>
            <input name="form_list" required="" type="text" placeholder="Masukkan data subkriteria" class="form-control" autofocus="" focus value="">
          </div>
          <div class="form-group">
            <label class="control-label">Keterangan</label>
            <input name="form_keterangan" placeholder="Masukkan keterangan" required="" class="form-control" onkeyup="return text(this);" value="">
          </div>
          <div class="form-group">
            <label class="control-label">Nilai</label>
            <input type="text" name="form_nilai" required="" onkeyup="return angka(this);" placeholder="Masukkan nilai" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SAVE">
            <input type="button" class="btn btn-default" value="BACK" onclick="history.back(-1)"">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php } elseif($page=="edit") { ?>

<div class="row">
 <div class="col-md-12"> 
   <div class="panel panel-default">
     <div class="panel-heading">         
       <h2 class="panel-title"> <b>Edit Subkriteria</b></h2>                            
     </div>
     <div class="panel-body">
       <div class="col-md-4"></div>
       <div class="col-md-4">
         <?php foreach ($subkriteria as $field_subkriteria) { ?>
         <form action="<?=base_url().'penilaian/aksi/subkriteria'?>" name="form2" method="POST" onsubmit="return validasi(this)" >
          <input name="form_id" type="hidden" value="<?=$field_subkriteria->id_subkriteria?>">
          <div class="form-group">
            <label class="control-label">List</label>
            <input name="form_list" required="" type="text" placeholder="Masukkan data subkriteria" class="form-control" autofocus="" focus readonly value="<?=$field_subkriteria->list?>">
          </div>
          <div class="form-group">
            <label class="control-label">Keterangan</label>
            <input name="form_keterangan" placeholder="Masukkan keterangan" required="" class="form-control" onkeyup="return text(this);" value="<?=$field_subkriteria->keterangan?>">
          </div>
          <div class="form-group">
            <label class="control-label">Nilai</label>
            <input type="text" name="form_nilai" required="" onkeyup="return angka(this);" placeholder="Masukkan nilai" class="form-control" value="<?=$field_subkriteria->nilai?>">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SAVE">
            <input type="button" class="btn btn-default" value="BACK" onclick="history.back(-1)"">
          </div>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>

<?php } ?>