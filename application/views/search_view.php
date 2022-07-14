<section>
    <div class="content-wrapper">

            <div class="unwrap">
                <div class="container container-md pv-lg">
                    <div class="text-center mb-lg pb-lg">
                        <div class="h2 text-bold">Cauta un jucator</div>
                        <p>Introdu numele cautat mai jos. Sunt afisate primele 50 de rezultate.</p>
                    </div>
                </div>
        </div>

        <div class="container container-md">
            <div id="step1">
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
                <div align="center">
                    <?php echo form_open("search"); ?>
                            <input class="form-control input-lg radius-clear" type="text" name="searchPlayer" id="searchPlayer" placeholder="Search">
                            <input type="hidden" name="after" value="after">
                            <br>
                            <button class="btn btn-labeled btn-purple mb-2" id="searchButton" type="submit"><span class="btn-label"><i class="fa fa-times"></i></span> Search</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
            
            <br>
                <?php if($searchedtop != NULL) { ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Name</th>
                                                <th>Level</th>
                                                <th>Played Hours</th>
                                                <th>Faction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php foreach($searchedtop as $row) { ?>
                                            <tr>
                                                <?php $count++; ?>
                                                <td><?php echo $count; ?></td>
                                                <td>
                                                    <?php if($row->Status == 1) { ?>
                                                    <i class="fa fa-circle text-green" data-toggle="tooltip" data-original-title="Online"></i>
                                                    <?php } else { ?>
                                                    <i class="fa fa-circle text-red" data-toggle="tooltip" data-original-title="Offline"></i>
                                                    <?php } ?> 
                                                    <a data-toggle="tooltip" title="" href="<?php echo base_url(); ?>profile/<?php echo $row->name; ?>"><?php echo $row->name; ?></a>
                                                </td>
                                                <td><?php echo $row->Level; ?></td>
                                                <td><?php echo round($row->ConnectedTime, 2); ?></td>
                                                <td><?php echo faction_name($row->Member); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</section>

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
