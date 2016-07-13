<table>
<th>ФИО</th><th>Действия</th>
<?php foreach ($members as $item) : ?>
	<tr>
	<td><?=$item['title']?></td>
	<td>
	<form action="/admin/competitions/members/1" id="form" method="POST">
		<input type="hidden" name="data[member_id]"  value="<?=$item['id']?>">
		<?php if($item['active'] == 0): ?>
		<input type="hidden" name="data[status]"  value="1">
		<input type="submit" value="Активировать">
	<?php else: ?>
		<input type="hidden" name="data[status]"  value="0">
		<input type="submit" value="Деактивировать">
	<?php endif ?>
	</form>

	<a href="/admin/members/edit/<?=$item['id']?>"> Редактировать</a> |
	
<?php echo $this->Form->postLink('Удалить', array('controller' => 'members', 'action' => 'admin_delete', $item['id']), array('confirm' => 'Подтвердите удаление')); ?>
		
	</td>
	</tr>
<?php endforeach; ?>
</table>
