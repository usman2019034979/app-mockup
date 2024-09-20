<?php
require_once 'db.php';

class AppRetrieve extends DB
{

    function __construct() {}

    public function retrieveData()
    {
        $sql    =   "SELECT * FROM data";
        try {
            $run = $this->conn->prepare($sql);
            $run->execute();
            $results = $run->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array('status' => true, 'data' => $results));
        } catch (PDOException $e) {
            echo json_encode(array('status' => false, 'message' => 'Error retrieving data: ' . $e->getMessage()));
        }
    }

    public function handleRequest()
    {
        if (!$this->connect()) {
            echo json_encode(array('status' =>  false, 'message' => 'Server not connected.'));
            return;
        }

        $this->retrieveData();
    }
}
$appRetrieve = new AppRetrieve();
$appRetrieve->handleRequest();
