
<section>
   <div class="content-wrapper">

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

            <div class="col-lg-12">
                <div class="col-md-8">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Editeaza profilul personal</h4>
                    <br><i>Completaza doar campurile pe care doresti sa le modifici!</i><br><br>
                        <div class="md-input-wrapper">
                            <?php echo form_open_multipart("profile/updateprofile/"); ?>
                                    <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nume:</label>
                                                    <input name="nume" type="text" class="form-control" value="<?php echo $info["nume"]; ?>" maxlength="30">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prenume:</label>
                                                    <input name="prenume" type="text" class="form-control" value="<?php echo $info["prenume"]; ?>" maxlength="30">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input name="email" type="text" class="form-control" value="<?php echo $info["email"]; ?>" maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Data nasterii:</label>
                                                    <?php if($info["location"] != null) { ?>
                                                        <input name="birth1" type="text" class="form-control" value="<?php echo $info["born_date"]; ?>" id="datepicker">
                                                    <?php } else { ?>
                                                        <input name="birth1" type="text" class="form-control" placeholder="camp necompletat" id="datepicker">
                                                    <?php } ?>
                                                </div></div>

                                        <div class="form-group">
                                            <label>Telefon:</label>
                                            <input name="telefon" type="text" class="form-control"  value="<?php echo $info["phone"]; ?>" maxlength="15">
                                        </div>

                                        <div class="form-group">
                                            <label>Locatie:</label>
                                            <?php if($info["location"] != null) { ?>
                                                <input name="location" type="text" class="form-control"  value="<?php echo $info["location"]; ?>" maxlength="50">
                                            <?php } else { ?>
                                                <input name="location" type="text" class="form-control" placeholder="completeaza orasul/judet tau" maxlength="50">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Adresa detaliata:</label>
                                            <?php if($info["adress"] != null) { ?>
                                                <textarea class="form-control" name="adress" rows="3" maxlength="250"><?php echo $info["adress"]; ?></textarea>
                                            <?php } else { ?>
                                                <textarea class="form-control" name="adress" placeholder="introduceti aici adresa dvs. completa" rows="3" maxlength="250"></textarea>
                                            <?php } ?>
                                        </div> 
                                        <div class="form-group">
                                            <label>Cod postal:</label>
                                            <?php if($info["zipcode"] != null) { ?>
                                                <input name="zipcode" type="text" class="form-control"  value="<?php echo $info["zipcode"]; ?>" maxlength="50">
                                            <?php } else { ?>
                                                <input name="zipcode" type="text" class="form-control"  placeholder="completeaza codul postal" maxlength="50">
                                            <?php } ?>
                                        </div> 
                                                                          
                                    </div>
                                        <span class="md-line"></span>
                                    <div align="center">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                        Trimite informatiile
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>Editare poza profil</h4>
                    <br>
                        <div class="md-input-wrapper">
                            <img style="display: block;margin: auto;" src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo $info["picture_path"]; ?>" alt="Big avatar">
                            <div align="center">poza de profil actuala</div>
                            <br>
                            <?php echo form_open_multipart("profile/updatephoto/"); ?>
                                    <div class="form-group">
                                        <label for="subject">Profile Picture:</label>
                                            <input class="form-control" name="profilepicture" accept="image/*" type="file" enctype='multipart/form-data'>
                                            <span class="text-danger"><?php echo form_error('profilepicture'); ?></span>
                                    </div>
                                        <span class="md-line"></span>
                                    <div align="centeR">
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                        Trimite
                                    </button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
</section>
