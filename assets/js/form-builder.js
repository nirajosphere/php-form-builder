/**
 *	The main jquery file which contains the main js/jquery functions to be used by the application
 *
 * @since 1.0.0
 * @author Niraj Gohel
 */
 $(function(){

 	/**
 	 * Initializing selectpickers for dropdowns
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel
 	 */
 	 function initSelectPickers(){
 	 	$('select').each(function(){
 	 		$(this).selectpicker();
 	 	});
 	 }
 	 initSelectPickers();

 	/**
 	 * A function to generate random string of length 12 chars using javascript
 	 *
 	 * TODO : Remove if not needed
 	 *
 	 * @return result - 12 char long string
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel
 	 */
 	 function randomString() {
 	 	var result           = '';
 	 	var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 	 	var charactersLength = characters.length;
 	 	for ( var i = 0; i < 12; i++ ) {
 	 		result += characters.charAt(Math.floor(Math.random() * charactersLength));
 	 	}
 	 	return result;
 	 }

 	/**
 	 *	Defining the current form id which will then be used across the whole page
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel
 	 */
 	 var currentFormID='';

 	/**
 	 * Disbaling the right click menu for generating the custom menu
 	 * 
 	 * TODO : Remove if not needed
 	 * 
 	 * @since 1.0.0
 	 * @author Niraj Gohel
 	 */
 	 $(document).contextmenu(function(e){
 	 	e.preventDefault();
 	 });

 	/**
 	 * A function to generate custom right click menu.
 	 * 
 	 * @param e - js event object
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel
 	 */
 	 $('.form-thumb').contextmenu(function(e){
 	 	e.preventDefault();
 	 	$('.form-thumb:not([data-id="'+$(this).data('id')+'"])').removeClass('selected');
 	 	$(this).addClass('selected');
 	 	currentFormID=$(this).data('id');
 	 	$("#contextMenu").css("left",e.pageX);
 	 	$("#contextMenu").css("top",e.pageY);
 	 	$("#contextMenu").fadeIn(200,function(){
 	 		$(document).on("click",function(){
 	 			$("#contextMenu").hide();        
 	 			$(document).off("click");
 	 		});		
 	 	});  
 	 });

 	/**
 	 * Removing selection from all other elements when a form thumbnail is selected
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('.form-listing').on('click',function(e){
 	 	currentFormID='';
 	 	$('.form-thumb').removeClass('selected');	
 	 });

 	/**
 	 * Selecting a form thumbnail on home screen
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('.form-thumb').on('click',function(e){
 	 	e.stopPropagation();
 	 	currentFormID=$(this).data('id');
 	 	$('.form-thumb:not([data-id="'+$(this).data('id')+'"])').removeClass('selected');
 	 	$(this).toggleClass('selected');
 	 });

 	/**
 	 * Redirect to edit template on double clicking a form
 	 *
 	 * @param e - js event object
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('.form-thumb').on('dblclick',function(e){
 	 	window.location.href=window.application_url+/form/+$(this).data('id')+'/edit';
 	 });

 	/**
 	 * Redirect to edit template from right click menu on a form thumbnail
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('#edit-form-right-click').on('click contextmenu',function(){
 	 	window.location.href=window.application_url+/form/+currentFormID+'/edit';
 	 });

 	/**
 	 * Redirect to responses template from right click menu on a form thumbnail
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('#view-responses-right-click').on('click contextmenu',function(){
 	 	window.location.href=window.application_url+/form/+currentFormID+'/responses';
 	 });

 	/**
 	 * Opening a popup to generate the link of public url for a form
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('#get-link-right-click').on('click contextmenu',function(){
 	 	var link=window.application_url+'/form/'+currentFormID+'/submit';
 	 	$('#shareLinkInput').val(link).focus().select();
 	 	$('#shareLinkModal').modal('show');
 	 });

 	/**
 	 * Copy link to clipboard when copy button is clicked in the popup
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('#copyShareLink').on('click',function(){
 	 	$('#shareLinkInput').focus().select();
 	 	document.execCommand('copy');
 	 });

 	/**
 	 * Making edit blocks sortable
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('.components').sortable({
 	 	handle: ".handle",
 	 });

 	/**
 	 * Appending a new component block in edit template when user clicks on plus icon
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('.add-component').on('click',function(){
 	 	$.ajax({
 	 		url:ajax_url,
 	 		data:{
 	 			action:'get_edit_template',
 	 		},
 	 		type:'post',
 	 		success:function(response){
 	 			$('.components').append(response);
 	 			$('select').each(function(){
 	 				$(this).selectpicker();
 	 			});
 	 		},
 	 		error:function(status){
 	 			console.log(status);
 	 		}
 	 	});
 	 });

 	/**
 	 * Saving a form in the database
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('#formConfig').on('submit',function(e){
 	 	var form_config=$(this);
 	 	e.preventDefault();
 	 	$.ajax({
 	 		url:ajax_url,
 	 		data:{
 	 			action:'save_form',
 	 			id:window.currentForm,
 	 			form:form_config.serialize(),
 	 		},
 	 		type:'post',
 	 		success:function(response){
 	 			window.location.href=application_url;
 	 		},
 	 		error:function(status){
 	 			console.log(status);
 	 		}
 	 	})
 	 });

 	/**
 	 * Deleting a editor block for a single component
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('body').on('click','.delete-control',function(){
 	 	var el=$(this);
 	 	el.closest('.component').fadeOut(300).remove();
 	 });

 	/**
 	 * Validation for editor block
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('body').on('focusout','.main-label',function(){
 	 	if(! $(this).val() ){
 	 		$(this).closest('.component').addClass('is-invalid');
 	 	}
 	 	else{
 	 		$(this).closest('.component').removeClass('is-invalid');
 	 	}	
 	 });

 	/**
 	 * Validation for editor block
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */ 
 	 $('body').on('click','.add-radio',function(){
 	 	var el=$(this);
 	 	var component_id=el.closest('.component').data('id');
 	 	$.ajax({
 	 		url:ajax_url,
 	 		data:{
 	 			action:'add_radio_option',
 	 			component_id:component_id,
 	 		},
 	 		type:'post',
 	 		success:function(response){
 	 			el.closest('.component-main').find('.radios-wrapper').append(response);
 	 		},
 	 		error:function(status){
 	 			console.log(status);
 	 		}
 	 	});
 	 });

 	/**
 	 * Adding a checkbox option
 	 *
 	 * @since 1.0.0
 	 * @author Niraj Gohel	
 	 */
 	 $('body').on('click keypress','.add-checkbox',function(event){
 	 	var el=$(this);
 	 	var component_id=el.closest('.component').data('id');
 	 	$.ajax({
 	 		url:ajax_url,
 	 		data:{
 	 			action:'add_checkbox_option',
 	 			component_id:component_id,
 	 		},
 	 		type:'post',
 	 		success:function(response){
 	 			el.closest('.component-main').find('.checkboxes-wrapper').append(response);
 	 		},
 	 		error:function(status){
 	 			console.log(status);
 	 		}
 	 	});
 	 });

 	 $('body').on('click','.delete-radio-option',function(){
 	 	$(this).closest('.radio-option').remove();
 	 });

 	 $('body').on('click','.delete-checkbox-option',function(){
 	 	$(this).closest('.checkbox-option').remove();
 	 });

 	 $('body').on('change','.component-type',function(){
 	 	var el=$(this)
 	 	var component_id=el.closest('.component').data('id');
 	 	$.ajax({
 	 		url:ajax_url,
 	 		data:{
 	 			action:'change_template',
 	 			type:el.val(),
 	 			component_id : component_id,
 	 		},
 	 		type:'post',
 	 		success:function(response){
 	 			el.closest('.component').replaceWith(response);
 	 			$('select').each(function(){
 	 				$(this).selectpicker();
 	 			});
 	 		},
 	 		error:function(status){
 	 			console.log(status);
 	 		}
 	 	});
 	 });

 	 $('.submit-container input:not([type="button"]), .submit-container textarea').on('blur',function(){
 	 	if($(this).prop('required') && $(this).val()==''){
 	 		$(this).closest('.validator').addClass('is-invalid');
 	 		if($(this).closest('.validator').find('.error-message').length==0){
 	 			$(this).closest('.validator').append('<div class="error-message text-danger"><small>This field is required</small></div>');
 	 		}
 	 	}
 	 	else{
 	 		$(this).closest('.validator').removeClass('is-invalid').find('.error-message').remove();	
 	 	}
 	 });

 	 if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
 	 	$('.selectpicker').selectpicker('mobile');
 	 }


 	});
