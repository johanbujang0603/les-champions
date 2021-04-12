<div class="button button-outline button-100 select-container">
	<select id="{{ isset($id) ? $id : $name }}" name="{{ $name }}" {{ $required ? 'required' : '' }} {{ isset($onchange) ? 'onchange='.$onchange : '' }}>
		<option id="default-value" value="{{ isset($default) ? $default : 0 }}" selected>{{ $label }}{{ $required ? '*' : '' }}</option>
		@foreach($datas as $data)
		<option value="{{ is_object($data) ? $data->id : $data['id'] }}">{{ is_object($data) ? $data->name : $data['name'] }}</option>
		@endforeach
	</select>
</div>