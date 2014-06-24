<?php

/**
 * This is the model class for table "{{manufacturer_translations}}".
 *
 * The followings are the available columns in table '{{manufacturer_translations}}':
 * @property integer $manufacturer_id
 * @property string $language_code
 * @property string $manufacturer_name
 * @property string $manufacturer_email
 * @property string $manufacturer_desc
 * @property string $manufacturer_url
 * @property string $slug
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class ManufacturerTranslations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{manufacturer_translations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('manufacturer_id, language_code, manufacturer_name', 'required'),
			array('manufacturer_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
			array('language_code', 'length', 'max'=>5),
			array('manufacturer_email', 'email'),
			array('manufacturer_name, manufacturer_email, manufacturer_url, slug', 'length', 'max'=>255),
			array('manufacturer_desc, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('manufacturer_id, language_code, manufacturer_name, manufacturer_email, manufacturer_desc, manufacturer_url, slug, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'manufacturer_id' => Yii::t('manufacturers', 'Manufacturer ID'),
			'language_code' => Yii::t('manufacturers', 'Language Code'),
			'manufacturer_name' => Yii::t('manufacturers', 'Manufacturer Name'),
			'manufacturer_email' => Yii::t('manufacturers', 'Manufacturer Email'),
			'manufacturer_desc' => Yii::t('manufacturers', 'Manufacturer Desc'),
			'manufacturer_url' => Yii::t('manufacturers', 'Manufacturer Url'),
			'slug' => Yii::t('manufacturers', 'Slug'),
			'created_on' => Yii::t('manufacturers', 'Created On'),
			'created_by' => Yii::t('manufacturers', 'Created By'),
			'modified_on' => Yii::t('manufacturers', 'Modified On'),
			'modified_by' => Yii::t('manufacturers', 'Modified By'),
			'locked_on' => Yii::t('manufacturers', 'Locked On'),
			'locked_by' => Yii::t('manufacturers', 'Locked By'),
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

		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('manufacturer_name',$this->manufacturer_name,true);
		$criteria->compare('manufacturer_email',$this->manufacturer_email,true);
		$criteria->compare('manufacturer_desc',$this->manufacturer_desc,true);
		$criteria->compare('manufacturer_url',$this->manufacturer_url,true);
		$criteria->compare('slug',$this->slug,true);
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
	 * @return ManufacturerTranslations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
//        protected function beforeSave() 
//        {
//            if ($this->isNewRecord)
//            {
//                $this->created_on = new CDbExpression('NOW()');
//                $this->created_by = Yii::app()->user->getId();
//            }
//            
//            $this->modified_on = new CDbExpression('NOW()');
//            $this->modified_by = Yii::app()->user->getId();    
//            
//            $this->locked_by = 0;
//            $this->locked_on = null;
//
//            return parent::beforeSave();
//        }
//        
//        protected function beforeValidate()
//        {
//            if(!parent::beforeValidate())
//            {
//                return FALSE;
//            }
//            
//            if((int)Yii::app()->user->getId() === (int)$this->locked_by)
//            {                
//                return true;
//            }
//            
//            if((int)$this->locked_by === 0 || $this->locked_on < date('Y-m-d H:i:s', time() - 3 * 60 * 60))
//            {                
//                return true;
//            }
//            
//            $username = Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('firstname') ." ". Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('lastname');
//            $this->addError('locked_by_user','You can not edit this. Record locked by '.$username.'.');
//            return FALSE;
//        }
//        
//        protected function beforeDelete() 
//        {
//            if((int)$this->locked_by === (int)Yii::app()->user->getId())
//            {
//                return true;
//            }    
//            
//            if ((int)$this->locked_by !== 0)
//            {
//                $username = Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('firstname') ." ". Yii::app()->getModule('user')->user($this->locked_by)->profile->getAttribute('lastname');
//                $this->addError('locked_by_user','You can not delete this. Record locked by '.$username.'.');
//                return FALSE;
//            }
//
//            return parent::beforeDelete();
//        }
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
}
