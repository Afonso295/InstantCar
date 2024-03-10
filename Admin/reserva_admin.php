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

    /* Estilo para texto vermelho */
    .red-text {
      color: red;
    }

    /* Estilo para texto amarelo */
    .yellow-text {
      color: orange;
    }
  </style>
</head>
<body>
  <div class="container">
  <a href="/lp/principal/home.php" class="back-button">Voltar ao Site</a>

    <h1>Área Administrativa - InstantCar</h1>
    <h2>Tabela de Reservas</h2>

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

    // Consultar a tabela "reservas"
    $query = "SELECT * FROM reserva ORDER BY id_reserva DESC";
    $result = mysqli_query($conn, $query);

    // Verificar se há registros na tabela
    if (mysqli_num_rows($result) > 0) {
      echo '<table>';
      echo '<tr><th>ID Reserva</th><th>Início</th><th>Fim</th><th>ID Carro</th><th>ID Usuário</th><th>Ações</th></tr>';

      // Exibir os registros da tabela
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';

        // Verificar se a data de fim é inferior à data atual
        $fim = $row['fim'];
        $idReserva = $row['id_reserva'];
        $inicio = $row['inicio'];
        $idCarro = $row['id_carro'];
        $idUsuario = $row['id_user'];

        if ($fim < date('Y-m-d')) {
          // Data de fim é anterior à data atual, aplicar estilo vermelho para a data de fim, início, ID do carro e ID do usuário
          echo '<td class="red-text">' . $idReserva . '</td>';
          echo '<td class="red-text">' . $inicio . '</td>';
          echo '<td class="red-text">' . $fim . '</td>';
          echo '<td class="red-text">' . $idCarro . '</td>';
          echo '<td class="red-text">' . $idUsuario . '</td>';
        } elseif ($fim == date('Y-m-d')) {
          // Data de fim é igual à data atual, aplicar estilo amarelo para o início, ID do carro e ID do usuário
          echo '<td class="yellow-text">' . $idReserva . '</td>';
          echo '<td class="yellow-text">' . $inicio . '</td>';
          echo '<td class="yellow-text">' . $fim . '</td>';
          echo '<td class="yellow-text">' . $idCarro . '</td>';
          echo '<td class="yellow-text">' . $idUsuario . '</td>';
        } else {
          // Data de fim é posterior à data atual, sem estilo especial para o ID da reserva, ID do carro e ID do usuário
          echo '<td>' . $idReserva . '</td>';
          echo '<td>' . $inicio . '</td>';
          echo '<td>' . $fim . '</td>';
          echo '<td>' . $idCarro . '</td>';
          echo '<td>' . $idUsuario . '</td>';
        }

        echo '<td><a href="reserva_edit.php?id=' . $idReserva . '">Editar</a> | <a href="delete_reserva.php?id=' . $idReserva . '">Excluir</a></td>';
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
