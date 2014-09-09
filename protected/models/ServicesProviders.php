<?php

/**
 * This is the model class for table "{{services_providers}}".
 *
 * The followings are the available columns in table '{{services_providers}}':
 * @property integer $id
 * @property string $provider_name
 * @property string $cif
 * @property integer $provider_type
 * @property string $provider_description
 * @property string $provider_url
 * @property string $provider_country
 * @property string $provider_address
 * @property string $default_language
 * @property string $phone
 * @property double $vat
 * @property string $provider_email
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property ServicesProvidersTypes $providerType
 */
class ServicesProviders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{services_providers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_type, cif, default_language, provider_country, provider_name, vat', 'required'),
			array('provider_type, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('vat', 'numerical', 'max'=>60, 'min'=>0),
			array('provider_name, provider_url, provider_email', 'length', 'max'=>255),
			array('cif, provider_address', 'length', 'max'=>45),
			array('provider_country', 'length', 'max'=>2),
			array('default_language', 'length', 'max'=>5),
			array('phone', 'length', 'max'=>32),
			array('provider_email', 'email'),
			array('provider_description, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provider_name, cif, provider_type, provider_description, provider_url, provider_country, provider_address, default_language, phone, vat, provider_email, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'providerType' => array(self::BELONGS_TO, 'ServicesProvidersTypes', 'provider_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'provider_name' => Yii::t('common', 'Provider Name'),
			'cif' => Yii::t('common', 'CIF'),
			'provider_type' => Yii::t('common', 'Provider Type'),
			'provider_description' => Yii::t('common', 'Provider Description'),
			'provider_url' => Yii::t('common', 'Provider URL'),
			'provider_country' => Yii::t('common', 'Provider Country'),
			'provider_address' => Yii::t('common', 'Provider Address'),
			'default_language' => Yii::t('common', 'Default Language'),
			'phone' => Yii::t('common', 'Phone'),
			'vat' => Yii::t('common', 'VAT'),
			'provider_email' => Yii::t('common', 'Provider Email'),
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
		$criteria->compare('provider_name',$this->provider_name,true);
		$criteria->compare('cif',$this->cif,true);
		$criteria->compare('provider_type',$this->provider_type);
		$criteria->compare('provider_description',$this->provider_description,true);
		$criteria->compare('provider_url',$this->provider_url,true);
		$criteria->compare('provider_country',$this->provider_country,true);
		$criteria->compare('provider_address',$this->provider_address,true);
		$criteria->compare('default_language',$this->default_language,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('vat',$this->vat);
		$criteria->compare('provider_email',$this->provider_email,true);
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
	 * @return ServicesProviders the static model class
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
