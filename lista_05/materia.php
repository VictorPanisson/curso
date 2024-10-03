<?php

include_once 'db.php';

class Materia {

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll() {
        $sql = "SELECT 
            Codigo, 
            Codigo_Curso, 
            DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i:%s') data_cadastro,
            duracao_materia,
            Nome
        FROM materia";
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
            Codigo_Curso, 
            DATE_FORMAT(data_cadastro, '%Y-%m-%d') data_cadastro,
            duracao_materia,
            Nome
        FROM materia
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
        $sql = "DELETE FROM materia WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $codigo);
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro excluído com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao excluir registro'];
    }

    function updateById($codigo, $data) {
        $sql = "UPDATE materia SET 
            Codigo_Curso = ?,
            data_cadastro = ?,
            duracao_materia = ?,
            Nome = ?
        WHERE Codigo = ?";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'isssi', 
            $data['Codigo_Curso'], 
            $data['data_cadastro'], 
            $data['duracao_materia'], 
            $data['Nome'], 
            $codigo
        );
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro atualizado com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao atualizar registro'];
    }

    function create($data) {
        $sql = "INSERT INTO materia (Codigo_Curso, data_cadastro, duracao_materia, Nome) VALUES (?, ?, ?, ?)";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'isss', 
            $data['Codigo_Curso'], 
            $data['data_cadastro'], 
            $data['duracao_materia'], 
            $data['Nome']
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

$materia = new Materia($conn);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode($materia->deleteById($_GET['Codigo']));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($materia->updateById($_GET['Codigo'], $data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($materia->create($data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'materia/cadastro')) {
        echo json_encode($materia->getById($_GET['Codigo']));
        return;
    }

    echo json_encode($materia->getAll());
    return;
}
?>
