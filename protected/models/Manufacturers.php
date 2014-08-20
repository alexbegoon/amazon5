<?php

/**
 * This is the model class for table "{{manufacturers}}".
 *
 * The followings are the available columns in table '{{manufacturers}}':
 * @property integer $id
 * @property integer $hits
 * @property string $manufacturer_email
 * @property string $manufacturer_url
 * @property integer $published
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Languages[] $productLanguages
 * @property Products[] $amzni5Products
 */
class Manufacturers extends CActiveRecord
{
    
        public $manufacturer_name;
    
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{manufacturers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hits, published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('manufacturer_email, manufacturer_url', 'length', 'max'=>255),
			array('manufacturer_email','email'),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, manufacturer_name, hits, manufacturer_email, manufacturer_url, published, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'productLanguages' => array(self::MANY_MANY, 'Languages', '{{manufacturer_translations}}(manufacturer_id, language_code)'),
			'manufacturerTranslations' => array(self::HAS_MANY, 'ManufacturerTranslations', array('manufacturer_id'=>'id')),
			'manufacturerProducts' => array(self::MANY_MANY, 'Products', '{{product_manufacturers}}(manufacturer_id, product_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'hits' => Yii::t('common', 'Hits'),
			'manufacturer_email' => Yii::t('common', 'Manufacturer Email'),
			'manufacturer_url' => Yii::t('common', 'Manufacturer URL'),
                        'manufacturer_name' => Yii::t('common', 'Manufacturer Name'),
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

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.hits',$this->hits);
		$criteria->compare('t.manufacturer_email',$this->manufacturer_email,true);
		$criteria->compare('t.manufacturer_url',$this->manufacturer_url,true);
		$criteria->compare('t.published',$this->published);
		$criteria->compare('t.created_on',$this->created_on,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by);
		$criteria->compare('t.locked_on',$this->locked_on,true);
		$criteria->compare('t.locked_by',$this->locked_by);
                
                $criteria->with = array( 'manufacturerTranslations', 'manufacturerProducts');
                $criteria->together = true;
                
                $criteria->compare( 'manufacturerTranslations.manufacturer_name', $this->manufacturer_name, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'manufacturer_name'=>array(
                                    'asc'=>'manufacturerTranslations.manufacturer_name',
                                    'desc'=>'manufacturerTranslations.manufacturer_name DESC',
                                ),
                                '*',
                            ),
                        ),
                        'pagination'=>array(
                            'pageSize'=>'20'
                        )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Manufacturers the static model class
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
            $currentLang='';
        
            if(Yii::app()->user->hasState('applicationLanguage'))
            {
                $currentLang = Yii::app()->user->getState('applicationLanguage');
            }
            
            if(!empty($currentLang))
            {
                $translation = ManufacturerTranslations::model()->findByPk(array('manufacturer_id'=>$this->primaryKey, 'language_code'=>$currentLang));
            }
            
            if($translation!==NULL)
            {
                return $translation->manufacturer_name;
            }
            
            $criteria = new CDbCriteria();
            $criteria->condition='manufacturer_id=:id'; 
            $criteria->params=array(':id'=>$this->primaryKey);
            $translation = ManufacturerTranslations::model()->find($criteria);

            if($translation!==NULL)
                return $translation->manufacturer_name;
                
            return NULL;
        }
        
        public static function listManufacturers()
        {
            return self::model()->findAll(array('condition'=>'published=1'));
        }
        
        public static function listData($manufacturer_id=null)
        {
            static $data=array();
            
            if(empty($data))
            {
                $manufacturers = self::listManufacturers();
                $data = CHtml::listData($manufacturers,'id',function($manufacturer) {
                    return CHtml::encode(Manufacturers::model()->findByPk($manufacturer->id)->name);
                });
                asort($data);
            }
            
            if(!empty($manufacturer_id) && isset($data[$manufacturer_id]))
                return $data[$manufacturer_id];
            
            return $data;
        }
        
        public static function itemAlias($type,$code=NULL) 
        {
            $_items = array(
                    'Published' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
                    'Blocked' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
            );
            if (isset($code))
                    return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
            else
                    return isset($_items[$type]) ? $_items[$type] : false;
	}
        
        public static function sync()
        {
            $result = Yii::t('common', 'Manufacturers synchronization');
            return  $result.' - <span class="green">OK</span>';
        }
        
        public static function assignToProduct($product)
        {
            static $providers;
            $valid = true;
            if(!isset($providers[$product['provider_id']]))
                    $providers[$product['provider_id']]=Providers::model()->findByPk($product['provider_id']);
            
            $q = new CDbCriteria();
            $q->condition = 'manufacturer_name=:match';
            $q->params = array(':match'=>$product['provider_brand']);

            $manufacturer = ManufacturerTranslations::model()->find( $q );

            if($manufacturer===null)
            {
                $manufacturer = new Manufacturers;
                $valid = $manufacturer->save();
                if(!$valid)
                {
                    ProviderSyncLogs::log(3, 
                            $product['provider_id'], 
                            $product['inner_sku'], 
                            get_validation_errors($manufacturer));
                }
                $manufacturerTranslation = new ManufacturerTranslations;
                $manufacturerTranslation->manufacturer_name = $product['provider_brand'];
                $manufacturerTranslation->manufacturer_id = $manufacturer->id;
                $manufacturerTranslation->language_code = $providers[$product['provider_id']]->default_language;
                $valid = $manufacturerTranslation->save();
                if(!$valid)
                {
                    ProviderSyncLogs::log(3, 
                            $product['provider_id'], 
                            $product['inner_sku'], 
                            get_validation_errors($manufacturerTranslation));
                }
            }
            
            if($valid)
            {
                $productManufacturers = new ProductManufacturers;
                $productManufacturers->product_id = $product['product_id'];
                $productManufacturers->manufacturer_id = $manufacturer->id;
                $valid = $productManufacturers->save();
                if(!$valid)
                {
                    ProviderSyncLogs::log(3, 
                            $product['provider_id'], 
                            $product['inner_sku'], 
                            get_validation_errors($productManufacturers));
                }
            }
            
            if($valid)
                return $manufacturer->id;
                 
        }
}
