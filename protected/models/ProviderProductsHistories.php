<?php

/**
 * This is the model class for table "{{provider_products_histories}}".
 *
 * The followings are the available columns in table '{{provider_products_histories}}':
 * @property string $id
 * @property integer $provider_id
 * @property string $product_id
 * @property string $provider_price
 * @property integer $quantity_in_stock
 * @property integer $currency_id
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property Providers $provider
 * @property Products $product
 */
class ProviderProductsHistories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_products_histories}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, product_id, currency_id, created_on, provider_price, quantity_in_stock', 'required'),
			array('provider_id, quantity_in_stock, currency_id', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>11),
			array('provider_price', 'length', 'max'=>15),
                        array('provider_price','compare','compareValue'=>'0.00001',
                                                                        'operator'=>'>',
                                                                        'allowEmpty'=>true , 
                                                                        'message'=>Yii::t('common', '{attribute} must be greater than zero')),
			array('created_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provider_id, product_id, provider_price, quantity_in_stock, currency_id, created_on', 'safe', 'on'=>'search'),
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
			'provider' => array(self::BELONGS_TO, 'Providers', 'provider_id'),
			'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'provider_id' => Yii::t('common', 'Provider ID'),
			'product_id' => Yii::t('common', 'Product ID'),
			'provider_price' => Yii::t('common', 'Provider Price'),
			'quantity_in_stock' => Yii::t('common', 'Quantity In Stock'),
			'currency_id' => Yii::t('common', 'Currency'),
			'created_on' => Yii::t('common', 'Created On'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('provider_price',$this->provider_price,true);
		$criteria->compare('quantity_in_stock',$this->quantity_in_stock);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProviderProductsHistories the static model class
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
            parent::beforeValidate();
            
            $this->created_on = date('Y-m-d H:i:s');
        }
}
