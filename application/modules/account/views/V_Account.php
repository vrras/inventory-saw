<?php
if($page=='utama')
{
  ?>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">  
          <h2 class="panel-title"> <b><?=$title?></b></h2> 
          <ul class="panel-controls" style="margin-top: 2px;">
           <li>
             <a href="<?= base_url().'account/new';?>" title="Tambah User"><span class="glyphicon glyphicon-plus"></span></a>
           </li>                                    
         </ul>                              
       </div>
       <div class="panel-body">
         <table id="sampleTable3" class="table datatable">
           <thead>
            <tr>
             <th style="width: 10px">#</th>
             <th style="text-align: center">Full Name</th>
             <th style="text-align: center">Username</th>
             <th style="text-align: center">Aksi</th>
           </tr>
         </thead>
         <tbody>
          <?php

          $no = 1;
          foreach($account as $field_account){ 
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $field_account->nm_user; ?></td>
              <td style="text-align: center"><?php echo $field_account->username; ?></td>
              <td>
                <?php

                if($field_account->level=='Admin')
                {
                  ?>

                  <center>
                    <a href="<?=base_url().'account/delete/'.$field_account->id_user;?>" class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                    <a href="<?=base_url().'account/edit/'.$field_account->id_user;?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                    <a href="<?=base_url().'account/newpassword/'.$field_account->id_user;?>" class="btn btn-warning"><i class="fa fa-key"></i></a>
                  </center> 

                  <?php
                }

                ?>
              </td>
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
elseif ($page=='insert') 
{
  ?>

  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-default">
        <div class="panel-heading">         
          <h2 class="panel-title"> <b><?=$title?></b></h2>                            
        </div>
        <div class="panel-body">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <form action="<?=base_url().'account/donew'?>" method="POST" >
              <div class="form-group">
                <label class="control-label">Full Name</label>
                <input name="form_nm_user" focus type="text" autocomplete="off" placeholder="Full Name" class="form-control" autofocus="" required >
              </div>
              <div class="form-group">
                <label class="control-label">Username</label>
                <input name="form_username" type="text" required placeholder="Username" class="form-control" >
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <input name="form_password" type="text" required placeholder="Password" class="form-control" >
              </div>
              <div class="form-group">
                <label class="control-label">Level</label>
                <select name="form_level" style="height: 32px;" class="form-control" reqiured>
                  <option value="">-- Pilih --</option>
                  <option value="Admin">Admin</option>
                  <option value="Pemilik">Pemilik</option>
                </select>
              </div><br>
              <div class="form-group">
               <input type="submit" class="btn btn-primary icon-btn" name="submit" value="SIMPAN">
               <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>
</div>

<?php
}
elseif ($page=='update') 
{
  ?>

  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-default">
        <div class="panel-heading">         
          <h2 class="panel-title"> <b><?=$title?></b></h2>                            
        </div>
        <div class="panel-body">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php foreach ($account as $field_account) { ?>
            <form action="<?=base_url().'account/doedit'?>" method="POST" >
              <div class="form-group">
                <input name="form_id_user" type="hidden" class="form-control" focus value="<?php echo $field_account->id_user; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Full Name</label>
                <input name="form_nm_user" type="text" autocomplete="off" placeholder="Full Name" class="form-control" autofocus="" required value="<?php echo  $field_account->nm_user; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Username</label>
                <input name="form_username" type="text" required placeholder="Username" class="form-control" value="<?php echo $field_account->username; ?>">
              </div><br>
              <div class="form-group">
               <input type="submit" class="btn btn-primary icon-btn" name="submit" value="UPDATE">
               <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
             </div>
           </div>
         </form>
         <?php } ?>
       </div>
     </div>
   </div>
 </div>
</div>

<?php
}
elseif ($page=='password') 
{
  ?>
  <script>
    function cekPass()
    {
      p1 = document.frm.form_password_baru.value;
      p2 = document.frm.form_ulangi_password.value;
      if(p1==p2)
      {
        document.frm.submit.disabled=false;
      }
      else
      {
        document.frm.submit.disabled=true;

      }
    }
  </script>

  <div class="row">
    <div class="col-md-12"> 
      <div class="panel panel-default">
        <div class="panel-heading">         
          <h2 class="panel-title"> <b><?=$title?></b></h2>                            
        </div>
        <div class="panel-body">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <?php foreach ($account as $field_account) { ?>
            <form action="<?=base_url().'account/donewpassword'?>" method="POST" name="frm">
              <div class="form-group">
                <input name="form_id_user" type="hidden" class="form-control" focus value="<?php echo $field_account->id_user; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Full Name</label>
                <input name="form_nm_user" type="text" autocomplete="off" placeholder="Full Name" class="form-control" autofocus="" required readonly="" value="<?php echo  $field_account->nm_user; ?>">
              </div>
              <div class="form-group">
                <label class="control-label">Password Baru</label>
                <input name="form_password_baru" type="password" onkeyup="cekPass();" placeholder="Password Baru" class="form-control" >
              </div>
              <div class="form-group">
                <label class="control-label">Ulangi Password</label>
                <input name="form_ulangi_password" type="password" placeholder="Ulangi Password" onkeyup="cekPass();" class="form-control">
              </div><br>
              <div class="form-group">
                <input type="submit" disabled="TRUE" class="btn btn-primary icon-btn" name="submit" value="CHANGE">
                <input type="button" class="btn btn-default" value="BATAL" onclick="history.back(-1)"">
              </div>
            </div>
          </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php  
}
?>