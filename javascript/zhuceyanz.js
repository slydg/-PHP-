/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
            //![CDATA[
            function validate()
            {
                if(document.forms.zhuceform.name.value === "")
                {
                    alert("请输入您的昵称。");
                    return false;
                }
                else if(document.forms.zhuceform.name.value.length < 2)
                {
                    alert("昵称不得少于2个字符。");
                    return false;
                }
                else if(document.forms.zhuceform.name.value.length > 20)
                {
                    alert("昵称不得多于20个字符（20个字母或10个汉字）。");
                    return false;
                }
                else if(/[^\u4e00-\u9fa5a-zA-Z0-9_-]{2,4}/.test(document.forms.zhuceform.name.value))
                {
                    alert("昵称中只可以使用汉字、数字、大小写字母、以及“_”符号。");
                    return false;
                }
                else if(document.forms.zhuceform.email.value === "")
                {
                    alert("请输入您的邮箱。");
                    return false;
                }
                else if(!((document.forms.zhuceform.email.value.indexOf(".") > 0)&&(document.forms.zhuceform.email.value.indexOf("@") > 0))||/[^a-zA-Z0-9.@_-]/.test(document.forms.zhuceform.email.value))
                {
                    alert("您的邮箱地址不符合规定。");
                    return false;
                }
                else if(document.forms.zhuceform.tel.value === "")
                {
                    alert("请输入您的电话或手机号码。");
                    return false;
                }
                else if(/[^0-9]/.test(document.forms.zhuceform.tel.value))
                {
                    alert("您的电话不符合规定。");
                    return false;
                }
                else if(document.forms.zhuceform.pass.value.length < 6)
                {
                    alert("密码长度不得小于6个字符。");
                    return false;
                }
                else if(!/[a-z]/.test(document.forms.zhuceform.pass.value)||!/[0-9]/.test(document.forms.zhuceform.pass.value))
                {
                    alert("考虑到您的账号安全，密码中必须含有至少一个数字和字母。");
                    return false;
                }
                else if(document.forms.zhuceform.pass.value !== document.forms.zhuceform.cpass.value)
                {
                    alert("您两次输入的密码不一致。");
                    return false;
                }
              return true;
            }