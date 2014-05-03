/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Created by rob for front end of signUp.php
 */
//      <!--script below checks to see if passwords match -->
//      <!-- logic courtesy of
//            http://www.sitepoint.com/using-the-html5-constraint-api-for-form-validation/-->
       
$( document ).ready(function() {
    if (navigator.userAgent.indexOf('Safari') && !navigator.userAgent.indexOf('Chrome')) {
        $('#submit_sign_up').click(function(){
                var pass1 = $('#InputPassword');
                var pass2 = $('#ConfirmPassword');
                var user = $('#InputUsername');
                var email = $('#InputEmail');
                if((pass1.val() == '')&&(user.val() == '')&&(pass2.val() == '')&&(email.val()=='')){
                   alert('Fields cannot be left blank');
                }
                else if(user.val() == ''){
                   alert('Username cannot be left blank');
                }
                else if (email.val() == ''){
                    alert('Email cannot be left blank')
                }
                else if(pass1.val() == ''){
                   alert('Password field cannot be left blank');
                }
                else if (pass2.val() == ''){
                   alert('Confirm Password field cannot be left blank');
                }
        })
    }
    else{
        document.getElementById("InputPassword").onchange = validatePassword;
        document.getElementById("ConfirmPassword").onchange = validatePassword;
    }
});
 //added for safari support
 
 //      <!--script below checks to see if passwords match -->
//      <!-- logic courtesy of
//            http://www.sitepoint.com/using-the-html5-constraint-api-for-form-validation/-->

 function validatePassword(){
    var pass2=document.getElementById("ConfirmPassword").value;
    var pass1=document.getElementById("InputPassword").value;
    if (pass1.length < 6 )
        document.getElementById("InputPassword").setCustomValidity("Password must be at least 6 characters long");
    else
        document.getElementById("InputPassword").setCustomValidity(''); 
        //clear pass.length check
    if(pass1!=pass2)
       document.getElementById("ConfirmPassword").setCustomValidity("Passwords Don't Match");
    else
       document.getElementById("ConfirmPassword").setCustomValidity('');  
    //empty string means no validation error
 }


