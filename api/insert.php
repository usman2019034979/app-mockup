<?php
require_once 'db.php';

class AppInsert extends DB
{

    function __construct() {}

    private function sanitize($data)
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public function insertData($name, $email, $gender, $subjects, $message)
    {

        $sql    =   "INSERT INTO data (name, email, gender, subjects, message) VALUES (:name, :email, :gender, :subjects, :message)";
        $run =   $this->conn->prepare($sql);
        $run->bindParam(':name', $name, PDO::PARAM_STR);
        $run->bindParam(':email', $email, PDO::PARAM_STR);
        $run->bindParam(':gender', $gender, PDO::PARAM_STR);
        $run->bindParam(':subjects', $subjects, PDO::PARAM_STR);
        $run->bindParam(':message', $message, PDO::PARAM_STR);
        if ($run->execute()) {
            return json_encode(array('status' => true, 'message' => 'Data inserted successfully.'));
        } else {
            return json_encode(array('status' => false, 'message' => 'Failed to insert data.'));
        }
        unset($run);
    }

    public function handleRequest()
    {
        if (!$this->connect()) {
            echo json_encode(array('status' =>  false, 'message' => 'Server not connected.'));
            return;
        }

        $expectedToken = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            header('Content-Type: application/json');
            header('Access-Control-Allow-Origins: *');
            header('Access-Control-Allow-Methods: POST');
            header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Access-Control-Allow-Origins, Content-Type, Authorization, X-Requested-With');

            $headers = getallheaders();
            if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . $expectedToken) {
                echo json_encode(array('status' => false, 'message' => 'Unauthorized User.'));
                return;
            }

            $jsonData = file_get_contents('php://input');
            $formData = json_decode($jsonData, true);
            $formData = $formData[0];
            $name = $this->sanitize($formData['name'] ?? '');
            $email =  filter_var($formData['email'], FILTER_VALIDATE_EMAIL);
            $gender = $this->sanitize($formData['gender'] ?? '');
            $subjects = isset($formData['subjects']) ? implode(', ', array_map([$this, 'sanitize'], $formData['subjects'])) : '';
            $message = $this->sanitize($formData['message'] ?? '');

            if($name	==	'' || $email	==	'' || $gender	==	'' || $subjects	==	'' || $message	==	''){
				echo json_encode(array('status' =>  false, 'message' => 'Values are empty.'));
				return;
			}
            
            echo $this->insertData($name, $email, $gender, $subjects, $message);
        } else {
            echo json_encode(array('status' =>  false, 'message' => 'Invalid request method.'));
        }
    }
}
$appInsert = new AppInsert();
$appInsert->handleRequest();
