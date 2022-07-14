<section>
    <!-- Page content-->
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
        
        <h3>Ticket &#9679; <a href="<?php echo base_url("contact/lista"); ?>">inapoi la listă</a> </h3>
        <div class="row">
            <div class="col-lg-8">
                <?php if($ticketStatus == 1) { ?>
                <div class="alert alert-warning" role="alert">
                    Acest ticket este inchis.
                </div>
                <?php } ?>
                <!-- Main panel-->
                <div class="panel b">
                    <div class="panel-heading">
                        <h4 class="mv">
                            Categorie: <span><?php echo $ticketReason; ?></span>
                        </h4>
                        <span id="ticketReason"></span>
                        <span>
                                <?php if($permissionChecker > 0 && $ticketStatus == 0) { ?>
                                        <em class="icon-pencil" id="editCategory" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editeaza categoria"></em>
                                        &thinsp;
                                        <?php echo form_open("contact/changeCategory/", "style='display: inline-block;'"); ?>
                                        <button style="border:none;background:transparent;" type="submit"><em class="icon-check" id="saveCategory" style="display:none;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Salveaza schimbarea"></em></button>
                                        <input type="hidden" name="newCategory" id="newCategory" value="<?php echo $ticketType; ?>" />
                                        <input type="hidden" name="ticketID" value="<?php echo $this->uri->segment(3); ?>" />
                                        <?php echo form_close(); ?>
                                <?php } ?>
                            </span>
                    </div>
                    <div class="panel-body bb bt">
                        <a class="inline" href="<?php echo base_url(); ?>profile/<?php echo $ticketStarterName; ?>" data-toggle="tooltip" data-title="Creator">
                            <img class="img-circle thumb48" src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo get_info("picture_path", "users", "id", $ticketStarter); ?>"> <?php echo getUserFullname($ticketStarter); ?>
                        </a>
                    </div>
                    <div class="panel-body">
                        <h4>Mesaj</h4>
                        <?php echo $ticketDescription; ?>
                    </div>
                </div>
                <!-- End Main panel-->
                <!-- Team messages-->
                <div class="panel b">
                    <div class="panel-heading">
                        <div class="panel-title">Raspunsuri tichet</div>
                    </div>
                    <!-- START list group-->
                    <div class="list-group" data-height="100%" data-scrollable="false">
                        <?php foreach($comment as $row): ?>
                        <div class="list-group-item">
                            <div class="media-box">
                                <div class="pull-left">
                                    <img class="media-box-object img-circle thumb32" src="<?php echo base_url("assets/img/profilepictures/") . getUserData($row->clientid, "picture_path"); ?>" alt="Image">
                                </div>
                                <div class="media-box-body clearfix">
                                    <small class="pull-right" data-toggle="tooltip" title="<?php echo $row->time; ?>">
                                        <?php echo get_time_difference($row->time); ?>
                                    </small>
                                    <strong class="media-box-heading text-primary">
                                        <a href="<?php echo base_url("profile/") ?><?php echo $row->clientid; ?>"><?php echo getUserFullname($row->clientid); ?></a>
                                            <?php if(getUserData($row->clientid, "devowner") == 1 ) { ?>
                                            <span class="label bg-purple"><i class="fa fa-cog"></i> administrator</span>
                                            <?php } ?>  
                                            <?php if(getUserData($row->clientid, "devowner") > 1 ) { ?>
                                            <span class="label bg-green"><i class="fa fa-cog"></i> administrator+</span>
                                            <?php } ?>  
                                            <?php if(getUserData($row->clientid, "doctor") > 0) { ?>
                                            <span class="label bg-primary"><i class="fa fa-comment"></i> doctor</font></span>
                                            <?php } ?>

                                        <?php if($permissionChecker > 1 || $row->clientid == $this->session->userdata("logged_in")["id"]) { ?>
                                        <a style="font-size: 17px;display: inline-block;margin: auto;margin-left: auto;vertical-align: sub;margin-left: 10px;" href="javascript:void(0)" onclick="edit_comment('<?php echo $row->id; ?>')" id="editcomment"><i class="fa fa-edit"></i></a>
                                        <a style="font-size: 17px;display: inline-block;margin: auto;margin-left: auto;vertical-align: sub;margin-left: 10px;" href="javascript:void(0)" onclick="del_comment('<?php echo $row->id; ?>')" id="deletecomment"> <i class="fa fa-trash"></i> </a>
                                        <?php } ?>
                                    </strong>
                                    <div id="comment_<?php echo $row->id; ?>"><?php echo html_purify($row->text); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- END list group-->
                    <!-- START panel footer-->
                    <?php if($ticketStatus == 0) { ?>
                    <div class="panel-footer clearfix">
                        <?php echo form_open("contact/insertcomment/" . $this->uri->segment(3)); ?>
                        <textarea class="form-control" name="comment" placeholder="Scrie mesajul..." type="text"></textarea>
                        <div style="padding-top: 7px;">
	                    	<button class="mb-1 btn btn-primary" type="submit" name="post"><i class="fa fa-paper-plane"></i> Post</button>&nbsp;&nbsp;&nbsp;
                        	<?php if($permissionChecker >= 3 || $isSupport >= 1) { ?><button class="mb-1 btn btn-purple" type="submit" name="postandclose"><i class="fas fa-share"></i> Post & Close</button><?php } ?>
                    	</div>
                        <?php echo form_close(); ?>
                    </div>
                    <?php } ?>
                    <!-- END panel-footer-->
                </div>
                <!-- End Team messages-->
            </div>
            <div class="col-lg-4">
                <!-- Aside panel-->
                <div class="panel b">

                    <table class="table bb">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Data crearii ticket-ului</strong>
                                </td>
                                <td><?php echo $ticketStarterDate; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Nume creator</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->nume; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Prenume creator</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->prenume; ?>
                                </td>
                            <tr>
                                <td>
                                    <strong>User DB ID:</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->id; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Data nasterii</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->born_date; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Telefon</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->phone; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Data crearii contului</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->regdate; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Locatie</strong>
                                </td>
                                <td>
                                    <?php echo $ticketStarterInfo->location; ?>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    </p>
            </div>
            <!-- end Aside panel-->
            <?php if( $permissionChecker > 0): ?>
            <div class="panel b">
                <div class="panel-body">
                    <b>Last tickets</b> by <?php echo $ticketStarterInfo->nume; ?> <?php echo $ticketStarterInfo->prenume; ?>
                    <ul class="list-inline mv">
                        <div class="table-responsive">
                           <table class="table table-hover">
                                <tr>
                                    <th>#ID</th>
                                    <th>Text</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    
                                </tr>
                                <?php foreach($lastTicketsBy as $row) { ?>
                                    <tr>
                                        <td><a href="<?php echo base_url("contact/view/" . $row->id); ?>"><?php echo $row->id; ?></a></td>
                                        <td><?php echo strip_tags(substr($row->message, 0, 35)); ?></td>
                                        <td><div class="badge bg-<?php echo getTicketColor($row->type); ?>"><?php echo getTicketType($row->type); ?></div></td>
                                        <td><?php echo $row->time; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            <!-- end Aside panel-->
        </div>

    </div>
    <?php $idulticket = $this->uri->segment(3); ?>

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>

<script src="<?php echo $this->config->config['base_url']; ?>assets/js/sweetalert2.all.min.js"></script>
<script>
    function edit_comment(id)
{
    var text_vechi = document.getElementById("comment_"+id).innerHTML;
    Swal({
        title: 'Change comment #'+id,
        input: 'textarea',
        inputValue: text_vechi,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then(result => {
        if (result.value) {
            $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("contact/editpost"); ?>',
                  data: {
                      postnou: result.value,
                      postcid: id,
                      ticketid: '<?php echo $idulticket; ?>'
                  },
                  success: function(data)
                  {
                      if(data == "_t43SCZq3czbhyy")
                      {
                        Swal(
                            'Error!',
                            'You cannot edit because ticket is closed or you need to wait 1 minute more before edit a new comment or the comment is posted for more than 15 minutes.',
                            'error'
                        )
                      }
                      else
                      {
                      document.getElementById("comment_"+id).innerHTML = result.value;
                    }
                    }
            });
          } else {
            Swal(
                'Ops!',
                'You canceled.',
                'error'
            )
          }
    })
}
</script>

<?php if($permissionChecker > 0) { ?>
    <style type="text/css">
      .swal2-container {
        zoom: 1.3;
       }
    </style>
<script>
    function del_comment(id)
{
    Swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                  type: "POST",
                  url: '<?php echo base_url("contact/deletepost"); ?>',
                  data: {
                      postcid: id,
                      ticketid: '<?php echo $idulticket; ?>'
                  },
                  success: function(data)
                  {
                      if(data == "_tb32wfvs65jghxx")
                      {
                        Swal(
                            'Error!',
                            'You cannot edit because ticket is closed or you need to wait 1 minute more before edit a new comment or the comment is posted for more than 15 minutes.',
                            'error'
                        )
                      }
                      else
                      {
                      document.getElementById("comment_"+id).innerHTML = "Comentariul a fost sters.";
                    }
                    }
            });
        } else {
            Swal(
                'Ops!',
                'You canceled.',
                'error'
            )
        }
    })
}
    </script>
<?php } ?>


<?php if($permissionChecker > 1): ?>
    <?php if($ticketStatus == 0): ?>
    <script>
        $("#editCategory").click(function() {
            $("#saveCategory").css("display", "inline-block");
            $("#editCategory").css("display", "none");
            <?php 
                $element_of_array = array(
                    "Suport clienti"            => 1,
                    "Tehnic"                    => 2,
                    "Financiar"                 => 3,
                    "Sesizari / reclamatii"     => 4,
                    "Feedback website"          => 5
                );

                $select = '<select style="width: 25%;display: inline-block;" class="form-control m-b" name="ticketCategory" id="ticketCategory" onchange="changeCateg(this)">';

                foreach ($element_of_array as $key => $value)
                {
                    if($value == $ticketType) {
                        $select .= '<option value="' . $value . '" selected>' . $key . '</option>';
                    }
                    else {
                        $select .= '<option value="' . $value . '">' . $key . '</option>';
                    }
                }

                $select .= "</select>";
            ?>
            $("#ticketReason").html('<?php echo $select; ?>');
        });

        function changeCateg(sel) {
            $("#newCategory").val(sel.value);
        }
    </script>
    <?php endif; ?>
<?php endif; ?>

</section>