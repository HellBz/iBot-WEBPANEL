<?php

/**
 *
 */

function generateInputText($name='', $value='')
{
	return '<input type="text" value="'.$value.'" name="'.$name.'" class="form-control" aria-describedby="basic-addon1">';
}

/**
 *
 */

function generateInputNumber($name='', $value='')
{
	return '<input type="number" value="'.$value.'" name="'.$name.'" class="form-control" aria-describedby="basic-addon1">';
}

/**
 *
 */

function generateInputTextarea($name='', $value='')
{
	return "<textarea class=\"form-control\" name=\"{$name}\" rows=\"3\">{$value}</textarea>";
}

/**
 *
 */

function generateInputYesno($name='', $value='1')
{
	global $lang;
	if($value == "no" || $value === '0')
	{
		$no_checked = 'checked';
		$yes_checked = '';
	}
	else
	{
		$yes_checked = 'checked';
		$no_checked = '';
	}

	return '
	<div class="radio">
	  	<label>
	    	<input type="radio" name="'.$name.'" id="optionsRadios1" value="1" '.$yes_checked.'>
	    	'.$lang['yes'].'
	  	</label>
	</div>
	<div class="radio">
	  	<label>
	    	<input type="radio" name="'.$name.'" id="optionsRadios2" value="0" '.$no_checked.'>
	    	'.$lang['no'].'
	  	</label>
	</div>';
}

/**
 *
 */

function generateInputOnoff($name='', $value='1')
{
	global $lang;
	if($value == "no" || $value === '0')
	{
		$no_checked = 'checked';
		$yes_checked = '';
	}
	else
	{
		$yes_checked = 'checked';
		$no_checked = '';
	}

	return '
	<div class="radio">
	  	<label>
	    	<input type="radio" name="'.$name.'" id="optionsRadios1" value="1" '.$yes_checked.'>
	    	'.$lang['turnon'].'
	  	</label>
	</div>
	<div class="radio">
	  	<label>
	    	<input type="radio" name="'.$name.'" id="optionsRadios2" value="0" '.$no_checked.'>
	    	'.$lang['turnoff'].'
	  	</label>
	</div>';
}

/**
 *
 */

function generateInputSelect($name='', $option_list='', $selectedvalue='')
{
	$string = '<select name="'.$name.'" class="form-control">';

	$options = explode(",", $option_list);

	for($i = 0; $i < count($options); $i++)
	{
		$selected = '';
		$exp = explode("=", $options[$i]);
		$value = $exp[0];
		$option = $exp[1];
		if($selectedvalue == $value)
		{
			$selected = 'selected="selected"';
		}
		$string .= "<option value=\"{$value}\" {$selected}>{$option}</option>";
	}
	$string .= '</select>';
	return $string;
}

/**
 *
 */

function generateInputChannels($name='', $value='')
{
	global $query;
	$channels = $query->getElement('data', $query->channelList(""));
	$string = '<select name="'.$name.'" class="form-control">';
	foreach($channels as $channel)
	{
		$selected = '';
		if($channel['cid'] == $value)
		{
			$selected = 'selected="selected"';
		}
		$string .= '<option value="'.$channel['cid'].'" '.$selected.'>'.$channel['channel_name'].'</option>';
	}
	$string .= '</select>';
	return $string;
}

/**
 *
 */

function generateInputServerGroups($name='', $value='')
{
	global $query;
	$groups = $query->getElement('data', $query->serverGroupList());
	$string = '<select name="'.$name.'" class="form-control">';
	foreach($groups as $group)
	{
		$selected = '';
		if($group['sgid'] == $value)
		{
			$selected = 'selected="selected"';
		}
		$string .= '<option value="'.$group['sgid'].'" '.$selected.'>'.$group['name'].' ('.$group['sgid'].')</option>';
	}
	$string .= '</select>';
	return $string;
}

/**
 *
 */

function generateInputChannelGroups($name='', $value='')
{
	global $query;
	$groups = $query->getElement('data', $query->channelGroupList());
	$string = '<select name="'.$name.'" class="form-control">';
	foreach($groups as $group)
	{
		$selected = '';
		if($group['cgid'] == $value)
		{
			$selected = 'selected="selected"';
		}
		$string .= '<option value="'.$group['cgid'].'" '.$selected.'>'.$group['name'].' ('.$group['cgid'].')</option>';
	}
	$string .= '</select>';
	return $string;
}