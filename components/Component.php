<?php
/**
 * Class file for the basic input field aka short answer
 * 
 * @since 1.0.0
 * @author Niraj Gohel
 */
class Component{
	/**
	 * Constructor Function
	 * 
	 * Sets the intial values of required parameters
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function Component(){
		$this->id=randomString();
		$this->type='short_answer';
		$this->label='';
		$this->is_required=false;
	}

	/**
	 * Initializer
	 * 
	 * Sets the values of parameters in case of customization required
	 * 
	 * @param $args - Array of values containing id,label,is_required and options
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function initialize($args){
		$args=(object)$args;
		$this->id= isset($args->id) ? $args->id : $this->id;
		$this->label=isset($args->label) ? $args->label : $this->label;
		$this->is_required=isset($args->is_required)? $args->is_required : $this->is_required;	
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
			<input type="text" class="form-control mt-2" placeholder="A short answer" disabled>
		</div>
		<?php
	}

	/**
	 * Function to get the FULL section for editor template.
	 * 
	 * @uses get_edit_main()
	 * @uses get_component_options()
	 * 
	 * @since 1.0.0
	 * @author Niraj Gohel
	 */
	function get_edit_template(){
		?>
		<div class="component" data-id="<?=$this->id?>">
			<div class="handle">..<br>..<br>..</div>
			<div class="row component-header">
				<div class="col-4">
					<select name="<?=$this->id?>[type]" id="<?=$this->id?>_type" class="form-control form-control-sm component-type selectpicker-dense">
						<?php get_component_options($this->type); ?>
					</select>
				</div>
				<div class="col-3 offset-5 text-right">
					<div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="<?=$this->id?>_is_required" name="<?=$this->id?>[is_required]"
						<?php if($this->is_required){echo 'checked'; } ?>>
						<label class="custom-control-label" for="<?=$this->id?>_is_required">Required</label>
					</div>
				</div>
			</div>
			<?php $this->get_edit_main(); ?>
			<div class="row pt-3 component-footer">
				<div class="col-12 text-right text-muted">
					<span class="delete-control"><i class="fas fa-trash"></i></span>
				</div>
			</div>
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
			<input type="text" class="form-control" id="<?=$this->id?>" name="<?=$this->id?>"
			<?php echo $this->is_required ? 'required' : '' ?>
			>
		</div>
		<?php
	}
}

?>