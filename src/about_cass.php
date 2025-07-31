<?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/header.php'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sobre CASS</title>
    <link rel="stylesheet" href="/cass/styles/bootstrap.min.css">
    <link rel="stylesheet" href="/cass/styles/global.css">

    <style>
        .tab-content {
            padding-top: 2rem;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="container container-lar mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-radius-card my-5 px-4">
                            <div class="card-body">

                                <h2 class="my-3">Sobre CASS</h2>

                                <ul class="nav nav-tabs" id="tabsSobreCass" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="objetivo-tab" data-bs-toggle="tab" data-bs-target="#objetivo" type="button" role="tab">Objetivo del Proyecto</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="aviso-tab" data-bs-toggle="tab" data-bs-target="#aviso" type="button" role="tab">Aviso de Privacidad</button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="tabsSobreCassContent">
                                    <div class="tab-pane fade show active" id="objetivo" role="tabpanel">
                                        <p class="section-title">¿Qué es CASS?</p>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas sint veniam vitae repudiandae sunt repellat inventore esse dolor? Sit, porro sapiente nemo doloremque ipsa facere ut repudiandae culpa quas accusantium?
                                        </p>

                                        <p class="section-title">Objetivos clave</p>
                                        <ul>
                                            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repudiandae aut est, tempora libero hic voluptates quam, dolor numquam inventore fugiat doloribus magnam placeat consequatur perspiciatis obcaecati, aperiam eveniet nobis repellendus!</li>
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla iure vero quia assumenda labore, veniam vitae accusantium cum deleniti nostrum nisi fugit voluptatum dolorem numquam maiores, dolores minima! Nam, voluptatibus.</li>
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore necessitatibus voluptatem, reprehenderit minima exercitationem quos a magni consequuntur facilis, provident ad repellendus omnis accusamus, odit fugiat voluptas? Dignissimos, totam cum.</li>
                                            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat voluptatum itaque earum totam soluta! Non, voluptate molestiae reiciendis est totam vitae accusantium possimus sit! Illo minus atque aut nulla neque.</li>
                                        </ul>

                                        <p class="section-title">¿Quiénes pueden usarlo?</p>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto ut obcaecati autem, assumenda vitae ea adipisci, ab eum praesentium illum ipsam accusantium minima. Nobis nesciunt commodi architecto numquam aperiam ea.
                                        </p>
                                    </div>

                                    <div class="tab-pane fade" id="aviso" role="tabpanel">
                                        <p class="section-title">Aviso de Privacidad</p>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis quod placeat dolores obcaecati, eveniet aliquam ex alias deserunt temporibus fugiat, numquam officia blanditiis ullam ipsam in voluptatem doloribus assumenda harum. </p>

                                        <p>
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius aliquid consequatur rerum, ducimus deleniti error ut excepturi. Labore recusandae natus incidunt! Placeat sunt modi earum saepe beatae expedita consequuntur tenetur.
                                        </p>

                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi fugit eum placeat ex veritatis iure labore neque culpa perspiciatis eveniet? Enim asperiores repudiandae ut inventore dolore tempore impedit vitae nemo.</a>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/cass/templates/footer.php'); ?>
    </div>
    <script src="/cass/scripts/bootstrap.bundle.min.js"></script>
</body>

</html>