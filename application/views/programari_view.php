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
                            <center><h4>Programari viitoare</h4></center>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($futureAppointments) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>La doctorul</th>
                                            <th>Data</th>
                                            <th>Ora ceruta</th>
                                            <th>Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($futureAppointments as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo getUserData($row->doctorid, "nume")." ".getUserData($row->doctorid, "prenume"); ?></td>
                                        <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($row->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?></td>
                                        </td>
                                        <td><?php echo interval_orar($row->hour); ?></td>
                                        <td><?php if($row->verified == 0) { ?>
                                                  <font color="red">in asteptare.</font>
                                                  <?php } else { ?>
                                                  <i>acceptata</i>, ora <?php echo $row->confirmed_hour; ?>.
                                                  <?php } ?></td>
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
                      <center><h4>Ultimele 20 programari vechi / expirate</h4></center>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($oldAppointments) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>La doctorul</th>
                                            <th>Data</th>
                                            <th>Interval orar</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($oldAppointments as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo getUserData($row->doctorid, "nume")." ".getUserData($row->doctorid, "prenume"); ?></td>
                                        <td><?php echo $row->date; ?></td>
                                        <td><?php echo interval_orar($row->hour); ?></td>
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

        </div>
    </div>
</section>