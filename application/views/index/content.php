<table>
<tr>
    <th>Email</th><th></th>
</tr>
    <?php
    foreach ($emails as $email)
    {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($email->getEmail(), ENT_COMPAT,'UTF-8',true) . '</td>';
        echo '<td><a href="//'. $_SERVER['SERVER_NAME'] . '/uitschrijven/' . $email->getID() . '" class="uitschrijven" data-confirm="Weet je zeker dat je '.htmlspecialchars($email->getEmail()).' wilt uitschrijven?">uitschrijven</a></td>';
        echo '</tr>';
    }
    ?>
</table>

<hr/>

<h2>Inschrijven</h2>
<form action="inschrijven" method="POST">
    <table>
        <tr>
            <td>Email:</td><td><input type="text" name="email" placeholder="Email"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Inschrijven"></td><td></td>
        </tr>
    </table>
</form>

<script>

    var unsubscribeLinks = document.querySelectorAll('.uitschrijven');

    for (var i = 0; i < unsubscribeLinks.length; i++)
    {
        unsubscribeLinks[i].addEventListener('click', function(evt)
        {
            evt.preventDefault();
            if(confirm(this.getAttribute('data-confirm')))
                window.location.href = this.getAttribute('href');
        });
    }

</script>