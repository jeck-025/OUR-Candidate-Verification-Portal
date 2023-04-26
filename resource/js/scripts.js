$(document).ready(function () {
  window.$("#candtable").dataTable({
    select: {
      style: "multi",
      selector: "td:first-child",
    },
  });
});

$(document).ready(function () {
  window.$("#onHoldtable").dataTable({
    select: {
      style: "multi",
      selector: "td:first-child",
    },
  });
});

$(document).ready(function () {
  window.$("#pendingtable").dataTable({
    select: {
      style: "multi",
      selector: "td:first-child",
    },
  });
});

$(document).ready(function () {
  window.$("#deniedtable").dataTable({
    select: {
      style: "multi",
      selector: "td:first-child",
    },
  });
});

$(document).ready(function () {
  window.$("#viewlogtable").dataTable({
    scrollX: true,
    dom:
      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5 mt-1'B><'col-sm-12 col-md-7'p>>",
    select: {
      style: "multi",
      selector: "td:first-child",
    },
    buttons: [
      {
        extend: "excelHtml5",
        className: "btn btn-success",
        text: "Excel",
        titleAttr: "Export to Excel",
        title: "CavePortal Reports",
      },
      {
        extend: "csvHtml5",
        className: "btn btn-primary",
        text: "CSV",
        titleAttr: "CSV",
        title: "CavePortal Reports",
      },
    ],
  });
});

function stopEvent(event) {
  event.preventDefault();
}

var uploadField = document.getElementById("diploma");

uploadField.onchange = function () {
  if (this.files[0].size > 2097152) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "File is too big. Please upload a file that is less than 2MB",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 2500,
      });
    this.value = "";
  }
};

var consentField = document.getElementById("consent");

consentField.onchange = function () {
  if (this.files[0].size > 2097152) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "File is too big. Please upload a file that is less than 2MB",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 2500,
      });
    this.value = "";
  }
};

var vIdField = document.getElementById("validID");

vIdField.onchange = function () {
  if (this.files[0].size > 2097152) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "File is too big. Please upload a file that is less than 2MB",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 2500,
      });
    this.value = "";
  }
};

var ID = document.getElementById("validID");

vIdField.onchange = function () {
  if (this.files[0].size > 2097152) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "File is too big. Please upload a file that is less than 2MB",
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 2500,
      });
    this.value = "";
  }
};
