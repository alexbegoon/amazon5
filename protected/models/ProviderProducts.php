<?php

/**
 * This is the model class for table "{{provider_products}}".
 *
 * The followings are the available columns in table '{{provider_products}}':
 * @property integer $provider_id
 * @property string $product_id
 * @property string $provider_product_name
 * @property string $provider_price
 * @property integer $quantity_in_stock
 * @property integer $currency_id
 * @property string $provider_brand
 * @property string $provider_category
 * @property string $provider_sex
 * @property string $provider_image_url
 * @property string $provider_thumb_image_url
 * @property string $inner_id
 * @property string $inner_sku
 * @property integer $blocked
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class ProviderProducts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, product_id, currency_id, quantity_in_stock, provider_price, provider_product_name', 'required'),
			array('provider_id, quantity_in_stock, currency_id, blocked, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>11),
                        array('product_id', 'unique', 'criteria'=>array(
                              'condition'=>'`provider_id`=:provider_id',
                              'params'=>array(
                                  ':provider_id'=>$this->provider_id
                              )
                        )),
                        array('provider_id', 'unique', 'criteria'=>array(
                              'condition'=>'`product_id`=:product_id',
                              'params'=>array(
                                  ':product_id'=>$this->product_id
                              )
                        )),
			array('quantity_in_stock', 'numerical', 'integerOnly'=>true, 'min'=>0),
			array('provider_product_name, provider_brand, provider_category, provider_sex, provider_image_url, provider_thumb_image_url', 'length', 'max'=>255),
			array('provider_price', 'length', 'max'=>15),
                        array('provider_price','compare','compareValue'=>'0.00001',
                                    'operator'=>'>',
                                    'allowEmpty'=>true , 
                                    'message'=>Yii::t('common', '{attribute} must be greater than zero')),
			array('inner_id, inner_sku', 'length', 'max'=>64),
			array('inner_sku', 'validateSku'),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('provider_id, product_id, provider_product_name, provider_price, quantity_in_stock, currency_id, provider_brand, provider_category, provider_sex, provider_image_url, provider_thumb_image_url, inner_id, inner_sku, blocked, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateSku($attribute,$params)
        {
            static $provider;
            if(!isset($provider[$this->provider_id]))
            $provider[$this->provider_id] = Providers::model()->findByPk($this->provider_id);
            
            if($provider[$this->provider_id]->sku_as_ean != 0)
            {
                if(preg_match('/^\d{6,13}/', $this->inner_sku) !== 1)
                {
                    $this->addError('inner_sku', Yii::t('common', 'SKU malformed'));
                }
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_id' => Yii::t('common', 'Provider ID'),
			'product_id' => Yii::t('common', 'Product ID'),
			'provider_product_name' => Yii::t('common', 'Provider Product Name'),
			'provider_price' => Yii::t('common', 'Provider Price'),
			'quantity_in_stock' => Yii::t('common', 'Quantity In Stock'),
			'currency_id' => Yii::t('common', 'Currency'),
			'provider_brand' => Yii::t('common', 'Provider Brand'),
			'provider_category' => Yii::t('common', 'Provider Category'),
			'provider_sex' => Yii::t('common', 'Provider Sex'),
			'provider_image_url' => Yii::t('common', 'Provider Image URL'),
			'provider_thumb_image_url' => Yii::t('common', 'Provider Thumb Image URL'),
			'inner_id' => Yii::t('common', 'Inner ID'),
			'inner_sku' => Yii::t('common', 'Inner SKU'),
			'blocked' => Yii::t('common', 'Blocked'),
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

		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('provider_product_name',$this->provider_product_name,true);
		$criteria->compare('provider_price',$this->provider_price,true);
		$criteria->compare('quantity_in_stock',$this->quantity_in_stock);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('provider_brand',$this->provider_brand,true);
		$criteria->compare('provider_category',$this->provider_category,true);
		$criteria->compare('provider_sex',$this->provider_sex,true);
		$criteria->compare('provider_image_url',$this->provider_image_url,true);
		$criteria->compare('provider_thumb_image_url',$this->provider_thumb_image_url,true);
		$criteria->compare('inner_id',$this->inner_id,true);
		$criteria->compare('inner_sku',$this->inner_sku,true);
		$criteria->compare('blocked',$this->blocked);
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
	 * @return ProviderProducts the static model class
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
        
        public static function syncProducts($model)
        {
            try
            {
                $currentTransaction = Yii::app()->db->getCurrentTransaction();
                if ($currentTransaction !== null) 
                {
                    // Transaction already started outside
                    $currentTransaction = null;
                }
                $transaction = Yii::app()->db->beginTransaction();
                $serviceData = self::requestProviderData($model);
                $products = self::processProviderData($serviceData,$model);
                $products = self::assignToProducts($products);
                self::assignToManufacturers($products);
                self::storeProducts($products);
                $transaction->commit();
                unset($products);
                return true;
            } catch (Exception $ex) {
                $transaction->rollback();
                throw new CHttpException(500,$ex->getMessage());
            }
        }
        
        private static function assignToManufacturers($products)
        {
            foreach ($products as $product)
            {
                // Assign Manufacturer
                if(!empty($product['provider_brand']))
                {
                    Manufacturers::assignToProduct($product);
                }
            }
            return $products;
        }

        private static function storeProducts($products)
        {
            foreach ($products as $product)
            {
                $criteria = new CDbCriteria;
                $criteria->condition = 'provider_id=:provider_id AND product_id=:product_id';
                $criteria->params    = array(':provider_id'=>$product['provider_id'],
                                             ':product_id'=>$product['product_id'] );
                
                $providerProduct = ProviderProducts::model()->find($criteria);
                if($providerProduct!==null)
                {
                    $providerProduct->attributes = $product;
                    if($providerProduct->save())
                    {
                        ProviderSyncLogs::log(2, 
                                $product['provider_id'], 
                                $product['inner_sku'], 
                                Yii::t('common', 'Product successfully updated'));
                    }
                    else
                    {
                        ProviderSyncLogs::log(3, 
                                $product['provider_id'], 
                                $product['inner_sku'], 
                                Yii::t('common', 'Cannot update the product. {errors}',
                                    array('{errors}'=>get_validation_errors($providerProduct))));
                    }
                }
                else 
                {
                    $providerProduct = new ProviderProducts;
                    $providerProduct->attributes = $product;
                    
                    if($providerProduct->save())
                    {
                        ProviderSyncLogs::log(1, 
                                $product['provider_id'], 
                                $product['inner_sku'], 
                                Yii::t('common', 'Product successfully created'));
                    }
                    else
                    {
                        ProviderSyncLogs::log(3, 
                                $product['provider_id'], 
                                $product['inner_sku'], 
                                Yii::t('common', 'Cannot create the new product. {errors}',
                                    array('{errors}'=>get_validation_errors($providerProduct))));
                    }
                }
            }
        }
        
        private static function assignToProducts($products)
        {
            if(!is_array($products)||empty($products))
                throw new CHttpException(500,  Yii::t('common', 'Products malformed'));
            
            static $providers;
            
            foreach ($products as $k=>$providerProduct) 
            {
                if(!isset($providers[$providerProduct['provider_id']]))
                    $providers[$providerProduct['provider_id']]=Providers::model()->findByPk($providerProduct['provider_id']);
                
                $sku = $providerProduct['inner_sku'];
                
                if($providers[$providerProduct['provider_id']]->sku_as_ean != 0)
                {
                    $sku = preg_replace('/^#/', '', $sku);
                    $sku = Products::fixProductSKU($providerProduct['inner_sku']);
                }
                
                $product = Products::model()->findBySKU($sku);
                
                if($product===null)
                {
                    $product=new Products;
                    $product->product_sku = $sku;
                    if(!$product->save())
                    {
                        throw new CHttpException(500,
                                Yii::t('common', 
                                        'Cannot create the new product. {errors}', 
                                        array('{errors}'=>get_validation_errors($product))));
                    }    
                }
                
                $products[$k]['product_id'] = $product->id;
            }
            
            return $products;
        }
        
        private static function requestProviderData($model)
        {
            if(empty($model->service_url))
                throw new CHttpException(500,
                        '{attribute} is empty for the provider: {provider_name}',
                        array('{provider_name}'=>$model->provider_name,
                              '{attribute}'=>$model->getAttributeLabel('service_url')));
            
            if(empty($model->sync_params))
                throw new CHttpException(500,Yii::t('common','{attribute} is empty for the provider: {provider_name}',
                        array('{provider_name}'=>$model->provider_name,
                              '{attribute}'=>$model->getAttributeLabel('sync_params'))));
            
            $data = file_get_contents_curl($model->service_url);
            
            if(empty($data))
                throw new CHttpException(500,
                        Yii::t('common',
                            'Service unavailable for the provider: {provider_name}. Please check this URL: {URL}. Provider contacts: Phone {Phone}, Email {Email}',
                            array('{provider_name}'=>$model->provider_name,
                                  '{URL}'=>$model->service_url,
                                  '{Phone}'=>$model->provider_phone,
                                  '{Email}'=>$model->provider_email,
                                )));
            
            return $data;
        }
        
        /**
         * Return clean formatted array of the provider products
         * @param type $serviceData
         * @param type $model
         * @return array
         */
        private static function processProviderData($serviceData,$model)
        {
            $data = array();
                        
            $rows = explode(
                    str_replace(
                            array("\\n","\\t"),
                            array("\n","\t"),
                            $model->getSyncParamValue('end_of_line')), $serviceData);
            
            if(empty($rows) || !is_array($rows))
                throw new CHttpException(500,
                        Yii::t('common', 'Provider data malformed. Provider: {provider_name}',
                        array('{provider_name}'=>$model->provider_name)));

            foreach ($rows as $k=>$row)
            {
                if($k < $model->getSyncParamValue('start_from_row'))
                    continue;
                if(empty($row))
                    continue;
                
                $product = array();
                $productMixedData = str_getcsv($row, str_replace(
                            array("\\n","\\t"),
                            array("\n","\t"),$model->getSyncParamValue('row_delimiter')));
                
                foreach (Providers::getSyncAvailableParameters() as $param)
                {
                    if(isset($productMixedData[$model->getSyncParamValue($param)]))
                    $product[$param] = trim(strip_tags($productMixedData[$model->getSyncParamValue($param)]));
                }
                
                if(isset($product['provider_price']))
                    $product['provider_price'] = (float)preg_replace('/,/', '.', $product['provider_price']);
                
                if(isset($model->discount)&&!empty($model->discount)&&$model->discount!=0)
                    $product['provider_price'] *= (float)$model->discount;
                
                unset($product['start_from_row']);
                unset($product['end_of_line']);
                unset($product['row_delimiter']);
                
                $product['currency_id']=$model->currency_id;
                $product['provider_id']=$model->id;
                
                $data[] = $product;
            }
            
            return $data;
        }
        
        public function afterSave() 
        {
            parent::afterSave();
            
            $attributes = $this->getAttributes();
            $validAttrs = array('provider_id','product_id','provider_price','quantity_in_stock','currency_id');
            $criteria = new CDbCriteria;
            $criteria->condition = 'provider_id=:provider_id AND product_id=:product_id';
            $criteria->params    = array(':provider_id'=>$attributes['provider_id'],
                                         ':product_id' =>$attributes['product_id']
                );
            $criteria->limit = 1;
            $criteria->order = 'created_on DESC';
            
            $history = ProviderProductsHistories::model()->find($criteria);
            
            if($history===null)
            {
                $history = new ProviderProductsHistories;
                foreach ($validAttrs as $attr)
                {
                    $history->setAttribute($attr, $attributes[$attr]);
                }
                $history->save();
            }
            else
            {
                $historyAttributes = $history->getAttributes($validAttrs);
                $historyAttributes['provider_price'] = (float)$historyAttributes['provider_price'];
                if(count(array_diff_assoc($historyAttributes,$attributes))>0)
                {
                    $history = new ProviderProductsHistories;
                    foreach ($validAttrs as $attr)
                    {
                        $history->setAttribute($attr, $attributes[$attr]);
                    }
                    $history->save();
                }
            }
        }
}
