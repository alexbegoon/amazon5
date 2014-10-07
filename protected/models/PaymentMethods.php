<?php

/**
 * This is the model class for table "{{payment_methods}}".
 *
 * The followings are the available columns in table '{{payment_methods}}':
 * @property integer $id
 * @property integer $published
 * @property integer $web_shop_id
 * @property string $handler_component
 * @property string $parameters
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Orders[] $orders
 * @property WebShops $webShop
 * @property Languages[] $amzni5Languages
 * @property Transactions[] $transactions
 */
class PaymentMethods extends CActiveRecord
{
    
        public $payment_method_name;
        
        
        public function afterFind() 
        {            
            if(!empty($this->parameters))
            {
                $this->setAttribute('parameters', unserialize(
                Yii::app()->securityManager->decrypt(
                $this->parameters,
                Yii::app()->params['encryptionKey'])));
            }
        }

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payment_methods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('web_shop_id, published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('handler_component', 'match', 'pattern'=>'/^PayPal$|^SagePay$|^Bank Transfer$|^TPV$/'), 
			array('handler_component, web_shop_id', 'required'), 
			array('parameters, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_method_name, web_shop_id, published, handler_component, parameters, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Orders', 'payment_method_id'),
			'amzni5Languages' => array(self::MANY_MANY, 'Languages', '{{payment_method_translations}}(payment_method_id, language_code)'),
                        'webShop' => array(self::BELONGS_TO, 'WebShops', 'web_shop_id'),
			'transactions' => array(self::HAS_MANY, 'Transactions', 'payment_method_id'),
			'paymentTranslations' => array(self::HAS_MANY, 'PaymentMethodTranslations', array('payment_method_id'=>'id')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'published' => Yii::t('common', 'Published'),
                        'web_shop_id' => Yii::t('common', 'Web Shop'),
			'handler_component' => Yii::t('common', 'Handler Component'),
			'payment_method_name' => Yii::t('common', 'Payment Method Name'),
			'parameters' => Yii::t('common', 'Parameters'),
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
		$criteria->compare('t.published',$this->published);
                $criteria->compare('t.web_shop_id',$this->web_shop_id);
		$criteria->compare('t.handler_component',$this->handler_component,true);
		$criteria->compare('t.parameters',$this->parameters,true);
		$criteria->compare('t.created_on',$this->created_on,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by);
		$criteria->compare('t.locked_on',$this->locked_on,true);
		$criteria->compare('t.locked_by',$this->locked_by);
                
                $criteria->with = array( 'paymentTranslations');
                $criteria->group = 't.id';
                $criteria->together = true;
                
                $criteria->compare( 'paymentTranslations.payment_method_name', $this->payment_method_name, true );

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'payment_method_name'=>array(
                                    'asc'=>'paymentTranslations.payment_method_name',
                                    'desc'=>'paymentTranslations.payment_method_name DESC',
                                ),
                                '*',
                            ),
                        ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentMethods the static model class
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
                $model = PaymentMethodTranslations::model()->findByPk(array('payment_method_id'=>$this->id,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='payment_method_id=:payment_method_id';
                $criteria->params=array(':payment_method_id'=>$this->id);
                $model = PaymentMethodTranslations::model()->find($criteria);
            }
            
            if($model===null)
            {
                return Yii::t('common', '*no name*');
            }
            
            return $model->payment_method_name;
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
        
        public static function listMethods($webShopId=null)
        {
            static $data=array();
            if(empty($data))
            {
                $data=self::model()->findAll(array('condition'=>'t.published=1'));
            }
            
            if($webShopId)
            {
                if(WebShops::model()->findByPk($webShopId)!==null)
                {
                    return self::model()->findAll(
                            array('condition'=>'t.published=1 AND t.web_shop_id=:web_shop_id',
                                  'params'=>array(':web_shop_id'=>$webShopId)));
                }
                else 
                {
                    return array();
                }
            }
            return $data;
        }
        
        public static function listData($methodId=null,$webShopId=null)
        {
            static $data=array();
                        
            if(empty($data))
            {
                $methods = self::listMethods($webShopId);
                $data = CHtml::listData($methods,'id',function($method) {
                    return $method->getName();
                });
                asort($data);
            }
            
            if(!empty($methodId))
            {
                $methods = self::listMethods($webShopId);
                $data = CHtml::listData($methods,'id',function($method) {
                    return $method->getName();
                });
                return $data[$methodId];
            }
            return $data;
        }
        
        public function beforeValidate()
        {
            if(is_array($this->parameters))
            {
                $this->setAttribute('parameters', Yii::app()->securityManager->encrypt(
                serialize($this->parameters),
                Yii::app()->params['encryptionKey']));
            }
            return parent::beforeValidate();
        }
        
        public static function listOptions($webShopId,$selected=null)
        {
            $str='';
            $methods = self::listMethods($webShopId);
            $data = CHtml::listData($methods,'id',function($method) {
                return $method->getName();
            });
            asort($data);
            foreach($data as $k=>$method)
            {
                $htmlOptions=array();
                $htmlOptions['value']=$k;
                if($selected==$k && $selected!==null)
                    $htmlOptions['selected']='selected';
                $str .= CHtml::tag('option',$htmlOptions,$method,true);
            }
            return $str;
        }
}
