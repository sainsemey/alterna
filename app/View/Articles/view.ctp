<div class="content_heading">
	<span><?=$post['Article']['title'] ?></span>
	<ul class="bread_cramps">
		<li>
			<a href="#"><?=__('Главная')?></a>
		</li>
		<li>
			<a href="/<?=$lang?>articles"><?=__('Полезная информция')?></a>
		</li>
		<li>
			<?=$post['Article']['title'] ?>
		</li>
	</ul>
</div>	
<div class="content_part">
	<img src="/img/article/thumbs/<?=$post['Article']['img']?>">
	
	<?=$post['Article']['body'] ?>
</div>	