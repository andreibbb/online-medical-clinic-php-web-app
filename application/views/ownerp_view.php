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
        <h3>Admin</h3>

        <div class="panel widget col-md-6">
            <div class="panel-body bg-purple">
                <div class="h5 mt0">Monthly incomes</div>
                <!-- Line chart-->
                <div data-sparkline="" data-type="line" data-height="40" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" data-values="
                <?php  if($donation): $count = 0; foreach($donation as $row): 
                            $count++; 
                            if($count != 1) {
                                echo ", " . $row->donateSUM; 
                            } else echo $row->donateSUM; 
                        endforeach; endif;
                ?>
                ">
                    <canvas style="display: inline-block; width: 498px; height: 40px; vertical-align: top;" width="498" height="40"></canvas>
                </div>
            </div>
            <div class="panel-body bg-purple-dark">
                <div class="row text-center">
                    <div class="col-xs-6">
                        <!-- Bar chart-->
                        <div data-sparkline="" data-bar-color="#5d9cec" data-height="30" data-bar-width="6" data-bar-spacing="6" data-values="1,3,4,7,5,9,4,4,7,5,9,6,4">
                            <canvas style="display: inline-block; width: 150px; height: 30px; vertical-align: top;" width="150" height="30"></canvas>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <h4 class="m0">+150</h4>
                        <p class="m0 text-muted">
                            <small>From last month</small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row row-table text-center">
                    <div class="col-xs-6">
                        <p class="m0 text-muted">Total brut</p>
                        <h4 class="m0"><?php echo $totalBrut; ?></h4>
                    </div>
                    <div class="col-xs-6">
                        <p class="m0 text-muted">Total net</p>
                        <h4 class="m0"><?php echo $totalNet; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="panel widget">
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-xs-6 pull-left">
                                <h3 class="m0">Mentenanta</h3>
                            </div>
                            <div class="col-xs-6 pull-right">
                                <a class="btn btn-purple pull-right" href="<?php echo base_url("ownerp/switchmaintenance/"); ?>">
                                    <em class="fa fa-hand-o-right"></em>
                                    <span><?php echo ((get_info("Value", "panel_assets", "Name", "Maintenance") == 1) ? "Stop" : "Start" ); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel widget">
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-xs-6 pull-left">
                                <h3 class="m0">Flush cache</h3>
                            </div>
                            <div class="col-xs-6 pull-right">
                                <a class="btn btn-purple pull-right" href="<?php echo base_url("ownerp/flushcache/"); ?>">
                                    <em class="fa fa-hand-o-right"></em>
                                    <span>Go</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="panel widget">
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-xs-6 pull-left">
                                <h3 class="m0">1€ = <?php echo get_info("Value", "panel_assets", "Name", "PremiumPoint"); ?> PP</h3>
                            </div>
                            <?php echo form_open("ownerp/setppvalue"); ?>
                            <div class="col-xs-3">
                                <input name="ppvalue" class="form-control m-b" placeholder="<?php echo get_info("Value", "panel_assets", "Name", "PremiumPoint"); ?>" style="display: inline-block;width:90%" type="number" min="0" step="1" required>
                            </div>
                            <div class="col-xs-3 pull-right">
                                <button class="btn btn-purple pull-right" style="display: inline-block;" type="submit">
                                    <em class="fa fa-hand-o-right"></em>
                                    <span>Set</span>
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel widget">
                    <div class="panel-body">
                        <div class="row row-table">
                            <div class="col-xs-6 pull-left">
                                <h3 class="m0">(SMS) 1€ = <?php echo get_info("Value", "panel_assets", "Name", "PremiumPointSMS"); ?> PP</h3>
                            </div>
                            <?php echo form_open("ownerp/setppvaluesms"); ?>
                            <div class="col-xs-3">
                                <input name="ppvalue" class="form-control m-b" placeholder="<?php echo get_info("Value", "panel_assets", "Name", "PremiumPointSMS"); ?>" style="display: inline-block;width:90%" type="number" min="0" step="1" required>
                            </div>
                            <div class="col-xs-3 pull-right">
                                <button class="btn btn-purple pull-right" style="display: inline-block;" type="submit">
                                    <em class="fa fa-hand-o-right"></em>
                                    <span>Set</span>
                                </button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="panel widget col-md-6">
            <div class="panel-body">
                        <h3 class="m0">Insert update on homepage</h3>
                        <br>
                        <?php echo form_open("update/insertUpdate"); ?>
                            <input class="form-control" placeholder="Titlu" name="versiune" required>
                            <br>
                            <textarea id="update" name="update" class="form-control"></textarea>
                            <br>
                            <button type="submit" class="form-control btn-purple">Submit</button>
                        <?php echo form_close(); ?>
            </div>

             <div class="panel-body">
                        <h3 class="m0">Stats</h3>
                        <br>
                        <ul>
                            <li><b>New accounts created today:</b> <?php echo $newAccountsToday; ?></li>
                        </ul>
            </div>
        </div>

        <div class="panel widget col-md-6">
            <div class="panel-body">
                        <h3 class="m0">Add Global Announcement</h3>
                        <br>
                        <?php echo form_open("ownerp/newAnnouncement"); ?>
                        <textarea name="globalannouncement" class="form-control" placeholder="Enter 'none' or no space for blank"></textarea>
                        <hr>
                        <button class="btn btn-purple pull-right" style="display: inline-block;" type="submit">
                            <em class="fa fa-hand-o-right"></em>
                            <span>Add Global Annoucement</span>
                        </button>
                        <?php echo form_close(); ?>
            </div>
        </div>

        <div class="panel widget col-md-6">
            <div class="panel-body">
                        <h3 class="m0">Last 25 Panel Logs</h3>
                        <br>
                        <table class="table table-hover">
                        <?php if($lastLogs) { ?>
                            <?php foreach($lastLogs as $row) { ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->log; ?></td>
                                    <td><?php echo date($row->time); ?></td>
                                </tr>
                        <?php } } ?>
                        </table>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
CKEDITOR.replace("update");
</script>

