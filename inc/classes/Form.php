<?php
/**
 * A class file that holds the class for Form Object
 */
class Form{
	/**
	 * Constructor
	 * 
	 * Recieves the id attribute and initializes the parameters and if the form does not exists, it will create a new record for the same
	 * 
	 * @param 12-character string holding the form id
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function Form($id){
		global $conn;
		$default_title='Untitled Form';
		$get_form_object=$conn->prepare('SELECT * from form where id=?');
		$get_form_object->bind_param('s',$id);
		$get_form_object->execute();
		$result=$get_form_object->get_result();
		if($result->num_rows>0){
			$current_form=(object)$result->fetch_assoc();
			$this->id=$id;
			$this->title=$current_form->title;
			$this->description=$current_form->description;
			$this->username=$current_form->username;
			$this->form_obj=(array)json_decode($current_form->form_object);
			$this->status=$current_form->status;	
		}
		else{
			$username=$_SESSION['username'];
			$insert_form_object=$conn->prepare('INSERT IGNORE INTO `form`(`id`, `username`, `title`) VALUES (?,?,?)');
			$insert_form_object->bind_param('sss',$id,$username,$default_title);
			$insert_form_object->execute();	
			$this->id=$id;
			$this->title=$default_title;
			$this->username=$username;
			$this->description='';
			$this->form_obj='';
			$this->status='inactive';
		}	
	}
	/**
	 * function to get id of the form
	 * 
	 * @return 12-character string holding the form id
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_id(){
		return $this->id;
	}

	/**
	 * function to get the title of the form
	 * 
	 * @return string Title of the form
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_title(){
		return $this->title;
	}

	/**
	 * function to update the form details in the database
	 * 
	 * @param $form_object - The array of form data
	 * 
	 * @return boolean true if object updated successfully, false if not.
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function update_form_object($form_object){
		global $conn;
		$title=$form_object['title'];
		unset($form_object['title']);

		$description=$form_object['description'];
		unset($form_object['description']);

		if(isset($form_object['accept_responses'])){
			if($form_object['accept_responses']=='on'){
				$status='active';
			}
			else{
				$status='inactive';
			}
			unset($form_object['accept_responses']);
		}
		else{
			$status='inactive';
		}
		$form_json=json_encode($form_object);
		$update_form_sql=$conn->prepare('UPDATE form SET title=?,description=?,form_object=?,status=? where id=?');
		$update_form_sql->bind_param('sssss',$title,$description,$form_json,$status,$this->id);
		if($update_form_sql->execute()){
			$this->title=$title;
			$this->form_obj=$form_object;
			$this->description=$description;
			$this->status=$status;
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * function to retrive the labels of the form
	 * 
	 * @return array of labels where key is unique id and value is label
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_labels(){
		$labels=array();
		foreach ($this->form_obj as $key => $value) {
			$labels[$key]=$value->label;
		}
		return $labels;
	}
	/**
	 * function to retrive the number of responses from database
	 * 
	 * @return integer number of total responses
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_responses_count(){
		global $conn;
		$responses_query=$conn->prepare('SELECT * from response where form_id = ? order by `timestamp` asc');
		$responses_query->bind_param('s',$this->id);
		$responses_query->execute();
		$results=$responses_query->get_result();
		return $results->num_rows;
	}

	/**
	 * function to retrive a single response from database
	 * 
	 * @return string Title of the form
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_response($response_id=1){
		global $conn;
		$id_query=$response_id-1;
		$responses_query=$conn->prepare('SELECT * from response where form_id = ? order by `timestamp` asc LIMIT ?,1');
		$responses_query->bind_param('si',$this->id,$id_query);
		$responses_query->execute();
		$results=$responses_query->get_result();
		$response=array();
		$labels=$this->get_labels();
		while($row=$results->fetch_assoc()){
			$row['response']=(array)json_decode($row['response']);
			$new_responses=array();
			foreach($row['response'] as $key => $val){
				if(isset($labels[$key])){
					$key=$labels[$key];
					$new_responses[$key]=$val;
				}
			}
			$row['response']=$new_responses;

			$row['has_prev']= $response_id==1 ? false : true ;
			$row['prev_id'] = $row['has_prev'] ? $response_id-1 : false ;
			$row['has_next'] = $response_id==$this->get_responses_count() ? false : true;
			$row['next_id'] = $row['has_next'] ? $response_id+1 : false ;

			$response=(object)$row;
		}
		return $response;
	}
}
?>