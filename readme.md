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
        change filepath on line 87 the local location of the verify.php file
    Setup database:
        run MySQL in XAMPP
        press the admin button
        press the import button
        upload the bookit.sql file located in the sql folder
        run without changing any settings
