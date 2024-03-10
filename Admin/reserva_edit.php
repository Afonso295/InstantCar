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

h1 {
  margin-top: 0px;
  margin-right: 80px;
}

form {
  margin-top: 20px;
  text-align: left;
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

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"] {
  padding: 5px;
  width: 100%;
  border-radius: 3px;
  border: 1px solid #ccc;
}
</style>
</head>
<body>
  <div class="container">
    <a href="/lp/principal/home.php" class="back-button">Voltar ao Site</a>

    <h1>Área Administrativa - InstantCar</h1>
    <h2>Editar Reserva</h2>

    <?php
    // Realizar a conexão com o banco de dados
    $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
      $reservaId = $_GET['id'];

      // Consultar a reserva com o ID especificado
      $query = "SELECT * FROM reserva WHERE id_reserva = $reservaId";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $inicio = $row['inicio'];
        $fim = $row['fim'];
        $carroId = $row['id_carro'];
        $userId = $row['id_user'];
      } else {
        echo 'Reserva não encontrada.';
        exit;
      }
    } else {
      echo 'ID da reserva não especificado.';
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Obter os dados do formulário
      $inicio = $_POST['inicio'];
      $fim = $_POST['fim'];
      $carroId = $_POST['carroId'];
      $userId = $_POST['userId'];

      // Atualizar os dados da reserva no banco de dados
      $updateQuery = "UPDATE reserva SET inicio='$inicio', fim='$fim', id_carro='$carroId', id_user='$userId' WHERE id_reserva=$reservaId";
      $updateResult = mysqli_query($conn, $updateQuery);

      if ($updateResult) {
        echo 'Reserva atualizada com sucesso.';
      } else {
        echo 'Erro ao atualizar a reserva: ' . mysqli_error($conn);
      }
    }
    ?>

    <form method="POST">
      <div class="form-group">
        <label for="inicio">Início:</label>
        <input type="text" id="inicio" name="inicio" value="<?php echo $inicio; ?>" required>
      </div>

      <div class="form-group">
        <label for="fim">Fim:</label>
        <input type="text" id="fim" name="fim" value="<?php echo $fim; ?>" required>
      </div>

      <div class="form-group">
        <label for="carroId">ID Carro:</label>
        <input type="text" id="carroId" name="carroId" value="<?php echo $carroId; ?>" required>
      </div>

      <div class="form-group">
        <label for="userId">ID Usuário:</label>
        <input type="text" id="userId" name="userId" value="<?php echo $userId; ?>" required>
      </div>

      <div class="button-container">
        <input type="submit" value="Atualizar">
        <input type="button" class="cancel-button" value="Cancelar" onclick="window.location.href = 'reserva_admin.php';">
      </div>
    </form>
  </div>
</body>
</html>
