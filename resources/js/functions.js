function snakeToCamel(string){
	return string.replace(/([-_][a-z])/g, (group) => group.toUpperCase().replace('-', '').replace('_', ''));
}

function scrollHeader(elem, header, content = null) {
	let fixed = false;
	$(window).bind('scroll', function () {
		if ($(window).scrollTop() > elem.position().top + elem.outerHeight(true)) {
			if(content != null && !header.hasClass('fixed')){
				content.css('padding-top', header.outerHeight(true) + 40);
				header.find('> div').removeClass('no-padding');
			}
			header.addClass('fixed');
		} else {
			if(content != null  && header.hasClass('fixed')){
				content.css('padding-top', 40);
				header.find('> div').addClass('no-padding');
			}
			header.removeClass('fixed');
		}
	});
}

function showDropdown(dropdown, input, fixed = false) {
	hideDropdown();
	if(!dropdown.is(':visible')) {
		let input_text = dropdown.find('input[type="text"]');
		let wrapper = $('<div class="dropdown-wrapper"></div>');
		let left = input.offset().left;

		input.addClass('active');
		if(fixed){
			if(dropdown.hasClass('dropdown-right-anchor')) {
				left -= dropdown.width(); 
			}
			dropdown.appendTo($('body'));
			dropdown.css({
				position: 'absolute',
				left: left,
				marginTop: input.height(),
				top: input.offset().top,
			});
		} else {
			wrapper.insertAfter(input);
			wrapper.append(input)
			dropdown.insertAfter(input);
		}
		dropdown.fadeIn('fast');
		if(input_text.length > 0){
			input_text.trigger('focus');
		}
	}
}

function hideDropdown() {
	$('.dropdown-wrapper:visible').each(function() {
		let wrapper = $(this);
		$(this).find('.dropdown').fadeOut('fast', function(){
			wrapper.find('>:first-child').insertAfter(wrapper);
			if($('#vue-hidden-elements'.length > 0)) {
				wrapper.children().appendTo($('#vue-hidden-elements'));
			} else {
				wrapper.children().insertAfter(wrapper);
			}
			wrapper.remove();
		});
	});
	$('.dropdown-fixed:visible').each(function() {
		$(this).fadeOut('fast', function(){
			if($('#vue-hidden-elements'.length > 0)) {
				$(this).appendTo($('#vue-hidden-elements'));
			}
		})
	});
}

function showModal(modal, e) {
	hideDropdown();
	if(e && $(e.target).parents('.modal').length){
		hideModal($(e.target).parents('.modal'));
	}
	if(modal.hasClass('modal-alone')) {
		hideModal($('.modal:visible'));
	}
	$('.modal-overlay').stop().fadeIn('fast');
	animShowUp(modal);
	modal.fadeIn('fast');
}

function hideModal(modal = 'all') {
	hideDropdown();
	if(modal == 'all'){
		modal = $('.modal');
		if(isMobile){
			modal = $('.modal, .mobile-modal');
		}
	}
	modal.each(function() {
		modal.find('video').trigger('load');
		$(this).stop().animate({
			opacity: 0,
			top: "40%"
		}, 300, function() {
			$(this).hide();
		});
	});
	$('.modal-overlay').fadeOut('fast');
}

function animShowUp(modal) {
	modal.css({
		display: "block",
		opacity: 0,
		top: "40%"
	});
	modal.css({
		marginTop: -(modal.outerHeight() / 2),
		marginLeft: -(modal.outerWidth() / 2)
	});
	modal.animate({
		opacity: 1,
		top: "50%"
	}, 300);
}

function displayFormError(container, error){
	let messages = "";
	if(typeof error == 'object'){
		$.each(error.messages, function(index, value){
			if(index > 0 && index < error.messages.length){
				messages += "<br>";
			}
			messages += " "+value;
		});
	} else {
		messages = error;
	}
	$('<span class="invalid-feedback">'+messages+'</span>').appendTo(container).show();
	container.show();
	if($('.modal:visible').length > 0) {
		setModalCenter($('.modal:visible'));
	}
}

function displayFormSuccess(container, message){
	$('<span class="success-feedback">'+message+'</span>').appendTo(container).show();
	container.show();
	if($('.modal:visible').length > 0) {
		setModalCenter($('.modal:visible'));
	}
}

function ajaxCall(route, type, params, callback = null, fileType = null){
	if(ajax_locked){
		let options = null;

		if($.isArray(callback)){
			options = "";
			for(let i = 1; i < callback.length; i++){
				if(typeof callback[i] === 'string') {
					options += ', "'+ callback[i] + '"';
				} else {
					options += ',' + callback[i];
				}
			}
			callback = callback[0];
		}

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				'Accept': 'application/json'
			}
		});
		let ajax_options = {
			type: type,
			url: route,
			data: params,
			success:function(data, textStatus, xhr){
				$('.button-loading').removeClass('button-loading');
				$('*').removeClass('loading');
				ajax_locked = false;
				if(callback != null){
					ajaxSuccess(xhr, callback, options);
				} else {
					return data;
				}
			},
			error: function(xhr, exception) {
				$('.button-loading').removeClass('button-loading');
				$('*').removeClass('loading');
				ajax_locked = false;
				if(callback != null){
					ajaxError(xhr, callback, options);
				} else {
					return data;
				}
			}
		};
		if(fileType) {
			$.extend(ajax_options, {
				processData: false,
				contentType: false
			});
		}

		$.ajax(ajax_options);
	}
}

function ajaxSuccess(data, callback, options = null) {
	let parameters = JSON.stringify(data);

	if(options) {
		parameters += options;
	}
	eval(callback + "("+ parameters +")");
}

function ajaxError(data, callback, options = null) {
	let parameters = JSON.stringify(data);

	if(options) {
		parameters += options;
	}
	eval(callback + "("+ parameters +")");
}

function getUrlParameter(sParam) {
	let sPageURL = window.location.search.substring(1),
	sURLVariables = sPageURL.split('&'),
	sParameterName,
	i;

	for (let i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};

function getUrlParameters() {
	let sPageURL = window.location.search.substring(1),
	sURLVariables = sPageURL.split('&'),
	sParameterName,
	results = [],
	i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');
		results[sParameterName[0]] = (sParameterName[1] === undefined) ? true : decodeURIComponent(sParameterName[1]);
	}
	return results;
};


function isValidURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
      '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
      '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
      '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
      '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
      '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}

function createUrl(str) {
	if(isValidURL(str)){
		if (str.indexOf("http://") == 0 || str.indexOf("https://") == 0) {
			return str;
		} else {
			return 'https://'+str;
		}
	}
}

function replaceUrlParam(url, paramName, paramValue)
{
	if (paramValue == null) {
		paramValue = '';
	}
	let pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
	if (url.search(pattern)>=0) {
		return url.replace(pattern,'$1' + paramValue + '$2');
	}
	url = url.replace(/[?#]$/,'');
	return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
}

function setModalCenter(modal){
	modal.stop().animate({
		marginTop: -(modal.outerHeight() / 2),
		maxHeight: "calc(100vh - "+ modal.outerHeight() / 4 +"px)"
	}, 300);
}

function readURL(input, preview) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#'+preview).attr('src', e.target.result);
		}
    	reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function slugify(str) {
	var map = {
		'-' : ' ',
		'-' : '_',
		'a' : 'á|à|ã|â|À|Á|Ã|Â',
		'e' : 'é|è|ê|É|È|Ê',
		'i' : 'í|ì|î|Í|Ì|Î',
		'o' : 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
		'u' : 'ú|ù|û|ü|Ú|Ù|Û|Ü',
		'c' : 'ç|Ç',
		'n' : 'ñ|Ñ'
	};
	
	for (var pattern in map) {
		str = str.replace(new RegExp(map[pattern], 'g'), pattern);
	};

	return str;
};