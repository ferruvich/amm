<div class="input-form">
	<h3>Inserisci un nuovo videogioco</h3>
	<form method="post" action="venditore/inserisci_gioco<?= $vd->scriviToken('?')?>">
		<input type="hidden" name="cmd" value="video_nuovo"/>
		<label for="titolo"> Titolo </label>
		<input type="text" name="titolo" id="titolo" value=""/>
        <br>
		<label for="anno"> Anno </label>
		<input type="text" name="anno" id="anno" value=""/>
        <br>
		<label for="trama"> Trama (max 500 caratteri) </label>
		<textarea rows="4" cols="20" name="trama" id="trama"/></textarea>
        <br>
		<label for="prezzo"> Prezzo </label>
		<input type="text" name="prezzo" id="prezzo" value=""/>
        <br>
		<label for="genere"> Genere </label>
		<select name="genere" id="genere">
            <?php foreach ($generi as $genere) { ?>
                <option value="<?= $genere->getId() ?>" ><?= $genere->getNome()?></option>
            <?php } ?>
        </select>
		<br>
		<label for="console"> Console </label>
		<select name="console" id="console">
            <?php foreach ($console as $consol) { ?>
                <option value="<?= $consol->getId() ?>" ><?= $consol->getNome()?></option>
            <?php } ?>
        </select>
		<div class="btn-group">
            <button type="submit" name="cmd" value="video_nuovo">Inserisci</button>
        </div>
	</form>
</div>
