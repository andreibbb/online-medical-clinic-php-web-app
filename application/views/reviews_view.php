<section>
    <div class="content-wrapper">
        <h3>Recenzii</h3>

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
                <?php if(!($this->session->userdata('logged_in')['id'])) { ?>
                    <div class="col-md-12">
                <?php } else { ?>
                    <div class="col-md-7">
                <?php } ?>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><center><i class="fas fa-user-clock"></i> Ultimele 5 recenzii lasate de utilizatori pe website</center></h4>
                        <br>
                        <?php if($last5reviews) { ?>
                            <?php $index1 = 1; ?>
                            <?php foreach($last5reviews as $row) { ?>
                                <table class="table table-responsive">
                                    <tr>
                                        <td>#ID
                                        </td>         
                                        <td><?php echo $index1; $index1++; ?> 
                                        </td>
                                        <td width="50%" rowspan="5"><i>Recenzie:</i><br><br><?php echo $row->text; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Doctor
                                        </td>         
                                        <td><a href="<?php echo base_url(); ?>/profile/<?php $row->doctorID; ?>"><?php echo getUserFullName($row->doctorID); ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pacient
                                        </td>         
                                        <td><?php echo getUserData($row->clientID, "prenume"); ?> <?php $numecomplet = getUserData($row->clientID, "nume"); ?> <?php echo $numecomplet[0]; ?>******
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rating</td>
                                        <td>
                                                <?php for($index = 0; $index < $row->ratingValue; $index++) { ?>
                                                    <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                <?php } ?>
                                    </tr>
                                    <tr>
                                        <td>Data adaugarii recenziei</td>
                                        <td><?php echo $row->addedDate; ?></td>
                                    </tr>                                    
                                </table>
                                <hr>
                                <br>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                
                <?php if($this->session->userdata('logged_in')['id']) { ?>
                <div class="col-md-5">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><center><i class="fas fa-file-pdf"></i> Ultimele 5 recenzii lasate de dvs</center></h4>
                        <br>
                            <?php if($last5reviewsByUser) { ?>
                                <?php $index_user = 1; ?>
                                <?php foreach($last5reviewsByUser as $row) { ?>
                                    <table class="table table-responsive">
                                        <tr>
                                            <td>#ID
                                            </td>         
                                            <td><?php echo $index_user; $index_user++; ?> 
                                            </td>
                                            <td width="50%" rowspan="4"><i>Recenzie:</i><br><br><?php echo $row->text; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Doctor
                                            </td>         
                                            <td><a href="<?php echo base_url(); ?>/profile/<?php $row->doctorID; ?>"><?php echo getUserFullName($row->doctorID); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rating</td>
                                            <td>
                                                    <?php for($index = 0; $index < $row->ratingValue; $index++) { ?>
                                                        <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                    <?php } ?>
                                        </tr>
                                        <tr>
                                            <td>Data adaugarii recenziei</td>
                                            <td><?php echo $row->addedDate; ?></td>
                                        </tr>                                    
                                    </table>
                                    <br>
                            <?php } } else { ?>
                                Nu ati lasat nicio recenzie.
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
    </div>
</section>
<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>