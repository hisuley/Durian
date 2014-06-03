$(function () {
    /*Login validation*/

    var initConfig = { "formId": "loginFrm", "absolute": true, "filed":
						[
						{ "name": "Account", "onFocus": "请输入登录名！", "onError": "登录名不能为空", "min": 1 },
						{ "name": "Password", "onFocus": "请输入密码！", "onError": "密码最少为6位", "min": 6 },
                        { "name": "Code", "onError": "验证码不能为空！", "min": 1 }
						]
    };
    init(initConfig);
    $("#Code").focus(function () {
        $("#cueCode").hide();
        document.getElementById("spCode").innerHTML = "请输入上述算式的答案！";
    });
    $("#Code").blur(function () {
        //if ($("#Code").val()!="") {
            document.getElementById("spCode").innerHTML = "";
        //}
    });
    formValidator("loginFrm");

    /*End login validation*/


    /*Login validation*/

    var initConfig = { "formId": "registerFrm", "absolute": true, "filed":
						[
						{ "name": "LoginName", "onFocus": "请输入登录名！", "onError": "登录名必需是11位的手机号码", "min": 11, "isMobile": true },
						   { "name": "LoginNameAgain", "onFocus": "请输入重复登录名！", "onError": "2次登录名不一致", "min": 11, "isMobile": true, "compare": "LoginName" },
                        { "name": "VerificationCode", "onFocus": "请输入动态码！", "onError": "动态码最少为4位", "min": 4 },
                        { "name": "RPassword", "onFocus": "请设置一个6或8位的密码！", "onError": "请设置一个6或8位的密码", "min": 6 },
                        { "name": "RetypePassword", "onFocus": "请输入重复密码！", "onError": "2次密码不一致", "min": 6,
                            "compare": "RPassword"
                        },
                        { "name": "CompanyName", "onFocus": "必需包括公司简称、部门及负责人<br />例如：虎翼罗湖部张伟！", "onError": "必需包括公司简称、部门及负责人<br />例如：虎翼罗湖部张伟", "min": 1 },
                        { "name": "ContactName", "onFocus": "请输入联系人名称", "onError": "联系人名称不能为空", "min": 1 },
                        { "name": "Phone", "onFocus": "请输入公司固话！", "onError": "公司固话不能为空", "min": 1 },
                        { "name": "Province_CityName", "onFocus": "请选择省份-城市！", "onError": "省份-城市不能为空", "min": 1 },
                        { "name": "Address", "onFocus": "无需再写省份和城市<br /><span style='color:#73c406'>如：罗湖区嘉宾路3005号1202</span>！", "onError": "详细地址不能为空", "min": 1, "max": "500", "maxError": "详细地址长度不能大于500位！" }
						]
    };
    init(initConfig);
    formValidator("registerFrm");

    /*End login validation*/
});