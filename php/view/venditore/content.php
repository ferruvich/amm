<?php
switch ($vd->getSottoPagina()) {
    case 'anagrafica':
        include 'anagrafica.php';
        break;

    case 'games':
        include 'games.php';
        break;
	
	case 'games_sold':
        include 'games_sold.php';
        break;
    
    case 'vendi_copie':
        include 'vendi_copie.php';
        break;
    
    case 'inserisci_gioco':
        include 'inserisci_gioco.php';
        break;

	case 'trama':
		include 'trama.php';
		break;

        ?>
        

    <?php default: ?>
        <h2 class="icon-title" id="h-home">Pannello di Controllo</h2>
        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul class="panel">
            <li><a href="venditore/anagrafica<?= $vd->scriviToken('?')?>" id="pnl-anagrafica">Anagrafica</a></li>
			<li><a href="venditore/games_sold<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Giochi venduti</a></li>
            <li><a href="venditore/games<?= $vd->scriviToken('?')?>" id="pnl-iscrizione">Giochi in vendita</a></li>
            <li><a href="venditore/vendi_copie<?= $vd->scriviToken('?')?>" id="pnl-libretto">Vendi copie</a></li>
        </ul>
        <?php
        break;
}
?>


