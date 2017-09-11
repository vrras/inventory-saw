<ul class="x-navigation">
    <li class="xn-logo">
        <a href="#">KURNIA JAYA</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="xn-profile">
        <a href="#" class="profile-mini">
            <img src="<?=asset_url();?>assets/images/users/user6.jpg" alt="John Doe"/>
        </a>
        <div class="profile">
            <div class="profile-image">
                <img src="<?=asset_url();?>assets/images/users/user6.jpg" alt="John Doe"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name"><?=$this->session->userdata("full_name");?></div>
                <div class="profile-data-title"><?=$this->session->userdata("level");?></div>
            </div>
        </div>                                                                        
    </li>
    <center><li class="xn-title"><b>Daftar Menu</b></li></center>
    <li>
        <a href="<?=base_url().'dashboard/'?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
    </li>  
    <?php
    if($this->session->userdata("level")=='Pemilik'){
        ?>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-hdd-o"></span> <span class="xn-text">LAPORAN BARANG</span></a>
            <ul>
                <li><a href="<?=base_url().'laporan/barang/yearly'?>"><span class="fa fa-hdd-o"></span>YEARLY</a></li>
                <li><a href="<?=base_url().'laporan/barang/monthly'?>"><span class="fa fa-hdd-o"></span>MONTHLY</a></li>
                <li><a href="<?=base_url().'laporan/barang/daily'?>"><span class="fa fa-hdd-o"></span>DAILY</a></li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-hdd-o"></span> <span class="xn-text">LAPORAN PENJUALAN</span></a>
            <ul>
                <li><a href="<?=base_url().'laporan/penjualan/yearly'?>"><span class="fa fa-hdd-o"></span>YEARLY</a></li>
                <li><a href="<?=base_url().'laporan/penjualan/monthly'?>"><span class="fa fa-hdd-o"></span>MONTHLY</a></li>
                <li><a href="<?=base_url().'laporan/penjualan/daily'?>"><span class="fa fa-hdd-o"></span>DAILY</a></li>
            </ul>
        </li>
        <li>
            <a href="<?=base_url().'laporan/pelanggan'?>"><span class="fa fa-hdd-o"></span> <span class="xn-text">LAPORAN PELANGGAN</span></a>
        </li>
        <?php
    }else{
        ?>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-laptop"></span> <span class="xn-text">DATA BARANG</span></a>
            <ul>
                <li><a href="<?=base_url().'data/barang'?>"><span class="fa fa-hdd-o"></span>DATA BARANG</a></li>
                <li class="xn-openable">
                </li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-laptop"></span> <span class="xn-text">DATA PELANGGAN</span></a>
            <ul>
                <li><a href="<?=base_url().'data/pelanggan/input'?>"><span class="fa fa-male"></span>INPUT DATA PELANGGAN</a></li>
                <li><a href="<?=base_url().'data/pelanggan/'?>"><span class="fa fa-table"></span>LIHAT DATA PELANGGAN</a></li>
                <li class="xn-openable">
                </li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-laptop"></span> <span class="xn-text">DATA TRANSAKSI</span></a>
            <ul>
                <li><a href="<?=base_url().'trx/penjualan/'?>"><span class="fa fa-hdd-o"></span>TRANSAKSI PENJUALAN</a></li>
                <li><a href="<?=base_url().'trx/penjualan/all'?>"><span class="fa fa-hdd-o"></span>DATA SEMUA TRANSAKSI</a></li>
                <li class="xn-openable">

                </li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-laptop"></span> <span class="xn-text">DATA PENILAIAN</span></a>
            <ul>
                <li><a href="<?=base_url().'penilaian/kriteria/'?>"><span class="fa fa-hdd-o"></span>DATA KRITERIA</a></li>
                <li><a href="<?=base_url().'penilaian/subkriteria/kriteria'?>"><span class="fa fa-hdd-o"></span>DATA SUBKRITERIA</a></li>
                <li><a href="<?=base_url().'penilaian/alternatif/'?>"><span class="fa fa-hdd-o"></span>DATA ALTERNATIF</a></li>
                <li class="xn-openable">

                </li>
            </ul>
        </li>  
        <?php
    }
    ?> 
</ul>
