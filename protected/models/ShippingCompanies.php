<?php

/**
 * This is the model class for table "{{shipping_companies}}".
 *
 * The followings are the available columns in table '{{shipping_companies}}':
 * @property integer $id
 * @property string $company_name
 * @property string $company_desc
 * @property string $company_website
 * @property string $tracking_number_format
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property ShippingMethods[] $shippingMethods
 */
class ShippingCompanies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shipping_companies}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('company_name','required'),
                        array('company_name','unique'),
			array('created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('company_name', 'length', 'max'=>128, 'min'=>3),
			array('company_desc, company_website, tracking_number_format', 'length', 'max'=>255),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_name, tracking_number_format, company_desc, company_website, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'shippingMethods' => array(self::HAS_MANY, 'ShippingMethods', 'shipping_company_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'company_name' => Yii::t('common', 'Company Name'),
			'company_desc' => Yii::t('common', 'Company Description'),
			'company_website' => Yii::t('common', 'Company Website'),
                        'tracking_number_format' => Yii::t('common', 'Tracking Number Format (RegExp)'),
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_desc',$this->company_desc,true);
		$criteria->compare('company_website',$this->company_website,true);
                $criteria->compare('tracking_number_format',$this->tracking_number_format,true);
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
	 * @return ShippingCompanies the static model class
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
        
        public static function listCompanies()
        {
            static $data=array();
            if(empty($data))
            {
                $data=self::model()->findAll(array('order'=>'t.company_name'));
            }
            return $data;
        }
        
        public static function listData($companyId=null)
        {
            static $data=array();
                        
            if(empty($data))
            {
                $companies = self::listCompanies();
                $data = CHtml::listData($companies,'id',function($company) {
                    return $company->company_name;
                });
            }
            
            if(!empty($companyId))
            {
                $companies = self::listCompanies();
                $data = CHtml::listData($companies,'id',function($company) {
                    return $company->company_name;
                });
                return $data[$companyId];
            }
            return $data;
        }
        
        /**
         * Validate tracking number format.
         * @param mixed $trackingNumber
         * @param int $shippingMethodID
         * @return boolean True if valid or false
         */
        public static function validateTrackingNumber($trackingNumber,$shippingMethodID)
        {
            $shippingMethod=ShippingMethods::model()->findByPk($shippingMethodID);
            if($shippingMethod===null)
                return false;
            
            $shippingCompany=self::model()->findByPk($shippingMethod->shipping_company_id);
            if($shippingCompany===null)
                return false;
            
            if(empty($shippingCompany->tracking_number_format))
                return true;
            
        if( is_array($trackingNumber) || 
            is_object($trackingNumber) || 
            !preg_match($shippingCompany->tracking_number_format, $trackingNumber))
        {
            return false;
        }
            
            return true;
        }
}
