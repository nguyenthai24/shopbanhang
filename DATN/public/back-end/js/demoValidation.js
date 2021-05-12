$().ready(function() {
	$("#demoForm").validate({
		onfocusout: false,
		onkeyup: false,
		onclick: false,
		rules: {
				admin_email: {
							required: true,
							email: true
						},
				admin_password: {
							required: true,
							minlength: 10
						},
				
			},
			messages: {
				admin_email: "Vui lòng nhập Email",
				admin_password: {
							required: 'Vui lòng nhập mật khẩu',
							minlength: 'Vui lòng nhập ít nhất 10 kí tự'
						},
				
			}
	});
});