<?php

/**
 * This is the model class for table "{{manufacturer_translations}}".
 *
 * The followings are the available columns in table '{{manufacturer_translations}}':
 * @property integer $manufacturer_id
 * @property string $language_code
 * @property string $manufacturer_name
 * @property string $manufacturer_desc
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
                        array('language_code', 'unique', 'criteria'=>array(
                            'condition'=>'`manufacturer_id`=:manufacturer_id',
                            'params'=>array(
                                ':manufacturer_id'=>$this->manufacturer_id
                            )
                        )),
			array('manufacturer_id, created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
                        array('slug','unique','allowEmpty'=>false),
			array('language_code', 'length', 'max'=>5),
                        array('language_code', 'in', 'range'=>Languages::range()),
			array('manufacturer_name, slug', 'length', 'max'=>255),
			array('manufacturer_desc, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('manufacturer_id, language_code, manufacturer_name, manufacturer_desc, slug, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
                    'manufacturer' => array(self::HAS_ONE, 'Manufacturers', 'id'),
                    'language' => array(self::HAS_ONE, 'Languages', array('lang_code'=>'language_code')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'manufacturer_id' => Yii::t('common', 'Manufacturer ID'),
			'language_code' => Yii::t('common', 'Language Code'),
			'manufacturer_name' => Yii::t('common', 'Manufacturer Name'),
			'manufacturer_desc' => Yii::t('common', 'Manufacturer Desc'),
			'slug' => Yii::t('common', 'Slug'),
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

		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('manufacturer_name',$this->manufacturer_name,true);
		$criteria->compare('manufacturer_desc',$this->manufacturer_desc,true);
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
        
        /**
         * Return available translation.
         * Firstly system check user language.
         * @param type $id
         */
        public function getTranslation($id)
        {
            $model = null;
            if(Yii::app()->user->hasState('applicationLanguage'))
            {
                $currentLang = Yii::app()->user->getState('applicationLanguage');
                
                $model = $this->findByPk(array('manufacturer_id'=>$id,'language_code'=>$currentLang));
            }
            
            if($model===null)
            {
                $criteria = new CDbCriteria;
                $criteria->condition='manufacturer_id=:manufacturer_id';
                $criteria->params=array(':manufacturer_id'=>$id);
                $model = $this->find($criteria);
            }
            
            if($model===null)
            {
                throw new CHttpException(500,'Model hasn\'t any translations');
            }
            
            return $model;
        }
        
        public function behaviors()
        {
          return array( 'CBuyinArBehavior' => array(
                'class' => 'application.vendor.alexbassmusic.CBuyinArBehavior', 
              ));
        }
        
        public function beforeValidate()
        {
            if(!empty($this->manufacturer_name) && empty($this->slug))
            {
                $this->slug = url_slug($this->manufacturer_name);
            }
            else 
            {
                $this->slug = url_slug($this->slug);
            }
            
            return parent::beforeValidate();
        }
        
        public function afterDelete() {
            parent::afterDelete();
            
            Yii::app()->setGlobalState('ManufacturersList', date(DATE_W3C));
        }
        
        public function afterSave() {
            parent::afterSave();
            
            Yii::app()->setGlobalState('ManufacturersList', date(DATE_W3C));
        }
}
