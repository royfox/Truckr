<?php
class UploadsController extends AppController {

    public function view ($type = null, $dir = null, $file = null) {

        if(!$type || !$dir || !$file){
            throw new NotFoundException();
        }

        $file_path = APP. 'uploads'. DS . $type . DS . $dir . DS. $file;

        $extension =  pathinfo($file_path, PATHINFO_EXTENSION);

        if(!file_exists($file_path)){
            throw new NotFoundException();
        }

        $this->viewClass = 'Media';

        $params = array(
            'id'        => $file,
            'download'  => false,
            'extension' => $extension,
            'path'      => 'uploads'. DS . $type . DS . $dir . DS
        );

        $this->set($params);
    }

    public function post($dir, $file){
        $this->redirect(array("action"=>"view", "post", $dir, $file));
    }
}