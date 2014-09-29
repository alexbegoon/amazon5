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
            'schema'=>'html5',
            'language'=>Yii::app()->language,
            'entity_encoding'=>'raw',
            'height'=>200,
            'plugins'=>array("advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "template paste textcolor"),
            'toolbar1'=>"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor",
            'image_advtab'=>true,
            'browser_spellcheck'=>true,
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
