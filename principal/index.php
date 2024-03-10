<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>InstantCar-Home</title>
  <link rel="stylesheet" type="text/css" href="/lp/CSS/css_home.css">
  <link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">
</head>
<body>
  <header>
	<nav>
  <div class="logo" onclick="window.location.href = 'home.php';">InstantCar</div>
		<ul>
			<li><a href="home.php">Home</a></li>
		    <li><a href="marca.html">Carros</a></li>	
			<li><a href="sobre.html">Sobre</a></li>
		</ul>
	</nav>
  </header>

  <main>
    <div id="video-container">
      <button id="ver-carros" onclick="window.location.href = 'marca.html';">Reservar Carro</button>
      <video id="home-video" src="https://www.youtube.com/watch?v=caSOytYFU3c" autoplay muted loop></video>
    </div>
    <section id="features">
      <h2>Por que escolher-nos?</h2>
      <ul style="list-style: none; padding: 0;">
        <li style="display: inline-block; text-align: center; margin-right: 1px; margin-top: 16px;">
          <img src="/lp/foto-carro/icons1.png" alt="Ícone 1">
          <p>Preços competitivos</p>
        </li>
        <li style="display: inline-block; text-align: center; margin-right: 1px;">
          <img src="/lp/foto-carro/icons2.png" alt="Ícone 2">
          <p>Atendimento ao cliente 24/7</p>
        </li>
        <li style="display: inline-block; text-align: center; margin-right: 1px;">
          <img src="/lp/foto-carro/icons3.png" alt="Ícone 3">
          <p>Carros bem cuidados</p>
        </li>
        <li style="display: inline-block; text-align: center; margin-top: 19px;">
          <img src="/lp/foto-carro/icons4.png" alt="Ícone 4">
          <p>Carros de alta categoria</p>
        </li>
      </ul>
    </section>

      

 <section id="cars">
 <h2>Veja nossa frota de carros</h2> 
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
  // Executa a consulta SQL para selecionar apenas o carro com o ID 2
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 2";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="car">';
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
  

  // Executa a consulta SQL para selecionar apenas o carro com o ID 5
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 5";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="car">';
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


  // Executa a consulta SQL para selecionar apenas o carro com o ID 3
  $sql = "SELECT marca, modelo, características, preco, disponibilidade FROM carro WHERE id_carro = 3";
  $result = $conn->query($sql);

  if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
  }
  
  while ($row = $result->fetch_assoc()) {
    echo '<div class="car">';
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
    
    // Fecha a conexão
    $conn->close();
  ?>
  </section>
  </main>
  <h1>Localização da InstantCar</h1>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3121.362636853878!2d-8.890294755724344!3d38.52540809611176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1943a8515d24b7%3A0x673dc089b7bb2863!2sR.%20Cap.%20Ten.%20Carvalho%20Ara%C3%BAjo%2015%2C%202900-646%20Set%C3%BAbal!5e0!3m2!1spt-PT!2spt!4v1683883287006!5m2!1spt-PT!2spt" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
  <footer>
    <div class="footer-container">
      <p>&copy; 2023 InstantCar, All Rights Reserved</p>
      <div class="footer-links">
        <a href="home.php">Home</a>
        <a href="marca.html">Carros</a>
        <a href="sobre.html">Sobre</a>
        <a href="../admin/login_admin.php">Admin</a>
      </div>
    </div>
  </footer>
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
    window.location.href = "marca.html";
  });

  // Altera a cor do botão com base na disponibilidade
  if (btn.classList.contains("btn-disabled")) {
    btn.style.backgroundColor = "gray";
    btn.innerHTML = "Reservado";
  } 
});
  </script>
</html>
