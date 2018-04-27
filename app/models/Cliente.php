<?php
  class Cliente {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function registrar($data){
        $this->db->query('INSERT INTO clientes (nome_cliente, email_cliente, telefone_cliente,
        senha_cliente, data_nasc_cliente) VALUES (:nome, :email, :telefone, :senha, :data_nascimento)');
        //Bind values
        $this->db->bind(':nome', $data['nome']); 
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefone', $data['telefone']);
        $this->db->bind(':senha', $data['senha']);
        $this->db->bind(':data_nascimento', $data['data_nascimento']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function editar($data){
        $this->db->query('UPDATE clientes SET nome_cliente = :nome, email_cliente = :email, telefone_cliente = :telefone
        , senha_cliente = :senha, data_nasc_cliente = :data_nascimento WHERE id_cliente = :id');
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nome', $data['nome']); 
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefone', $data['telefone']);
        $this->db->bind(':senha', $data['senha']);
        $this->db->bind(':data_nascimento', $data['data_nascimento']);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }

      public function login($email, $senha)
      {
          $this->db->query('SELECT * FROM clientes WHERE email_cliente = :email');
          $this->db->bind(':email', $email);

          $row = $this->db->single();

          $senha_hashed = $row->senha_cliente;
          if (password_verify($senha, $senha_hashed)) {
              return $row;
          } else {
              return false;
          }
      }

      public function findClienteByEmail($email)
      {
          $this->db->query('SELECT * FROM clientes WHERE email_cliente = :email');
          $this->db->bind(':email', $email);

          $row = $this->db->single();
          if ($this->db->rowCount() > 0) {
              return true;
          } else {
              return false;
          }
      }

      public function getClienteById($id){
        $this->db->query('SELECT * FROM clientes WHERE id_cliente = :id');
        $this->db->bind(':id', $id);
  
        $row = $this->db->single();
  
        return $row;
      }



}