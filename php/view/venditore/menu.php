<ul>
    <li class="<?= strpos($vd->getSottoPagina(),'home') !== false || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="venditore/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'anagrafica') !== false ? 'current_page_item' : '' ?>"><a href="venditore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= strpos($vd->getSottoPagina(), 'games') !== false ? 'current_page_item' : '' ?>"><a href="venditore/games<?= $vd->scriviToken('?')?>">Giochi in vendita da te</a></li>
	<li class="<?= strpos($vd->getSottoPagina(), 'games_sold') !== false ? 'current_page_item' : '' ?>"><a href="venditore/games_sold<?= $vd->scriviToken('?')?>">Giochi venduti</a></li>
    <li class="<?= strpos($vd->getSottoPagina(),'vendi_copie') !== false ? 'current_page_item' : '' ?>"><a href="venditore/vendi_copie<?= $vd->scriviToken('?')?>">Vendi giochi</a></li>
</ul>
