@php
$dataAttributes = "";
if(isset($data_attributes)){
foreach($data_attributes as $key => $attribute){
$dataAttributes .= 'data-'.$key.'='.$attribute.' ';
}
}
@endphp
<div class="align-checkbox {{ isset($no_mb) ? '' : 'mb-3' }}" {{ $dataAttributes }}>
	<input type="checkbox" name="{{ $name }}" id="{{ isset($id) ? $id : $name }}-{{ $value }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}>
	<label for="{{ isset($id) ? $id : $name }}-{{ $value }}">{{ $label }}</label>
</div>