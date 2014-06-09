<?php

/**
 * This is the model class for table "{{web_shops}}".
 *
 * The followings are the available columns in table '{{web_shops}}':
 * @property integer $id
 * @property string $shop_name
 * @property string $shop_code
 * @property string $template_name
 * @property string $shop_url
 * @property string $default_language
 * @property integer $currency_id
 * @property integer $offline
 * @property string $email
 * @property string $email_header
 * @property string $email_footer
 * @property string $email_subject
 * @property string $admin_email
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Categories[] $categories
 * @property Content[] $contents
 * @property ContentCategories[] $contentCategories
 * @property Menu[] $menus
 * @property Orders[] $orders
 * @property PriceRules[] $priceRules
 * @property ProductPrices[] $productPrices
 * @property ProductReviews[] $productReviews
 * @property ShippingCosts[] $shippingCosts
 * @property Languages $defaultLanguage
 * @property Currencies $currency
 */
class WebShops extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{web_shops}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('default_language, currency_id', 'required'),
			array('currency_id, offline, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('shop_name', 'length', 'max'=>100),
			array('shop_code', 'length', 'max'=>64),
			array('template_name', 'length', 'max'=>15),
			array('shop_url, email, email_header, email_subject, admin_email', 'length', 'max'=>255),
			array('default_language', 'length', 'max'=>7),
			array('email_footer, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, shop_name, shop_code, template_name, shop_url, default_language, currency_id, offline, email, email_header, email_footer, email_subject, admin_email, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'categories' => array(self::HAS_MANY, 'Categories', 'web_shop_id'),
			'contents' => array(self::HAS_MANY, 'Content', 'web_shop_id'),
			'contentCategories' => array(self::HAS_MANY, 'ContentCategories', 'web_shop_id'),
			'menus' => array(self::HAS_MANY, 'Menu', 'web_shop_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'web_shop_id'),
			'priceRules' => array(self::HAS_MANY, 'PriceRules', 'web_shop_id'),
			'productPrices' => array(self::HAS_MANY, 'ProductPrices', 'web_shop_id'),
			'productReviews' => array(self::HAS_MANY, 'ProductReviews', 'web_shop_id'),
			'shippingCosts' => array(self::HAS_MANY, 'ShippingCosts', 'web_shop_id'),
			'defaultLanguage' => array(self::BELONGS_TO, 'Languages', 'default_language'),
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shop_name' => 'Shop Name',
			'shop_code' => 'Shop Code',
			'template_name' => 'Template Name',
			'shop_url' => 'Shop Url',
			'default_language' => 'Default Language',
			'currency_id' => 'Currency',
			'offline' => 'Offline',
			'email' => 'Email',
			'email_header' => 'Email Header',
			'email_footer' => 'Email Footer',
			'email_subject' => 'Email Subject',
			'admin_email' => 'Admin Email',
			'created_on' => 'Created On',
			'created_by' => 'Created By',
			'modified_on' => 'Modified On',
			'modified_by' => 'Modified By',
			'locked_on' => 'Locked On',
			'locked_by' => 'Locked By',
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
		$criteria->compare('shop_name',$this->shop_name,true);
		$criteria->compare('shop_code',$this->shop_code,true);
		$criteria->compare('template_name',$this->template_name,true);
		$criteria->compare('shop_url',$this->shop_url,true);
		$criteria->compare('default_language',$this->default_language,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('offline',$this->offline);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_header',$this->email_header,true);
		$criteria->compare('email_footer',$this->email_footer,true);
		$criteria->compare('email_subject',$this->email_subject,true);
		$criteria->compare('admin_email',$this->admin_email,true);
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
	 * @return WebShops the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
