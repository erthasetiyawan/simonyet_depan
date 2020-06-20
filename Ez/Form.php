<?php

/**
 * @author Ertha Dwi Setiyawan
 */

if (!function_exists('form_open')) {
	function form_open($id) {
		return "<form id='".$id."'>";
	}
}

if (!function_exists('form_close')) {
	function form_close() {
		return "</form>";
	}
}

if (!function_exists('form_line')) {
	function form_line() {
		return '<div class="hr-line-dashed"></div>';
	}
}

if (!function_exists('form_text')) {
	function form_text($label = '',$name = '',$value = '',$icon = 'star',$msg = '',$attribute = 'required') {

		if(!empty($msg)) $msg = '<br/>' . $msg . '';
			
		$html = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
					<label for="'.$name.'">'.$label.' </label>
					<div class="input-group">
				        <span class="input-group-btn">
				        	<button type="button" class="btn btn-default"><i class="fa fa-'.$icon.'"></i></button>
				        </span>
				        <input type="text" placeholder="'.$label.'" class="form-control '.$name.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
			        	'.$msg.'
				    </div>
				</div></div>';

		return $html;
	}
}

if (!function_exists('form_number')) {
	function form_number($label = '',$name = '',$value = '',$icon = 'star',$attribute = 'required') {

		$html = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
					<label for="'.$name.'">'.$label.' </label>
					<div class="input-group">
				        <span class="input-group-btn">
				        	<button type="button" class="btn btn-default"><i class="fa fa-'.$icon.'"></i></button>
				        </span>
				        <input type="number" placeholder="'.$label.'" class="form-control '.$name.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
				    </div>
				</div></div>';

		return $html;
	}
}

if (!function_exists('form_email')) {
	function form_email($label = '',$name = '',$value = '',$icon = 'star',$msg = '',$attribute = 'required') {

		if(!empty($msg)) $msg = '<br/>' . $msg . '';

		$html = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
					<label for="'.$name.'">'.$label.' </label>
					<div class="input-group">
				        <span class="input-group-btn">
				        	<button type="button" class="btn btn-default"><i class="fa fa-'.$icon.'"></i></button>
				        </span>
				        <input type="email" placeholder="'.$label.'" class="form-control '.$name.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
			        	'.$msg.'
				    </div>
				</div></div>';

		return $html;
	}
}

if (!function_exists('form_file')) {
	function form_file($label = '',$name = '', $value = '',$icon = 'star',$attribute = 'required', $msg = "") {

		if(!empty($msg)) $msg = '<br/>' . $msg . '';

		$html = '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
					<label for="'.$name.'">'.$label.' </label>
					<div class="input-group">
				        <span class="input-group-btn">
				        	<button type="button" class="btn btn-default"><i class="fa fa-'.$icon.'"></i></button>
				        </span>
				        <input type="file" placeholder="'.$label.'" class="form-control '.$name.'" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
			        	'.$msg.'
				    </div>
				</div></div>';

		return $html;

	}
}

if (!function_exists('form_area')) {
	function form_area($label = '',$name = '', $value = '',$rows = '5', $attribute = 'required') {

		$html = '<div class="form-group">
					<label id="'.$name.'">'.$label.'</label>
			        <div>
			        	<textarea rows="'.$rows.'" placeholder="'.$label.'" class="form-control '.$name.'" id="'.$name.'" name="'.$name.'" '.$attribute.'>'.$value.'</textarea>
			        </div>
			    </div>';

		return $html;

	}
}

if (!function_exists('form_button')) {
	function form_button($label, $name, $type='Cancel') {
		$html = '
				<div class="input-group">
					<div>
				        <button type="reset" class="btn btn-white">
				            '.$type.'
				        </button>
				        <button class="btn btn-primary '.$name.'" data-name="'.ucfirst($label).'" name="'.$name.'">
				            '.$label.' 
				        </button>
					</div>
				</div>';

		return $html;
	}
}


if (!function_exists('form_select')) {
	function form_select($label, $name, array $values = null, $selected = null, $attr = 'required') {

		$select = "";

		if (!empty($values)) {
			
			$select .= "<option value=''>Choose ".$label."</option>";

			foreach ($values as $key => $value) {
				
				$var = ($key == $selected) ? 'selected' : false;

				$select .= "<option value='".$key."' ".$var.">".$value."</option>";

			}

		}else{

			$select .= "<option value=''>Data ".$label." Empty</option>";

		}

		$html = '<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="'.$name.'">'.$label.' </label>';
					'<div class="input-group">
				        <select name="'.$name.'" class="form-control col-md-7 col-xs-12" id="'.$name.'" '.$attr.'>
				            '.$select.'
				        </select>
				        <span class="input-group-btn">
				        	<button class="btn btn-default"><i class="fa fa-star"></i></button>
				        </span>
				    </div>
				</div>';

		return $html;
	}
}