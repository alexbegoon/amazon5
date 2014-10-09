<?php

/**
 * This is the model class for table "{{order_status_translations}}".
 *
 * The followings are the available columns in table '{{order_status_translations}}':
 * @property string $status_code
 * @property string $language_code
 * @property string $status_name
 * @property string $status_desc
 * @property string $email_subject_template
 * @property string $email_body_template
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class OrderStatusTranslations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order_status_translations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status_code, language_code, status_name', 'required'),
			array('created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('status_code', 'length', 'max'=>2),
			array('status_code', 'match', 'pattern'=>'/^\w{2}$/'),
			array('language_code', 'length', 'max'=>5),
                        array('language_code', 'in', 'range'=>Languages::range()),
                        array('language_code', 'unique', 'criteria'=>array(
                            'condition'=>'`status_code`=:status_code',
                            'params'=>array(
                                ':status_code'=>$this->status_code
                            )
                        )),
			array('status_name', 'length', 'max'=>64, 'min'=>5),
			array('status_desc,email_subject_template', 'length', 'max'=>255),
			array('email_body_template, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status_code, email_subject_template, email_body_template, language_code, status_name, status_desc, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status_code' => Yii::t('common', 'Status Code'),
			'language_code' => Yii::t('common', 'Language Code'),
			'status_name' => Yii::t('common', 'Status Name'),
			'status_desc' => Yii::t('common', 'Status Description'),
                        'email_subject_template' => Yii::t('common', 'Email Subject Template'),
			'email_body_template' => Yii::t('common', 'Email Body Template'),
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

		$criteria->compare('status_code',$this->status_code,true);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('status_name',$this->status_name,true);
		$criteria->compare('status_desc',$this->status_desc,true);
                $criteria->compare('email_subject_template',$this->email_subject_template,true);
		$criteria->compare('email_body_template',$this->email_body_template,true);
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
	 * @return OrderStatusTranslations the static model class
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
