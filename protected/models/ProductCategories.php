<?php

/**
 * This is the model class for table "{{product_categories}}".
 *
 * The followings are the available columns in table '{{product_categories}}':
 * @property string $product_id
 * @property string $category_id
 */
class ProductCategories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{product_categories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, category_id', 'required'),
			array('product_id, category_id', 'numerical', 'integerOnly'=>true),
                        array('product_id', 'unique', 'criteria'=>array(
                                'condition'=>'`category_id`=:category_id',
                                'params'=>array(
                                    ':category_id'=>$this->category_id
                                ),
                            ),
                        ),
			array('product_id, category_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('product_id, category_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => Yii::t('common', 'Product ID'),
			'category_id' => Yii::t('common', 'Category ID'),
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

		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('category_id',$this->category_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductCategories the static model class
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
        
        public function afterDelete() {
            parent::afterDelete();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
        
        public function afterSave() {
            parent::afterSave();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
}
