PLEASE DO NOT FOLLOW ALL OF THE INSTRUCTIONS BELOW TO SETUP THE SYSTEM IF YOU ARE A DEVELOPER THEY MIGHT NOT BE CORRECT


Reservation system for the Emmen campus of NHL Stenden
Recommended operating system:
    Windows

Programs needed to run project:
    XAMPP
    Any browser

Setup:
    Setup email server in XAMPP
        locate XAMPP/sendmail/sendmail.ini file
        open in any text editor
        change smtp_server to smtp.gmail.com
        change smtp_port to 465
        change auth_username to test.nhlstenden@gmail.com
        change auth_password to Project2pw
        change filepath on line 87 the local location of the verify.php file DO NOT CHANGE THE FILEPATH ON THAT LINE, IT DOESN'T EXIST
        locate XAMPP/php/php.ini file
        open in any text editor
        change smtp_server to smtp.gmail.com
        change smtp_port to 465
        remove semicolon from line that contains sendmail filepath and change it to the location of that file. usually "\"C:\XAMPP\sendmail\sendmail.exe" -t"
    Setup database:
        run MySQL in XAMPP
        press the admin button
        press the import button
        upload the bookit.sql file located in the sql folder
        run without changing any settings
