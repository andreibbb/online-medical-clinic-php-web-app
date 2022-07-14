<section>
    <div class="content-wrapper">
         <?php if($this->session->flashdata('error') !== null): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div><br>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('success') !== null): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div><br>
                        <?php endif; ?>
        <h3>Notificari</h3>
        <div class="pull-left">
                        <a class="btn btn-sm btn-purple" href="<?php echo base_url("notification/markall"); ?>">Marcheaza toate notificarile ca citite</a>
        </div></br>
        <div class="table-grid table-grid-desktop">
            <div class="col"><br>
                <div class="panel panel-default">
                    <div class="panel-body">
                    
                        <table class="table table-hover mb-mails">
                            <tbody>
                                <?php if($notification) { ?>
                                <?php foreach($notification as $row) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <i class="<?php echo ($row->readed_notification == 1) ? "far fa-bell" : "fas fa-bell"; ?>"></i>
                                        </td>
                                        <td>
                                            <div class="mb-mail-date pull-right"><?php echo $row->time; ?></div>
                                            <a href="<?php echo base_url(""); ?><?php if($row->link) echo $row->link; else echo "javascript:void(0)"; ?>">
                                            <div class="mb-mail-meta">
                                                <div class="pull-left">
                                                    <div style="<?php echo ($row->readed_notification == 1) ? "" : "color:#db3c3c"; ?>" class="mb-mail-subject"><?php echo ($row->readed_notification == 1) ? "" : "Notificare necitita"; ?></div>
                                                </div>
                                                <div class="mb-mail-preview"><?php echo $row->message; ?></div>
                                            </div>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                Nicio notificare nu a fost gasita!
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
