<?php //debug($data); ?>
<div class="admin_add">
	<div class="ad_up">
		<h2>Редактирование участника</h2>
	</div>
<?php 

echo $this->Form->create('Member', array('type' => 'file'));
echo $this->Form->input('title', array('label' => 'Название:'));
echo $this->Form->input('img', array('label' => 'Изображение:', 'type' => 'file'));
echo $this->Form->input('position', array('label' => 'Должность:'));
echo $this->Form->input('body', array('label' => 'Текст:', 'id' => 'editor'));
?>
<div class="edit_bot">
	<div class="bot_r">
	<?
	
	echo $this->Form->input('id');
	echo $this->Form->end('Редактировать');
	?>
	</div>
</div>
<script type="text/javascript">
	 CKEDITOR.replace( 'editor' );
</script>
</div>