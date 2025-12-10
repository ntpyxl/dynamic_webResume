<?php
header('Content-Type: application/json');
require_once 'dbConn.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$formData = $input['data'] ?? '';

if ($action == "getData_AboutMe") {
    $statement = $pdo->prepare('SELECT * FROM about');
    $statement->execute();
    $aboutMeData = $statement->fetchAll();

    $statement = $pdo->prepare('SELECT * FROM aboutSubcategories');
    $statement->execute();
    $aboutMeSubcategoriesData = $statement->fetchAll();

    echo json_encode(
        [
            'success' => true,
            'data' => ["about" => $aboutMeData, "subcategories" => $aboutMeSubcategoriesData]
        ]
    );
    exit;
}

if ($action == "getData_TechSkill") {
    $statement = $pdo->prepare('SELECT * FROM techSkillSubcategories');
    $statement->execute();
    $techSkillSubcategoriesData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $techSkillSubcategoriesData]);
    exit;
}

if ($action == "getData_Projects") {
    $statement = $pdo->prepare('SELECT * FROM projects');
    $statement->execute();
    $projectsData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $projectsData]);
    exit;
}

if ($action == "getData_Education") {
    $statement = $pdo->prepare('SELECT * FROM education');
    $statement->execute();
    $educationData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $educationData]);
    exit;
}

if ($action == "loginUser") {
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $statement->execute([$formData['username']]);
    $userData = $statement->fetch();

    // email check
    if ($userData === false) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Username does not exist yet.']);
        exit;
    }

    // password check
    if ($formData['password'] != $userData['passkey']) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        exit;
    }

    $_SESSION['user_id'] = $userData['user_id'];
    $_SESSION['username'] = $userData['username'];

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['success' => false, 'data' => "Unknown action provided."]);
exit;
