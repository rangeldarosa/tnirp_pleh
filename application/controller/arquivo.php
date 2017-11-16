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
       
        if(isset($_POST["cadArquivoNome"]) && isset($_POST["cadArquivoValorPeB"]) && 
            isset($_POST["cadArquivoValorColor"]) && isset($_POST['cadArquivoPaginas']) && 
            isset($_FILES['cadArquivoFile'])) {

            $nomeOriginal = $_FILES['cadArquivoFile']['name'];
            $novoNome = sha1($_FILES['cadArquivoFile']['name']+rand()).".pdf";

            $arquivo["nome"] = $_POST["cadArquivoNome"];
            $arquivo["paginas"] = $_POST['cadArquivoPaginas'];
            $arquivo["caminho_para_o_arquivo"] = $novoNome;
            $arquivo["arquivo_privado"] = $_POST['cadArquivoArqPrivado'];
            $arquivo["estado"] = $_POST['cadArquivoEstado'];
            $arquivo["valor_preto_e_branco"] = $_POST['cadArquivoValorPeB'];
            $arquivo["valor_colorido"] = $_POST['cadArquivoValorColor'];

            $disciplina = $_POST['cadArquivoDisciplina'];
            
            if($this->arquivoModel->salvarArquivo($arquivo)) {
                $dir = $_SERVER["DOCUMENT_ROOT"]."/tnirp_pleh/documentos/";
                move_uploaded_file($_FILES['cadArquivoFile']['tmp_name'],$dir.$novoNome);
                $arquivoCadastrado = $this->arquivoModel->buscarUltimoArquivoCadastrado();
                $this->auxiliarDisciplina->salvarDisciplinaArquivo($arquivoCadastrado[0]->CD_ARQUIVO,$disciplina);
                Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo, inserido com sucesso");
                header('location: ' . URL . 'arquivo/');
            }
        }
    }

}