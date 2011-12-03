<?php

App::import('Sanitize');

class AppModel extends Model {

    function afterFind($res, $bool) {
        parent::afterFind($res, $bool);
        if (!$bool) {
            return h($res, ENT_NOQUOTES);
        } else {
            return $res;
        }
        //return $res;
        //return Sanitize::clean($res, array('encode' => true));
    }

}

?>
