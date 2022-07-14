<section>
    <div class="content-wrapper">
        <h3>Despre noi</h3>

        <?php if($this->session->flashdata('error') !== null): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success') !== null): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>
        
            <div class="container container-md">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel b">
                            <div class="panel body">
                                <table class="table table-responsive">
                                    <tr>
                                        <td><img src="<?php echo base_url(); ?>assets/img/desprenoi1.jpg" class="img-responsive"></td>
                                        <td><h2>MediCare Romania</h2><br>
                                        <h4>Singura companie privata de ingrijire medicala si de diagnostic cu experienta internationala.</h4><br></td>
                                    </tr>
                                    <tr>
                                        <td><h2>Grupul MediCare</h2><br>
                                        <h4>Unul dintre cei mai importanti furnizori internationali de servicii medicale si de diagnostic.</h4><br><br></td>
                                        <td><img src="<?php echo base_url(); ?>assets/img/desprenoi2.jpg" class="img-responsive"></td>
                                    </tr>
                                    <tr>
                                        <td><img src="<?php echo base_url(); ?>assets/img/desprenoi3.jpg" class="img-responsive"></td>
                                        <td><h2>Asociatia MediCare</h2><br>
                                        <h4>Impreuna putem face mai mult!</h4><br><br></td>
                                    </tr>
                                    <tr>
                                        <td><h2>Acreditari</h2><br>
                                        <h4>Servicii sigure din punct de vedere calitativ, al respectarii normelor de sanatate si securitate in munca si al asigurarii protectiei mediului inconjurator.</h4></td>
                                        <td><img src="<?php echo base_url(); ?>assets/img/desprenoi4.jpg" class="img-responsive"></td>
                                    </tr>                            
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>