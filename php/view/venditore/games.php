<h2 class="icon-title" id="h-videogiochi">Videogiochi inseriti</h2>
<ul class="none">
    <li><strong>Nome:</strong> <?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong> <?= $user->getCognome() ?></li>
</ul>
<?php if (count($copie) > 0) {
	$noncomprati = false;
	foreach($copie as $copia){
		if(!$copia->comprato()){
			$noncomprati = true;
		}
	}
	if($noncomprati){
?>
    <table>
        <thead>
            <tr>
                <th class="gioco-col-large">Titolo</th>
                <th class="gioco-col-small">Anno</th>
                <th class="gioco-col-small">Trama</th>
                <th class="gioco-col-small">Prezzo</th>
                <th class="gioco-col-large">Console</th>
                <th class="gioco-col-small">Genere</th>
            </tr>
        </thead>
        <tbody>
            <?php
			$c = 0;
            foreach ($copie as $copia) {
				if($copia->getVenditore()->getId() == $user->getId() && !$copia->comprato()){ ?>
                    <tr <?= $c % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td><?= $copia->getVideogioco()->getTitolo() ?></td>
                        <td><?= $copia->getVideogioco()->getAnno() ?></td>
                        <td><a href="venditore/games?cmd=trama&copia=<?= $c ?><?= $vd->scriviToken('&') ?>" title="Trama del gioco">Trama</a></td>
                        <td><?= $copia->getVideogioco()->getPrezzo() ?></td>
						<td><?= $copia->getVideogioco()->getConsole()->getNome() ?></td>
						<td><?= $copia->getVideogioco()->getGenere()->getNome() ?></td>
                    </tr>
                    <?php
					$c++;
                }
            }
	} else { ?>
    <p> Nessun videogioco in vendita </p>
<?php } ?>
        </tbody>
    </table>
<?php 
} else { ?>
    <p> Nessun videogioco in vendita</p>
<?php } ?>
<div class="input-form">

    <form method="post" action="venditore/vendi_gioco<?= $vd->scriviToken('?') ?>">
        <button type="submit"name="cmd" value="v_gioco">Vendi un videogioco</button>
    </form>

</div>
