<?php

class Branch extends CActiveRecord {
	/**
	 * The followings are the available columns in table 'branch':
	 * @var integer $id
	 * @var string $name
	 * @var string $title
	 * @var integer $parentId
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return Branch the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @param integer $id
	 * @return Branch|Null  
	 */
	public static function load($id) {
		if (!$id)
			throw new Exception('id is not defined');

		$branch = self::model();
		return $branch->findByPk($id);
	}

	/**
	 * @todo  вынести в базовый класс
	 * @see CActiveRecord.save
	 */
	public function save($runValidation=true, $attributes=null) {
		return parent::save();
	}

	/**
	 * @todo  вынести в базовый класс
	 * @see CActiveRecord.delete
	 */
	public function delete() {
		return parent::delete();
	}

	/**
	 * @return Array Набор правил для валидации данных
	 */
	public function rules() {
		return array_merge(
										parent::rules(), 
										array(
												array('title', 'required'),
												array('title', 'length', 'min' => 1, 'max' => 200),
												array('parentId', 'checkParentId', array('key' => 'value'))
										)
		);
	}

	/**
	 * @param string $attribute имя проверяемого атрибута
	 * @param array $params переданные параметры. Как я понял они задаются при определении валидатора
	 */
	public function checkParentId($attribute, $params) {
		if (is_null($this->parentId))
			return;

		if (!is_int($this->parentId)) {
			$this->addError($attribute, 'Свойство parentId должно быть числом');
			return;
		}
						
		$result = $this->load($this->parentId);
		if (!$result)
			$this->addError($attribute, 'Свойство parentId не может быть утановлена как родительская. Ветки с id = ' . $this->parentId . ' не существует');
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'branch';
	}

}