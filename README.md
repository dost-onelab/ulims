DOST Unified Laboratory Information Management System
=====

RELEASE NOTES

This document provides the release notes for the Unified Laboratory Information System. It describes installation     instructions, configuration changes compared to the previous releases of ULIMS, additional features and etc ...

SYSTEM REQUIREMENTS



INSTALLATION

    1.  Download or clone ulims from this repository.
    2.  Extract the release file to a Web-accessible directory:
            
            X:/xampp/htdocs for xampp on windows environment
            /var/www or /var/www/html for linux
            
    3.  Modify database configurations:
            


FILE PERMISSIONS

    Grant read/write permissions by running the following commands:

        sudo chmod -R 777 ulims/assets
        sudo chmod -R 777 ulims/protected/runtime
        sudo chmod -R 777 ulims/config/site-settings.ini
        sudo chmod -R 777 ulims/config/form-settings.ini

