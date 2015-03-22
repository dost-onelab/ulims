## DOST Unified Laboratory Information Management System ##

###RELEASE NOTES###

This document provides the release notes for the Unified Laboratory Information Management System. 
It describes installation instructions, configuration changes compared to the previous releases of ULIMS, 
additional features and etc ...


####SYSTEM REQUIREMENTS####

This release requires at least PHP 5.1 and above. This release has been tested with Apache HTTP server on 
Windows and Linux. It may also run on other Web servers and platforms, provided PHP 5.1 is supported.


####COMPATIBILITY####
This release has been tested with the following:

    | Operating Systems     | Web Server / PHP / MySQL Version                          |
    | --------------------- |-----------------------------------------------------------|
    | Windows 7 Pro         | XAMPP 1.7.3 - Apache 2.2.14 / PHP 5.3.1 / MySQL 5.1.41    |
    |                       | XAMPP 5.6.3 - Apache 2.4.10 / PHP 5.6.3 / MySQL 5.6.21    |
    |                       |                                                           |
    | Ubuntu 14.04.1 LTS    | Apache 2.4.7 / PHP 5.5.9 / MySQL 5.5.40                   |
    

####PRE-INSTALLATION####

From your existing ULIMS installation do the following:
- Secure a copy of the `ulims/protected/config` and `ulims/images` directory. 
  You will need information from the files in that directory. 
    
- Export(backup) the databases (ulimsaccounting, ulimscashiering, ulimslab, ulimsportal, phaddress).
    
(Skip this if you are installing from scratch)


####INSTALLATION####

1. Download or clone ulims from this repository.
2. Extract the release file to a Web-accessible directory:
    ```    
    X:/xampp/htdocs for xampp on windows environment
    /var/www or /var/www/html for linux
    ```  

3. ULIMS Configurations

    - Database credentials for ULIMS have been moved to `/ulims/protected/config/db.php` which resides on the same directory as the main.php file. In this way we will always have the same `main.php` file. 

    - Update the usernames and passwords for the different databases specified in the db.php file.
    
    - Replace the following files in the `/ulims/protected/config` with the ones you obtained from the Pre-Installation instruction:
        ```
        site-settings.ini
        form-settings.ini
        ```
    
    - Replace the directory `/ulims/images` from the Pre-Installation instruction:
    
4. Databases
 
    ##### A. New Installation #####

    - If you are installing from scratch - create and import clean databases from the `ulims/protected/data` directory.
    
    ##### B. Migrating from Existing Installation #####

    - Create and import the database (ulimsaccounting, ulimscashiering, ulimslab, ulimsportal, phaddress) you obtained from the Pre-Installation instruction.
        
    - Check the structure of the `ulimslab.request` table. The datatype for field `requestDate` should be 'date' and there should be a field `create_time` with a 'TIMESTAMP' datatype. 
            
    - If not, execute the following sql commands separately.
        ```
        ALTER TABLE `request` CHANGE `requestDate` `requestDate` DATE NOT NULL
        ALTER TABLE `request` ADD `create_time` TIMESTAMP
        UPDATE `ulimslab`.`request` SET `create_time` = `requestDate`
        ALTER TABLE `request` CHANGE `create_time` `create_time` TIMESTAMP NOT NULL
        ALTER TABLE `request` CHANGE `create_time` `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ```
    This modifications with fix the issue on generating duplicate request reference when creating requests.
            
            
    - Truncate the tables `ulimsportal.AuthItem` and `ulimsportal.AuthItemChild`.
    
        ```
        TRUNCATE TABLE `AuthItem`
        TRUNCATE TABLE `AuthItemChild`
        ```        
    Import the `AuthItem.sql` and `AuthItemChild.sql` from `ulims/protected/data` directory to the respective tables in ulimsportal database.
    
    ##### C. Additional Database #####
    
    - A new database has been added for the Referral Module. Create new database `onelabdb` and import  `ulims/protected/data/onelabdb.sql`. 


    - Select onelabdb and separately execute each of the four(4) sets of commands in the             `ulims/protected/data/onelabdb_views.txt`.
  

5.  File/Folder Permissions (for linux installation)

    - Grant read/write permissions to several files/folders by running the following commands:
 
        ```
        sudo chmod -R 777 ulims/assets
        sudo chmod -R 777 ulims/protected/runtime
        sudo chmod 777 ulims/config/site-settings.ini
        sudo chmod 777 ulims/config/form-settings.ini
        sudo chmod 777 ulims/config/api-settings.ini
        ```
        
        create the folder `ulims/assets` if does not exist.
    
    - The following tables are case-sensitive:
    
        ```
        ulimsportal.AuthItem
        ulimsportal.AuthItemChild
        ulimsportal.Rights
        ```
        
        rename these tables as indicated above.

more info soon...
