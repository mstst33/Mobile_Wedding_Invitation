<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width"/>
    <title>Login - Kakao JavaScript SDK</title>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
  </head>
  <body>
    <script type='text/javascript'>
    	var app_key = '';
    	var rest_key = '';
    	var redirect_uri = 'http://mstst33.com/marriage/auth/kakao/';

        Kakao.init(app_key);
        Kakao.Auth.getStatus(function(statusObj)
		{	
			if(statusObj.status == "connected")
			{
				kakao_request();
			}
			else
			{
				// kakao_login_rest();
				kakao_login();
			}
		});

        function kakao_login_rest()
        {
        	var auth_uri = 'https://kauth.kakao.com/oauth/authorize?client_id=' + rest_key + '&redirect_uri=' + redirect_uri + '&response_type=code';
        	var decodedURI = decodeURIComponent(location.href);
			var tmp_json = decodedURI.split("?");
			if(tmp_json.length > 1)
			{
				var loc_json = tmp_json[1].split("=");
				if(loc_json[0]=='code')
				{
					alert(loc_json[1]);
					Kakao.Auth.setAccessToken(loc_json[1], true);
					kakao_request();
				}
				else
				{
					window.location.href = auth_uri;
				}
			}
			else
			{
				window.location.href = auth_uri;
			}
        }

        function kakao_login()
        {
        	Kakao.Auth.login({
				success: function(authObj) {
				  alert("success: " + JSON.stringify(authObj));
				  // 로그인 성공시, API를 호출합니다.
				  kakao_request();
				},
				fail: function(errObj) {
				  alert("fail: " + JSON.stringify(errObj));
				  window.location.href = 'http://mstst33.com/marriage/#guestWrapper';
				}
			});
        }

        function kakao_request()
        {
        	Kakao.API.request({
				url: '/v1/user/me',
				success: function(res) {
				  var json_str = JSON.stringify(res);
				  alert("success_req: " + json_str);
				  window.location.href = 'http://mstst33.com/marriage/?kakao=' + json_str;
				},
				fail: function(error) {
				  alert("error_req" + JSON.stringify(error));
				  window.location.href = 'http://mstst33.com/marriage/#guestWrapper';
				}
			});
        }
    </script>
  </body>
</html>