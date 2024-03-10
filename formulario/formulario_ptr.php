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

// Obter os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telemovel = $_POST['telemovel'];
$id_carro = $_POST['id_carro'];
$inicio = $_POST['inicio'];
$fim = $_POST['fim'];
$titulo = $_POST['titulo'];
$nif = $_POST['nif'];


// Inserir dados na tabela "user"
$sql_user = "INSERT INTO user (nome, email, telemovel, titulo, nif) VALUES ('$nome', '$email', '$telemovel', '$titulo', '$nif')";
if ($conn->query($sql_user) === TRUE) {
    $id_user = $conn->insert_id; // Obter o ID do usuário recém-criado

    // Inserir dados na tabela "reserva"
    $sql_reserva = "INSERT INTO reserva (id_user, inicio, fim, id_carro) VALUES ($id_user, '$inicio', '$fim', '$id_carro')";
    if ($conn->query($sql_reserva) === TRUE) {
        // Atualizar a disponibilidade na tabela "carro"
        $sql_atualizar_disponibilidade = "UPDATE carro SET disponibilidade = 2 WHERE id_carro = $id_carro";
        if ($conn->query($sql_atualizar_disponibilidade) === TRUE) {
            header("Location: /lp/relatoriopdfBD/agradecimento.html");
            exit();
        } else {
            echo "Erro ao atualizar a disponibilidade do carro: " . $conn->error;
        }
    } else {
        echo "Erro ao criar reserva: " . $conn->error;
    }
} else {
    echo "Erro ao inserir dados do usuário: " . $conn->error;
}

$conn->close();
?>
