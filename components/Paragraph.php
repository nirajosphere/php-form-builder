<?php 
/**
 * Class file for the paragraph/textarea input field aka long answer
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
include_once('Component.php');
class Paragraph extends Component{

	/**
	 * Constructor Function
	 * 
	 * Sets the intial values of required parameters
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function Paragraph(){
		Component::Component();
		$this->type='long_answer';
	}

	/**
	 * Function to get the MAIN section for editor template.
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
			<textarea class="form-control mt-2" rows="5" placeholder="A Long Answer" disabled></textarea>
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
			<label for="<?=$this->id?>"><?=$this->label?><?php echo $this->is_required ? '<i class="text-danger">*</i>' : '' ?></label>
			<textarea class="form-control" id="<?=$this->id?>" name="<?=$this->id?>" rows="5" <?php echo $this->is_required ? 'required' : '' ?>></textarea>
		</div>
		<?php
	}
}
?>