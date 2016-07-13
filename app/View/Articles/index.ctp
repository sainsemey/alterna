<div class="content_heading">
	<span><?=__('Полезная информция')?></span>
	<ul class="bread_cramps">
		<li>
			<a href="/<?=$lang?>"><?=__('Главная')?></a>
		</li>
		<li>
			<?=__('Полезная информция')?>
		</li>
	</ul>
</div>
<ul class="invest_ul">
<?php foreach($data as $item): ?>
	<li>
		<div class="invest-mini">
			<a href="/articles/view/<?=$item['Article']['id']?>">
				<img src="/img/article/thumbs/<?=$item['Article']['img']?>"/>
			</a>
			<a class="art_a" href="/articles/view/<?=$item['Article']['id']?>"><?=$item['Article']['title']?></a>
			<span class="fl_l"><?=$item['Country']['title']?></span>
			<span class="fl_r"><?=$item['Category']['title']?></span>
			<div class="clearfix"></div>
			
		</div>
	</li>
	<?php endforeach ?>
																													
</ul>	