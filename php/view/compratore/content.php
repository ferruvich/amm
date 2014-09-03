<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include_once 'anagrafica.php';
        break;

    case 'acquisto':
        include_once 'acquisto.php';
        break;
	
	case 'trama':
		include_once 'trama.php';
		break;

    default:
        
        ?>
        <h2 class="icon-title" id="h-home">Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul class="panel">
            <li><a href="compratore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
            <li><a href="compratore/acquisto<?= $vd->scriviToken('?')?>">Compra un gioco!</a></li>
        </ul>
        <?php
        break;
}
?>


