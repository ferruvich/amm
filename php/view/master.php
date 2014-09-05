<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php';

    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <title><?= $vd->getTitolo() ?></title>
            <base href="<?= Settings::getApplicationPath() ?>php/"/>
            <meta name="keywords" content="God of videogame" />
            <meta name="description" content="Sito di vendita online di videogiochi" />
            <link href="../css/style.css" rel="stylesheet" type="text/css"/>
        </head>
        <body>
            <div id="page">
                <header>
                    <!--  header -->
                    <div id="header">
                        <div id="logo">
                            <h1 class="titolo"><br><br><?= $vd->getTitolo()?></h1>
                        </div>
                        <!-- tabs -->
                        <div id="menu">
                            <?php
                            $menu = $vd->getMenuFile();
                            require "$menu";
                            ?>
                        </div>
                    </div>
                </header>
                <!-- start page -->
                <!--  sidebar 1 -->
                <div id="sidebar1">
                    <ul>
                        <li id="categories">
                            <?php
                            $left = $vd->getLeftBarFile();
                            require "$left";
                            ?>
                        </li>
                    </ul>
                </div>
                <!-- contenuto -->
                <div id="content">
                    <?php
                    if ($vd->getMessaggioErrore() != null) {
                        ?>
                        <div class="error">
                            <div>
                                <?=
                                $vd->getMessaggioErrore();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($vd->getMessaggioConferma() != null) {
                        ?>
                        <div class="confirm">
                            <div>
                                <?=
                                $vd->getMessaggioConferma();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $content = $vd->getContentFile();
                    require "$content";
                    ?>


                </div>

                <div class="clear">
                </div>
            </div>
        </body>
    </html>





