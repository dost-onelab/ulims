DOST Unified Laboratory Information Management System
=====

RELEASE NOTES

This document provides the release notes for the Unified Laboratory Information System. It describes installation     instructions, configuration changes compared to the previous releases of ULIMS, additional features and etc ...

SYSTEM REQUIREMENTS

PRE-INSTALLATION

    From your existing ULIMS installation do the following:
        - Secure a copy of the ulims/protected/config directory. You will need information from the files in that directory. 
        - Export the databases (ulimsaccounting, ulimscashiering, ulimslab, ulimsportal, phaddress).
        
    (Skip this if you are installing from scratch)

INSTALLATION

    1.  Download or clone ulims from this repository.
    2.  Extract the release file to a Web-accessible directory:
            
            X:/xampp/htdocs for xampp on windows environment
            /var/www or /var/www/html for linux
            
    3.  ULIMS Configurations
    
        Database credentials for ULIMS have been moved to /ulims/protected/config/db.php which resides on the same
        directory as the main.php file. In this way we will always have the same main.php file. 
        
        Update the usernames and passwords for the different databases specified in the db.php file.

    4.  Databases
    
        Create and import the database (ulimsaccounting, ulimscashiering, ulimslab, ulimsportal, phaddress) 
        you obtained from the Pre-Installation instruction.
        
        If you are installing from scratch - create and import clean databases from the ulims/protected/data
        directory.
        
        A new database has been added for the Referral Module. Create new database `onelabdb` and import 
        ulims/protected/data/onelabdb.sql. Select onelabdb and execute the four sets of commands in the 
        ulims/protected/data/onelabdb_views.txt
        
FILE PERMISSIONS

    Grant read/write permissions by running the following commands:

        sudo chmod -R 777 ulims/assets
        sudo chmod -R 777 ulims/protected/runtime
        sudo chmod -R 777 ulims/config/site-settings.ini
        sudo chmod -R 777 ulims/config/form-settings.ini

