<section>
    <!-- Page content-->
    <div class="content-wrapper">

        <h3>Contactează-ne!</h3>
        <div class="row">
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

            <div class="col-md-12">
                <div class="mb-lg clearfix">
                    <div class="pull-left">
                        <a class="btn btn-sm btn-purple" href="<?php echo base_url("contact/create"); ?>">Create new ticket</a>
                    </div>
                </div>
                <div class="panel b">
                    <div class="panel-body">
                        <div class="table-responsive">                            
                                    <?php if($results) { ?>
                                        <table class="table" id="datatable1">
                                        <thead>
                                            <tr>
                                                <th>Categorie</th>
                                                <th>#ID</th>
                                                <th>Mesaj</th>
                                                <th>Data crearii</th>
                                                <th>Nume user</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($results as $row): ?>
                                        <tr>
                                            <td>
                                                <div class="badge bg-<?php echo getTicketColor($row->type); ?>"><?php echo getContactReason($row->type); ?></div>
                                            </td>
                                            <td>#<?php echo $row->id; ?></td>
                                            <td class="text-nowrap">
                                                <small><?php echo substr(htmlentities(str_replace("<p>", "", $row->Ticket)), 0, 35); ?>...</small>
                                            </td>
                                            <td><?php echo $row->time; ?></td>
                                            <td>
                                                <a data-toggle="tooltip" title="" href="<?php echo base_url(); ?>profile/<?php echo $row->clientid; ?>"><?php echo getUserFullName($row->clientid); ?></a>
                                            </td>
                                            <td>
                                                <?php if($row->status == 0) { ?>
                                                <div class="inline wd-xxs label label-success">deschis</div>
                                                <?php } elseif($row->status == 1) { ?>
                                                <div class="inline wd-xxs label label-danger">inchis</div>
                                                <?php } ?>
                                            </td>
                                            <td align="center">
                                                <a href="<?php echo base_url(); ?>contact/view/<?php echo $row->id; ?>" style="width: 90px;" class="btn btn-purple btn-xs"><i class="fa fa-search-plus"></i> deschide</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                            </tbody>
                                          </table>
                                    <?php } else { ?>
                                        Niciun ticket de ajutor nu a fost gasit!
                                    <?php } ?> 

                            <?php if (isset($links)) { ?>
                            <?php echo $links ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>