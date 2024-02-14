<?php
         $to = "nareshdhumal263@gmail.com";
         $subject = "Test Mail";
         
         $message = "<b>This is HTML message.</b>";
         $message .= "<h1>This is headline.</h1>";
         
         $header = "From:nareshd@parasightsolutions.com  \r\n";
        // $header = "From:ideaportal@jmbaxi.com  \r\n";
      //   $header = "From:webmin@ideaportal.jmbaxi.com  \r\n";
         $header .= "Cc:nareshd@parasightsolutions.com  \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>