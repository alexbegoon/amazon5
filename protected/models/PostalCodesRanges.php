<?php

/**
 * This is the model class for table "{{postal_codes_ranges}}".
 *
 * The followings are the available columns in table '{{postal_codes_ranges}}':
 * @property integer $id
 * @property string $range_name
 * @property string $country_code
 * @property integer $postal_code_from
 * @property integer $postal_code_to
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Countries $countryCode
 * @property ShippingCosts[] $shippingCosts
 */
class PostalCodesRanges extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{postal_codes_ranges}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_code, postal_code_from, postal_code_to', 'required'),
			array('postal_code_from, postal_code_to, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
                        array('postal_code_from, postal_code_to','numerical','min'=>0),
                        array('postal_code_from, postal_code_to','validateRange'),
			array('range_name', 'length', 'max'=>255, 'min'=>3),
			array('country_code', 'length', 'max'=>2),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, range_name, country_code, postal_code_from, postal_code_to, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
		);
	}
        
        public function validateRange($attribute,$params)
        {
            if($this->postal_code_from>=$this->postal_code_to)
            {
                $this->addError($attribute, Yii::t('common', 
                '{attribute} malformed', 
                array('{attribute}'=>$this->attributeLabels()[$attribute])));
                
                return FALSE;
            }
            
            $criteria = new CDbCriteria;
            $criteria->condition=':postal_code_from<=postal_code_to AND :postal_code_to>=postal_code_from AND country_code=:country_code';
            $criteria->params=array(
                ':postal_code_from'=>$this->postal_code_from,
                ':postal_code_to'=>$this->postal_code_to,
                ':country_code'=>$this->country_code,
            );
            
            if(self::model()->exists($criteria))
            {
                $this->addError($attribute, Yii::t('common', 
                'Overlap the existing postal codes'));
                
                return FALSE;
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
			'country' => array(self::BELONGS_TO, 'Countries', 'country_code'),
			'shippingCosts' => array(self::HAS_MANY, 'ShippingCosts', 'postal_codes_range_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'range_name' => Yii::t('common', 'Range Name'),
			'country_code' => Yii::t('common', 'Country'),
			'postal_code_from' => Yii::t('common', 'Postal Code From'),
			'postal_code_to' => Yii::t('common', 'Postal Code To'),
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
		$criteria->compare('range_name',$this->range_name,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('postal_code_from',$this->postal_code_from);
		$criteria->compare('postal_code_to',$this->postal_code_to);
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
	 * @return PostalCodesRanges the static model class
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
        
        public function afterValidate()
        {
            if( empty($this->range_name) && 
                    !empty($this->country_code) && 
                    !empty($this->postal_code_from) && 
                    !empty($this->postal_code_to) )
            {
                $this->range_name = Countries::listData($this->country_code) .' ('
                        . $this->postal_code_from . ' - ' . $this->postal_code_to . ')';
            }
            return parent::afterValidate();
        }
        
        public static function listRanges()
        {
            static $data=array();
            if(empty($data))
            {
                $data=self::model()->with('country')->findAll(array('order'=>'t.range_name, country.name','condition'=>'t.id!=0'));
            }
            return $data;
        }
        
        public static function listData($rangeId=null)
        {
            static $data=array();
                   
            if($rangeId==='0')
            {
                return Yii::t('common', 'All postal codes');
            }
            
            if(empty($data))
            {
                $ranges = self::listRanges();
                $data[0] = Yii::t('common', 'All postal codes');
                $data = array_merge($data,CHtml::listData($ranges,'id',function($range) {
                    return $range->range_name;
                }, 'country.name'));
            }
            
            if(!empty($rangeId))
            {
                $ranges = self::listRanges();
                $data[0] = Yii::t('common', 'All postal codes');
                $data = array_merge($data,CHtml::listData($ranges,'id',function($range) {
                    return $range->range_name;
                }));
                return $data[$rangeId];
            }
            return $data;
        }
}
