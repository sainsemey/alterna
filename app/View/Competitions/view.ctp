<div class="content">
	<div class="title_index">
		<h2><?= __('Конкурс')?></h2>
	</div>
	<div class="concurs_big">
		<div class="concurs_img"><img src="/img/big_konkurs.jpg" alt=""/></div>
		<div class="title"><?=$data['Competition']['title'] ?></div>
		<?=$data['Competition']['body'] ?>
		<a href="#modal1"class="button open_modal"><?= __('УЧАСТВОВАТЬ В КОНКУРСЕ')?></a>
	</div>
	<ul class="concurs_list">
	<?php foreach($members as $item): ?>
		<li>
			<div class="concurs_img"><img src="/img/big_konkurs.jpg" alt=""/></div>
			<div class="title"><?=$item['Member']['title'] ?></div>
			<div class="job"><strong><?= __('Место работы')?>:</strong> <?=$item['Member']['position'] ?></div>
			<p><strong><?= __('Описание')?>: </strong><?=$item['Member']['body'] ?></p>
			<div class="golosovanie"><?= __('Голосование')?>: 
			<form action="/competitions/view/<?=$data['Competition']['id'] ?>" method="POST">
			<input type="hidden" name="data[member_id]" value="<?=$item['Member']['id'] ?>">
			<input type="hidden" name="data[competition_id]" value="<?=$data['Competition']['id'] ?>">
				<button type="submit"></button>
			</form>
			<?php echo $this->Like->getVotes($item['Member']['id'])?></div>
		</li>
	<?php endforeach ?>
	</ul>
</div>
<?php echo $this->element('sidebar'); ?>

<?php echo $this->element('partners'); ?>