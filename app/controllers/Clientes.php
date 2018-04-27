<?php
  class Clientes extends Controller {
    public function __construct(){
        $this->clienteModel = $this->model('Cliente');
    }

    public function index(){
        if(isLoggedIn()){
          redirect('clientes/editar/' . $_SESSION['id_cliente']);
        } else {

            // Init data
            $data =[    
            'email' => '',
            'senha' => '',
            'email_err' => '',
            'senha_err' => '',        
            ];
            
            //Carrega view
            $this->view('clientes/login', $data);
        }
      }

    public function registrar(){
            // Checa pelo POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Init data
                $data = [
                    'nome' => trim($_POST['nome']),
                    'email' => trim($_POST['email']),
                    'telefone' => trim($_POST['telefone']),
                    'senha' => trim($_POST['senha']),
                    'confirma_senha' => trim($_POST['confirma_senha']),                   
                    'data_nascimento' => trim($_POST['data_nascimento']),
                    'nome_err' => '',
                    'email_err' => '',
                    'telefone_err' => '',
                    'senha_err' => '',
                    'confirma_senha_err' => '',
                    'data_nascimento_err' => ''
                ];

                // Validação do nome
                if (empty($data['nome'])) {
                    $data['nome_err'] = 'Por favor digite seu nome';
                }           
                
                // Validação do email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Por favor digite seu email';
                } else {
                    //Checa email
                    if ($this->clienteModel->findClienteByEmail($data['email'])) {
                        $data['email_err'] = "Esse email já foi registrado";
                    }
                }

                // Validação do telefone
                if (empty($data['telefone'])) {
                    $data['telefone_err'] = 'Por favor digite seu telefone';
                }     

                // Validação da senha
                if (empty($data['senha'])) {
                    $data['senha_err'] = 'Por favor digite sua senha';
                } elseif (strlen($data['senha']) < 5) {
                    $data['senha_err'] = 'Sua senha deve conter mais de 5 caracteres';
                }

                // Validação da confirmação da senha
                if(empty($data['confirma_senha'])) {
                    $data['confirma_senha_err'] = 'Por favor confirme sua senha';
                } else {
                    if ($data['senha'] != $data['confirma_senha']) {
                        $data['confirma_senha_err'] = 'As senhas não conferem';
                    }
                }
        
                // Validação da data de nascimento
                if (empty($data['data_nascimento'])) {
                    $data['data_nascimento_err'] = 'Por favor digite a data de seu nascimento';
                } else {
                    //Converter do padrão do form dd/mm/YYYY para o padrão do banco YYYY-mm-dd
                    $data['data_nascimento'] = str_replace('/', '-', $data['data_nascimento']);
                    $data['data_nascimento'] = date('Y-m-d', strtotime($data['data_nascimento']));
                }
                
                // Confere se os erros estão vazios
                if (empty($data['nome_err']) && empty($data['email_err']) && empty($data['telefone_err']) &&
                    empty($data['senha_err']) && empty($data['confirmar_senha_err']) && empty($data['data_nascimento_err'])) {

                    // Hash senha
                    $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

                    // Registra Cliente
                    if ($this->clienteModel->registrar($data)) {
                        redirect('clientes/index');
                    } else {
                        die('Ocorreu um erro');
                    }

                } else {
                    // Carrega view com erros
                    $this->view('clientes/registrar', $data);
                }

            } else {
                // Init data
                $data = [
                    'nome' => '',
                    'email' => '',
                    'telefone' => '',
                    'senha' => '',
                    'confirma_senha' => '',                   
                    'data_nascimento' => '',
                    'nome_err' => '',
                    'email_err' => '',
                    'telefone_err' => '',
                    'senha_err' => '',
                    'confirma_senha_err' => '',
                    'data_nascimento_err' => ''
                ];

                // Carrega view
                $this->view('clientes/registrar', $data);
            }
        }

        public function login()
        {
            // Checa pelo POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Init data
                $data = [
                    'email' => trim($_POST['email']),                   
                    'senha' => trim($_POST['senha']),
                    'email_err' => '',
                    'senha_err' => ''
                ];

                //Valida Email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Por favor insira seu email';
                }

                //Valida Senha
                if (empty($data['senha'])) {
                    $data['senha_err'] = 'Por favor insira sua senha';
                }

                // Checa pelo cliente/email
                if ($this->clienteModel->findClienteByEmail($data['email'])) {
                    // Cliente encontrado
                } else {
                    // Cliente não encontrado
                    $data['email_err'] = 'Nenhum cliente encontrado';
                }

                //Confere se os erros estão vazios
                if (empty($data['email_err']) && empty($data['senha_err'])) {
                    //Checa e seta usuario logado
                    $loggedInUser = $this->clienteModel->login($data['email'], $data['senha']);
                    
                    if ($loggedInUser) {
                       //Cria Session
                       $this->criarSessionCliente($loggedInUser);
                    } else {
                        $data['senha_err'] = 'Senha incorreta';

                        $this->view('clientes/login', $data);
                    }
                } else {
                    // Carrega view com erros
                    $this->view('clientes/login', $data);
                }                

            } else {
                // Init data
                $data = [
                    'email' => '',
                    'senha' => '',
                    'email_err' => '',
                    'senha_err' => ''
                ];        
                
                // Carrega view
                $this->view('clientes/login', $data);
            }
        }

        public function editar($id){
            if($id != $_SESSION['id_cliente']){
                redirect('clientes/editar/'. $_SESSION['id_cliente']);
            }
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              // Sanitize POST array
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
              $data = [
                'id' => $id,
                'nome' => trim($_POST['nome']),
                'email' => trim($_POST['email']),
                'telefone' => trim($_POST['telefone']),
                'senha' => trim($_POST['senha']),
                'confirma_senha' => trim($_POST['confirma_senha']),                   
                'data_nascimento' => trim($_POST['data_nascimento']),
                'id_cliente' => $_SESSION['id_cliente'],
                'nome_err' => '',
                'email_err' => '',
                'telefone_err' => '',
                'senha_err' => '',
                'confirma_senha_err' => '',
                'data_nascimento_err' => ''
              ];
      
              // Valida data
            if (empty($data['nome'])) {
                $data['nome_err'] = 'Por favor digite seu nome';
            }           
            
            if (empty($data['email'])) {
                $data['email_err'] = 'Por favor digite seu email';
            } else {
                if ($this->clienteModel->findClienteByEmail($data['email']) != $_SESSION['email_cliente']) {
                    $data['email_err'] = "Esse email já foi registrado";
                }
            }

            if (empty($data['telefone'])) {
                $data['telefone_err'] = 'Por favor digite seu telefone';
            }     

            if (empty($data['senha'])) {
                $data['senha_err'] = 'Por favor digite sua senha';
            } elseif (strlen($data['senha']) < 5) {
                $data['senha_err'] = 'Sua senha deve conter mais de 5 caracteres';
            }

            if(empty($data['confirma_senha'])) {
                $data['confirma_senha_err'] = 'Por favor confirme sua senha';
            } else {
                if ($data['senha'] != $data['confirma_senha']) {
                    $data['confirma_senha_err'] = 'As senhas não conferem';
                }
            }
    
            if (empty($data['data_nascimento'])) {
                $data['data_nascimento_err'] = 'Por favor digite a data de seu nascimento';
            } else {
                //Converter do padrão do form dd/mm/YYYY para o padrão do banco YYYY-mm-dd
                $data['data_nascimento'] = str_replace('/', '-', $data['data_nascimento']);
                $data['data_nascimento'] = date('Y-m-d', strtotime($data['data_nascimento']));
            }
      
              // Confere se os erros estão vazios
              if (empty($data['nome_err']) && empty($data['email_err']) && empty($data['telefone_err']) &&
              empty($data['senha_err']) && empty($data['confirmar_senha_err']) && empty($data['data_nascimento_err'])) {
              
                //Hash senha
                $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
                
                if($this->clienteModel->editar($data)){
                  redirect('clientes');
                } else {
                  die('Something went wrong');
                }
              } else {
                // Carrega views com erros
                $this->view('clientes/editar', $data);
              }
      
            } else {
              // Get existing post from model
              $cliente = $this->clienteModel->getClienteById($id);

                //Converter do padrão do banco YYYY-mm-dd para o padrão do form dd/mm/YYYY
                $cliente->data_nasc_cliente = str_replace('-', '/', $cliente->data_nasc_cliente);
                $cliente->data_nasc_cliente = date('d/m/Y', strtotime($cliente->data_nasc_cliente));
      
              // Check for owner
              if($cliente->id_cliente != $_SESSION['id_cliente']){
                redirect('clientes');
              }
      
              $data = [
                'id' => $id,
                'nome' => $cliente->nome_cliente, 
                'email' =>  $cliente->email_cliente,
                'telefone' =>  $cliente->telefone_cliente,
                'senha' =>   '',
                'confirma_senha' => '',                   
                'data_nascimento' =>  $cliente->data_nasc_cliente
              ];
        
              $this->view('clientes/editar', $data);
            }
          }

        public function criarSessionCliente($cliente){
            $_SESSION['id_cliente'] = $cliente->id_cliente;
            $_SESSION['email_cliente'] = $cliente->email_cliente;
            $_SESSION['nome_cliente'] = $cliente->nome_cliente;
            redirect('clientes');
        }
      
        public function logout(){
            unset($_SESSION['id_cliente']);
            unset($_SESSION['email_cliente']);
            unset($_SESSION['nome_cliente']);
            session_destroy();
            redirect('clientes/login');
        }  

}