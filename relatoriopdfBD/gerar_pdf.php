<?php
// Carregar o Composer
require './vendor/autoload.php';

// Incluir conexão com BD
include_once './conexao.php';

// QUERY para recuperar o último registro da base de dados
$query_utilizadores = "SELECT id_user, nome, email, nif, telemovel FROM user ORDER BY id_user DESC LIMIT 1";

// Prepara a QUERY
$result_utilizadores = $conn->prepare($query_utilizadores);

// Executar a QUERY
$result_utilizadores->execute();

// Informações para PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-pt'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<style>";
$dados .= "body {";
$dados .= "  font-family: Arial, sans-serif;";
$dados .= "  background-color: #F0F0F0;";
$dados .= "}";
$dados .= ".container {";
$dados .= "  width: 100%;";
$dados .= "  height: 90%;";
$dados .= "  padding: 20px;";
$dados .= "  background-color: #FFF;";
$dados .= "  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);";
$dados .= "}";
$dados .= "h1 {";
$dados .= "  text-align: left;";
$dados .= "}";
$dados .= "table {";
$dados .= "  width: 100%;";
$dados .= "  border-collapse: collapse;";
$dados .= "  margin-top: 20px;";
$dados .= "}";
$dados .= "th, td {";
$dados .= "  border: 1px solid #CCC;";
$dados .= "  padding: 10px;";
$dados .= "  text-align: left;";
$dados .= "}";
$dados .= "th {";
$dados .= "  background-color: #F0F0F0;";
$dados .= "}";
$dados .= "tfoot td {";
$dados .= "  text-align: right;";
$dados .= "}";
$dados .= "tfoot tr:last-child td:first-child {";
$dados .= "  text-align: left;";
$dados .= "}";
$dados .= "img {";
$dados .= "  display: block;";
$dados .= "  margin: 20px auto;";
$dados .= "  max-width: 200px;";
$dados .= "  float: right;";
$dados .= "}";
$dados .= ".footer {";
$dados .= "  position: absolute;";
$dados .= "  bottom: 0;";
$dados .= "  left: 0;";
$dados .= "  width: 100%;";
$dados .= "  padding: 10px;";
$dados .= "  background-color: #F0F0F0;";
$dados .= "}";   
$dados .= ".iban {";
$dados .= "  font-size: 16px;";
$dados .= "  font-weight: bold;";
$dados .= "  color: #333;";
$dados .= "  margin-bottom: 10px;";
$dados .= "}";
$dados .= "</style>";
$dados .= "<title>Fatura</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<div class='container'>";
$dados .= "<img src='http://localhost/lp/foto-carro/foto-pap1.png' alt='Logo da Empresa'>";
$dados .= "<h1>Fatura</h1>";
$dados .= "<hr>";

// Adicionar a data e hora da criação da fatura
// Definir o fuso horário
date_default_timezone_set('Europe/Lisbon'); // Substitua 'Europe/Lisbon' pelo fuso horário desejado
// Recuperar a data e hora atual
$data_hora_atual = date('Y-m-d H:i:s');
$dados .= "<p><strong>Data de criação:</strong> " . date('d/m/Y H:i:s') . "</p>";

// Recuperar o último registro da tabela "user"
if ($row_utilizador = $result_utilizadores->fetch(PDO::FETCH_ASSOC)) {
    extract($row_utilizador);
    $dados .= '<table margin-left style="border: none; background-color: transparent; width: 100%; margin-left: -10px;">';
    $dados .= '<tr>';
    $dados .= '<td style="border: none;"><strong>Cliente:</strong> ' . $nome . '</td>';
    $dados .= '<td style="border: none;"><strong>Nif:</strong> ' . $nif . '</td>';
    $dados .= '</tr>';
    $dados .= '<tr>';
    $dados .= '<td style="border: none;"<strong>Email:</strong> ' . $email . '</td>';
    $dados .= '<td style="border: none;"><strong>Telemóvel:</strong> ' . $telemovel . '</td>';
    $dados .= '</tr>';
    $dados .= '</table>';
    $dados .= '<hr>';
    
    

    // Pesquisar na tabela "reserva" usando o "id_user" para obter o "id_carro"
    $query_reserva = "SELECT id_carro, inicio, fim FROM reserva WHERE id_user = :id_user";
    $result_reserva = $conn->prepare($query_reserva);
    $result_reserva->bindParam(':id_user', $id_user);
    $result_reserva->execute();

    if ($row_reserva = $result_reserva->fetch(PDO::FETCH_ASSOC)) {
        extract($row_reserva);
        
        // Calcular a quantidade de dias da reserva
        $data_inicio = new DateTime($inicio);
        $data_fim = new DateTime($fim);
        $diferenca = $data_inicio->diff($data_fim);
        $quantidade_dias = $diferenca->days;
        
        // Pesquisar na tabela "carro" usando o "id_carro" para obter a marca, o modelo e o preço correspondente
        $query_carro = "SELECT marca, modelo, preco FROM carro WHERE id_carro = :id_carro";
        $result_carro = $conn->prepare($query_carro);
        $result_carro->bindParam(':id_carro', $id_carro);
        $result_carro->execute();

        if ($row_carro = $result_carro->fetch(PDO::FETCH_ASSOC)) {
            extract($row_carro);
            $preco_carro = $preco;
            $total = $preco_carro * $quantidade_dias;
            $valor_iva = $total * 0.23;
            $subtotal = $total - $valor_iva;

            // Adicionar a marca e o modelo na tabela de serviços prestados
            $dados .= "<table>";
            $dados .= "<tr>";
            $dados .= "<th>Descrição</th>";
            $dados .= "<th>Quantidade</th>";
            $dados .= "<th>Preço (EUR)</th>";
            $dados .= "</tr>";
            $dados .= "<tr>";            
            $dados .= "<td>Carro: $marca $modelo</td>";
            $dados .= "<td>$quantidade_dias dias</td>";
            $dados .= "<td>$preco_carro €/Dia</td>";
            $dados .= "</tr>";
            $dados .= "</table>";

            $dados .= "<table>";
            $dados .= "<tfoot>";
            $dados .= "<tr>";
            $dados .= "<td colspan='2'>Subtotal</td>";
            $dados .= "<td>$subtotal €</td>";
            $dados .= "</tr>";
            $dados .= "<tr>";
            $dados .= "<td colspan='2'>IVA (23%)</td>";
            $dados .= "<td>$valor_iva €</td>";
            $dados .= "</tr>";
            $dados .= "<tr>";
            $dados .= "<th colspan='2'>Total</th>";
            $dados .= "<th>$total €</th>";
            $dados .= "</tr>";
            $dados .= "</tfoot>";
            $dados .= "</table>";

            $dados .= "<p>O pagamento deve ser efetuado até 2 horas após a data desta fatura. Caso não efectuar o pagamento a reserva irá ser cancelada.</p>";

            $dados .= "<p class='iban'>Código IBAN: [PT50 6309 1037 19260016244 19]</p>";

            $dados .= "<div class='footer'>";
            $dados .= "<p>SEDE:</p>";
            $dados .= "<p>R. Cap. Ten. Carvalho Araújo 15, 2900-646 Setúbal</p>";
            $dados .= "<p>Telefone: 932 847 583</p>";
            $dados .= "<p>Email: contato@intantcar.com</p>";
            $dados .= "<p>Website: www.instantcar.pt</p>";
            $dados .= "</div>";

        }
    }
}

$dados .= "</div>";
$dados .= "</body>";
$dados .= "</html>";

// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe Dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o método loadHtml e enviar o conteúdo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientação do papel
// portrait - Imprimir no formato vertical
$dompdf->setPaper('A4', 'portrait');
// portrait - Imprimir no formato retrato
//$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();