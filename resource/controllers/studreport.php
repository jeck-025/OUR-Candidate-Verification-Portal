<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
$id = $_POST['id'];
$viewtable = new viewtable();
$view = new view();
$mapname = $view->getccodeName($id);
?>
   <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
   <link rel="stylesheet" href="resource/css/studreport.css">


<h3 class='text-center pt-3'>Map Reports from <?php echo $mapname;?></h3>
<h5 class="card-title">Map Results <span>| Today</span></h5>
<a href="mapreport" type="button" class="btn btn-primary refresh mb-3"><i class="bi bi-arrow-repeat"></i>&nbsp
Refresh</a>
<table id='viewmaptable' class='table table-borderless table-hover shadow' width='100%'>
<?php $viewtable->viewMapResultTable($id); ?>
</table>


<script>
   
$(document).ready(function(){
    window.$('#viewmaptable').dataTable({
        scrollX: true,
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5 mt-1'B><'col-sm-12 col-md-7'p>>",
        select: {
            style: 'multi',
            selector: 'td:first-child'
        },
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-success',
                text: 'Excel',
                titleAttr: 'Export to Excel',
                title: 'CavePortal Map Reports',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-primary',
                text: 'CSV',
                titleAttr: 'CSV',
                title: 'CavePortal Map Reports',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger',
                text: 'PDF',
                titleAttr: 'PDF',
                title: 'CavePortal Map Reports',
                pageSize: 'TABLOID',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            }
        ]
        
    });
});

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>
