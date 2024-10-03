<?php

include_once 'db.php';

class Aluno {

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll() {
        $sql = "SELECT 
            Codigo, 
            Codigo_Pessoa, 
            DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i:%s') data_cadastro
        FROM aluno";
        $result = $this->conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    function getById($codigo) {
        $sql = "SELECT 
            Codigo, 
            Codigo_Pessoa, 
            DATE_FORMAT(data_cadastro, '%Y-%m-%d') data_cadastro
        FROM aluno
        WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $codigo);
        $stm->execute();

        $result = $stm->get_result();

        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    function deleteById($codigo) {
        $sql = "DELETE FROM aluno WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $codigo);
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro excluído com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao excluir registro'];
    }

    function updateById($codigo, $data) {
        $sql = "UPDATE aluno SET 
            Codigo_Pessoa = ?,
            data_cadastro = ?
        WHERE Codigo = ?";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'isi', 
            $data['Codigo_Pessoa'], 
            $data['data_cadastro'], 
            $codigo
        );
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro atualizado com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao atualizar registro'];
    }

    function create($data) {
        $sql = "INSERT INTO aluno (Codigo_Pessoa, data_cadastro) VALUES (?, ?)";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'is', 
            $data['Codigo_Pessoa'], 
            $data['data_cadastro']
        );
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro criado com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao criar registro'];
    }
}

$allowed_methods = [
    'GET',
    'POST',
    'PUT',
    'DELETE'
];

if (!in_array($_SERVER['REQUEST_METHOD'], $allowed_methods)) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode( [
        'status' => 'error',
        'msg' => 'Invalid Request'
    ] );
}

$aluno = new Aluno($conn);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode($aluno->deleteById($_GET['Codigo']));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($aluno->updateById($_GET['Codigo'], $data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($aluno->create($data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'aluno/cadastro')) {
        echo json_encode($aluno->getById($_GET['Codigo']));
        return;
    }

    echo json_encode($aluno->getAll());
    return;
}
?>
