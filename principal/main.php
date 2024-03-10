<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <title>Main content</title>
  <link rel="stylesheet" type="text/css" href="/lp/CSS/css_main´s.css">
  <link rel="icon" href="http://localhost/lp/foto-carro/icons-pap.png" type="image/x-icon">
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

  // Executa a consulta SQL para selecionar os carros
  $sql = "SELECT id_carro, marca, modelo, características, preco, disponibilidade FROM carro";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }

  // Exibe os resultados
  while ($row = $result->fetch_assoc()) {
    echo '<div class="vehicle">';
    $image = ($row["disponibilidade"] == 2) ? 'carro' . $row["id_carro"] . '_reservado.png' : 'carro' . $row["id_carro"] . '.png';
    echo '<img src="/lp/foto-carro/' . $image . '" alt="Carro">';
    echo '<h3>' . $row["marca"] . ' ' . $row["modelo"] . '</h3>';
    echo '<p>' . $row["características"] . '</p>';
    echo '<p><strong>Preço: €' . $row["preco"] . '/dia</strong></p>';

    // Verifica a disponibilidade e define a cor do botão de acordo
    if ($row["disponibilidade"] == 1) {
      echo '<button class="btn-alugar" data-car-id="' . $row["id_carro"] . '">Alugar</button>';
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

    // Redireciona o usuário para a página de aluguel com o ID do carro como parâmetro
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
