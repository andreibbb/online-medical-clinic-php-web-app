 <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 350px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

      #map2 {
        height: 350px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

       
      #map3 {
        height: 350px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }

       
    </style>
<section>
  <div class="content-wrapper">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
           <h4>MediCare Brasov - sediu principal</h4>
        </div>     
        <div class="panel-body">            
          <table class="table table-responsive">
                                    <tr>
                                        <td>
                                          <div align="center">
                                            <img src="<?php echo base_url(); ?>assets/img/clinici/sediuprincipal.jpg" class="img-responsive" eight="350">
                                          </div>
                                        </td>         
                                        <td width="30%">
                                          <h4>Sediul principal MediCare Brasov</h4>
                                          <br>
                                          <i class="fas fa-map-marker-alt"></i> <b>Adresa:</b>
                                            <br>
                                            Bulevardul Eroilor, nr.3 / 500007 Brasov<br><br>
                                          <i class="fas fa-phone"></i> <b>Telefon:</b>
                                            <br>
                                            021 9896 / 021 9897<br><br><br>
                                          <i class="fas fa-clock"></i> Orar<br>
                                              <table class="table table-sm">
                                                <tr>
                                                  <td>Luni - Vineri</td>
                                                  <td>08:00 - 20:00</td>                                                  
                                                </tr>
                                                <tr>
                                                  <td>Sambata</td>
                                                  <td><i>inchis</i></td>
                                                </tr>
                                                <tr>
                                                  <td>Duminica</td>
                                                  <td><i>inchis</i></td>
                                                </tr>
                                              </table>

                                        </td>
                                        <td width="45%">
                                              <div id="map"></div>
                                              <script>
                                                  // Initialize and add the map
                                                  function initMap() {
                                                    // The location of Uluru
                                                    var uluru = {lat: <?php echo $clinic_posX; ?>, lng: <?php echo $clinic_posY; ?>};
                                                    // The map, centered at Uluru
                                                    var map = new google.maps.Map(
                                                        document.getElementById('map'), {zoom: 18, center: uluru});
                                                    // The marker, positioned at Uluru
                                                    var marker = new google.maps.Marker({position: uluru, map: map});
                                                  }
                                              </script>      
                                              <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>                              
                                        </td>
                                    </tr>                                   
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">  
        <div class="panel-heading">
           <h4>MediCare Brasov - clinica 'Tractorul'</h4>
        </div>      
        <div class="panel-body">            
          <table class="table table-responsive">
                                    <tr>
                                        <td>
                                          <div align="center">
                                            <img src="<?php echo base_url(); ?>assets/img/clinici/clinicatractorul.jpg" class="img-responsive" height="250">
                                          </div>
                                        </td>         
                                        <td>
                                          <h4>Clinica 'Tractorul' Medicare Brasov</h4>
                                          <br>
                                          <i class="fas fa-map-marker-alt"></i> <b>Adresa:</b>
                                            <br>
                                            Turnului, nr.3 / 500007 Brasov<br><br>
                                          <i class="fas fa-phone"></i> <b>Telefon:</b>
                                            <br>
                                            021 9896 / 021 9897<br><br><br>
                                          <i class="fas fa-clock"></i> Orar<br>
                                              <table class="table table-sm">
                                                <tr>
                                                  <td>Luni - Vineri</td>
                                                  <td>08:00 - 20:00</td>                                                  
                                                </tr>
                                                <tr>
                                                  <td>Sambata</td>
                                                  <td>10:00 - 14:00</td>
                                                </tr>
                                                <tr>
                                                  <td>Duminica</td>
                                                  <td><i>inchis</i></td>
                                                </tr>
                                              </table>
                                        </td>                
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">        
        <div class="panel-heading">
           <h4>Laborator analize & teste laborator</h4>
        </div>
        <div class="panel-body">            
          <table class="table table-responsive">
                                    <tr>
                                        <td>
                                          <div align="center">
                                            <img src="<?php echo base_url(); ?>assets/img/clinici/laborator.jpg" class="img-responsive" height="250">
                                          </div>
                                        </td>         
                                        <td>
                                          <h4>Laborator MediCare Brasov</h4>
                                          <br>
                                          <i class="fas fa-map-marker-alt"></i> <b>Adresa:</b>
                                            <br>
                                            Bulevardul Eroilor, nr.3 / 500007 Brasov<br><br>
                                          <i class="fas fa-phone"></i> <b>Telefon:</b>
                                            <br>
                                            021 9896 / 021 9897<br><br><br>
                                          <i class="fas fa-clock"></i> Orar<br>
                                              <table class="table table-sm">
                                                <tr>
                                                  <td>Luni - Vineri</td>
                                                  <td>09:00 - 16:00</td>                                                  
                                                </tr>
                                                <tr>
                                                  <td>Sambata</td>
                                                  <td><i>inchis</i></td>
                                                </tr>
                                                <tr>
                                                  <td>Duminica</td>
                                                  <td><i>inchis</i></td>
                                                </tr>
                                              </table>
                                        </td>                                
          </table>
        </div>
      </div>
    </div>

    
  </div>
</section>
<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
