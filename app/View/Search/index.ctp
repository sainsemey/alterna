<?php //debug($res) ?>
<div class="content_heading">
	<span><?=__('Поиск')?></span>
	<ul class="bread_cramps">
		<li>
			<a href="/<?=$lang?>"><?=__('Главная')?></a>
		</li>
		<li>
			<?=__('Поиск')?>
		</li>
	</ul>
</div>
<ul class="invest_ul">
<?php foreach($res as $item): ?>
	<li>
		<div class="invest-mini">
			<a class="art_a" href="/<?=$item['i18n']['locale']?>/<?=mb_strtolower($item['i18n']['model']) ?>/view/<?=$item['i18n']['foreign_key']?>"><?=$item['i18n']['content']?></a>
			<div class="clearfix"></div>
			
		</div>
	</li>
	<?php endforeach ?>
																													
</ul>	