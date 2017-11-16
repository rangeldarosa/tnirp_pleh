<?php

class Arquivo extends Controller {

    function __construct()  {
        parent::__construct();
        require APP . 'util/Util.php';
        require APP . 'model/ArquivoModel.php';
        require APP . 'model/InstituicaoModel.php';
        $this->arquivoModel = new ArquivoModel($this->db);
        $this->instituicaoModel = new InstituicaoModel($this->db);
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
            
            if($this->arquivoModel->salvarArquivo($arquivo)) {
                $dir = $_SERVER["DOCUMENT_ROOT"]."/tnirp_pleh/documentos/";
                echo $dir.$novoNome;
                echo move_uploaded_file($_FILES['cadArquivoFile']['tmp_name'],$dir.$novoNome);
                Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo, inserido com sucesso");
                header('location: ' . URL . 'arquivo/');
            }
        }
    }

    public function editarCurso($cdArquivo){
        
        //$cursos = $this->model->listarCursosAtivos();
        //$curso = $this->model->buscarCursoPorCodigo($cdCurso);
        
        require APP . 'view/_templates/header.php';
        require APP . 'view/arquivo/index.php';
        require APP . 'view/_templates/footer.php';
        
        if($cdArquivo && isset($_POST))  {
        
            $arquivoEdit = array();
        
            if(!empty($_POST["cadArquivoNome"]) && !empty($_POST["cadArquivoValorPeB"]) && 
                !empty($_POST["cadArquivoValorColor"]) && !empty($_POST['cadArquivoPaginas']) && 
                !empty($_FILES['cadArquivoFile'])) {

                $nomeOriginal = $_FILES['cadArquivoFile']['name'];
                $novoNome = sha1($_FILES['cadArquivoFile']['name']+rand()).".pdf";

                $arquivoEdit["nome"] = $_POST["cadArquivoNome"];
                $arquivoEdit["paginas"] = $_POST['cadArquivoPaginas'];
                $arquivoEdit["caminho_para_o_arquivo"] = $novoNome;
                $arquivoEdit["arquivo_privado"] = $_POST['cadArquivoArqPrivado'];
                $arquivoEdit["estado"] = $_POST['cadArquivoEstado'];
                $arquivoEdit["valor_preto_e_branco"] = $_POST['cadArquivoValorPeB'];
                $arquivoEdit["valor_colorido"] = $_POST['cadArquivoValorColor'];
        
                if($this->model->alterarArquivo($arquivoEdit, $cdArquivo)) {
        
                    
        
                    Util::retornarMensagemSucesso("Sucesso!", null, "Arquivo, Alterado com sucesso");
                    header('location: ' . URL . 'arquivo/');
                 } else {
                    Util::retornarMensagemErro("Erro ao alterar o Arquivo!", "ERRO NO UPDATE", "Aconteceu algo errado ao atualizar o arquivo");
                }
            }
        }
    }

}
