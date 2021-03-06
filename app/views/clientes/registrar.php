<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-light mt-5">
        <h2>Criar uma conta</h2>
        <form action="<?php echo URLROOT; ?>/clientes/registrar" id="form" method="POST">
          <div class="form-group">
            <label for="nome">Nome: <sup>*</sup></label>
            <input type="text" id="nome" name="nome" class="form-control form-control-lg <?php echo (!empty($data['nome_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nome']; ?>">
            <span class="invalid-feedback"><?php echo $data['nome_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" id="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="data_nascimento">Data de nascimento: <sup>*</sup></label>
            <input type="text" id="data_nascimento" name="data_nascimento" class="form-control form-control-lg <?php echo (!empty($data['data_nascimento_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['data_nascimento']; ?>">
            <span class="invalid-feedback"><?php echo $data['data_nascimento_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="telefone">Telefone: <sup>*</sup></label>
            <input type="text" id="telefone" name="telefone" class="form-control form-control-lg <?php echo (!empty($data['telefone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['telefone']; ?>">
            <span class="invalid-feedback"><?php echo $data['telefone_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="senha">Senha: <sup>*</sup></label>
            <input type="password" id="senha" name="senha" class="form-control form-control-lg <?php echo (!empty($data['senha_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['senha']; ?>">
            <span class="invalid-feedback"><?php echo $data['senha_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="confirma_senha">Confirmar Senha: <sup>*</sup></label>
            <input type="password" id="confirma_senha" name="confirma_senha" class="form-control form-control-lg <?php echo (!empty($data['confirma_senha_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirma_senha']; ?>">
            <span class="invalid-feedback"><?php echo $data['confirma_senha_err']; ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="Registrar" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/clientes/login" class="btn btn-light btn-block">Tem uma conta? Login</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>