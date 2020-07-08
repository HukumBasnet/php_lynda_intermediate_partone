<?php
class MyDecorator implements Swift_Plugins_Decorator_Replacements
{
    private $conn;

    public function __construct(\mysqli $connection)
    {
        $this->conn = $connection;
    }

    public function getReplacementsFor($address)
    {
        try {
            $sql = 'SELECT name, greeting FROM users WHERE address = ?';
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('s', $address);
            $stmt->execute();
            $stmt->bind_result($name, $greeting);
            $stmt->fetch();
            return [
                '#name#' => $name,
                '#greeting#' => $greeting
            ];
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}