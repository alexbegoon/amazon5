<?php
/**
 * Description of TilesWidget
 *
 * @author Alexander.B <alexbassmusic@gmail.com> - https://www.odesk.com/users/~01ae8f6e1a81c189cf
 */
class TilesWidget extends CWidget
{
    public $items;
    
    public function run()
    {
        $this->render('tiles', array(
            'tiles'=>$this->items   
        ));
    }
}
