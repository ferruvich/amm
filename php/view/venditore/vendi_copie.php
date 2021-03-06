<div class="input-form">
    <h3>Vendi copia</h3>
    <form method="post" action="venditore/vendi_copie<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="c_nuova"/>
        <label for="videogiochi">Videogioco</label>
        <select name="videogiochi" id="videogiochi">
            <?php foreach ($videogiochi as $videogioco) { ?>
                <option value="<?= $videogioco->getId() ?>" ><?= $videogioco->getTitolo() . " - " . $videogioco->getConsole()->getNome() . " - € " . $videogioco->getPrezzo()?></option>
            <?php } ?>
        </select>
        <div class="btn-group">
            <button type="submit" name="cmd" value="c_nuova">Vendi</button>
        </div>
    </form>
	<div>
		Se il videogioco che si desidera vendere non è nella lista, inseriscilo!:
		<form method="post" action="venditore/inserisci_gioco<?= $vd->scriviToken('?')?>">
			<button type="submit" name="cmd" value="v_nuovo"> Inserisci </button>
		</form>
	</div>
</div>
