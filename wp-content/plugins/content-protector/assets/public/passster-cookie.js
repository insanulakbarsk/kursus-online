(function ($) {

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }

    $(document).ready(function () {

        let cookieName = 'passster';
		let passster_pwd = '';
		
		if( $('.passster-password').length > 1) {
			
		 $('.passster-password').on("input", function () {
			passster_pwd = $(this).val();
       		});
		} else {
			$('#passster_password').on("input", function () {
            	passster_pwd = $(this).val();
       		});

        }
        
        if( $('.passster-submit').length > 1) {
            $('.passster-submit').click(function () {
                cookie.remove(cookieName);

                let sanitized = passster_pwd;

                cookie.set(cookieName, sanitized, {
                    expires: parseInt(passster_cookie['days']), // Expires in 999 days
                    path: '/',
                });

            });
           } else {
            
            $('#passster_submit').click(function () {
                cookie.remove(cookieName);

                let sanitized = passster_pwd;

                cookie.set(cookieName, sanitized, {
                    expires: parseInt(passster_cookie['days']), // Expires in 999 days
                    path: '/',
                });

            });
           }

    });


}(jQuery));