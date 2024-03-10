<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>InstantCar-Formulário</title>
    <link rel="stylesheet" type="text/css" href="/lp/CSS/css_formulario.css">
    <link rel="icon" href="/lp/foto-carro/icons-pap.png" type="image/x-icon">
</head>
<body>
    <h1>Formulário de Aluguer de Carro</h1>
    <form action="formulario_ptr.php" method="POST">

        <label for="nome">Nome completo:</label>
        <input type="text" id="nome" name="nome" pattern="[A-Za-zÀ-ú\s]+" title="Apenas letras são permitidas" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>        

        <label for="telemovel">Telemóvel:</label>
        <input type="number" id="telemovel" name="telemovel" pattern="[0-9]{9}" minlength="9" maxlength="9" required>

        <label for="id_carro">Modelo do carro:</label>
        <select id="id_carro" name="id_carro" required>
            <?php
            // Dados de conexão ao banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "nada";
            $dbname = "instantcar";

            // Conexão ao banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Falha na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta os carros disponíveis
            $sql_carros = "SELECT id_carro, marca, modelo FROM carro WHERE disponibilidade =1";
            $result_carros = $conn->query($sql_carros);
            
            $carId = $_GET['id_carro'] ?? '';

            if ($result_carros->num_rows > 0) {
              while ($row_carro = $result_carros->fetch_assoc()) {
                $id_carro = $row_carro["id_carro"];
                $marca = $row_carro["marca"];
                $modelo = $row_carro["modelo"];
          
                // Verifica se o ID do carro corresponde ao carro selecionado
                $selected = ($id_carro == $carId) ? 'selected' : '';
          
                echo "<option value='$id_carro' $selected>$marca $modelo</option>";
              }
            }
            $conn->close();
            ?>
        </select>

        <label for="inicio">Data de início da locação:</label>
        <input type="date" id="inicio" name="inicio" required>

        <label for="fim">Data de término da locação:</label>
        <input type="date" id="fim" name="fim" disabled required>

        <label for="titulo">Título:</label>
        <select id="titulo" name="titulo" required>
            <option value="">Selecione um título</option>
            <option value="Sr.">Sr.</option>
            <option value="Sra.">Sra.</option>
        </select>

        <label for="nif">NIF:</label>
        <input type="text" id="nif" name="nif" pattern="[0-9]{9}" minlength="9" maxlength="9" required>        
        <button id="submit-button" type="submit">Reservar</button>

    </form>

    <script>
        // Obtém a data atual
        var today = new Date().toISOString().split('T')[0];
    
        // Define a data mínima para o campo de início como a data atual
        document.getElementById('inicio').setAttribute('min', today);
    
        // Define a data mínima para o campo de fim como a data inicial + 1 dia
        document.getElementById('inicio').addEventListener('change', function() {
            var inicioValue = document.getElementById('inicio').value;
            var minFimDate = new Date(inicioValue);
            minFimDate.setDate(minFimDate.getDate() + 1);
            var minFimDateString = minFimDate.toISOString().split('T')[0];
            document.getElementById('fim').setAttribute('min', minFimDateString);

            // Habilita ou desabilita o campo de término com base no preenchimento do campo de início
            document.getElementById('fim').disabled = !inicioValue;
            
        });
    </script>
    
</body>
</html>
