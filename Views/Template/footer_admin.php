<script>
  const base_url = "<?= base_url(); ?>";
</script>
<!-- jQuery -->
<script src="<?= media(); ?>/js/jquery-ui/jquery-3.6.0.min.js"></script>
<script src="<?= media(); ?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?= media(); ?>/js/jquery-ui/jquery-ui.min.js"></script>

<!-- Bootstrap -->
<script src="<?= media(); ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?= media(); ?>/js/plugins/selectpicker/bootstrap-select.min.js"></script>
<!-- FastClick -->
<script src="<?= media(); ?>/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?= media(); ?>/vendors/nprogress/nprogress.js"></script>

<!-- dataTAble -->
<script src="<?= media(); ?>/dataTables/datatables.min.js"></script>

<!-- sweetalert js -->
<script src="<?= media(); ?>/Alert/dist/sweetalert2.all.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?= media(); ?>/build/js/custom.min.js"></script>

<script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>


</body>

</html>