<?php

class BranchController extends Controller
{
	private $modelClass = Branch;
	
	public function actionView($id) {
		$branch = $this->getModel($id);
		var_dump($branch->attributes);
	}
	
	public function actionTest() {
		$branch = $this->getModel(1);
		assert($branch->id === 1);
		assert($branch->id === 2);
		
	}
	
	protected function getModel($id) {
		$branch = $this->getModelClass();
		return $branch::load($id);
	}
	
	protected function getModelClass() {
		return $this->modelClass;
	}
}
