<?php

/**
 * This is the model class for table "{{provider_sync_logs}}".
 *
 * The followings are the available columns in table '{{provider_sync_logs}}':
 * @property string $id
 * @property integer $provider_id
 * @property integer $code
 * @property string $provider_product_sku
 * @property string $message
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 *
 * The followings are the available model relations:
 * @property Providers $provider
 */
class ProviderSyncLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_sync_logs}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, provider_product_sku, code, message', 'required'),
			array('provider_id, code, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('provider_product_sku', 'length', 'max'=>64),
			array('message, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, provider_id, code, provider_product_sku, message, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('common', 'ID'),
			'provider_id' => Yii::t('common', 'Provider'),
			'code' => Yii::t('common', 'Code'),
			'provider_product_sku' => Yii::t('common', 'Provider Product Sku'),
			'message' => Yii::t('common', 'Message'),
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
		$criteria->compare('provider_id',$this->provider_id);
		$criteria->compare('code',$this->code);
		$criteria->compare('provider_product_sku',$this->provider_product_sku,true);
		$criteria->compare('message',$this->message,true);
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
	 * @return ProviderSyncLogs the static model class
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
        
        /**
         * Log action
         * @param int $code 1 - product created, 2 - product updated, 3 - error
         * @param type $provider_id
         * @param type $provider_product_sku
         * @param type $message
         */
        public static function log($code, $provider_id, $provider_product_sku, $message)
        {
            $logMsg = new ProviderSyncLogs;
            $logMsg->code                   = $code;
            $logMsg->provider_id            = $provider_id;
            $logMsg->provider_product_sku   = $provider_product_sku;
            $logMsg->message                = $message;
            
            $logMsg->save();
        }
}
