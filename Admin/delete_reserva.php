<?php
// Verificar se o ID da reserva foi fornecido
if (isset($_GET['id'])) {
  // Obter o ID da reserva
  $reserva_id = $_GET['id'];

  // Verificar se o botão de exclusão foi clicado
  if (isset($_POST['confirm'])) {
    // Realizar a conexão com o banco de dados
    $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    // Preparar a consulta SQL para excluir a reserva
    $query = "DELETE FROM reserva WHERE id_reserva = $reserva_id";

    // Executar a consulta SQL
    if (mysqli_query($conn, $query)) {
      // Redirecionar de volta para a página de reservas
      header('Location: reserva_admin.php');
      exit();
    } else {
      echo 'Erro ao excluir a reserva: ' . mysqli_error($conn);
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
  }
} else {
  echo 'ID da reserva não fornecido.';
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
    <p>Tem certeza que deseja excluir a reserva?</p>
    <form method="POST" action="">
      <button type="submit" class="eliminar" name="confirm">Excluir</button>
      <button type="button" class="cancelar" onclick="window.location.href = 'reserva_admin.php'">Cancelar</button>
    </form>
  </div>
</body>
</html>
