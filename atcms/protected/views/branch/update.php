<?php
$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Create Branch', 'url'=>array('create')),
	array('label'=>'View Branch', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Branch', 'url'=>array('admin')),
);
?>

<h1>Update Branch <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>