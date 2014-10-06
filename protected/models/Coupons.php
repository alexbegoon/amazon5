<?php

/**
 * This is the model class for table "{{coupons}}".
 *
 * The followings are the available columns in table '{{coupons}}':
 * @property string $id
 * @property string $coupon_code
 * @property string $percent_or_total
 * @property string $coupon_type
 * @property integer $currency_id
 * @property string $coupon_value
 * @property string $coupon_start_date
 * @property string $coupon_expiry_date
 * @property string $coupon_value_valid
 * @property integer $published
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Currencies $currency
 */
class Coupons extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{coupons}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('currency_id,coupon_code,percent_or_total,coupon_type,coupon_value', 'required'),
			array('currency_id, published, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('coupon_code', 'unique'),
			array('published', 'boolean'),
			array('coupon_code', 'length', 'max'=>32, 'min'=>3),
			array('percent_or_total', 'length', 'max'=>7),
			array('percent_or_total', 'match', 'pattern'=>'/^percent$|^total$/'),
			array('coupon_type', 'length', 'max'=>9),
			array('coupon_type', 'match', 'pattern'=>'/^gift$|^permanent$/'),
			array('coupon_value, coupon_value_valid', 'length', 'max'=>15),
			array('coupon_value, coupon_value_valid', 'numerical'),
			array('coupon_start_date, coupon_expiry_date', 'validateDates'),
			array('coupon_start_date, coupon_expiry_date', 'date', 'allowEmpty'=>true, 'format'=>array('yyyy-MM-dd HH:mm:ss','yyyy-MM-dd','0000-00-00 00:00:00')),
			array('coupon_start_date, coupon_expiry_date, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, coupon_code, percent_or_total, coupon_type, currency_id, coupon_value, coupon_start_date, coupon_expiry_date, coupon_value_valid, published, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateDates($attribute,$params)
        {
            if($this->coupon_start_date=='0000-00-00 00:00:00'&&
               $this->coupon_expiry_date=='0000-00-00 00:00:00')
                return true;
                
            if(!empty($this->coupon_start_date)&&!empty($this->coupon_expiry_date))
                if($this->coupon_start_date>=$this->coupon_expiry_date)
                {
                    $this->addError($attribute, 
                            Yii::t('common', Yii::t('common', '{attribute1} must be greater than {attribute2}',
                                array('{attribute2}'=>$this->attributeLabels()['coupon_start_date'],
                                      '{attribute1}'=>$this->attributeLabels()['coupon_expiry_date']))
                            ));
                    return false;
                }
            
            return true;
        }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'coupon_code' => Yii::t('common', 'Coupon Code'),
			'percent_or_total' => Yii::t('common', 'Percent Or Total'),
			'coupon_type' => Yii::t('common', 'Coupon Type'),
			'currency_id' => Yii::t('common', 'Currency'),
			'coupon_value' => Yii::t('common', 'Coupon Value'),
			'coupon_start_date' => Yii::t('common', 'Coupon Start Date'),
			'coupon_expiry_date' => Yii::t('common', 'Coupon Expiry Date'),
			'coupon_value_valid' => Yii::t('common', 'Coupon Value Valid'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('coupon_code',$this->coupon_code,true);
		$criteria->compare('percent_or_total',$this->percent_or_total,true);
		$criteria->compare('coupon_type',$this->coupon_type,true);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('coupon_value',$this->coupon_value,true);
		$criteria->compare('coupon_start_date',$this->coupon_start_date,true);
		$criteria->compare('coupon_expiry_date',$this->coupon_expiry_date,true);
		$criteria->compare('coupon_value_valid',$this->coupon_value_valid,true);
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
	 * @return Coupons the static model class
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
}
