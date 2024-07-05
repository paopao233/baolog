// 0 表示永不超时，
$.alert = function(subject, timeout, options) {
	var options = options || {size: "md"};
	var s = '\
	<div class="modal fade" tabindex="-1" role="dialog">\
		<div class="modal-dialog modal-'+options.size+'">\
			<div class="modal-content">\
				<div class="modal-header">\
					<h4 class="modal-title">'+lang.tips_title+'</h4>\
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
						<span aria-hidden="true">&times;</span>\
					</button>\
				</div>\
				<div class="modal-body">\
					<h5>'+subject+'</h5>\
				</div>\
				<div class="modal-footer">\
					<button type="button" class="btn btn-secondary" data-dismiss="modal">'+lang.close+'</button>\
				</div>\
			</div>\
		</div>\
	</div>';
	var jmodal = $(s).appendTo('body');
	jmodal.modal('show');
	if(typeof timeout != 'undefined' && timeout >= 0) {
		setTimeout(function() {
			jmodal.modal('dispose');
		}, timeout * 1000);
	}
	
	return jmodal;
};

$.confirm = function(subject, ok_callback, options) {
	var options = options || {size: "md"};
	options.body = options.body || '';
	var title = options.body ? subject : lang.confirm_title+':';
	var subject = options.body ? '' : '<p>'+subject+'</p>';
	var s = '\
	<div class="modal fade" tabindex="-1" role="dialog">\
		<div class="modal-dialog modal-'+options.size+'">\
			<div class="modal-content">\
				<div class="modal-header">\
					<h5 class="modal-title">'+title+'</h5>\
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
						<span aria-hidden="true">&times;</span>\
					</button>\
				</div>\
				<div class="modal-body">\
					'+subject+'\
					'+options.body+'\
				</div>\
				<div class="modal-footer">\
					<button type="button" class="btn btn-primary">'+lang.confirm+'</button>\
					<button type="button" class="btn btn-secondary" data-dismiss="modal">'+lang.close+'</button>\
				</div>\
			</div>\
		</div>\
	</div>';
	var jmodal = $(s).appendTo('body');
	jmodal.find('.modal-footer').find('.btn-primary').on('click', function() {
		jmodal.modal('hide');
		if(ok_callback) ok_callback();
	});
	jmodal.modal('show');
	return jmodal;
};

$(function() {
	$('[data-modal-title]').each(function() {
		var jthis = $(this);
		jthis.on('click', function() {
			var url = jthis.data('modal-url') || jthis.attr('href');	
			var title = jthis.data('modal-title');	
			var arg = jthis.data('modal-arg');	
			var callback_str = jthis.data('modal-callback');
			callback = window[callback_str];
			var size = jthis.data('modal-size'); // 对话框的尺寸
			
			// 弹出对话框
			if(this.ajax_modal) this.ajax_modal.modal('dispose');
			this.ajax_modal = $.ajax_modal(url, title, size, callback, arg);
			
			return false;
		});
	});
});

