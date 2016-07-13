<div class="content_heading">
	<span>	<?=$data['Investor']['title']?></span>
	<ul class="bread_cramps">
		<li>
			<a href="/<?=$lang?>"><?=__('Главная')?></a>
		</li>
		<li>
			<a href="/<?=$lang?>investors"><?=__('Инвесторам')?></a>
		</li>
		<li>
			<?=$data['Investor']['title']?>
		</li>
	</ul>
</div>
<div class="project">
	<div class="proj_up">
		<img src="/img/investor/thumbs/<?=$data['Investor']['img']?>">
			<span class="heading"><?=$data['Investor']['title']?></span>
			<ul class="proj_ul">
				<li><span>Стадия проекта:</span> <?=$data['Investor']['stage']?></li>
				<li><span>Отрасль проекта:</span> <?=$data['Category']['title']?></li>
				<li><span>Регион:</span> <?=$data['Country']['title']?></li>
				<li><span>Стоимость проекта:</span> <?=$data['Investor']['investment']?> KZT</li>
			</ul>
			<a href="#">Связаться с нами</a>
	</div>
	<ul class="proj_part">
		<li>
			<div class="p_heading">Идея проекта:</div>
			<div class="proj_text">
				<p><?=$data['Investor']['idea']?></p>
			</div>
		</li>
		<li>
			<div class="p_heading">О Владельце проекта:</div>
			<div class="proj_text">
				<p><?=$data['Investor']['owner']?></p>
			</div>
		</li>
		<li>
			<div class="p_heading">Актуальность:</div>
			<div class="proj_text">
				<p><?=$data['Investor']['relevance']?></p>
			</div>
		</li>
		<li>
			<div class="p_heading">Преимущества:</div>
			<div class="proj_text">
				<p><?=$data['Investor']['advantages']?></p>
			</div>
		</li>
		<li>
			<div class="p_heading">Предложение инвестору:</div>
			<div class="proj_text">
				<p><?=$data['Investor']['offer']?></p>
			</div>
		</li>
	</ul>
</div>
<sidebar class="proj_sidebar">
	<div class="wr">
		<span class="other_heading"><?= __('Другие проекты')?></span>
		<ul class="other_proj">
		<?php foreach($projects as $item): ?>
			<li>
				<div class="invest-mini">
					<a href="/<?=$lang?>investors/view/<?=$item['Investor']['id'] ?>">
						<img src="/img/investor/thumbs/<?=$item['Investor']['img']?>"/>
					</a>
					<a class="art_a" href="/<?=$lang?>investors/view/<?=$item['Investor']['id'] ?>"><?=$item['Investor']['title'] ?></a>
					<span class="fl_l"><?=$item['Country']['title'] ?></span>
					<span class="fl_r"><?=$item['Category']['title'] ?></span>
					<div class="clearfix"></div>
					<span class="price">
						Вложение: <?=$item['Investor']['investment'] ?> KZT
					</span>
				</div>
			</li>
		<?php endforeach ?>				
		</ul>
	</div>
</sidebar>
<div class="clearfix"></div>