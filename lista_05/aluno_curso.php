<?php

include_once 'db.php';

class AlunoCurso {

    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function getAll() {
        $sql = "SELECT 
            Codigo, 
            Codigo_Aluno, 
            Codigo_Curso, 
            DATE_FORMAT(data_cadastro, '%d/%m/%Y %H:%i:%s') data_cadastro,
            DATE_FORMAT(data_inicio, '%d/%m/%Y') data_inicio,
            DATE_FORMAT(data_fim, '%d/%m/%Y') data_fim
        FROM aluno_curso";
        $result = $this->conn->query($sql);

        $data = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    function getById($Codigo) {
        $sql = "SELECT 
            Codigo, 
            Codigo_Aluno, 
            Codigo_Curso, 
            DATE_FORMAT(data_inicio, '%Y-%m-%d') data_inicio,
            DATE_FORMAT(data_fim, '%Y-%m-%d') data_fim
        FROM aluno_curso
        WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $Codigo);
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

    function deleteById($Codigo) {
        $sql = "DELETE FROM aluno_curso WHERE Codigo = ?";
        $stm = $this->conn->prepare($sql);

        $stm->bind_param('i', $Codigo);
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro excluído com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao excluir registro'];
    }

    function updateById($Codigo, $data) {
        $sql = "UPDATE aluno_curso SET 
            Codigo_Aluno = ?,
            Codigo_Curso = ?,
            data_inicio = ?,
            data_fim = ?
        WHERE Codigo = ?";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'isssi', 
            $data['Codigo_Aluno'], 
            $data['Codigo_Curso'], 
            $data['data_inicio'], 
            $data['data_fim'], 
            $Codigo
        );
        $stm->execute();

        if (!$stm->error) {
            return ['status' => 'ok', 'msg' => 'Registro atualizado com sucesso'];
        }

        return ['status' => 'error', 'msg' => 'Falha ao atualizar registro'];
    }

    function create($data) {
        $sql = "INSERT INTO aluno_curso (Codigo_Aluno, Codigo_Curso, data_inicio, data_fim) VALUES (?, ?, ?, ?)";

        $stm = $this->conn->prepare($sql);

        $stm->bind_param(
            'isss', 
            $data['Codigo_Aluno'], 
            $data['Codigo_Curso'], 
            $data['data_inicio'],
            $data['data_fim']
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

$alunoMaterio = new AlunoCurso($conn);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo json_encode($alunoMaterio->deleteById($_GET['Codigo']));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($alunoMaterio->updateById($_GET['Codigo'], $data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($alunoMaterio->create($data));
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'aluno_curso/cadastro')) {
        echo json_encode($alunoMaterio->getById($_GET['Codigo']));
        return;
    }

    echo json_encode($alunoMaterio->getAll());
    return;
}
