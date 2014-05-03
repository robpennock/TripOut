/* 
 * JS file created by Rob.
 */

$( document ).ready(function() {
    //if safari use jquery
    if (navigator.userAgent.indexOf('Safari') && !navigator.userAgent.indexOf('Chrome')) {
    // Yep, it's Safari =)
        $('#submit_sign_in').click(function(){
            var pass1 = $('#InputPassword');
            if((pass1.val() == '')&&($('#InputUsername').val() == '')){
               alert('Fields cannot be left blank');
            }
            else if($('#InputUsername').val() == ''){
               alert('Username cannot be left blank');
            }
            else if($('#InputPassword').val() == ''){
               alert('Password field cannot be left blank');
            }
        })
    }else {
        document.getElementById("InputUsername").onchange = validation;
        document.getElementById("InputPassword").onchange = validation;
    // Nope, it's another browser =(
    }


    //this section deals with signIn.php textfield validation

    

});
function validation(){
            var pass1=document.getElementById("InputPassword").value;
            var user = document.getElementById("InputUsername").value;
            if (pass1 == '' )
                document.getElementById("InputPassword").setCustomValidity("Password field can't be blank");
            else
                document.getElementById("InputPassword").setCustomValidity(''); 
                //clear pass.length check
            if(user == '')
               document.getElementById("InputUsername").setCustomValidity("Username can't be blank");
            else
               document.getElementById("InputUsername").setCustomValidity('');  
}

