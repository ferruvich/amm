<h2 class="icon-title">Venditore</h2>
<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="venditore/home<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="venditore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'games' ? 'current_page_item' : '' ?>"><a href="venditore/games<?= $vd->scriviToken('?')?>">Giochi in vendita da te</a></li>
	<li class="<?= $vd->getSottoPagina() == 'games_sold' ? 'current_page_item' : '' ?>"><a href="venditore/games_sold<?= $vd->scriviToken('?')?>">Giochi venduti</a></li>
    <li class="<?= $vd->getSottoPagina() == 'vendi_copie' ? 'current_page_item' : '' ?>"><a href="venditore/vendi_copie<?= $vd->scriviToken('?')?>">Vendi</a></li>
	<li class="logout"><a href="venditore?cmd=logout">Logout</a></li>
</ul>
