<div class="content_heading">
	<span><?=$data['Service']['title']?></span>
	<ul class="bread_cramps">
		<li>
			<a href="/<?=$lang?>"><?= __('Главная')?></a>
		</li>
		<li>
			<?=__('Услуги')?>
		</li>
		<li><?=$data['Service']['title']?></li>
	</ul>
</div>	
<div class="content_part">
	<?=$data['Service']['body']?>
</div>