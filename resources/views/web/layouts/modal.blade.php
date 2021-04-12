<div id="{{ str_replace('_', '-', $modal_id ?? $data_modal) }}-modal" class="modal hidden {{ isset($class) ? $class : '' }}" data-modal="{{ str_replace('_', '-', $modal_id ?? $data_modal) }}">
    <i class="modal-close icon-close"></i>
    <div class="modal-container">
    	@php
    		$formated_datas = [];
    		if(isset($datas)){
	    		foreach($datas as $key => $data){
	    			$formated_datas[$key] = $data;
	    		}
			} 
    	@endphp
    	@include('web.modals.'.$data_modal, $formated_datas)
    	
    </div>
</div>