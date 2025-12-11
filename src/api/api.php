<?php
header('Content-Type: application/json');
require_once 'dbConn.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$formData = $input['data'] ?? '';

if ($action == "saveData_AboutMe") {
    $statement = $pdo->prepare('UPDATE about SET content = ? WHERE content_type = ?');
    $statement->execute([$formData['intro'], 'Intro']);
    $statement->execute([$formData['motto'], 'Motto']);

    $statement = $pdo->prepare('UPDATE aboutSubcategories SET subcategory_content = ? WHERE subcategory_name = ?');
    $statement->execute([$formData['rawSubcategories']['Strengths'], 'Strengths']);
    $statement->execute([$formData['rawSubcategories']['Interests'], 'Interests']);

    echo json_encode(['success' => true]);
    exit;
}

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


if ($action == "saveData_TechSkill") {
    $statement = $pdo->prepare('UPDATE techSkillSubcategories SET subcategory_content = ? WHERE subcategory_name = ?');
    $statement->execute([$formData['Front-end'], 'Front-end']);
    $statement->execute([$formData['Back-end'], 'Back-end']);
    $statement->execute([$formData['Programming'], 'Programming']);

    echo json_encode(['success' => true]);
    exit;
}

if ($action == "getData_TechSkill") {
    $statement = $pdo->prepare('SELECT * FROM techSkillSubcategories');
    $statement->execute();
    $techSkillSubcategoriesData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $techSkillSubcategoriesData]);
    exit;
}


if ($action == "createData_Projects") {
    $statement = $pdo->prepare('INSERT INTO projects (project_name, project_image_filename, project_description, project_repository) VALUES (?, ?, ?, ?)');
    $statement->execute([$formData['Title'], $formData['ImageName'], $formData['Description'], $formData['Link']]);

    echo json_encode(['success' => true]);
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'uploadImage_Projects') {
    if (!empty($_FILES['image']['tmp_name'])) {
        $fileName = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];
        $fileFormat = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueID = sha1(md5(rand(1, 9999999)));
        $newFileName = $uniqueID . "." . $fileFormat;

        $imagesDirectory = "../images/";

        if (!is_dir($imagesDirectory)) {
            if (!mkdir($imagesDirectory, 0777, true)) {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to create directory.']);
                exit;
            }
        }

        $targetPath = $imagesDirectory . $newFileName;

        if (move_uploaded_file($tempName, $targetPath)) {
            echo json_encode([
                'success' => true,
                'fileName' => $newFileName
            ]);
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Upload failed.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'No file received.']);
    }
    exit;
}

if ($action == "getData_Projects") {
    $statement = $pdo->prepare('SELECT * FROM projects');
    $statement->execute();
    $projectsData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $projectsData]);
    exit;
}

if ($action == "deleteData_Projects") {
    $statement = $pdo->prepare('DELETE FROM projects WHERE id = ?');
    $statement->execute([$formData['project_id']]);

    echo json_encode(['success' => true]);
    exit;
}


if ($action == "createData_Education") {
    $statement = $pdo->prepare('INSERT INTO education (education_name, education_type, education_description) VALUES (?, ?, ?)');
    $statement->execute([$formData['Title'], $formData['Type'], $formData['Description']]);

    echo json_encode(['success' => true]);
    exit;
}

if ($action == "getData_Education") {
    $statement = $pdo->prepare('SELECT * FROM education');
    $statement->execute();
    $educationData = $statement->fetchAll();

    echo json_encode(['success' => true, 'data' => $educationData]);
    exit;
}

if ($action == "deleteData_Education") {
    $statement = $pdo->prepare('DELETE FROM education WHERE id = ?');
    $statement->execute([$formData['certificate_id']]);

    echo json_encode(['success' => true]);
    exit;
}


if ($action == "loginUser") {
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $statement->execute([$formData['username']]);
    $userData = $statement->fetch();

    // username check
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

echo json_encode(['success' => false, 'data' => "Error / Unknown action provided."]);
exit;
