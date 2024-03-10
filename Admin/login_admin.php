<!DOCTYPE html>
<html>
<head>
<title>InstantCar-Admin</title>
<link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">
<script>
    function exibirAcessoNegado() {
      alert("Acesso negado!");
    }
  </script>
<style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }
    .container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      text-align: center;
    }

    h1 {
      margin-top: 0;
      color: #FF8C00;
      float: center;
    }

    p {
      margin-bottom: 20px;
      color: #555;
    }

    form {
      display: inline-block;
    }

    label {
      display: block;
      margin-bottom: 10px;
      text-align: left;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"],
    button {
      margin: 5px;
      padding: 10px 20px;
      background-color: #FF8C00;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button.cancelar {
      margin: 5px;
      padding: 10px 20px;
      background-color: #FF8C00;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
</style>
</head>
<body>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nome = $_POST['nome'];
      $senha = $_POST['senha'];

      if ($nome === "admin" && $senha === "admin") {
        header("Location: carro_admin.php"); // Redireciona para a página de administração
        exit();
      } else {
        echo "<script>exibirAcessoNegado();</script>"; // Exibe o alerta de acesso negado usando JavaScript
      }
    }
  ?>
 <div class="container">
 <h1>Administração do Site</h1>
  <form method="post">
    <label for="nome">Nome de usuário:</label>
    <input type="text" name="nome" required><br><br>
    <label for="senha">Senha:</label>
    <input type="password" name="senha" required><br><br>

    <input type="submit" value="Entrar">
    <button type="button" class="cancelar" onclick="window.location.href = '../principal/home.php'">Cancelar</button>
  </form>
 </div>
</body>
</html>
