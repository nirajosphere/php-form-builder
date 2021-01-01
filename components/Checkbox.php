<?php 
/**
 * Class file for the checkbox input field
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */

include_once('Component.php');
class Checkbox extends Component{

	/**
	 * Overriding Constructor Function
	 * 
	 * Sets the intial values of required parameters
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function Checkbox(){
		Component::Component();
		$this->type='checkboxes';
		$this->options=array();
	}

	/**
	 * Overriding Initialize Function
	 * 
	 * Sets the intial values of required parameters
	 * 
	 * @param args - array of arguments containing id,type,is_required and options
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function initialize($args){
		$args=(object)$args;
		Component::initialize($args);
		$this->options = isset($args->options) ? $args->options : $this->options;	
	}

	/**
	 * Function to get the MAIN section for editor template.
	 * 
	 * @uses get_edit_checkboxes
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_edit_main(){
		?>
		<div class="component-main pt-3">
			<input type="text" class="form-control main-label" name="<?=$this->id?>[label]" id="<?=$this->id?>_label" placeholder="Question"
			<?php if($this->label!=''){echo 'value="'.$this->label.'"';} ?>
			required>
			<div class="checkboxes-wrapper">
				<?php 
				foreach ($this->options as $key => $value) {
					$single_option_object=(object)array();
					$single_option_object->id=$key;
					$single_option_object->label=$value->label;
					$this->get_edit_checkboxes($single_option_object);	
				}
				if(count((array)$this->options)<=0){ 
					$this->get_edit_checkboxes();
				}
				?>
			</div>
			<div class="d-flex align-items-center my-2 w-100">
				<div class="mr-2 opacity-0">
					<i class="far fa-circle"></i>
				</div>
				<button class="add-checkbox w-50">
					<i class="fas fa-plus"></i>
				</button>
			</div>
		</div>
		<?php
	}


	/**
	 * function to generate the single option block in the editor
	 * 
	 * @param new_checkbox_obj - Object of the radio option contains id and label
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_edit_checkboxes($new_checkbox_obj=''){
		if($new_checkbox_obj==''){
			$new_radio_id = randomString();
		}
		else{
			$new_radio_id = $new_checkbox_obj->id;
		}
		?>
		<div class="d-flex align-items-center my-2 w-100 checkbox-option">
			<div class="mr-2">
				<i class="far fa-square"></i>
			</div>
			<div class="w-50">
				<input type="text" class="form-control form-control-sm" name="<?=$this->id?>[options][<?=$new_radio_id?>][label]" placeholder="Option"
				<?php echo isset($new_checkbox_obj->label)?'value='.$new_checkbox_obj->label : ''?>
				required>
			</div>
			<button class="ml-2 cursor-pointer btn p-0 delete-checkbox-option">
				<i class="fas fa-times fa-sm"></i>
			</button>
		</div>
		<?php
	}


	/**
	 * Function to get the section for submit template.
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_view_template(){
		?>
		<div class="form-group validator">
			<div class="mb-1"><?=$this->label?><?php echo $this->is_required ? '<i class="text-danger">*</i>' : '' ?></div>
			<?php
			foreach ($this->options as $key => $value) {
				?>
				<div class="custom-control custom-checkbox w-100">
					<input type="checkbox" id="<?=$key.'_'.$value->label?>" name="<?=$this->id?>" value="<?=$value->label?>" class="custom-control-input" <?= $this->is_required==true ? 'required' : '' ?> >
					<label class="custom-control-label w-100" for="<?=$key.'_'.$value->label?>"><?=$value->label?></label>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}
}
?>