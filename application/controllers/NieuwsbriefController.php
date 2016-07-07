<?php

class NieuwsbriefController
{
    /**
     * @var DatabaseController the connection to the database
     */
    private $database;

    /**
     * Start the database connection with the MySQL server
     * NieuwsbriefController constructor.
     */
    public function __construct()
    {
        $this->database = new DatabaseController();
    }

    /**
     * Returns all the Nieuwsbrief objects from the database
     * @return array
     */
    public function fetchAll()
    {
        $nieuwsbrieven = [];

        $sql = "SELECT `ID` FROM `nieuwsbrief`";
        if($stmt = $this->database->prepare($sql))
        {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($db_id);

            if($stmt->num_rows >= 1)
            {
                while($stmt->fetch())
                {
                    $nieuwsbrieven[] = new Nieuwsbrief($db_id);
                }
            }
        }

        return $nieuwsbrieven;
    }
}