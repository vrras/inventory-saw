<script type="text/javascript" src="<?=asset_url();?>js/plugins/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?=asset_url();?>js/plugins/jquery/jquery-ui.js"></script>

<script type="text/javascript">
  function angka(obj){
    var pola = "^";
    pola += "[0-9 ) ( - .]*";
    pola += "$";
    rx = new RegExp(pola);
    if (!obj.value.match(rx)){
      if (obj.lastMatched){
        obj.value = obj.lastMatched;
    }
    else {
        obj.value = "";
    }
}
else {
  obj.lastMatched = obj.value;
}
}
function text(obj){
    var pola = "^";
    pola += "[a-zA-Z ' .]*";
    pola += "$";
    rx = new RegExp(pola);
    if (!obj.value.match(rx)){
      if (obj.lastMatched){
        obj.value = obj.lastMatched;
    }
    else {
        obj.value = "";
    }
}
else {
  obj.lastMatched = obj.value;
}
}
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-7">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title"> <b>Data Barang Penjualan</b></h2>
                </div>

                <div class="panel-body">
                    <table id="sampleTable3" class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="text-align: center;" width="70px">Stok</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th style="text-align: center;">Qty+DISC.</th>
                                <th style="text-align: center;">ADD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php foreach ($barang as $field_barang) { ?>
                            <tr>
                                <form name="keranjang_form" action="<?=base_url().'trx/penjualan/keranjang/';?>" method="POST">
                                    <td><?php echo $no++; ?></td>
                                    <td style="text-align: center;"><?=$field_barang->quantity; ?></td>
                                    <td><?php echo $field_barang->nm_barang; ?></td>
                                    <td><?php echo "Rp. "; echo number_format($field_barang->harga,2,',','.');?></td>
                                    <td>
                                        <input type="text" hidden name="id_barang" value="<?php echo $field_barang->id_barang; ?>">
                                        <input type="text" name="qty" id="qty" required="required" onkeypress="return number_only(event)" placeholder="Qty" size="2" maxlength="3" style="text-align: center; margin-right: 3px;">
                                        <input type="text" maxlength="3" onkeypress="return number_only(event)" name="disc" placeholder="0 %" size='2' style="text-align: center;">
                                        <input type="text" hidden name="batas" id="batas" value="<?php echo $field_barang->quantity; ?>">
                                    </td>
                                    <td>
                                        <?php

                                        if($field_barang->quantity=='0')
                                        {
                                            ?>
                                            <font color="red" align="center"><i>Stok habis!</i></font>
                                            <?php
                                        }else{
                                            ?>
                                            <center>
                                                <button class="btn btn-default" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                            </center>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </form>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title"> <b>Keranjang Penjualan</b></h2>
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="<?=base_url().'trx/penjualan/batalall/';?>" onclick="return confirm('Yakin ingin membatalkan transaksi?');"  title="Batalkan Transaksi"><span class="glyphicon glyphicon-trash"></span></a></li>
                    </ul>
                </div>

                <div class="panel-body">

                    <table id="sampleTable3" class="table datatable">
                        <thead>
                            <tr>
                                <th width="50px">#</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Disc.</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no  = 1;

                            $sub_total = 0;
                            $total_harga = 0;

                            foreach ($trx as $field_trx) {
                                $dis     = (($field_trx->qty * $field_trx->harga)*$field_trx->disc)/100;
                                $costsum = ($field_trx->qty * $field_trx->harga)-$dis;
                                $total_harga = $total_harga + $costsum;
                                ?>
                                <form name="form_cart" action="" method="get">
                                    <tr>
                                        <td><?=$no;?></td>
                                        <td><?=$field_trx->nm_barang;?></td>
                                        <td><?php echo "Rp. ". number_format($field_trx->harga,0,',','.')." x ".$field_trx->qty;?></td>
                                        <td><?=$field_trx->disc;?></td>
                                        <?php
                                        if($field_trx->disc==0)
                                        {
                                            ?>
                                            <td>
                                                <?php echo "Rp. ". number_format($field_trx->harga * $field_trx->qty,0,',','.');?>

                                            </td>
                                            <td>
                                                <a href='<?=base_url().'trx/penjualan/batal/'.$field_trx->id_barang?>' onclick="return confirm('Yakin ingin membatalkan barang?');"><button style="color: black" type="submit"><i class="fa fa-times"></i></button></a>
                                            </td>
                                            <?php
                                        }else{
                                            ?>
                                            <td>
                                                <?php echo "Rp. ". number_format($costsum,0,',','.');?>
                                            </td>
                                            <td>
                                                <a href='<?=base_url().'trx/penjualan/batal/'.$field_trx->id_barang?>' onclick="return confirm('Yakin ingin membatalkan?');"><button style="color: black" type="submit"><i class="fa fa-times"></i></button></a>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                </form>
                                <?php
                                $no++;
                            }

                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='2'><b>TOTAL BAYAR</b></td>
                                <td colspan='4' align="right">Rp. <b style="color: red; font-size: 18px;" class='w3-text-red w3-small w3-right'><?php echo number_format($total_harga,2,',','.') ?></b></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class='w3-card-2 w3-light-blue'>
                        <?php
                        if(isset($pelanggan)==""){?>
                        <form action='<?=base_url().'trx/penjualan/pelanggan'?>' method='POST' class='w3-container'>
                            <input type='hidden' name='form_total' id='total' value='<?php echo isset($total_harga) ? $total_harga : 0; ?>'>
                            <div id="hilang" class="form-group">
                                <div class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">ID Pelanggan</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" autocomplete=off onkeyup="return angka(this);" id="id_pel" name='form_id_pelanggan'>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <p class="col-md-5"></p>
                                <p class="col-md-2">
                                    <button type="submit" class="btn btn-info">Next <i class='fa fa-chevron-circle-right'></i></button>
                                </p>
                            </div>
                        </form>
                        <?php }elseif($pelanggan=="baru"){?>
                        <form action='<?=base_url().'trx/penjualan/simpan'?>' method='POST' class='w3-container'>
                            <input type='hidden' name='form_total' id='total' value='<?php echo isset($total_harga) ? $total_harga : 0; ?>'>
                            <input class="form-control" type="hidden" autocomplete=off onkeyup="return angka(this);" id="id_pel" value="" name='form_id_pelanggan'>
                            <div class="form-group">
                                <div id="nm_pel" class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Nama Pelanggan</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-7">
                                        <input type="text" required="" name='form_nama' id='nama' onkeyup="return text(this);" autocomplete="" class="form-control" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Bayar</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-2"><span class="input-group-addon">Rp.</span></div>
                                    <div class="col-md-5">
                                        <input type="text" required="" name='form_jmlbayar' id='bayar' onkeyup="return angka(this);" class="form-control" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <div class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Status Pembayaran</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type='radio' class='w3-radio' name='form_status' value='cash' checked>
                                        <label class='w3-validate'>CASH</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input onch type='radio' class='w3-radio' name='form_status' value='credit'>
                                        <label class='w3-validate'>CREDIT</label>
                                    </div>
                                </div>
                                -->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="col-md-5"><button id="save" type="submit" class="btn btn-info"><i class='fa fa-save'></i> Simpan Transaksi</button></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4"> <a href="<?=base_url().'trx/penjualan/'?>"><button type="button" class="btn btn-info"><i class='fa fa-chevron-circle-left'></i> Kembali</button></a> </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php }else{ ?>
                        <form action='<?=base_url().'trx/penjualan/simpan'?>' method='POST' class='w3-container'>
                            <input type='hidden' name='form_total' id='total' value='<?php echo isset($total_harga) ? $total_harga : 0; ?>'>
                            <?php foreach ($pelanggan as $field_member) { ?>
                            <input class="form-control" type="hidden" autocomplete=off onkeyup="return angka(this);" id="id_pel" value="<?=$field_member->id_pelanggan?>" name='form_id_pelanggan'>
                            <div class="form-group">
                                <div id="nm_pel" class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Nama Pelanggan</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-5">
                                        <input type="text" readonly="" required="" name='form_nama' value="<?=$field_member->nama_pelanggan?>" id='nama' onkeyup="return text(this);" autocomplete="" class="form-control" autofocus="">
                                    </div>
                                    <?php
                                    if( $field_member->status=='member'){ ?>
                                    <div class="col-md-2"><i><label class="check"> *Member</label></i></div>
                                    <?php }elseif($field_member->status=='no_member'){ ?>
                                    <div class="col-md-2"><i><label class="check"> *Pelanggan</label></i></div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Bayar</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-2"><span class="input-group-addon">Rp.</span></div>
                                    <div class="col-md-5">
                                        <input type="text" required="" name='form_jmlbayar' id='bayar' onkeyup="return angka(this);" class="form-control" autofocus="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <!--
                                <div class="col-md-12"><br>
                                    <div class="col-md-4">
                                        <label class="control-label">Status Pembayaran</label>
                                    </div>
                                    <div class="col-md-1">:</div>
                                    <div class="col-md-3">
                                        <input type='radio' class='w3-radio' name='form_status' value='cash' checked>
                                        <label class='w3-validate'>CASH</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input onch type='radio' class='w3-radio' name='form_status' value='credit'>
                                        <label class='w3-validate'>CREDIT</label>
                                    </div>
                                </div>
                            -->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="col-md-5"><button id="save" type="submit" class="btn btn-info"><i class='fa fa-save'></i> Simpan Transaksi</button></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-4"> <a href="<?=base_url().'trx/penjualan/'?>"><button type="button" class="btn btn-info"><i class='fa fa-chevron-circle-left'></i> Kembali</button></a> </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div><br>
    </div>
</div>
</div>