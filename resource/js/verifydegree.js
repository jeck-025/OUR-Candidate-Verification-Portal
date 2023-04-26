$(document).ready(function () {
    load_data();
    var count = 1;

    function load_data() {
        $(document).on('click', '.verifyD', function () {
            var a = $(this).data("id");
            $("#verifydegree").submit(function (e) {
                e.preventDefault();
                this.a = a;
                var b = $('#vfdegree').val();
               

                if (a === '' || b === '') {
                    $('#smessage').html('<div class="alert alert-danger"> Required All Fields</div>');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '/caveportal/resource/controllers/verifyDegree.php',
                        data: {
                            did: a,
                            vfdegree: b
                        },
                        success: function (response) {
                            $('#verify-degree').modal().hide();

                            swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Degree Verified',
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 1500
                            }).then(function (result) {
                                if (true) {
                                    window.location = 'info.php?id='+a;
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