<?php
// Verificar se o ID do usuário foi fornecido
if (isset($_GET['id'])) {
  // Obter o ID do usuário
  $user_id = $_GET['id'];

  // Realizar a conexão com o banco de dados
  $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

  // Verificar se a conexão foi estabelecida com sucesso
  if (!$conn) {
    die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
  }

  // Verificar se o formulário foi enviado
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o botão de confirmação foi clicado
    if (isset($_POST['confirm'])) {
      // Preparar a consulta SQL para excluir o usuário
      $query = "DELETE FROM user WHERE id_user = $user_id";

      // Executar a consulta SQL
      if (mysqli_query($conn, $query)) {
        echo '<script>alert("Usuário excluído com sucesso!");</script>';
      } else {
        echo 'Erro ao excluir o usuário: ' . mysqli_error($conn);
      }
    } else {
      echo '<script>alert("Exclusão cancelada.");</script>';
    }

    // Redirecionar de volta à página de usuários após o processamento
    echo '<script>window.location.href = "user_admin.php";</script>';
    exit();
  }

  // Fechar a conexão com o banco de dados
  mysqli_close($conn);
} else {
  echo 'ID do usuário não fornecido.';
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">
  <title>Confirmar Exclusão</title>
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
    }

    p {
      margin-bottom: 20px;
    }

    form {
      display: inline-block;
    }

    button {
      margin: 5px;
      padding: 10px 20px;
      background-color: #FF8C00;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .eliminar {
      background-color: #FFA500;
    }
    .cancelar {
      background-color: #FFA500;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Confirmar Exclusão</h1>
    <p>Tem certeza que deseja excluir o usuário?</p>
    <form method="POST">
      <button type="submit" class="eliminar" name="confirm">Excluir</button>
      <button type="button" class="cancelar" onclick="window.location.href = 'user_admin.php'">Cancelar</button>
    </form>
  </div>
</body>
</html>
