<!DOCTYPE html>
<html>
<head>
<title>InstantCar-Admin</title>
  <link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">
  <style>
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

    input[type="submit"],
    .cancel-button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .cancel-button {
      background-color: #e74c3c;
    }

    .button-container {
      text-align: left;
      margin-top: 10px;
    }

    .button-container input[type="submit"] {
      float: none;
    }

  </style>
</head>
<body>
  <div class="container">

    <h1>Área Administrativa - InstantCar</h1>
    <h2>Editar Carro</h2>

    <?php
    // Realizar a conexão com o banco de dados
    $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
      $carroId = $_GET['id'];

      // Consultar o carro com o ID especificado
      $query = "SELECT * FROM carro WHERE id_carro = $carroId";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $marca = $row['marca'];
        $modelo = $row['modelo'];
        $cor = $row['cor'];
        $matricula = $row['matricula'];
        $preco = $row['preco'];
        $caracteristicas = $row['características'];
        $disponibilidade = $row['disponibilidade'];
      } else {
        echo 'Carro não encontrado.';
        exit;
      }
    } else {
      echo 'ID do carro não especificado.';
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obter os dados do formulário
      $marca = $_POST['marca'];
      $modelo = $_POST['modelo'];
      $cor = $_POST['cor'];
      $matricula = $_POST['matricula'];
      $preco = $_POST['preco'];
      $caracteristicas = $_POST['caracteristicas'];
      $disponibilidade = $_POST['disponibilidade'];

      // Atualizar os dados do carro no banco de dados
      $updateQuery = "UPDATE carro SET marca='$marca', modelo='$modelo', cor='$cor', matricula='$matricula', preco='$preco', características='$caracteristicas', disponibilidade='$disponibilidade' WHERE id_carro=$carroId";
      $updateResult = mysqli_query($conn, $updateQuery);

      if ($updateResult) {
        echo 'Carro atualizado com sucesso.';
      } else {
        echo 'Erro ao atualizar o carro: ' . mysqli_error($conn);
      }
    }
    ?>

    <form method="POST">
      <label for="marca">Marca:</label>
      <input type="text" id="marca" name="marca" value="<?php echo $marca; ?>" required>

      <label for="modelo">Modelo:</label>
      <input type="text" id="modelo" name="modelo" value="<?php echo $modelo; ?>" required>

      <label for="cor">Cor:</label>
      <input type="text" id="cor" name="cor" value="<?php echo $cor; ?>" required>

      <label for="matricula">Matrícula:</label>
      <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>

      <label for="preco">Preço:</label>
      <input type="text" id="preco" name="preco" value="<?php echo $preco; ?>" required>

      <label for="caracteristicas">Características:</label>
      <input type="text" id="caracteristicas" name="caracteristicas" value="<?php echo $caracteristicas; ?>" required>

      <label for="disponibilidade">Disponibilidade:</label>
      <input type="text" id="disponibilidade" name="disponibilidade" value="<?php echo $disponibilidade; ?>" required>

      <div class="button-container">
        <input type="submit" value="Atualizar">
        <input type="button" class="cancel-button" value="Cancelar" onclick="window.location.href = 'carro_admin.php';">
      </div>
    </form>
  </div>
</body>
</html>
