<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>Main content</title>
  <link rel="stylesheet" type="text/css" href="/lp/CSS/css_main´s.css">
</head>
<body>
<?php
  $servername = "localhost";
  $username = "root";
  $password = "nada";
  $dbname = "instantcar";
  
  // Cria uma conexão
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Verifica se a conexão foi bem-sucedida
  if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
  }
  



  // Executa a consulta SQL para selecionar apenas o carro com o ID 1
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 1";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "1" . '_reservado.png' : 'carro' . "1" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "1" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }
    
 


 
  // Executa a consulta SQL para selecionar apenas o carro com o ID 7
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 7";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "7" . '_reservado.png' : 'carro' . "7" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "7" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }


  

  // Executa a consulta SQL para selecionar apenas o carro com o ID 6
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 6";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "6" . '_reservado.png' : 'carro' . "6" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "6" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }


  

  // Executa a consulta SQL para selecionar apenas o carro com o ID 5
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 5";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "5" . '_reservado.png' : 'carro' . "5" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "5" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }



  
 
  // Executa a consulta SQL para selecionar apenas o carro com o ID 4
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 4";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "4" . '_reservado.png' : 'carro' . "4" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "4" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }


  

  // Executa a consulta SQL para selecionar apenas o carro com o ID 3
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 3";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "3" . '_reservado.png' : 'carro' . "3" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "3" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }


  
  // Executa a consulta SQL para selecionar apenas o carro com o ID 2
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 2";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . "2" . '_reservado.png' : 'carro' . "2" . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . "2" . '">Alugar</button>';
    } else {
      echo '<button class="btn-alugar btn-disabled" disabled>Reservado</button>';
    }

    echo '</div>';
  }
   // Fecha a conexão
   $conn->close();
?>

</body>
<script>
// Seleciona todos os botões usando a classe "btn-alugar"
const btnsAlugar = document.querySelectorAll(".btn-alugar");

// Adiciona um evento de clique a cada botão
btnsAlugar.forEach(function(btn) {
  btn.addEventListener("click", function() {
    // Obtém o ID do carro a partir do atributo de dados
    const carId = btn.dataset.carId;

    // Redireciona o usuário para a página de perfil com o ID do carro como parâmetro
    window.open("../formulario/formulario1.php?id_carro=" + carId, "_blank");
  });

  // Altera a cor do botão com base na disponibilidade
  if (btn.classList.contains("btn-disabled")) {
    btn.style.backgroundColor = "gray";
    btn.innerHTML = "Reservado";
  }
});
</script>
</html>
