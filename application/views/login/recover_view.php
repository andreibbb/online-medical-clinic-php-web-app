<section>
    <div class="block-center mt-xl wd-xxl">
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
        
        <div class="panel panel-default">
                    <div class="panel-heading text-center" style="background-color: #23b7e5;">
                       <a href="#">
                          <img class="block-center img-rounded" src="<?php echo base_url("assets/img/logo.png"); ?>" alt="Image">
                       </a>
                    </div>
            <div class="panel-body">
                <p class="text-center pv">RECUPERARE PAROLA</p>
                <?php echo form_open("login/recoverpassw/"); ?>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="email" placeholder="Introdu email-ul" required>
                        <span class="fa fa-envelope form-control-feedback text-muted"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="phone" placeholder="Introdu numarul tau de telefon" required>
                        <span class="fa fa-phone form-control-feedback text-muted"></span>
                    </div>
                
                    <button class="btn btn-block btn-primary mt-lg" type="submit">Recuperare cont</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>