<section>
    <div class="content-wrapper">
        <h4><?php if($this->uri->segment(2) == "appointments"){ ?>Lista programari - <?php echo getUserFullName($this->uri->segment(3)); ?> 
                <?php } elseif($this->uri->segment(2) == "reviews") { ?> Lista recenzii - <?php echo getUserFullName($this->uri->segment(3)); ?>
                 <?php } elseif($this->uri->segment(2) == "tickets") { ?> Lista tickete de contact - <?php echo getUserFullName($this->uri->segment(3)); ?>
                 <?php } elseif($this->uri->segment(2) == "iplogs") { ?> IP-uri conectate pentru - <?php echo getUserFullName($this->uri->segment(3)); ?> / userID: <?php echo $this->uri->segment(3); ?>
                 <?php } ?>
                    <hr></h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php echo $th; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($this->uri->segment(2) == "appointments") { ?>
                                            <?php 
                                                if(isset($results)) {
                                                    foreach($results as $row) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $row->id; ?></td>
                                                <td><?php echo $row->requested_time; ?></td>
                                                <td>
                                                    <?php if($row->verified == "0") { ?> 
                                                        <i>in asteptare</i>
                                                    <?php } elseif($row->verified == "2") { ?>
                                                        <font color="red"><b>respinsa</b></font>
                                                    <?php } else { ?>
                                                        <font color="green"><b>verificata</b></font>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($row->contactoption == "telefon") { ?> 
                                                        telefonic
                                                    <?php } else { ?>
                                                        notificare website
                                                    <?php } ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>profile/<?php echo $row->doctorid; ?>">Dr. <?php echo getUserFullName($row->doctorid); ?></a>
                                                </td>
                                                <td><?php if($row->confirmed_hour != null) { ?>
                                                        <?php echo $row->confirmed_hour; ?>
                                                    <?php } else { ?>
                                                        Ora nu a fost confirmata.
                                                    <?php } ?>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>programari/view/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">vezi</a></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else echo "<td colspan='4'>Nu exista inregistrari pentru acest utilizator.</td>" ?>
                                    <?php } elseif($this->uri->segment(2) == "reviews") { ?>
                                            <?php 
                                                if(isset($results)) {
                                                    foreach($results as $row) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $row->id; ?></td>
                                                <td><a href="<?php echo base_url(); ?>profile/<?php echo $row->doctorid; ?>">Dr. <?php echo getUserFullName($row->doctorID); ?></a></td>
                                                <td>
                                                    <small><?php echo substr(htmlentities(str_replace("<p>", "", $row->text)), 0, 50); ?>...</small>
                                                </td>
                                                <td>
                                                    <?php for($index = 0; $index < ((int)($row->ratingValue)); $index++) { ?>
                                                        <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                      <?php } ?>
                                                <td>
                                                    <?php echo $row->addedDate; ?>
                                                </td>
                                                <td><a href="<?php echo base_url(); ?>reviews/view/<?php echo $row->id; ?>" class="btn btn-primary btn-xs">vezi</a></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else echo "<td colspan='4'>Nu exista inregistrari pentru acest utilizator.</td>" ?>
                                    <?php } elseif($this->uri->segment(2) == "tickets") { ?>
                                            <?php 
                                                if(isset($results)) {
                                                    foreach($results as $row) { 
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="badge bg-<?php echo getTicketColor($row->type); ?>"><?php echo getContactReason($row->type); ?></div>
                                                </td>
                                                <td>#<?php echo $row->id; ?></td>
                                                <td class="text-nowrap">
                                                    <small><?php echo substr(htmlentities(str_replace("<p>", "", (str_replace("</p>", "", $row->message)))), 0, 55); ?>...</small>
                                                </td>
                                                <td><?php echo $row->time; ?></td>
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
                                            <?php } ?>
                                            <?php } else echo "<td colspan='4'>Nu exista inregistrari pentru acest utilizator.</td>" ?>
                                    <?php } else if($this->uri->segment(2) == "iplogs") { ?>
                                            <?php 
                                                if(isset($results)) {
                                                    foreach($results as $row) { 
                                            ?>
                                            <tr>
                                            <td><?php echo $row->id; ?></td>
                                            <td><?php echo $row->login_ip; ?></td>
                                            <td><?php $details = json_decode(file_get_contents("http://ipinfo.io/".$row->login_ip."/json?token=8f372991d4be75"));
                                                      echo $details->city . " / " . $details->region; ?></td>
                                            <td><?php echo $details->org; ?></td>
                                            <td><?php echo $row->time; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else echo "<td colspan='4'>Nu exista inregistrari pentru acest utilizator.</td>" ?>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if(isset($links)) { ?>
                <?php echo $links; ?>
            <?php } ?>
            </div>
        </div>
    </div>
</section>