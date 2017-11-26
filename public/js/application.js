appConfig = {}

initialize = function () {
  document.getElementById("loading-area").style.display = 'block';
  $(window).unload(function() {
        document.getElementById("loading-area").style.display = 'none';
  });

  $(document).ready(function(){
    appConfig.initDataTable();
    appConfig.initCustomMultiSelect();
    appConfig.initCustomSelect();
    appConfig.bloquearInspecionar();
    appConfig.bloquearPrint();
  });

}

appConfig.ajaxDynamicSimpleCombo = function(controller, metodo, areaLoadSelect, limparComboMetodo, id, idSelected) {
  if(id == '' || id == undefined) {
    metodo = limparComboMetodo;
  }
  var urlLoad = url+controller+"/"+metodo+"/"+id;
  if(idSelected == '' || idSelected == undefined) {
    var urlLoad = url+controller+"/"+metodo+"/"+id+"/"+idSelected;
  }
  document.getElementById("loading-area").style.display = 'block';
  $(areaLoadSelect).load(urlLoad,function(data, sucess, response){
    appConfig.initCustomSelect();
    document.getElementById("loading-area").style.display = 'none';
  });
};

appConfig.clearCombo = function(limparFilial, limparAno, limparCurso, limparProfessor, limparDisciplina) {
  if(limparAno && document.getElementById('cadArquivoAno') !== undefined && document.getElementById('cadArquivoAno') !== null) {
    if(document.getElementById('cadArquivoAno').value !== '') {
      appConfig.ajaxDynamicSimpleCombo('ano', 'buscarAnoPorFilialCombo', '#loadComboAno', 'limparComboAnoPorFilialEInstituicao' , document.getElementById('cadArquivoFilial').value+'/'+document.getElementById('cadArquivoInstituicao').value);
    }
  }
  if(limparDisciplina && document.getElementById('cadArquivoDisciplina') !== undefined && document.getElementById('cadArquivoDisciplina') !== null) {
    if(document.getElementById('cadArquivoDisciplina').value !== '') {
      appConfig.ajaxDynamicSimpleCombo('disciplina', 'buscarDisciplinaPorProfessorCombo', '#loadComboDisciplina', 'limparComboDisciplinaPorProfessor', document.getElementById('cadArquivoProfessor').value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value+'/'+document.getElementById('cadArquivoAno').value+'/'+document.getElementById('cadArquivoCurso').value);
    }
  }
  if(limparFilial && document.getElementById('cadArquivoFilial') !== undefined && document.getElementById('cadArquivoFilial') !== null) {
    if(document.getElementById('cadArquivoFilial').value !== '') {
      appConfig.ajaxDynamicSimpleCombo('filial', 'buscarFilialPorInsituicaoCombo', '#loadComboFilial', 'limparComboFilialPorInstituicao', document.getElementById('cadArquivoInstituicao').value);
    }
  }
  if(limparProfessor && document.getElementById('cadArquivoProfessor') !== undefined && document.getElementById('cadArquivoProfessor') !== null) {
    if(document.getElementById('cadArquivoProfessor').value !== '') {
      appConfig.ajaxDynamicSimpleCombo('professor', 'buscarProfessorPorCursoCombo', '#loadComboProfessor', 'limparComboProfessorPorCurso', document.getElementById('cadArquivoCurso').value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value+'/'+document.getElementById('cadArquivoAno').value);
    }
  }
  if(limparCurso && document.getElementById('cadArquivoCurso') !== undefined && document.getElementById('cadArquivoCurso') !== null) {
    if(document.getElementById('cadArquivoCurso').value !== '') {
      appConfig.ajaxDynamicSimpleCombo('curso', 'buscarCursoPorAnoCombo', '#loadComboCurso', 'limparComboCursoPorAno', document.getElementById('cadArquivoAno').value+'/'+document.getElementById('cadArquivoInstituicao').value+'/'+document.getElementById('cadArquivoFilial').value);
    }
  }
  return initComboCallBack();
}

var initComboCallBack = function () {
    appConfig.initCustomSelect();
}

appConfig.ajaxDynamicSimple = function(controller, metodo, areaLoadSelect, limparComboMetodo, id) {
  if(id == '' || id == undefined) {
    metodo = limparComboMetodo;
  }
  var urlLoad = url+controller+"/"+metodo+"/"+id;
  document.getElementById("loading-area").style.display = 'block';
  $(areaLoadSelect).load(urlLoad,function(data, sucess, response){
    document.getElementById("loading-area").style.display = 'none';
  });
};

appConfig.ajaxDynamicFormPost = function(buttomId, areaLoad, controller, metodo) {
  $("#"+buttomId).submit(function () {
    document.getElementById("loading-area").style.display = 'block';
    var dados = jQuery(this).serialize();
    $.ajax({
      url: url + controller+"/"+metodo,
      data: {
        dados: dados,
      },
      type: "POST",
      success: function (data) {
        document.getElementById("loading-area").style.display = 'none';
      }
    });
  });
}

appConfig.initCustomSelect = function () {
  $(document).ready(function() {
    $("select").customselect({
      search: true,
      mobilecheck: false,
      showblank: false,
      showdisabled: true
    });
  });
}

appConfig.initDataTable = function () {
  $(document).ready(function(){
      $('.table-list').DataTable({
      "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ Resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
      "oPaginate": {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
      },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      }
    });
  });
}

appConfig.initCustomMultiSelect = function () {
  $(function() {
    $('.multi-select-app').multiSelect({
      selectableHeader: "<div class='custom-header'>Selecione</div><input type='text' class='search-input form-control' autocomplete='off' placeholder='Pesquise'>",
      selectionHeader: "<div class='custom-header'>Selecionados</div><input type='text' class='search-input form-control' autocomplete='off' placeholder='Pesquise'>",
      afterInit: function(ms){
        var that = this,
            $selectableSearch = that.$selectableUl.prev(),
            $selectionSearch = that.$selectionUl.prev(),
            selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
            selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });
  });
}

appConfig.bloquearInspecionar = function () {

}

appConfig.bloquearPrint = function () {
  function limpeza(){
    window.clipboardData.setData('text','')
  }
  function limpeza2(){
    if(clipboardData){
      clipboardData.clearData();
    }
  }
  setInterval("limpeza2();", 1000);
}
