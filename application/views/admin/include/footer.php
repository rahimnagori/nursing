<script type="text/javascript" src="<?=site_url('assets/admin/');?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/admin/');?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/admin/');?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=site_url('assets/admin/');?>js/custom.js"></script>
<script type="text/javascript">

/*tabel*/
$('#extent_tbl1').DataTable();
/*tabel close*/
</script>
<script type="text/javascript">
  $(".toggle_us").click(function(){
    $(".sidebar").toggleClass("menu_open");
  });

  const BASE_URL = "<?=site_url();?>";
  const LOADING = "<i class='fa fa-spin fa-spinner' aria-hidden='true'></i> Processing ... ";
</script>
<script>
  $(function(){

$('.sidebar2 li a').filter(function(){return this.href==location.href}).parent().addClass('active').siblings().removeClass('active')

})
</script>

</body>
</html>