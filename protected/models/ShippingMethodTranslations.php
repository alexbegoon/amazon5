<?php

/**
 * This is the model class for table "{{shipping_method_translations}}".
 *
 * The followings are the available columns in table '{{shipping_method_translations}}':
 * @property integer $shipping_method_id
 * @property string $language_code
 * @property string $shipping_method_name
 * @property string $shipping_method_desc
 * @property string $shipping_method_title
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class ShippingMethodTranslations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shipping_method_translations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipping_method_id, language_code, shipping_method_name', 'required'),
			array('shipping_method_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('language_code', 'length', 'max'=>5, 'min'=>5),
			array('shipping_method_name, shipping_method_desc, shipping_method_title', 'length', 'max'=>255, 'min'=>3),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('shipping_method_id, language_code, shipping_method_name, shipping_method_desc, shipping_method_title, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'shipping_method_id' => Yii::t('common', 'Shipping Method'),
			'language_code' => Yii::t('common', 'Language Code'),
			'shipping_method_name' => Yii::t('common', 'Name of Shipping Method'),
			'shipping_method_desc' => Yii::t('common', 'Description of Shipping Method'),
			'shipping_method_title' => Yii::t('common', 'Title of Shipping Method'),
			'created_on' => Yii::t('common', 'Created On'),
			'created_by' => Yii::t('common', 'Created By'),
			'modified_on' => Yii::t('common', 'Modified On'),
			'modified_by' => Yii::t('common', 'Modified By'),
			'locked_on' => Yii::t('common', 'Locked On'),
			'locked_by' => Yii::t('common', 'Locked By'),
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

		$criteria->compare('shipping_method_id',$this->shipping_method_id);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('shipping_method_name',$this->shipping_method_name,true);
		$criteria->compare('shipping_method_desc',$this->shipping_method_desc,true);
		$criteria->compare('shipping_method_title',$this->shipping_method_title,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_on',$this->modified_on,true);
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('locked_on',$this->locked_on,true);
		$criteria->compare('locked_by',$this->locked_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ShippingMethodTranslations the static model class
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
}
