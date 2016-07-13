<div class="admin_add">
	<div class="ad_up">
		<h2>Добавление статьи</h2>
	</div>
<?php 
echo $this->Form->create('Article', array('type' => 'file'));
?>

<div class="input select">
<label for="ArticleCategoryId">Категория:</label>
	<select required name="data[Article][category_id]" id="ArticleCategoryId">
		<option value="">Выберите категорию</option>
		<?php foreach($categories as $key => $value): ?>
			<option value="<?=$key?>"><?=$value?></option>
		<?php endforeach ?>
	</select>
</div>

<?php
echo $this->Form->input('title', array('label' => 'Название:'));

echo $this->Form->input('body', array('label' => 'Текст:', 'id' => 'editor'));
echo $this->Form->input('date', array('label' => 'Дата:'));
echo $this->Form->input('img', array('label' => 'Изображение:', 'type' => 'file'));
echo $this->Form->input('keywords', array('label' => 'Ключевые слова:'));
echo $this->Form->input('description', array('label' => 'Описание:'));
echo $this->Form->end('Создать');
?>
<script type="text/javascript">
	 CKEDITOR.replace( 'editor' );
</script>
</div>