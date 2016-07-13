<a href="/admin/articles/add">Добавить на русском</a> | <a href="/admin/articles/add?lang=kz">Добавить на казахском</a><br>
<table>
<th>Название</th><th>Категория</th><th>Редактировать</th><th>Удаление</th>
<?php foreach ($data as $item) : ?>
	<tr>
	<td>
	<?php  foreach($item['titleTranslation'] as $title): ?>
		<?= $title['locale'] .': '. $title['content']; ?><br>
	<?php endforeach; ?>
	 
	</td>
	<td>
	<?= $item['Category']['title'] ?>
	</td>
	
	<td>
	<a href="/admin/articles/edit/<?=$item['Article']['id']?>?lang=ru"> рус</a> |
	 <a href="/admin/articles/edit/<?=$item['Article']['id']?>?lang=kz"> каз</a> |
	 <a href="/admin/articles/edit/<?=$item['Article']['id']?>?lang=en"> eng</a></td>
	 <td>
<div class="news_del">	<?php echo $this->Form->postLink('Удалить', array('action' => 'admin_delete', $item['Article']['id']), array('confirm' => 'Подтвердите удаление')); ?>
			</div> 
	</td>
	</tr>
<?php endforeach; ?>
</table>
