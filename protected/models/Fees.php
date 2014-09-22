<?php

/**
 * This is the model class for table "{{fees}}".
 *
 * The followings are the available columns in table '{{fees}}':
 * @property string $code
 * @property string $fee_type
 * @property string $fee_mode
 * @property double $percent
 * @property string $amount
 * @property integer $currency_id
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
class Fees extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{fees}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, currency_id, fee_type, fee_mode', 'required'),
			array('code', 'unique'),
			array('currency_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('percent', 'numerical', 'min'=>0, 'max'=>60),
			array('code', 'length', 'max'=>64, 'min'=>3),
			array('fee_type', 'match', 'pattern'=>'/Financial Fees|Marketplace Fees/'),
			array('fee_mode', 'match', 'pattern'=>'/Percent|Amount|Percent and Amount/'),
			array('amount', 'length', 'max'=>15),
			array('amount', 'numerical', 'min'=>0.01),
			array('created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('code, fee_type, fee_mode, percent, amount, currency_id, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'currency' => array(self::BELONGS_TO, 'Currencies', 'currency_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'code' => Yii::t('common', 'Code'),
			'fee_type' => Yii::t('common', 'Fee Type'),
			'fee_mode' => Yii::t('common', 'Fee Mode'),
			'percent' => Yii::t('common', 'Percent'),
			'amount' => Yii::t('common', 'Amount'),
			'currency_id' => Yii::t('common', 'Currency'),
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

		$criteria->compare('code',$this->code,true);
		$criteria->compare('fee_type',$this->fee_type,true);
		$criteria->compare('fee_mode',$this->fee_mode,true);
		$criteria->compare('percent',$this->percent);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('currency_id',$this->currency_id);
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
	 * @return Fees the static model class
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
