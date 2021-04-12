let isMobile = false;
let ajax_locked = false;
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|iPhone|xiino/i.test(navigator.userAgent)
	|| /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))
	|| window.innerWidth <= 760) {
	isMobile = true;
}

$(document).ready(function() {
	$('body').on('click', function(){
		hideDropdown();
	});

	/**
    * Smooth scrolling to page anchor on click
    **/
    $("a[href*='#']:not([href='#'])").click(function() {
    	if (location.hostname == this.hostname && this.pathname.replace(/^\//,"") == location.pathname.replace(/^\//,"")) {
    		let anchor = $(this.hash);
    		anchor = anchor.length ? anchor : $("[name=" + this.hash.slice(1) +"]");
    		if ( anchor.length ) {
    			$("html, body").stop().animate({
    				scrollTop: anchor.offset().top - 39
    			}, 200);
    		}
    	}
    });

    if(isMobile){
    	$(window).bind('scroll', function () {
    		if ($(window).scrollTop() > $('header').position().top) {
    			$('header').addClass('fixed');
    		} else {
    			$('header').removeClass('fixed');
    		}
    	});
    }

	/**
    * Button inside <a> element don't trigger redirection or stop propagation
    **/
    $('body').on('click', 'a', function(e){
    	if($(e.target).hasClass('prevent-default') || $(e.target).parents('.prevent-default').length > 0) {
    		e.preventDefault();
    	}
    	if($(e.target).hasClass('stop-propagation') || $(e.target).parents('.stop-propagation').length > 0) {
    		e.stopPropagation();
    	}
    });

	////////////////////////////////////// DROPDOWNS
	$('body').on('click', '.trigger-dropdown', function(e){
		e.stopPropagation();
		let dropdown = $('#'+ $(this).data('dropdown'));
		showDropdown(dropdown, $(this), $(this).data('dropdown-fixed'));
	});

	$('body').on('click', '.dropdown', function(e){
		e.stopPropagation();
	});
	//////////////////////////////////////

	////////////////////////////////////// MODALS
	$('body').on('click', '.trigger-modal', function(e){
		e.stopPropagation();
		let data_modal = $.trim($(this).data('modal'));
		if(data_modal == 'close'){
			hideModal();
			return true;
		}
		let modal = $('.modal[data-modal="'+ data_modal +'"]');
		if(modal.length == 0){
			modal = $('.mobile-modal[data-modal="'+ data_modal +'"]');
		}
		showModal(modal, e);
	});

	$('body').on('click', '.trigger-modal .stop-propagation', function(e){
		e.stopPropagation();
	});

	$('body').on('click', '.modal .modal-close', function(e){
		e.stopPropagation();
		hideModal();
	});

	$('body').on('click', '.modal', function(e){
		e.stopPropagation();
		hideDropdown();
	});

	$('body').on('click', '.modal-overlay', function() {
		hideModal();
	});
	//////////////////////////////////////

	////////////////////////////////////// AJAX
	$('body').on('click', '.ajax-button', function(){
		$(this).addClass('button-loading');
		if($(this).parents('.modal').length > 0){
			$(this).parents('.modal').addClass('loading');
		}
	});
	//////////////////////////////////////

	////////////////////////////////////// INPUT FILE PREVIEW
	$('body').on('change', '.input-file', function(event){
		let input_id = $(this).attr('id');

		readURL(this, input_id+"-preview");
		$('#'+input_id+'-label').hide();
		$('#'+input_id+'-send, #'+input_id+'-edit').show();
	});
	//////////////////////////////////////
});