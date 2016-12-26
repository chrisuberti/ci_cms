<?php defined('BASEPATH') OR exit('No direct script access allowed');
 /**
  * 
  */
 class Blog_model extends MY_Model
 {
     function add_new_entry($name, $body){
         $data = array(
             'entry_name' => $name,
             'entry_body' => $body,
             'pub_date' => date('Y-m-d')
             );
        $this->db->insert('entry', $data);
     }
 }