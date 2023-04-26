$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyGD', function () {
            var a = $(this).data("id");
            $("#verifydategrad").submit(function (e) {  
                e.preventDefault();
                this.a = a;
                var b = $('#vfdategrad').val();
                

                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/verifyDateGrad.php',
                        data: {
                            did: a,
                            vfdategrad: b
                        },
                        success: function (response) {
                            $('#verify-date-grad').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Graduation Date Verified',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 1500
                            }).then(function (result) {
                                if (true) {
                                    window.location = 'info.php?id=' + a;
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