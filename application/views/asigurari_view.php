<div class="unwrap">
    <div class="bg-cover">
        <div class="container container-md pv-lg">
            <div class="text-center mb-lg pb-lg">
                <div class="h1 text-bold">Asigurări de viață</div>
                <p>Clinica noastră îți pune la dispoziție următoarele pachete.</p>
            </div>
        </div>
    </div>
</div>
<div class="container container-md">
    <div class="row">
        <div class="col-md-4">
            <div class="panel b">
                <div class="panel-body text-center">
                    <a class="link-unstyled text-primary primarypanelfaq" id="p1" href="#">
                        <i class="fas fa-5x fa-user"></i>
                        <br>
                        <span class="h4"><b>Prevention Basic</b></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel b">
                <div class="panel-body text-center">
                    <a class="link-unstyled text-info primarypanelfaq" id="p2" href="#">
                        <i class="fas fa-5x fa-user-friends"></i>
                        <br>
                        <span class="h4"><b>Preventation Plus</b></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel b">
                <div class="panel-body text-center">
                    <a class="link-unstyled text-purple primarypanelfaq" id="p3" href="#">
                        <i class="fas fa-5x fa-users"></i>
                        <br>
                        <span class="h4"><b>Prevention Complete</b></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h1 class="jumbotrontitle" style="text-transform: capitalize;"></h1>
                <p class="jumbotrontext">
                    Alege un pachet de mai sus pentru a vedea detaliile despre acesta.
                </p>
            </div>
        </div>
    </div>
    <br><br>
</div>

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
<script>
    $(".primarypanelfaq").click(function() {
        if($(this).attr('id') == "p1") {
            $(".jumbotrontitle").text("Prevention Basic");
            $(".jumbotrontext").html("<strong>Cateva dintre avantajele abonamentului Prevention Basic:</strong><br><ul><li>valoare minimala comparativ cu valoarea per serviciu</li><li>acoperire nationala</li><li>Serviciul de Urgenta 24/7 nelimitat</li><li>orientarea catre preventie si diagnosticare</li><li>poate fi urmarita evolutia starii de sanatate pentru ca ai acces la un dosar medical electronic</li><li>consultatii de urgenta la domiciliu (reducere 30%) si ambulanta in regim de urgenta (reducere 30%) cu recomandare pentru Serviciul de Urgenta 24/7 (<strong>valabil doar pentru orasul Brasov</strong>)</li><li>acces direct la o&nbsp;gama de servicii medicale</li><li>patru consultatii pe an incluse, cu acces direct la Medicina Interna si Medicina Generala</li><li>doua consultatii pe an incluse, cu acces direct la Ginecologie si Urologie</li><li>gama larga de consultatii medicale cu reducere de 30%</li><li>varietate de investigatii medicale incluse, cu acces direct sau cu recomandare</li><li>gama larga de investigatii medicale cu reducere 30%</li><li>gama larga de proceduri medicale cu reducere 20% (<strong>inclusiv Kinetoterapie</strong>)</li><li>un set anual de analize inclus, cu acces direct</li><li>10% reducere la analize de laborator</li></ul><br>*toate serviciile medicale, inclusiv recoltarea probelor pentru analize de sange sau microbiologie, se efectueaza cu o&nbsp;programare prealabila sau recomandare dupa caz, din partea unui medic MediCare.<br><br><b>Prevention Basic: 9 euro/lună</b><br>");
        }
        if($(this).attr('id') == "p2") {
            $(".jumbotrontitle").text("Prevention Plus");
            $(".jumbotrontext").html("<strong>Cateva dintre beneficiile abonamentului Prevention Plus:</strong><br><ul><li>valoare minimala comparativ cu valoarea per serviciu</li><li>acoperire nationala</li><li>Serviciul de Urgenta 24/7 nelimitat</li><li>orientarea catre preventie si diagnosticare</li><li>poate fi urmarita evolutia starii de sanatate pentru ca ai acces la un dosar medical electronic<br>consultatii de urgenta la domiciliu (1/an, apoi reducere 50%) si ambulanta in regim de urgenta (1/an, apoi reducere 50%) cu recomandare pentru Serviciul de Urgenta 24/7 (<strong>valabil doar pentru orasul Brasov</strong>)</li><li>acces direct la o&nbsp;gama larga de servicii</li><li>consultatii nelimitate cu acces direct la Medicina Generala, Medicina Interna, Ginecologie</li><li>varietate de consultatii incluse (1/an), cu acces direct sau cu recomandare</li><li>gama larga de consultatii medicale, cu 50% reducere, dupa consumarea consultatiilor incluse in abonament</li><li>varietate de investigatii medicale incluse (1/an), cu acces direct sau cu recomandare</li><li>gama larga de investigatii medicale cu reducere de 30% dupa consumarea investigatiilor incluse in abonament</li><li>10% reducere la investigatii CT (tomografie computerizata) si RMN (rezonanta magnetica nucleara)</li><li>gama larga de proceduri medicale cu reducere de 30% (<strong>inclusiv Kinetoterapie</strong>)</li><li>set anual de analize inclus, nelimitat, cu acces direct</li><li>15% reducere pentru diverse analize de laborator</li></ul><br>*toate serviciile medicale, inclusiv recoltarea probelor pentru analize de sange sau microbiologie, se efectueaza cu o&nbsp;programare prealabila sau recomandare dupa caz, din partea unui medic MediCare.<br><br><b>Prevention Plus: 16 euro/lună</b><br>");
        }
        if($(this).attr('id') == "p3") {
            $(".jumbotrontitle").text("Prevention Complete");
            $(".jumbotrontext").html("<strong>Cateva dintre avantajele beneficiile abonamentului Prevention Complete:</strong><br><ul><li>valoare minimala comparativ cu valoarea per serviciu</li><li>acoperire nationala</li><li>Serviciul de Urgenta 24/7 nelimitat</li><li>orientarea catre preventie si diagnosticare</li><li>poate fi urmarita evolutia starii de sanatate pentru ca ai acces la un dosar medical electronic</li><li>consultatii in regim de urgenta la domiciliu sau ambulanta in regim de urgenta si transport medicalizat in regim de urgenta <strong>nelimitat</strong>, cu recomandare pentru Serviciul de Urgenta 24/7 (<strong>valabil doar pentru orasul Brasov</strong>)</li><li>acces direct la o&nbsp;gama larga de servicii</li><li>consultatii cu acces nelimitat la o&nbsp;gama larga de specialitati medicale, cu sau fara recomandare</li><li>investigatii medicale nelimitate cu recomandare</li><li>20% reducere la invetigatii CT (tomografie computerizata) si RMN (rezonanta magnetica nucleara)</li><li>analize incluse nelimitat, cu recomandare</li><li>proceduri incluse nelimitat, cu recomandare (<strong>inclusiv Kinetoterapie</strong>)</li></ul><br>*toate serviciile medicale, inclusiv recoltarea probelor pentru analize de sange sau microbiologie, se efectueaza cu o&nbsp;programare prealabila sau recomandare dupa caz, din partea unui medic MediCare.<br><br><strong>Prevention Complete: 37 euro/lună</strong><br>");
        }
    });
</script>