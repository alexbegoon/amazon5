<?php

/**
 * This is the model class for table "{{transactions}}".
 *
 * The followings are the available columns in table '{{transactions}}':
 * @property string $id
 * @property string $outer_id
 * @property string $order_id
 * @property integer $payment_method_id
 * @property string $request
 * @property string $response
 * @property string $verification
 * @property integer $canceled
 * @property string $canceled_on
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property PaymentMethods $paymentMethod
 */
class Transactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{transactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, order_id, payment_method_id', 'required'),
			array('payment_method_id, canceled, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('id, order_id', 'length', 'max'=>10),
			array('outer_id', 'length', 'max'=>255),
			array('request, response, verification, canceled_on, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, outer_id, order_id, payment_method_id, request, response, verification, canceled, canceled_on, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethods', 'payment_method_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'outer_id' => Yii::t('common', 'Outer'),
			'order_id' => Yii::t('common', 'Order'),
			'payment_method_id' => Yii::t('common', 'Payment Method'),
			'request' => Yii::t('common', 'Request'),
			'response' => Yii::t('common', 'Response'),
			'verification' => Yii::t('common', 'Verification'),
			'canceled' => Yii::t('common', 'Canceled'),
			'canceled_on' => Yii::t('common', 'Canceled On'),
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
		$criteria->compare('outer_id',$this->outer_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('payment_method_id',$this->payment_method_id);
		$criteria->compare('request',$this->request,true);
		$criteria->compare('response',$this->response,true);
		$criteria->compare('verification',$this->verification,true);
		$criteria->compare('canceled',$this->canceled);
		$criteria->compare('canceled_on',$this->canceled_on,true);
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
	 * @return Transactions the static model class
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
