<?php

/**
 * This is the model class for table "{{category_translations}}".
 *
 * The followings are the available columns in table '{{category_translations}}':
 * @property string $category_id
 * @property string $language_code
 * @property string $category_name
 * @property string $category_s_desc
 * @property string $category_desc
 * @property string $meta_desc
 * @property string $meta_keywords
 * @property string $custom_title
 * @property string $slug
 * @property string $created_on
 * @property integer $created_by
 * @property string $modified_on
 * @property integer $modified_by
 * @property string $locked_on
 * @property integer $locked_by
 */
class CategoryTranslations extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category_translations}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, language_code, category_name', 'required'),
			array('created_by, modified_by, locked_by', 'numerical', 'integerOnly'=>true),
                        array('language_code', 'unique', 'criteria'=>array(
                            'condition'=>'`category_id`=:category_id',
                            'params'=>array(
                                ':category_id'=>$this->category_id
                            )
                        )),
			array('category_id', 'length', 'max'=>11),
			array('language_code', 'length', 'max'=>5),
                        array('language_code', 'in', 'range'=>Languages::range()),
			array('category_name, slug', 'length', 'min'=>4),
			array('slug', 'unique', 'allowEmpty'=>false),
			array('category_name, category_s_desc, meta_desc, meta_keywords, custom_title, slug', 'length', 'max'=>255),
			array('category_desc, created_on, modified_on, locked_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('category_id, language_code, category_name, category_s_desc, category_desc, meta_desc, meta_keywords, custom_title, slug, created_on, created_by, modified_on, modified_by, locked_on, locked_by', 'safe', 'on'=>'search'),
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
			'category_id' => Yii::t('common', 'Category'),
			'language_code' => Yii::t('common', 'Language Code'),
			'category_name' => Yii::t('common', 'Category Name'),
			'category_s_desc' => Yii::t('common', 'Category Short Description'),
			'category_desc' => Yii::t('common', 'Category Description'),
			'meta_desc' => Yii::t('common', 'Meta Description'),
			'meta_keywords' => Yii::t('common', 'Meta Keywords'),
			'custom_title' => Yii::t('common', 'Custom Title'),
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

		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('language_code',$this->language_code,true);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('category_s_desc',$this->category_s_desc,true);
		$criteria->compare('category_desc',$this->category_desc,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('custom_title',$this->custom_title,true);
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
	 * @return CategoryTranslations the static model class
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
        
        public function beforeValidate()
        {
            if(!empty($this->category_name) && empty($this->slug))
            {
                $this->slug = url_slug($this->category_name);
            }
            else 
            {
                $this->slug = url_slug($this->slug);
            }
            
            return parent::beforeValidate();
        }
        
        public function afterDelete() {
            parent::afterDelete();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
        
        public function afterSave() {
            parent::afterSave();
            
            Yii::app()->setGlobalState('CategoryTreeVersion', date(DATE_W3C));
        }
}
