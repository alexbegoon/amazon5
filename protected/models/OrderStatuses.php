<?php

/**
 * This is the model class for table "{{order_statuses}}".
 *
 * The followings are the available columns in table '{{order_statuses}}':
 * @property string $status_code
 * @property integer $published
 * @property integer $public
 * @property integer $notify_customer_if_applied
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Languages[] $amzni5Languages
 * @property Orders[] $orders
 */
class OrderStatuses extends CActiveRecord
{    
        public $status_name;
        public $status_desc;

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_statuses}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_code', 'required'),
			array('status_code', 'unique'),
			array('published, public, notify_customer_if_applied, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('published, public, notify_customer_if_applied', 'boolean'),
			array('public, notify_customer_if_applied', 'validateMarkers'),
			array('status_code', 'length', 'max'=>2),
			array('status_code', 'match', 'pattern'=>'/^\w{2}$/'),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status_code, published, public, notify_customer_if_applied, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateMarkers($attribute, $params)
        {
            if($this->notify_customer_if_applied=='1'&&$this->public!='1')
            {
                $this->addError($attribute, Yii::t('common', '{attribute} ambiguous.',
                        array('{attribute}'=>  $this->attributeLabels()[$attribute])));
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
                        'amzni5Languages' => array(self::MANY_MANY, 'Languages', '{{order_status_translations}}(status_code, language_code)'),
			'orderStatusTranslations' => array(self::HAS_MANY, 'OrderStatusTranslations', array('status_code'=>'status_code')),
                        'orders' => array(self::HAS_MANY, 'Orders', 'order_status'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status_code' => Yii::t('common', 'Status Code'),
                        'status_name' => Yii::t('common', 'Status Name'),
			'status_desc' => Yii::t('common', 'Status Description'),
			'published' => Yii::t('common', 'Published'),
			'public' => Yii::t('common', 'Public'),
			'notify_customer_if_applied' => Yii::t('common', 'Notify Customer If Applied'),
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

		$criteria->compare('t.status_code',$this->status_code,true);		
		$criteria->compare('t.published',$this->published);
		$criteria->compare('t.public',$this->public);
		$criteria->compare('t.notify_customer_if_applied',$this->notify_customer_if_applied);
		$criteria->compare('t.created_on',$this->created_on,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.modified_on',$this->modified_on,true);
		$criteria->compare('t.modified_by',$this->modified_by);
		$criteria->compare('t.locked_on',$this->locked_on,true);
		$criteria->compare('t.locked_by',$this->locked_by);
                
                $criteria->with = array( 'orderStatusTranslations');
                $criteria->group = 't.status_code';
                $criteria->together = true;
                
                $criteria->compare('orderStatusTranslations.status_name',$this->status_name,true);
		$criteria->compare('orderStatusTranslations.status_desc',$this->status_desc,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'attributes'=>array(
                                'status_name'=>array(
                                    'asc'=>'orderStatusTranslations.status_name',
                                    'desc'=>'orderStatusTranslations.status_name DESC',
                                ),
                                'status_desc'=>array(
                                    'asc'=>'orderStatusTranslations.status_desc',
                                    'desc'=>'orderStatusTranslations.status_desc DESC',
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
	 * @return OrderStatuses the static model class
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
                $model = OrderStatusTranslations::model()->findByPk(array('status_code'=>$this->status_code,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='status_code=:status_code';
                $criteria->params=array(':status_code'=>$this->status_code);
                $model = OrderStatusTranslations::model()->find($criteria);
            }
            
            if($model===null)
            {
                return Yii::t('common', '*no name*');
            }
            
            return $model->status_name;
        }
        
        public static function itemAlias($type,$code=NULL) 
        {
            $_items = array(
                    'Published' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
                    'Public' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
                    'Notify Customer If Applied' => array(
                            '0' => Yii::t('yii','No'),
                            '1' => Yii::t('yii','Yes'),
                    ),
            );
            if (isset($code))
                    return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
            else
                    return isset($_items[$type]) ? $_items[$type] : false;
        }
        
        public static function listStatuses()
        {
            static $data=array();
            if(empty($data))
            {
                $data=self::model()->findAll(array('condition'=>'t.published=1'));
            }
            return $data;
        }
        
        public static function range()
        {
            static $data=array();
                        
            if(empty($data))
            {
                $statuses = self::listStatuses();
                $data = CHtml::listData($statuses,'status_code','status_code');
            }
            
            return $data;
        }

        public static function listData($statusCode=null)
        {
            static $data=array();
                        
            if(empty($data))
            {
                $statuses = self::listStatuses();
                $data = CHtml::listData($statuses,'status_code',function($status) {
                    return $status->getName();
                }, function($status) {
                    if($status->public=='1')
                    return Yii::t('common', 'Public');
                    return Yii::t('common', 'System');
                });
                array_multisort($data);
            }
            
            if(!empty($statusCode))
            {
                $statuses = self::listStatuses();
                $data = CHtml::listData($statuses,'status_code',function($status) {
                    return $status->getName();
                });
                return $data[$statusCode];
            }
            return $data;
        }
        
        public static function listPublicData()
        {
            static $data=array();
            if(empty($data))
            {
                $statuses=self::model()->findAll(array('condition'=>'t.published=1 AND t.public=1'));
                $data = CHtml::listData($statuses,'status_code',function($status) {
                        return $status->getName();
                });
                asort($data);
            }
            return $data;
        }
        
        public static function listSystemData()
        {
            static $data=array();
            if(empty($data))
            {
                $statuses=self::model()->findAll(array('condition'=>'t.published=1 AND t.public=0'));
                $data = CHtml::listData($statuses,'status_code',function($status) {
                        return $status->getName();
                });
                asort($data);
            }
            return $data;
        }
}
