$(document).ready(function() {
    load_data();
    var count = 1;

    function load_data() {
       $(document).on('click', '.changeC', function() {
          var a = $(this).data("id");
          $("#updatecampus").submit(function(e) {
             e.preventDefault();
             this.a = a;
             var b = $('#campus').val();
            

             if (a === '' || b === '') {
                $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
             } else {
                $.ajax({
                   type: 'POST',
                   url: '/caveportal/resource/controllers/changeCampus.php',
                   data: {
                      did: a,
                      campus: b
                   },
                   success: function(response) {
                      $('#edit-campus').modal().hide();

                      swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: 'Campus Changed Successfully',
                         showConfirmButton: false,
                         timerProgressBar: true,
                         timer: 1500
                      }).then(function(result) {
                         if (true) {
                            window.location = 'info.php?id=' + a;
                         }
                      })

                   },
                   error: function(response) {
                      console.log("Failed");
                   }
                });
             }
          });
       })
    }

 });


$(document).ready(function () {
   load_data();
   var count = 1;

   function load_data() {
      $(document).on('click', '.changeC2', function () {
         var a = $(this).data("id");
         $("#updatecampus2").submit(function (e) {
            e.preventDefault();
            this.a = a;
            var b = $('#campus').val();


            if (a === '' || b === '') {
               $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
            } else {
               $.ajax({
                  type: 'POST',
                  url: '/caveportal/resource/controllers/changeCampus2.php',
                  data: {
                     did: a,
                     campus: b
                  },
                  success: function (response) {
                     $('#edit-campus2').modal().hide();

                     swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Campus Changed Successfully',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1500
                     }).then(function (result) {
                        if (true) {
                           window.location = 'admindash.php';
                        }
                     })

                  },
                  error: function (response) {
                     console.log("Failed");
                  }
               });
            }
         });
      })
   }

});