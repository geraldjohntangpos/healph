function checkSubmit() {
   if($('input[name="oldpass"]').val() == "" || $('input[name="newpass"]').val() ==  "" || $('#oldpassMessage').text() != "" || $('#newpassMessage').text() != "") {
            $('#submit').attr('disabled', 'disabled');
      }
      else {
            $('#submit').removeAttr('disabled');
      }
}

$('#submit').ready(function() {
   checkSubmit();
});

$('input[name="oldpass"]').keyup(function() {
   var id = $("#cid").text();
//	var id = 13;
   var inputval = $(this).val();
   function checkthis(ss, id) {
      var message = "";
      var theData = "accountid=" +id+ "&pass=" +ss;
      console.log(theData);
      if(ss != "") {
         $.ajax({
            type: "POST",
            url: "queries/checkpass.php",
            data: theData,
            dataType: 'json',
            async: false,
            success: function(data) {
               var mess = "";
               if(!data) {
                  mess = "Old password do not match. Enter correct password";
               }
               console.log(data);
               return message = mess;
            }
         });

      }
      else {
         message = "Enter old password";
      }

      if(message != "") {
         message += " please!";
      }

      return message;
   }

   $('#oldpassMessage').text(checkthis(inputval, id));
   checkSubmit();

});

$('input[name="newpass"]').keyup(function() {

   var inputval = $(this).val();
   function checkthis(ss) {
      var message = "";

      if(ss == "") {
         message = "Enter new password";
      }
      else {
         if(ss.length < 5) {
            message = "Enter atleast 5 characters";
         }
      }

      if(message != "") {
         message += " please!";
      }
      return message;
   }

   $('#newpassMessage').text(checkthis(inputval));
   checkSubmit();

});
