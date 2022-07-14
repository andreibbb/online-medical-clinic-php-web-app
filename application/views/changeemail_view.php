
<section>
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


    <div class="content-wrapper">

                <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Schimba-ti adresa de email</h3>
                        <br>
                         <div class = "alert alert-info" style="background:#BC2F20;">
                            <b>Atentie!</b><br>
                            Odata ce ai schimbat emailul, nu vei mai putea recupera contul daca nu ai acces la noul email.<br>
                            Poti schimba mail-ul o singura data la 24 de ore.<br>
                        </div>
                        <br>
                        <div class="col-lg-4">
                            <?php echo form_open("changeemail/change/"); ?>
                                <div class="md-input-wrapper">
                                    <label>Introdu aici noua adresa de email: </label>
                                    <input name="newmail" type="email" class="form-control" maxlength="50" required>
                                    <span class="md-line"></span>
                                </div>
                                <br>
                                <div class="md-input-wrapper">
                                    <label>Introdu aici parola ta: </label>
                                    <input name="password" type="password" class="form-control" maxlength="50" required>
                                    <span class="md-line"></span>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-purple waves-effect waves-light">
                                    Continua
                                </button>
                            <?php echo form_close(); ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>