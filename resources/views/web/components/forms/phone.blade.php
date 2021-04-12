<input type="tel" name="{{ isset($id) ? $id : $name }}" id="{{$name}}" placeholder="{{ $placeholder }}{{ $required ? '*' : '' }}" value='{{ isset($value) ? $value : old($name) }}' {{ $required ? 'required' : '' }} pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">