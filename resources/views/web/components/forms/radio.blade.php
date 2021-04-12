@php
$dataAttributes = "";
if(isset($data_attributes)){
foreach($data_attributes as $key => $attribute){
$dataAttributes .= 'data-'.$key.'='.$attribute.' ';
}
}
@endphp
<div class="align-checkbox mb-3" {{ $dataAttributes }}>
	<input type="radio" name="{{ $name }}" id="{{ isset($id) ? $id : $name }}-{{ $value }}" value="{{ $value }}" {{ isset($checked) && $checked ? 'checked' : '' }} {{ isset($required) && $required ? 'required' : '' }}>
	<label for="{{ isset($id) ? $id : $name }}-{{ $value }}">{{ $label }}</label>
</div>