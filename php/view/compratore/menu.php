<ul>
    <li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>"><a href="compratore<?= $vd->scriviToken('?')?>">Home</a></li>
    <li class="<?= $vd->getSottoPagina() == 'anagrafica' ? 'current_page_item' : '' ?>"><a href="compratore/anagrafica<?= $vd->scriviToken('?')?>">Anagrafica</a></li>
    <li class="<?= $vd->getSottoPagina() == 'acquisto' ? 'current_page_item' : '' ?>"><a href="compratore/acquisto<?= $vd->scriviToken('?')?>">Compra un gioco!</a></li>
</ul>
