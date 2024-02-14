<h1>Ping Response</H1>
<?php
echo "<h1>SMTP</h1>";
echo exec("ping -c 3 smtp.gmail.com");

echo "<br><h2>Google</h2><br>";
echo exec("ping -c 3 google.com");
?>