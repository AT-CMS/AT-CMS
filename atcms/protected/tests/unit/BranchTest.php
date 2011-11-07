<?php

class BranchTest extends CDbTestCase {

	public $fixtures = array(
			'branches' => 'Branch'
	);

	public function testLoad() {
		$branch = Branch::load(1);
		
		/**
		 * @todo Не понятно почему instanceof работает. Разобраться
		 */
		$this->assertTrue($branch instanceof Branch); 
		$this->assertEquals($branch->id, $this->branches['branch1']['id'], 'id ok');
		$this->assertEquals($branch->title, $this->branches['branch1']['title'], 'title ok');
		/**
		 * @todo прикрутить name. может использоваться например в красивых урлах
		 */
		//$this->assertEquals($branch->name, $this->branches['branch1']['name'], 'name ok');
		$this->assertEquals($branch->parentId, null, 'parentId ok');
	}

	public function testTableName() {
		$branch = new Branch();
		$branch->load(1);
		$this->assertEquals($branch->tableName(), 'branch', 'table name ok');
	}
	
	public function testSave() {
		$branch = new Branch;
		$this->assertTrue($branch->isNewRecord, 'Branch created by new operator. isNewRecord ok'); //http://www.yiiframework.com/doc/api/1.1/CActiveRecord#save-detail
		
		$branch->title = $this->branches['branch1']['title'];
		$branch->parentId = 1;
		$this->assertTrue($branch->save(), 'Save ok');
		
		$allBranches = Branch::model()->findAll();
		$this->assertEquals(count($this->branches) + 1, count($allBranches), 'new branch has been added');
		
		$branch = new Branch;
		$this->assertFalse($branch->save(), 'branch title rules ok');
		$err = $branch->getErrors();
		$this->assertEquals(1, count($err), 'one error ok');
		$this->assertEquals('Title cannot be blank.', $err['title'][0], 'one error ok');
	}
	
	public function testUpdate() {
		$branch = Branch::load(3);
		$oldTitle = $branch->title;
		$oldParentId = $branch->parentId;
		$this->assertEquals('Тестовая запись 3', $oldTitle, 'Old title value is ok');
		$this->assertEquals(2, $oldParentId, 'Old parent id value is ok');
		
		$newTitle = 'New title Yo';
		$newParentId = 1;
		$branch->title = $newTitle;
		$branch->parentId = $newParentId;
		$this->assertTrue($branch->save(), ' Update call is Ok');
		
		$branch = Branch::load(3);
		$this->assertEquals($newTitle, $branch->title, 'Update success. Title == new value');
		$this->assertNotEquals($oldTitle, $newTitle, 'new Value != old Value');
		$this->assertNotEquals($oldTitle, $branch->title, 'Update success. Title != old Value');
		
		$this->assertEquals($newParentId, $branch->parentId, 'Update success. parentId == new value');
		$this->assertNotEquals($oldParentId, $newParentId, '$oldParentId != $newParentId');
		$this->assertNotEquals($oldParentId, $branch->parentId, 'Update success. parent id != old Value');
	}
	
	public function testDelete(){
		$this->assertTrue(false);
	}

}