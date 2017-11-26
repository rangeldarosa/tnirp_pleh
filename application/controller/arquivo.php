<?php

class Arquivo extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/ArquivoModel.php';
        require APP . 'model/InstituicaoModel.php';
        require APP . 'model/AuxiliarDisciplinaArquivo.php';

        $this->arquivoModel = new ArquivoModel($this->db);
        $this->instituicaoModel = new InstituicaoModel($this->db);
        $this->auxiliarDisciplina = new AuxiliarDisciplinaArquivo($this->db);
    }

    public function index() {
        Util::validarLogin();
        $listarInstituicoesCombo = $this->instituicaoModel->buscarTodosAsInstituicoes();
        $arquivos = $this->arquivoModel->buscarTodosOsArquivos();

        require APP . 'view/_templates/header.php';
        require APP . 'view/arquivo/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function salvarArquivo(){

        if(isset($_POST["cadArquivoNome"]) &&
            isset($_FILES['cadArquivoFile']) &&
            isset($_POST['cadArquivoArqPrivado']) &&
            isset($_POST['cadArquivoEstado']) &&
            isset($_POST['cadArquivoDisciplina'])) {

            $nomeOriginal = $_FILES['cadArquivoFile']['name'];
            $novoNome = sha1($_FILES['cadArquivoFile']['name']+rand()).".pdf";

            $arquivo["nome"] = $_POST["cadArquivoNome"];
            $arquivo["paginas"] = 1; //$_POST['cadArquivoPaginas'];
            $arquivo["caminho_para_o_arquivo"] = $novoNome;
            $arquivo["arquivo_privado"] = $_POST['cadArquivoArqPrivado'];
            $arquivo["estado"] = $_POST['cadArquivoEstado'];

            $disciplina = $_POST['cadArquivoDisciplina'];

            if($this->arquivoModel->salvarArquivo($arquivo)) {
                $dir = dirname(__FILE__);
                $dir = str_replace("application\controller","", $dir);
                $dir = str_replace("application/controller","", $dir);;
                $dir = $dir.'documentos/';
                move_uploaded_file($_FILES['cadArquivoFile']['tmp_name'],$dir.$novoNome);
                $qtPaginas = Util::numeroPaginas($novoNome);
                $arquivoCadastrado = $this->arquivoModel->buscarUltimoArquivoCadastrado();
                $this->auxiliarDisciplina->salvarDisciplinaArquivo($arquivoCadastrado[0]->CD_ARQUIVO,$disciplina);
                $this->arquivoModel->atualizarPaginaArquivo($arquivoCadastrado[0]->CD_ARQUIVO, $qtPaginas);
                Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo, inserido com sucesso");
                header('location: ' . URL . 'arquivo/');
            }
        }
    }

    public function bloquearArquivo($cdArquivo) {
        $this->arquivoModel->bloquearArquivo($cdArquivo);
    }

    public function desbloquearArquivo($cdArquivo) {
        $this->arquivoModel->desbloquearArquivo($cdArquivo);
    }

}
