<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model{

    protected $table = 'students';
    
    public function register_user($user_name,$password,$instructor_id,$user_course){
    	/*
    	$user_name = $this->db->escape($user_name);
    	$password = $this->db->escape($password);
    	$instructor_id = $this->db->escape($instructor_id);
    	$user_course = $this->db->escape($user_course);
    	*/
    	$query=$this->db->query("INSERT INTO students(student_name,student_password,instructor_id,student_course) VALUES('$user_name','$password','$instructor_id','$user_course')");
    	if($query){
    		return true;
    	}
    	else{
    		return false;
    	}
    }

    public function instructor_signup(){
    	$trainer_name = "admin";
    	$instructor_password = "$2y$10$/K.hjNr84lLNDt8fTXjoI.DBp6PpeyoJ.mGwrrLuCZfAwfSAGqhOW";
    	$query=$this->db->query("INSERT INTO instructor(instructor_name,instructor_password) VALUES('$trainer_name','$instructor_password')");
    }

    public function get_user_trainer_id($user_name){
        $query = $this->db->query("SELECT instructor_id FROM students WHERE student_name = '$user_name'");
        return mysqli_fetch_array($query);
    }

}