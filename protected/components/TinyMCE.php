<?php
/**
 * TinyMCE is a platform independent web based Javascript 
 * HTML WYSIWYG editor control released as Open Source under LGPL. 
 * TinyMCE has the ability to convert HTML TEXTAREA fields 
 * or other HTML elements to editor instances.
 * 
 * This widget is a wrapper for TinyMCE.
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 * @link http://www.tinymce.com/wiki.php/Configuration Configuration
 * @link http://www.tinymce.com/index.php About
 */
class TinyMCE extends CWidget 
{
    public $options;
    
    public function run()
    {
        // Defaults
        $this->options = array(
            'selector'=>'textarea',
            'language'=>Yii::app()->language,
            'entity_encoding'=>'raw',
            'height'=>200,
        );
        
        $baseUrl = Yii::app()->baseUrl;
        $tinymceOptions = '';
        $cs = Yii::app()->getClientScript();  
        $cs->registerScriptFile($baseUrl.'/js/tinymce/tinymce.min.js');
        if(empty($this->options))
            return FALSE;
        
        $tinymceOptions=CJavaScript::encode($this->options);
        $cs->registerScript("_init_TinyMCE","tinymce.init($tinymceOptions);");
    }
}
