$(function () {
    /*find pwd validation*/

    var initConfig = { "formId": "findPwdFrm", "absolute": true, "filed":
						[
						{ "name": "LoginName", "onFocus": "请输入登录名！", "onError": "登录名必需是11位的手机号码", "min": 11, "isMobile": true },
						{ "name": "VerificationCode", "onFocus": "请输入动态码！", "onError": "动态码最少为4位", "min": 4 },
                        { "name": "Password", "onFocus": "请设置一个6或8位的密码！", "onError": "请设置一个6或8位的密码", "min": 6 },
                        { "name": "RetypePassword", "onFocus": "请输入重复密码！", "onError": "2次密码不一致", "min": 6,
                            "compare": "Password"
                        }
						]
    };
    init(initConfig);
    formValidator("findPwdFrm");

    /*end find pwd validation*/
});