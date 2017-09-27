

$(document).ready(function()
{
    /* start  of   ajax login  form  */
    $('#loginform').submit(function(e)
    {
        e.preventDefault();
        $.ajax({
        type: "POST",
        url: 'checkLogin.php',
        data: $(this).serialize(),
        beforeSend : function(s){
            $('#spinner').css('display', 'block');
        
            },
        success: function(response)
        {
            if (response.trim()=="success")
            {
                $('#spinner').css('display', 'none');
                
                window.location.href="index.php";
                
            }else
            {
                spinner.style.display='none';
                alert("there is an error in the Email or Pssword try agin ");
            }
        }

    });


    });
    /* End  of   ajax  login  form  */


    /* start  of   ajax singup  form  */

  

});

$(document).ready(function(event)
{
            // event.preventDefault();

    $("#register-form").validate({
        rules: {
            username: {
            required: true,
            minlength: 3
          },
          lastname: {
            required: true,
            minlength: 3
          },
          Mobile: {
            required: true,
            minlength: 10
          },
          City: {
            required: true,
            minlength:3
          },
          addres: {
            required: true,
            minlength:3
          },
          password: {
            required: true,
            minlength:4
          },
          
          email: {
            required: true,
            email: true
            
          },
          myFile: {
            required: true,
            
          },
        },
        messages: {
          name: {
            required: "We need your email address to contact you",
            minlength: jQuery.validator.format("At least {0} characters required!")
          },
          
        },
        submitHandler: submitForm

      });
      
       function submitForm(event)
      {
        var data = $("#register-form").serialize();
          $.ajax({
  
              type : 'POST',
              url  : 'checkSigup.php',
              data : data,
              beforeSend: function()
              {
                  $("#error").fadeOut();
                  $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
              },
              success :  function(response)
              {
                  if(response.trim()==1){
                    $("#error").fadeOut(10)
                      $("#error").fadeIn(10, function(){
  

                          $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');
  
                          $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
  
                      });
  
                  }
                  else if(response.trim()=="registered")
                  {
                    $("#error").fadeOut(10)
                    
                    $("#error").fadeIn(10, function(){
                      $("#btn-submit").html('Signing Up');
                      $("#error").html('<div class="alert alert-success"><span class="glyphicon glyphicon-info-sign"></span> &nbsp;  you  are now  registered </div>');
                    });
                    setTimeout(function(){
                        window.location.href="index.php";
                      }, 2000);
                    
                  }
                  else{
                    $("#error").fadeOut(10)
                    
                      $("#error").fadeIn(10, function(){
  
                          $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');
  
                          $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');
  
                      });
  
                  }
              }
          });
          return false;
      }
      
});
