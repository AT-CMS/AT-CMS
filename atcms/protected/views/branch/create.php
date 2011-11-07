<?php
$this->breadcrumbs=array(
	'Branches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Branch', 'url'=>array('index')),
	array('label'=>'Manage Branch', 'url'=>array('admin')),
);
?>

<h1>Create Branch</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>