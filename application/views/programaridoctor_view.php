<section> 
    <div class="content-wrapper">
        <h3>Programarile dvs. (<?php echo $personalInformations->nume; ?> <?php echo $personalInformations->prenume; ?>)</h3>
        
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
        
        <div class="row">         
            <div class="col-md-7">
                <div class="panel b">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <center><h4>Programarile pentru astazi <?php echo date('d/m/Y'); ?></h4></center>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($todayAppointments) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nume pacient</th>
                                            <th>Ora</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($todayAppointments as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->clientid; ?>"><?php echo getUserData($row->clientid, "nume")." ".getUserData($row->clientid, "prenume"); ?></a></td>
                                        <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($row->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?>, ora <?php echo $row->confirmed_hour; ?></td>
                                        <td><a href="<?php echo base_url(); ?>programari/view/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">view</a></td>
                                    </tr>
                                    <?php } } else { ?>
                                      Nu a fost gasita nicio programare.
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel b">
                    <div class="panel-body">
                      <center><h4>Viitoarele 40 de programari</h4></center>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($tomorrowAppointments) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nume pacient</th>
                                            <th>Data</th>
                                            <th>Ora</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($tomorrowAppointments as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->clientid; ?>"><?php echo getUserData($row->clientid, "nume")." ".getUserData($row->clientid, "prenume"); ?></a></td>
                                        <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($row->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?></td>
                                        <td>ora <?php echo $row->confirmed_hour; ?></td>
                                        <td><a href="<?php echo base_url(); ?>programari/view/<?php echo $row->id; ?>" class="btn btn-purple btn-xs">view</a></td>
                                    </tr>
                                    <?php } } else { ?>
                                      Nu a fost gasita nicio programare.
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-7">
                <div class="panel b">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <center><h4>Programarile pentru data de ieri <?php $yesterdayDate = date('m/d/Y');  echo date('d/m/Y', strtotime($yesterdayDate. '-1 days')); ?></h4></center>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($yesterdayAppointments) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nume pacient</th>
                                            <th>Ora</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($yesterdayAppointments as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->clientid; ?>"><?php echo getUserData($row->clientid, "nume")." ".getUserData($row->clientid, "prenume"); ?></a></td>
                                        <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($row->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?>, ora <?php echo $row->confirmed_hour; ?></td>
                                        <td><a href="<?php echo base_url(); ?>programari/view/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">view</a></td>
                                    </tr>
                                    <?php } } else { ?>
                                      Nu a fost gasita nicio programare.
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>