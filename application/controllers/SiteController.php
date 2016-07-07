<?php

class SiteController
{
    /**
     * Fetch all the Nieuwsbrief abonnementen
     * And print them in the index view
     */
    function index()
    {
        $ctr = new NieuwsbriefController();
        $emails = $ctr->fetchAll();

        include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'head.php';
        include ROOT . DS . 'application' . DS . 'views' . DS . 'index' . DS . 'content.php';
        include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'footer.php';
    }

    /**
     * Unsubscribe the email with the corresponding ID,
     * if no email has been found return a 404 error
     * @param $page_id
     */
    function uitschrijven($page_id)
    {
        $brief = New Nieuwsbrief($page_id);

        if($brief->getID() != null)
        {
            $status = ($brief->unsubscribe($brief->getID())) ? $brief->getEmail() . " is uitgeschreven" : "mislukt om " . $brief->getEmail() . 'uit te schrijven.';
            include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'head.php';
            include ROOT . DS . 'application' . DS . 'views' . DS . 'uitschrijven' . DS . 'content.php';
            include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'footer.php';
        }
        else
        {
            http_response_code(404);
            echo "<h3>Page not found - 404</h3>";
        }
    }

    /**
     * Subscribe to the Nieuwsbrief with the email,
     * This methods checks if there is an email and if not add a new record in the database
     */
    function inschrijven()
    {
        $brief = new Nieuwsbrief();

        if(!$brief->existsEmail($_POST['email'])) {
            $status = ($brief->subscribe($_POST['email'])) ? "Uw bent nu geabonnerd op de nieuwsbrief!" : "Er ging iets mis, probeer het later opnieuw";
        }
        else
        {
            $status = "U bent al geabonneerd op de nieuwsbrief";
        }

        include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'head.php';
        include ROOT . DS . 'application' . DS . 'views' . DS . 'inschrijven' . DS . 'content.php';
        include ROOT . DS . 'application' . DS . 'views' . DS . 'essentials' . DS . 'footer.php';
    }
}