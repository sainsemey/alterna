<div class="admin_add">
	<div class="ad_up">
		<h2>Добавление материала</h2>
	</div>
<?php 
echo $this->Form->create('Investor', array('type' => 'file'));
echo $this->Form->input('title', array('label' => 'Название:'));
echo $this->Form->input('img', array('label' => 'Изображение:', 'type' => 'file'));
?>

<div class="input select">
<label for="InvestorCategoryId">Категория:</label>
	<select required name="data[Investor][category_id]" id="InvestorCategoryId">
		<option value="">Выберите категорию</option>
		<?php foreach($categories as $key => $value): ?>
			<option value="<?=$key?>"><?=$value?></option>
		<?php endforeach ?>
	</select>
</div>

<div class="input select">
<label for="InvestorCountryId">Страна:</label>
	<select required name="data[Investor][country_id]" id="InvestorCountryId">
		<option value="">Выберите страну</option>
		<?php foreach($countries as $key => $value): ?>
			<option value="<?=$key?>"><?=$value?></option>
		<?php endforeach ?>
	</select>
</div>
<?php
echo $this->Form->input('investment', array('label' => 'Вложение:'));
echo $this->Form->input('stage', array('label' => 'Стадия проекта:'));
//echo $this->Form->input('body', array('label' => 'Текст:', 'id' => 'editor'));
echo $this->Form->input('idea', array('label' => 'Идея проекта:'));
echo $this->Form->input('owner', array('label' => 'О Владельце проекта:'));
echo $this->Form->input('relevance', array('label' => 'Актуальность:'));
echo $this->Form->input('advantages', array('label' => 'Преимущества:'));
echo $this->Form->input('offer', array('label' => 'Предложение инвестору:'));

echo $this->Form->input('keywords', array('label' => 'Ключевые слова:'));
echo $this->Form->input('description', array('label' => 'Описание:'));
echo $this->Form->end('Создать');
?>
<script type="text/javascript">
	 CKEDITOR.replace( 'editor' );
</script>
</div>