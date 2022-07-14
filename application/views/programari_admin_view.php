<section>
    <div class="content-wrapper">
        <h3>Lista programarilor</h3>
        
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
            <div class="col-md-12">
                <div class="panel b">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">                                
                                  <?php if($results) { ?>
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Pacient</th>
                                            <th>La doctorul</th>
                                            <th>Data crearii</th>
                                            <th>Data/ora ceurta </th>
                                            <th>Status cerere</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php foreach($results as $row) { ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->clientid; ?>"><?php echo getUserData($row->clientid, "nume")." ".getUserData($row->clientid, "prenume"); ?></a></td>
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->doctorid; ?>">
                                                <?php echo getUserData($row->doctorid, "nume")." ".getUserData($row->doctorid, "prenume"); ?>
                                            </a>
                                        </td>
                                        <td><?php echo $row->requested_time; ?></td>
                                        <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($row->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?>, <?php echo interval_orar($row->hour); ?></td>
                                        <td><?php if($row->verified == 0) { ?>
                                                  <font color="red">in asteptare.</font>
                                                  <?php } else { ?>
                                                  <i>acceptata</i>, ora <?php echo $row->confirmed_hour; ?>.
                                                  <?php } ?></td>
                                        <td><a href="<?php echo base_url(); ?>programari/aview/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">deschide cerere</a></td>
                                    </tr>
                                    <?php } } else { ?>
                                      Nu a fost gasita nicio programare in baza de date.
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </div>

                    </div>
                </div>
                <?php if (isset($links)) { ?>
                                <?php echo $links ?>
                            <?php } ?>
            </div>
        </div>
    </div>
</section>