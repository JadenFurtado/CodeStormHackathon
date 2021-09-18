<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model{

    protected $table = 'students';

    public function log_user_signin($user_id,$session_id){
    	$user_id = $this->escape();
    	if($session_id==$_COOKIE['filemanager']){
    		$query="INSERT INTO login_history(student_id,session_id) VALUES('$user_id','$session_id')";
    		
    	}
    }
   
}