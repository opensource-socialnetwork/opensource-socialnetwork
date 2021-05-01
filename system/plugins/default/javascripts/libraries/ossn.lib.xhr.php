//<script>
/**
 * Register a ajax request
 *
 * @param $datap['form'] = form id
 * @param $datap['callback'] = call back function
 * @param $datap['error'] = on error function
 * @param $datap['beforeSend'] = before send function
 * @param $datap['url'] = form action url
 *
 * @return bool
 */
Ossn.ajaxRequest = function($datap){
    $(function(){
		
        var $form_name = $datap['form'];
        $('body').on("submit", $form_name, function(event){
													
			var $data = Ossn.call_hook('ajax', 'request:settings', null, $datap);	
        	var url = $data['url'];
        	var callback = $data['callback'];
        	var error = $data['error'];
       	 	var befsend = $data['beforeSend'];
        	var action = $data['action'];
        	var containMedia = $data['containMedia'];
        	var $xhr = $data['xhr'];
			
        	if(url == true){
            	url = $($form_name).attr('action');
        	}
            event.preventDefault();
            event.stopImmediatePropagation();

            if(!callback){
                return false;
            }
            if(!befsend){
                befsend = function(){}
            }
            if(!action){
                action = false;
            }
            if(action == true){
                url = Ossn.AddTokenToUrl(url);
            }

            if(!error){
                error = function(xhr, status, error){
                    if(error == 'Internal Server Error' || error !== ''){
                        Ossn.MessageBox('syserror/unknown');
                    }
                };
            }
            if(!$xhr){
                $xhr = function(){
                    var xhr = new window.XMLHttpRequest();
                    return xhr;
                };
            }
            var $form = $(this);
            if(containMedia == true){
                $requestData = new FormData($form[0]);
                $removeNullFile = function(formData){
                    if(formData.keys){
                        for (var key of formData.keys()){
                            var fileName = null || formData.get(key)['name'];
                            var fileSize = null || formData.get(key)['size'];
                            if(fileName != null && fileSize != null && fileName == '' && fileSize == 0){
                                formData.delete(key);
                            }
                        }
                    }
                };
                //Some Iphone devices unable to post #1295
                $removeNullFile($requestData);
                $vars = {
                    xhr: $xhr,
                    async: true,
                    cache: false,
                    contentType: false,
                    type: 'post',
                    beforeSend: befsend,
                    url: url,
                    error: error,
                    data: $requestData,
                    processData: false,
                    success: callback,
                };
            } else {
                $vars = {
                    xhr: $xhr,
                    async: true,
                    type: 'post',
                    beforeSend: befsend,
                    url: url,
                    error: error,
                    data: $form.serialize(),
                    success: callback,
                };
            }
			//[E] Return xhr object on post and ajaxrequest #1909
            return $.ajax($vars);
        });
    });
};
/**
 * Register a post request
 *
 * @param $datap['callback'] = call back function
 * @param $datap['error'] = on error function
 * @param $datap['beforeSend'] = before send function
 * @param $datap['url'] = form action url
 *
 * @return bool
 */
Ossn.PostRequest = function($datap){
	var $data = Ossn.call_hook('ajax:post', 'request:settings', null, $datap);
	var url = $data['url'];
	var callback = $data['callback'];
	var error = $data['error'];

	var befsend = $data['beforeSend'];
	var $fdata = $data['params'];
	var async = $data['async'];
	var action = $data['action'];
	var $xhr = $data['xhr'];
	if(!callback){
		return false;
	}
	if(!befsend){
		befsend = function(){}
	}
	if(typeof async === 'undefined'){
		async = true;
	}
	if(!action){
		action = true;
	}
	if(action == true){
		url = Ossn.AddTokenToUrl(url);
	}
	if(!error){
		error = function(){};
	}
	if(!$xhr){
		$xhr = function(){
			var xhr = new window.XMLHttpRequest();
			return xhr;
		};
	}
	//[E] Return xhr object on post and ajaxrequest #1909
	return $.ajax({
		xhr: $xhr,
		async: async,
		type: 'post',
		beforeSend: befsend,
		url: url,
		error: error,
		data: $fdata,
		success: callback,
	});
};