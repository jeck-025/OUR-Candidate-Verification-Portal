$(document).ready(function() {
    load_data();
    var count = 1;

    function load_data() {
       $(document).on('click', '.changeD', function() {
          var a = $(this).data("id");
          $("#updatedocuments").submit(function(e) {
             e.preventDefault();
             this.a = a;
             var b = $('#diploma').val();
             var c = $('#consent').val();
             console.log('Test' + a);

             if (a === '' || b === ''|| c === '') {
                $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
             } else {
                $.ajax({
                   type: 'POST',
                   url: '/caveportal/resource/controllers/updateDocuments.php',
                   data: {
                      id: a,
                      diploma: b,
                      consent: c
                   },
                   success: function(response) {
                      $('#edit-documents').modal().hide();

                      swal.fire({
                         icon: 'success',
                         title: 'Success',
                         text: 'New Documents Upload Successfully',
                         showConfirmButton: false,
                         timerProgressBar: true,
                         timer: 1500
                      }).then(function(result) {
                         if (true) {
                            window.location = 'admindash';
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