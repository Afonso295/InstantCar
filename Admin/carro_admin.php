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

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #FF8C00;
      color: white;
    }

    a {
      color: blue;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .separator {
      display: inline-block;
      margin-right: 20px;
      color: blue;
      background-color: white;
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
  </style>
</head>
<body>
  <div class="container">
    <a href="/lp/principal/home.php" class="back-button">Voltar ao Site</a>

    <h1>Área Administrativa - InstantCar</h1>
    <h2>Tabela de Carros</h2>

    <span class="separator"></span>
      <a href="user_admin.php" class="link">user</a>
      <span class="separator"></span>
      <a href="reserva_admin.php" class="link">reservar</a>
      <span class="separator"></span>
      <a href="carro_admin.php" class="link">carros</a>

    <?php
    // Realizar a conexão com o banco de dados
    $conn = mysqli_connect('localhost', 'root', 'nada', 'instantcar');

    // Verificar se a conexão foi estabelecida com sucesso
    if (!$conn) {
      die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    // Consultar a tabela "carro"
    $query = "SELECT * FROM carro";
    $result = mysqli_query($conn, $query);

    // Verificar se há registros na tabela
    if (mysqli_num_rows($result) > 0) {
      echo '<table>';
      echo '<tr><th>ID Carro</th><th>Marca</th><th>Modelo</th><th>Cor</th><th>Matrícula</th><th>Preço</th><th>Características</th><th>Disponibilidade</th><th>Ações</th></tr>';

      // Exibir os registros da tabela
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id_carro'] . '</td>';
        echo '<td>' . $row['marca'] . '</td>';
        echo '<td>' . $row['modelo'] . '</td>';
        echo '<td>' . $row['cor'] . '</td>';
        echo '<td>' . $row['matricula'] . '</td>';
        echo '<td>' . $row['preco'] . '</td>';
        echo '<td>' . $row['características'] . '</td>';
        echo '<td>' . $row['disponibilidade'] . '</td>';
        echo '<td><a href="carro_edit.php?id=' . $row['id_carro'] . '">Editar</a> | <a href="delete_carro.php?id=' . $row['id_carro'] . '">Excluir</a></td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      echo 'Nenhuma reserva encontrada.';
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($conn);
    ?>
  </div>
</body>
</html>
