<div class="content_heading">
	<span><?=__('Инвесторам')?></span>
	<ul class="bread_cramps">
		<li>
			<a href="/<?=$lang?>"><?=__('Главная')?></a>
		</li>
		<li>
			<?=__('Инвесторам')?>
		</li>
	</ul>
</div>
<div class="invest_form">
<form method="GET">
	<select placeholder="выберите страну" name="country">
		<option value="" disabled selected hidden'><?=__('Выберите страну')?></option>
		<?php foreach($countries as $key => $value): ?>
			<option value="<?=$key?>"><?=$value?></option>
		<?php endforeach ?>
	</select>
	<select name="category">
		<option value="" disabled selected hidden'><?=__('Выберите отрасль')?></option>
		<?php foreach($categories as $key => $value): ?>
			<option value="<?=$key?>"><?=$value?></option>
		<?php endforeach ?>
	</select>
	<input type="submit" value="<?=__('Искать')?>"/>
	</form>
</div>
<ul class="invest_ul">
<?php foreach($data as $item): ?>
	<li>
		<div class="invest-mini">
			<a href="/<?=$lang?>investors/view/<?=$item['Investor']['id'] ?>">
				<img src="/img/investor/thumbs/<?=$item['Investor']['img'] ?>"/>
			</a>
			<a class="art_a" href="/<?=$lang?>investors/view/<?=$item['Investor']['id'] ?>"><?=$item['Investor']['title'] ?></a>
			<span class="fl_l"><?=$item['Country']['title'] ?></span>
			<span class="fl_r"><?=$item['Category']['title'] ?></span>
			<div class="clearfix"></div>
			<span class="price">
				<?=$item['Investor']['investment'] ?> тг.
			</span>
		</div>
	</li>
	<?php endforeach ?>
																													
</ul>