## ULIMS - IMPORTING DATA ##

###RELEASE NOTES###

This document aims to provide instructions on how to use the Import Data feature on Ulims Laboratory Module

####UPDATE FILES####

The following are the files added/updated on this feature:

        ```
        ulims/protected/data/DataEntryForm.xlsx
        ulims/protected/extensions/eexcelview/EExcelViewCreateDataEntryFile.php
        ulims/protected/modules/lab/controllers/RequestController.php
        ulims/protected/modules/lab/controllers/AccomplishmentsController.php
        ulims/protected/modules/lab/views/request/importData.php
        ulims/upload/import.txt
        ```

Download the each file manually and update your existing ULIMS installation or use the synch from this repository.

    Note: Please create a backup of your existing ULIMS installation before applying this update.

After updating local ULIMS grant read/write permissions on the file `ulims/upload/import.txt` by running:
  
    `sudo chmod -R 777 ulims/upload/import.txt`

####DATA ENTRY FORM ver.1####

Generate the `DataEntryForm.xlsx` file from the ULIMS Laboratory Module (navigate to http://{server Hostname or IP}/ulims/lab/request/importData). Data for `lab`, `customer`, `discount`, `sampletype` and `test` will be available for lookup in the generated file.

Using the generated file, create monthly data entry files (e.g. Jan2010.xlsx, Feb2010.xlsx, Mar2010.xlsx ...) for easy management.

####LOADING THE DATA ENTRY FORM ON ULIMS####

Use the monthly data entry files and try loading them to verify that all entries on the file are

