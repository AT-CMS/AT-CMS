<?php

class m111027_181442_addATCMSdb extends CDbMigration {
	private $ext = '.sql';
	
	public function up() {
		$sql = file_get_contents(get_class($this) . '_up' . $this->ext);
		$this->run($sql);		
	}

	public function down() {
		$sql = file_get_contents(get_class($this) . '_down' . $this->ext);
		$this->run($sql);
	}
	
	private function run($sql) {
		$this->execute($sql);
	}

	/*
	  // Use safeUp/safeDown to do migration with transaction
	  public function safeUp()
	  {
	  }

	  public function safeDown()
	  {
	  }
	 */
}