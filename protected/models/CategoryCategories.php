<?php

/**
 * This is the model class for table "{{category_categories}}".
 *
 * The followings are the available columns in table '{{category_categories}}':
 * @property string $parent_id
 * @property string $child_id
 *
 * The followings are the available model relations:
 * @property Categories $parent
 * @property Categories $child
 */
class CategoryCategories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category_categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, child_id', 'required'),
			array('parent_id', 'validateParent'),
			array('parent_id, child_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('parent_id, child_id', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateParent($attribute,$params)
        {
            if ($this->parent_id == $this->child_id)
            {
                $this->addError('parent_id', Yii::t('common', 'You Cannot assign this category to itself'));
            }
            $parents=Categories::getParentsList($this->parent_id);
            
            if(in_array($this->child_id, $parents))
            {
                $this->addError('parent_id', Yii::t('common', 'You Cannot assign to this category'));
            }
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'parent' => array(self::BELONGS_TO, 'Categories', 'parent_id'),
			'child' => array(self::BELONGS_TO, 'Categories', 'child_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'parent_id' => Yii::t('common', 'Parent Category'),
			'child_id' => Yii::t('common', 'Child Category'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('child_id',$this->child_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryCategories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
        
        public function beforeValidate()
        {
            if(empty($this->parent_id))
            {
                $this->parent_id = 0;
            }
            
            return parent::beforeValidate();
        }
        
        public function afterDelete() {
            parent::afterDelete();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
        
        public function afterSave() {
            parent::afterSave();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
}
