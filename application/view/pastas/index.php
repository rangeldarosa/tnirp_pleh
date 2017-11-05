<script>
  $(document).ready(function() {
    appConfig.ajaxDynamicSimple('pastas', 'buscaPastasByPages', '#loadPastas', 'limparPastasByPages', 'instituicao/1/null/null/null/null/null');
  });
</script>
<div class="container-fluid">
  <div class="pastas-area">
    <h2 class="text-center">Procure seu Arquivo</h2><br>
    <?php
    include APP . 'view/_templates/alerts/alerts.tpl.php';
    ?>
    <div id="loadPastas"></div>
  </div>
