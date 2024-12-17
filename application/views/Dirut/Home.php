<?php
$data['tittle'] = "Halaman Utama";
$this->load->view('template/head', $data);
?>

<body>
    <div id="wrapper">
        <?php $this->load->view('template/navbar'); ?>
        <!--/. NAV TOP  -->
        <?php $this->load->view('template/menu'); ?>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div class="header">
                <h2 class="page-header">Dashboard</h2>
                <?= $this->session->flashdata('pesan'); ?>
                <ol class="breadcrumb">
                    <li><a href="#"><?php $str = $this->session->userdata('nama_pegawai');
                                    echo wordwrap($str, 30, "<br>\n"); ?></a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>

            <div id="page-inner">
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                                <div class="number">
                                    <h3>
                                        <h3><?= $jmlh[0]['id'] ?></h3>
                                        <small>Total aset aktif</small>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-laptop fa-5x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                                <div class="number">
                                    <h3>
                                        <h3><?= $stts_dipinjam[0]['dipinjam'] ?></h3>
                                        <small>Aset terpinjam</small>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-handshake-o fa-5x green"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="board">
                            <div class="panel panel-primary">
                                <div class="number">
                                    <h3>
                                        <h3><?= $stts_dikembalikan[0]['dikembalikan'] ?></h3>
                                        <small>Aset dikembalikan</small>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-handshake-o fa-5x blue"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default chartJs">
                                <div class="panel-heading">
                                    <div class="card-title">
                                        <div class="title">Jumlah Aset Perkategori</div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="asetPerkategori" style="height: 300px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default chartJs">
                                <div class="panel-heading">
                                    <div class="card-title">
                                        <div class="title">Status Usulan Pengadaan</div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="usulanPengadaan" style="height: 300px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <?php $this->load->view('template/copyright') ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <?php $this->load->view('template/script') ?>

        <!-- <script src="<?= base_url(); ?>assets_app/js/custom-scripts.js"></script> -->
        <!-- Chart Js -->
        <script type="text/javascript" src="<?= base_url(); ?>assets_app/js/Chart.min.js"></script>
        <script>
            var get_data_aset = '<?= base_url('Aset/get_data_aset') ?>';
            var get_status = '<?= base_url('Aset/get_status') ?>';
        </script>
        <script type="text/javascript" src="<?= base_url(); ?>assets_app/js/chartjs.js"></script>

</body>

</html>