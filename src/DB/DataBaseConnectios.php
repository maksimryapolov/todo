<?php

class  DataBaseConnectios
{
    private self $instance;

    private function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
    }

    public function getInstance(): self
    {
        if($this->instance != null) {
            // $this->instance = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            new self(

            );
            return $this->instance;
        }

        $this->instance;
    }
}