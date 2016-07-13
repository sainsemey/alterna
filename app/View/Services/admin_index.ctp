<a href="/admin/services/add">Добавить</a><br>
<table>
	<tr>
			<th>ID</th>
			<th>Название</th>
			<th>Дествия</th>	
		</tr>
<?php foreach($data as $item): ?>
 	<tr>
 		<td><?=$item['Service']['id']?></td>
 		<td>
 			<?php foreach($item['titleTranslation'] as $title): ?>
				<?= $title['locale'] .': '. $title['content']; ?><br>
			<?php endforeach; ?>
		</td>
 		<td>Редактировать: <a href="/admin/services/edit/<?=$item['Service']['id']?>?lang=ru"> рус</a> |
	 <a href="/admin/services/edit/<?=$item['Service']['id']?>?lang=kz"> каз</a> |
	 <a href="/admin/services/edit/<?=$item['Service']['id']?>?lang=en"> eng</a> |
			<?php echo $this->Form->postLink('Удалить', array('action' => 'admin_delete', $item['Service']['id']), array('confirm' => 'Подтвердите удаление')); ?></td>
	</tr>
<?php endforeach ?>
</table>