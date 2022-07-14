<section>
    <div class="block-center mt-xl" style="width: 500px;">

    <?php if($this->session->flashdata('error') !== null || strlen(validation_errors())): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <?php echo validation_errors(); ?>
    </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('succes') !== null): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('succes'); ?>
    </div>
    <?php endif; ?>
                 
        <div class="panel panel-default">
            <div class="panel-heading text-center" style="background-color: #23b7e5;">
                <a href="#">
                    <img class="block-center img-rounded" src="<?php echo base_url("assets/img/logo.png"); ?>" alt="Image">
                </a>
            </div>
            
            <div class="panel-body">
                <p class="text-center pv">DACA NU AI DEJA UN CONT CREAT, ITI POTI CREA UNUL COMPLETAND CAMPURILE DE MAI JOS.</p>
                
                <?php echo form_open("register/new/"); ?>
                <label>Adresa de email:</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="email" placeholder="Introdu adresa ta de email" required>
                        <span class="fa fa-envelope form-control-feedback text-muted"></span>
                    </div>
                
                <label>Parola:</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" id="exampleInputPassword1" name="password" type="password" value="" placeholder="Introdu parola" required>
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                <label>Confirma parola:</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" id="exampleInputPassword2" name="passwordr" type="password" value="" placeholder="Reintrodu parola de mai sus" required>
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                <label>Nume</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="nume" placeholder="Numele dvs." required>
                        <span class="fa fa-info-circle form-control-feedback text-muted"></span>
                    </div>

                <label>Prenume</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="prenume" placeholder="Prenumele dvs." required>
                        <span class="fa fa-info-circle form-control-feedback text-muted"></span>
                    </div>         
                
                <label>Telefon</label>
                    <div class="form-group has-feedback">
                        <input class="form-control" type="text" name="telefon" placeholder="Numarul dvs. de telefon" required>
                        <span class="fa fa-phone form-control-feedback text-muted"></span>
                    </div>         
                    <div align="center">
                             <?php echo $widget;?>
                             <?php echo $script;?>
                          </div>
                    <button class="btn btn-block btn-primary mt-lg" type="submit">Creaza cont</button>
             
                <?php echo form_close(); ?>
            </div>
        </div>

    </div>
</section>