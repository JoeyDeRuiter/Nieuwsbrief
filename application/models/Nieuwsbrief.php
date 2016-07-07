<?php

/**
 * Class Nieuwsbrief
 * @Author Joey de Ruiter
 */

class Nieuwsbrief
{
    /**
     * @var null | int, the nieuwsbrief ID out the databasae
     */
    protected $id = null;

    /**
     * @var string, the nieuwsbrief email out the database
     */
    protected $email = "";

    /**
     * Nieuwsbrief constructor.
     * If an id is supplemented, load the nieuwsbrief corresponding to the id out of the database
     * @param null $id
     */
    public function __construct($id = null)
    {
        if($id != null)
        {
            $this->load($id);
        }
    }

    /**
     * Load the Nieuwsbrief data from the MySQL database,
     * Returns true on successful load
     * @param $id
     * @return bool
     */
    public function load($id)
    {
        $database = new DatabaseController();
        $sql = "SELECT `ID`, `email` FROM `nieuwsbrief` WHERE `ID` = ?";

        if($stmt = $database->prepare($sql))
        {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($db_id, $db_email);

            if($stmt->num_rows >= 1)
            {
                $stmt->fetch();
                $this->id = $db_id;
                $this->email = $db_email;
                return true;
            }
        }

        return false;
    }

    /**
     * Subscribe with an email
     * @param $email
     * @return bool
     */
    public function subscribe($email)
    {
        $database = new DatabaseController();
        // Check if valid email
        // Check if not exists
        // Insert into database

        // If the email is invalid return false
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;

        if(!$this->existsEmail($email))
        {
            $sql = "INSERT INTO `nieuwsbrief`(`ID`, `email`) VALUES (null,?)";

            if($stmt = $database->prepare($sql))
            {
                $stmt->bind_param('s', $email);
                return (bool)$stmt->execute();
            }
        }

    }

    /**
     * Unsubscribe an email address with the corresponding ID
     * Returns true on success
     * @param $id
     * @return bool
     */
    public function unsubscribe($id)
    {
        $database = new DatabaseController();
        // Check if exists
        // Remove from database

        if($this->existsID($id))
        {
            $sql = "DELETE FROM `nieuwsbrief` WHERE `ID` = ?";

            if($stmt = $database->prepare($sql))
            {
                $stmt->bind_param('i', $id);
                return (bool)$stmt->execute();
            }
        }
    }

    /**
     * Returns true if there is a email with the requested email is found
     * Returns false if not
     * @param $email
     * @return bool
     */
    public function existsEmail($email)
    {
        $database = new DatabaseController();
        $sql = "SELECT `email` FROM `nieuwsbrief` WHERE `email` = ?";

        if($stmt = $database->prepare($sql))
        {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            return (bool)$stmt->num_rows;
        }
    }

    /**
     * Returns true if there is a email with the requested email with the id is found
     * Returns false if not
     * @param $id
     * @return bool
     */
    public function existsID($id)
    {
        $database = new DatabaseController();
        $sql = "SELECT `email` FROM `nieuwsbrief` WHERE `ID` = ?";

        if($stmt = $database->prepare($sql))
        {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            return (bool)$stmt->num_rows;
        }
    }

    /**
     * Returns the Nieuwsbrief ID
     *
     * @return int
     */
    public function getID()
    {
        return (int)$this->id;
    }

    /**
     * Returns the Nieuwsbrief email
     *
     * @return string
     */
    public function getEmail()
    {
        return (string)$this->email;
    }
}