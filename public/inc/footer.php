
 <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark navbar-border">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2025 <a class="text-bold-800 grey darken-2" href="#" target="_blank">BURO STORE </a></span><span class="float-md-right d-none d-lg-block">Fait avec<i class="feather icon-heart pink"></i></span></p>
    </footer>
    <!-- END: Footer-->


<?= require_once 'links/footer.php'; ?>
    <!-- END: Page JS-->
<script>
  $(function () {
    $('.dataex-visibility-disable').DataTable()
    $('.datatable-commune').DataTable();
    $('.database-ville').DataTable();
    $('.database-poste').DataTable();
    $('.database-branche').DataTable();
    $('.datatable-listeVersement').DataTable();

  })
  setTimeout(function() {
    $('.datatable-paiement').DataTable();
}, 500);

</script>

<script>
  tinymce.init({
    selector: '#description_produit',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>


<script>
  // Cibler tous les éléments avec la classe "retour"
  document.querySelectorAll('.retour').forEach(function(btn) {
    btn.addEventListener('click', function() {
      window.history.back(); // Retour à la page précédente
    });
  });
</script>

</body>

</html>



