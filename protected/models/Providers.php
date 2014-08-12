<?php

/**
 * This is the model class for table "{{providers}}".
 *
 * The followings are the available columns in table '{{providers}}':
 * @property integer $id
 * @property string $provider_name
 * @property string $cif
 * @property string $provider_desc
 * @property string $provider_url
 * @property string $provider_country
 * @property string $provider_address
 * @property string $provider_type
 * @property string $provider_phone
 * @property string $provider_fax
 * @property integer $sku_as_ean
 * @property string $vat
 * @property string $discount
 * @property integer $currency_id
 * @property string $default_language
 * @property integer $inactive
 * @property string $sku_format
 * @property string $provider_email
 * @property string $service_url
 * @property string $sync_params
 * @property integer $sync_enabled
 * @property string $sync_schedule
 * @property string $last_sync_date
 * @property integer $send_csv
 * @property integer $send_xls
 * @property string $csv_format
 * @property string $xls_format
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property ItemsByProviders[] $itemsByProviders
 * @property PriceRules[] $priceRules
 * @property ProviderInvoices[] $providerInvoices
 * @property ProviderOrders[] $providerOrders
 * @property Products[] $amzni5Products
 * @property ProviderProductsHistories[] $providerProductsHistories
 * @property Warehouse[] $warehouses
 * @property Languages $defaultLanguage
 */
class Providers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{providers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('cif, provider_name, vat, provider_type, provider_country, provider_email, currency_id, default_language', 'required'),
			array('default_language','match','pattern'=> '/^[a-zA-Z]{2}-[a-zA-Z]{2}$/','message'=> Yii::t('common','Language code must be in format \'xx-xx\', where \'x\' - letter.')),
                        array('inactive, created_by, modified_by, locked_by, currency_id', 'numerical', 'integerOnly'=>true),
			array('provider_name, provider_email', 'length', 'max'=>128),
			array('cif, provider_desc, provider_url, provider_address, sku_format', 'length', 'max'=>255),
			array('provider_country', 'length', 'max'=>2),
                        array('vat, discount','compare','compareValue'=>'0.00001',
                                                                                'operator'=>'>',
                                                                                'allowEmpty'=>true , 
                                                                                'message'=>Yii::t('common', '{attribute} must be greater than zero')),
			array('provider_type', 'length', 'max'=>16),
			array('provider_name', 'length', 'min'=>8),
			array('provider_email', 'email'),
			array('provider_name, cif, provider_email', 'unique'),
			array('vat', 'length', 'max'=>5),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provider_name, cif, provider_desc, provider_url, provider_country, provider_address, provider_type, vat, inactive, sku_format, provider_email, service_url, sync_params, sync_enabled, sync_schedule, last_sync_date, send_csv, send_xls, csv_format, xls_format, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'itemsByProviders' => array(self::HAS_MANY, 'ItemsByProviders', 'provider_id'),
			'priceRules' => array(self::HAS_MANY, 'PriceRules', 'provider_id'),
			'providerInvoices' => array(self::HAS_MANY, 'ProviderInvoices', 'provider_id'),
			'providerOrders' => array(self::HAS_MANY, 'ProviderOrders', 'provider_id'),
			'amzni5Products' => array(self::MANY_MANY, 'Products', '{{provider_products}}(provider_id, product_id)'),
			'providerProductsHistories' => array(self::HAS_MANY, 'ProviderProductsHistories', 'provider_id'),
			'warehouses' => array(self::HAS_MANY, 'Warehouse', 'provider_id'),
                        'defaultLanguage' => array(self::BELONGS_TO, 'Languages', 'default_language'),
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
			'provider_desc' => Yii::t('common', 'Provider Desc'),
			'provider_url' => Yii::t('common', 'Provider URL'),
			'provider_country' => Yii::t('common', 'Provider Country'),
			'provider_address' => Yii::t('common', 'Provider Address'),
			'provider_type' => Yii::t('common', 'Provider Type'),
			'provider_phone' => Yii::t('common', 'Provider Phone'),
			'provider_fax' => Yii::t('common', 'Provider Fax'),
			'sku_as_ean' => Yii::t('common', 'Storing SKU As EAN'),
			'vat' => Yii::t('common', 'VAT'),
			'discount' => Yii::t('common', 'Discount'),
                        'currency_id' => Yii::t('common', 'Provider Currency'),
			'default_language' => Yii::t('common', 'Default Language'),
			'inactive' => Yii::t('common', 'Inactive'),
			'sku_format' => Yii::t('common', 'SKU Format'),
			'provider_email' => Yii::t('common', 'Provider Email'),
                        'service_url' => Yii::t('common', 'Service URL'),
			'sync_params' => Yii::t('common', 'Synchronization Parameters'),
			'sync_enabled' => Yii::t('common', 'Synchronization Enabled'),
			'sync_schedule' => Yii::t('common', 'Synchronization Schedule'),
			'last_sync_date' => Yii::t('common', 'Last Synchronization Date'),
			'send_csv' => Yii::t('common', 'Send .CSV'),
			'send_xls' => Yii::t('common', 'Send .XLS'),
			'csv_format' => Yii::t('common', 'CSV Format'),
			'xls_format' => Yii::t('common', 'XLS Format'),
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
		$criteria->compare('provider_desc',$this->provider_desc,true);
		$criteria->compare('provider_url',$this->provider_url,true);
		$criteria->compare('provider_country',$this->provider_country,true);
		$criteria->compare('provider_address',$this->provider_address,true);
		$criteria->compare('provider_type',$this->provider_type,true);
		$criteria->compare('provider_phone',$this->provider_phone,true);
		$criteria->compare('provider_fax',$this->provider_fax,true);
		$criteria->compare('sku_as_ean',$this->sku_as_ean);
		$criteria->compare('vat',$this->vat,true);
		$criteria->compare('discount',$this->discount,true);
                $criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('default_language',$this->default_language,true);
		$criteria->compare('inactive',$this->inactive);
		$criteria->compare('sku_format',$this->sku_format,true);
		$criteria->compare('provider_email',$this->provider_email,true);
                $criteria->compare('service_url',$this->service_url,true);
		$criteria->compare('sync_params',$this->sync_params,true);
		$criteria->compare('sync_enabled',$this->sync_enabled);
		$criteria->compare('sync_schedule',$this->sync_schedule,true);
		$criteria->compare('last_sync_date',$this->last_sync_date,true);
		$criteria->compare('send_csv',$this->send_csv);
		$criteria->compare('send_xls',$this->send_xls);
		$criteria->compare('csv_format',$this->csv_format,true);
		$criteria->compare('xls_format',$this->xls_format,true);
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
	 * @return Providers the static model class
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
        
        public static function sync()
        {
            $result = Yii::t('common', 'Providers synchronization');
            return  $result.' - <span class="green">OK</span>';
        }
}
