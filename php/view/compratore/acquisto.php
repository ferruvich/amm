<h2 class="icon-title" id="h-videogioco">Lista videogiochi</h2>
<ul class="none">
    <li><strong>Nome:</strong><?= $user->getNome() ?></li>
    <li><strong>Cognome:</strong><?= $user->getCognome() ?></li>
</ul>

<h3>Lista Videogiochi</h3>
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
                <th class="gioco-col-small">Titolo</th>
                <th class="gioco-col-small">Anno</th>
                <th class="gioco-col-large">Trama</th>
                <th class="gioco-col-small">Prezzo</th>
                <th class="gioco-col-small">Console</th>
                <th class="gioco-col-small">Genere</th>
                <th class="gioco-col-small">Venditore</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($copie as $copia) { ?>
				<? if(!$copia->comprato()) {?>
                    <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?> >
                        <td><?= $copia->getVideogioco()->getTitolo() ?></td>
                        <td><?= $copia->getVideogioco()->getAnno() ?></td>
                        <td><a href="compratore/acquisto?cmd=trama&copia=<?= $i ?><?= $vd->scriviToken('&') ?>" title="Trama del gioco">Trama</a></td>
                        <td><?= $copia->getVideogioco()->getPrezzo() ?></td>
						<td><?= $copia->getVideogioco()->getConsole()->getNome() ?></td>
						<td><?= $copia->getVideogioco()->getGenere()->getNome() ?></td>
                        <td><?= $copia->getVenditore()->getNome() . ' ' . $copia->getVenditore()->getCognome() ?></td>
                        <td><a href="compratore/acquisto?cmd=acquisto&copia=<?= $i ?><?= $vd->scriviToken('&') ?>" title="Compra la copia">Compra</a></td>
                    </tr>
                    <?php
						$i++;
					}
			}
	}
            ?>
        </tbody>
    </table>
<?php 
} else { ?>
    <p> Nessun videogioco disponibile </p>
<?php }?>
