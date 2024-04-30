<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Light Gallery Plugin Js -->
<script src="../plugins/light-gallery/js/lightgallery-all.js"></script>

<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/tables/jquery-datatable.js"></script>
<script src="../js/pages/forms/editors.js"></script>


<!-- Demo Js -->
<script src="../js/demo.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="../plugins/sweetalert/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>


<!-- databales net -->
<script src="../plugins/datatables_asset/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables_asset/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<!-- <script src="../plugins/datatables_asset/datatables.net-scroller/js/datatables.scroller.min.js"></script> -->
<script src="../plugins/datatables_asset/jszip/dist/jszip.min.js"></script>
<script src="../plugins/datatables_asset/pdfmake/build/pdfmake.min.js"></script>
<script src="../plugins/datatables_asset/pdfmake/build/vfs_fonts.js"></script>

<!-- Multi Select Plugin Js -->
<script src="../plugins/multi-select/js/jquery.multi-select.js"></script>

<!-- select2 -->
<script type="text/javascript" src="../plugins/select/dist/js/select2.min.js"></script>

<!-- toastr js -->
<script type="text/javascript" src="../plugins/toastr/js/toastr.min.js"></script>

<!-- Ckeditor -->
<!-- <script src="../plugins/ckeditor/ckeditor.js"></script> -->

<!-- TinyMCE -->
<script src="../plugins/tinymce/tinymce.js"></script>

<!--<script type="text/javascript" src="../plugins/mycustom/js/jquery-ui.min.js"></script> -->

<!-- amcharts -->
<script type="text/javascript" src="../plugins/amcharts/amcharts.js"></script>
<script type="text/javascript" src="../plugins/amcharts/serial.js"></script>
<script type="text/javascript" src="../plugins/amcharts/plugins/export/export.min.js"></script>
<script type="text/javascript" src="../plugins/amcharts/themes/light.js"></script>
<script type="text/javascript" src="../plugins/amcharts/pie.js"></script>


<script type="text/javascript">
        function getAge() {
            var today = new Date();
            var birthDate = new Date($('#bday').val());
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            $('#age').val(age);
        }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();

        document.body.innerHTML = originalContents;
    }

    $('.select').select2({
        width: "100%",
        placeholder: "Select",
        maximumSelectionSize: 1,
        allowClear: true,
    });

</script>


</body>

</html>