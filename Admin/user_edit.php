<!DOCTYPE html>
<html>
<head>
<title>InstantCar-Admin</title>
  <link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 2000px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      text-align: center; /* Alinhar ao meio */
    }

    h2 {
        margin-top: 0px;
        text-align: center;
      }
      
      h1{
        margin-top: 0px;
        margin-right: 80px;
      }

    form {
      margin-top: 20px;
      text-align: left;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .back-button {
      display: inline-block;
      margin-top: -18px;
      margin-left: -18px;
      padding: 10px 20px;
      background-color: red;
      color: white;
      font-size: 16px;
      text-decoration: none;
      border-radius: 5px;
      float: left; /* Alinhar à esquerda */
    }

    .cancel-button {
        padding: 10px 25px;
        background-color: #e74c3c;
        color: white;
        font-size: 13px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="/lp/principal/home.php" class="back-button">Voltar ao Site</a>

    <h1>Área Administrativa - InstantCar</h1>
    <h2>Editar Usuário</h2>

    <?php
    // Realizar a conexão com o banco de dados
    $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
      $userId = $_GET['id'];

      // Consultar o usuário com o ID especificado
      $query = "SELECT * FROM user WHERE id_user = $userId";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $email = $row['email'];
        $telemovel = $row['telemovel'];
        $titulo = $row['titulo'];
        $nif = $row['nif'];
      } else {
        echo 'Usuário não encontrado.';
        exit;
      }
    } else {
      echo 'ID do usuário não especificado.';
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obter os dados do formulário
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telemovel = $_POST['telemovel'];
      $titulo = $_POST['titulo'];
      $nif = $_POST['nif'];

      // Atualizar o usuário no banco de dados
      $updateQuery = "UPDATE user SET nome='$nome', email='$email', telemovel='$telemovel', titulo='$titulo', nif='$nif' WHERE id_user=$userId";
      $updateResult = mysqli_query($conn, $updateQuery);

      if ($updateResult) {
        echo 'Usuário atualizado com sucesso.';
      } else {
        echo 'Erro ao atualizar o usuário: ' . mysqli_error($conn);
      }
    }
    ?>

    <form method="POST">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?php echo $email; ?>" required>

      <label for="telemovel">telemóvel:</label>
      <input type="text" id="telemovel" name="telemovel" value="<?php echo $telemovel; ?>" required>

      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>

      <label for="nif">NIF:</label>
      <input type="text" id="nif" name="nif" value="<?php echo $nif; ?>" required>

      <input type="submit" value="Atualizar">
      <input type="button" class="cancel-button" value="Cancelar" onclick="window.location.href = 'user_admin.php';">

    </form>
  </div>
</body>
</html>
