<h2>Список конкурсов</h2>
<a href="/admin/competitions/add">Добавить новый конкурс</a><br>
<table>
<th>Название</th> <th>Участники</th> <th>Действия</th>
<?php foreach ($data as $item) : ?>
	<tr>
	<td><?=$item['Competition']['title']?></td>
	<td><a href="/admin/competitions/members/<?=$item['Competition']['id']?>">Участники</a></td>
	<td>
	<a href="/admin/competitions/edit/<?=$item['Competition']['id']?>"> Редактировать</a> |
	
<?php echo $this->Form->postLink('Удалить', array('action' => 'admin_delete', $item['Competition']['id']), array('confirm' => 'Подтвердите удаление')); ?>
		
	</td>
	</tr>
<?php endforeach; ?>
</table>
