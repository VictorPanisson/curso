<?php

include_once 'db.php';

class Curso {

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll() {
        $sql = "SELECT 
            Codigo, 
            DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i:%s') data_cadastro,
            descricao,
            duracao_curso,
            lista_definida,
            Nome
        FROM curso";
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
            DATE_FORMAT(data_cadastro, '%Y-%m-%d') data_cadastro,
            descricao,
            duracao_curso,
            lista_definida,
            Nome
        FROM curso
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
        $sql = "DELETE FROM curso WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $codigo);
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro excluído com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao excluir registro'];
    }

    function updateById($codigo, $data) {
        $sql = "UPDATE curso SET 
            data_cadastro = ?,
            descricao = ?,
            duracao_curso = ?,
            lista_definida = ?,
            Nome = ?
        WHERE Codigo = ?";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'sssssi', 
            $data['data_cadastro'], 
            $data['descricao'], 
            $data['duracao_curso'], 
            $data['lista_definida'], 
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
        $sql = "INSERT INTO curso (data_cadastro, descricao, duracao_curso, lista_definida, Nome) VALUES (?, ?, ?, ?, ?)";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'sssss', 
            $data['data_cadastro'], 
            $data['descricao'], 
            $data['duracao_curso'], 
            $data['lista_definida'], 
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

$curso = new Curso($conn);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode($curso->deleteById($_GET['Codigo']));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($curso->updateById($_GET['Codigo'], $data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($curso->create($data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'curso/cadastro')) {
        echo json_encode($curso->getById($_GET['Codigo']));
        return;
    }

    echo json_encode($curso->getAll());
    return;
}
?>
