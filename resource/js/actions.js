// Confirm Button in Denied
function confirmDenied(){
    $("#remarks-dialog").submit(function(e) {
        e.preventDefault();
    
        var a = $('#remarks').val();
        var b = $('#did').val();
        if (Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'Do you really want to DENY these record? This process cannot be undone.',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been Successfully Denied',
                        text: 'Sending an email to the client, please wait...',
                        showCancelButton: false,
                        showConfirmButton: false,
                        showConfirmText: 'Confirm',
                        timerProgressBar: true, 
                        timer: 6000
                    }).then(okay => {
                                  if (okay) {
                                      window.location.href = 'info.php?id=' + b;
                                 }
                       });
                    $.ajax({
                        url: '/caveportal/resource/controllers/confirmremarks.php',
                        type: 'POST',
                        data: {
                            remarks: a,
                            did: b
                        },
                        success: function(response) {
                            
                           
                            console.log(response);
    
                        },
                        error: function(response) {
                            console.log(a + b);
                        }
                    })
    
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }));
    
    });
}

// Confirm Button in Hold
function confirmHold(){
    $("#remarks-dialog").submit(function(e) {
        e.preventDefault();
    
        var a = $('#remarks').val();
        var b = $('#hld').val();
        if (Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'Do you really want to HOLD these record? This process cannot be undone.',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been Successfully put On Hold',
                        text: 'Sending an email to the client, please wait...',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timerProgressBar: true, 
                        timer: 6000
                    }).then(okay => {
                                  if (okay) {
                                      window.location.href = 'info.php?id=' + b;
                                 }
                       });
                    $.ajax({
                        url: '/caveportal/resource/controllers/confirmhold.php',
                        type: 'POST',
                        data: {
                            remarks: a,
                            hld: b
                        },
                        success: function(response) {
                            
                           
                            console.log(response);
    
                        },
                        error: function(response) {
                            console.log(a + b);
                        }
                    })
    
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }));
    
    });
}

// Confirm Button in Approve
function confirmApprove(){
    $("#approve-dialog").submit(function(e) {
        e.preventDefault();
    
        var a = $('#apd').val();
        console.log(a);
        if (Swal.fire({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'Do you really want to APPROVE these record? This process cannot be undone.',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data has been Successfully Approved',
                        text: 'Sending an email to the client, please wait...',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timerProgressBar: true, 
                        timer: 6000
                    }).then(okay => {
                                  if (okay) {
                                      window.location.href = 'info.php?id=' + b;
                                 }
                       });
                    $.ajax({
                        url: '/caveportal/resource/controllers/confirmapprove.php',
                        type: 'POST',
                        data: {
                            apd: a
                        },
                        success: function(response) {
                            
                           
                            console.log(response);
    
                        },
                        error: function(response) {
                            console.log(a + b);
                        }
                    })
    
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }));
    
    });
}


