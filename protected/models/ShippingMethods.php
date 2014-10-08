<?php

/**
 * This is the model class for table "{{shipping_methods}}".
 *
 * The followings are the available columns in table '{{shipping_methods}}':
 * @property integer $id
 * @property integer $shipping_company_id
 * @property integer $shipping_type_id
 * @property integer $published
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property ShippingCosts[] $shippingCosts
 * @property Languages[] $amzni5Languages
 * @property ShippingCompanies $shippingCompany
 * @property ShippingTypes $shippingType
 */
class ShippingMethods extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shipping_methods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shipping_company_id, shipping_type_id', 'required'),
			array('shipping_company_id, shipping_type_id, published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shipping_company_id, shipping_type_id, published, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Orders', 'shipping_method_id'),
			'shippingCosts' => array(self::HAS_MANY, 'ShippingCosts', 'shipping_method_id'),
			'amzni5Languages' => array(self::MANY_MANY, 'Languages', '{{shipping_method_translations}}(shipping_method_id, language_code)'),
			'shippingCompany' => array(self::BELONGS_TO, 'ShippingCompanies', 'shipping_company_id'),
			'shippingType' => array(self::BELONGS_TO, 'ShippingTypes', 'shipping_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'shipping_company_id' => Yii::t('common', 'Shipping Company'),
			'shipping_type_id' => Yii::t('common', 'Shipping Type'),
			'published' => Yii::t('common', 'Published'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('shipping_company_id',$this->shipping_company_id);
		$criteria->compare('shipping_type_id',$this->shipping_type_id);
		$criteria->compare('published',$this->published);
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
	 * @return ShippingMethods the static model class
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
        
        public function getName()
        {
            $model=null;
            if(Yii::app()->user->hasState('applicationLanguage'))
            {
                $currentLang = Yii::app()->user->getState('applicationLanguage');
                $model = ShippingMethodTranslations::model()->findByPk(array('shipping_method_id'=>$this->id,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='shipping_method_id=:shipping_method_id';
                $criteria->params=array(':shipping_method_id'=>$this->id);
                $model = ShippingMethodTranslations::model()->find($criteria);
            }
            
            if($model===null)
            {
                return Yii::t('common', '*no name*');
            }
            
            return $model->shipping_method_name;
        }
        
        /**
         * List of available countries to ship using this method
         * @return array
         */
        public function getAvailableCountries()
        {
            $availableCountries=array();
            $models=ShippingCosts::model()->findAll(array(
                'select'=>'t.country_code',
                'group'=>'t.country_code',
                'distinct'=>true,
                'condition'=>'t.shipping_method_id=:shipping_method_id',
                'params'=>array(':shipping_method_id'=>$this->id),
            ));
            $availableCountries=CHtml::listData($models, 'country_code', 'country_code');
            return $availableCountries;
        }
        
        public static function itemAlias($type,$code=NULL) 
        {
		$_items = array(
			'Published' => array(
				'0' => Yii::t('yii','No'),
				'1' => Yii::t('yii','Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
        
        public static function listMethods()
        {
            static $data=array();
            if(empty($data))
            {
                $data=self::model()->findAll(array('condition'=>'t.published=1'));
            }
            return $data;
        }
        
        public static function listData($methodId=null)
        {
            static $data=array();
                        
            if(empty($data))
            {
                $methods = self::listMethods();
                $data = CHtml::listData($methods,'id',function($method) {
                    return $method->getName();
                });
                asort($data);
            }
            
            if(!empty($methodId))
            {
                $methods = self::listMethods();
                $data = CHtml::listData($methods,'id',function($method) {
                    return $method->getName();
                });
                return $data[$methodId];
            }
            return $data;
        }
}
