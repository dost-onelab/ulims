## ULIMS - IMPORTING DATA ##

###RELEASE NOTES###

This document aims to provide instructions on how to use the Import Data feature on Ulims Laboratory Module

####UPDATE FILES####

The following are the files added/updated for this feature:


        ulims/protected/data/DataEntryForm.xlsx
        ulims/protected/extensions/eexcelview/EExcelViewCreateDataEntryFile.php
        ulims/protected/modules/lab/controllers/RequestController.php
        ulims/protected/modules/lab/controllers/AccomplishmentsController.php
        ulims/protected/modules/lab/views/request/importData.php
        ulims/protected/modules/lab/views/request/_importRequestDetail.php
        ulims/upload/import.txt


Download the each file manually and update your existing ULIMS installation or use the synch from this repository.

    Note: Please create a backup of your existing ULIMS installation before applying this update.

After updating local ULIMS grant read/write permissions on the file `ulims/upload/import.txt` by running:
  
        sudo chmod -R 777 ulims/upload/import.txt
        
####UPDATE ULIMS RIGHTS####

        View `ulimsportal.AuthItemChild` table and query for the string "Import" under the `child` column.
        
        Results should show as follows. Insert any entries below not found in your table.
        
        | parent                | child                                 |
        | --------------------- |---------------------------------------|
        | Lab - System Manager 	| Lab.Request.ImportData                |
        | Lab - System Manager 	| Lab.Request.ImportRequest             |
        | Lab - System Manager 	| Lab.Request.ImportRequestDetails      |
        | Lab - System Manager 	| Lab.Request.Import                    |
        | Lab - User            | Lab.Request.ImportData                |
        | Lab - User            | Lab.Request.ImportRequest             |
        | Lab - User            | Lab.Request.ImportRequestDetails      |
        | Lab - User            | Lab.Request.Import                    |

        
####DATA ENTRY FORM ver.1####

Generate (using Chrome) the `DataEntryForm.xlsx` file from the ULIMS Laboratory Module (navigate to `http://{server Hostname or IP}/ulims/lab/request/importData`). Data for `lab`, `customer`, `discount`, `sampletype` and `test` will be available for lookup in the generated file.

Using the generated file, create monthly data entry files (e.g. Jan2010-CHE.xlsx, Feb2010-CHE.xlsx, Mar2010-CHE.xlsx ...) for easy management.

####LOADING THE DATA ENTRY FORM ON ULIMS####

Browse and load each monthly data entry files to verify that all entries. Take some time to navigate and check each entry. View the samples and tests for each request by clicking of the Request Reference(verify that sample codes are in order).

####IMPORTING DATA####

After thoroughly checking each request, Click on the green Import Requests button. If you dont see the button, your data entry file may have requests(requestRefNum) already in ULIMS database which will be in red text. Check the data entry file again for the duplicates. Then try loading the file again.

`Note: Use this feature ONLY to import Requests from previous years/months. Ensure that all entries are checked and verified especially the Request Reference Numbers and Request Dates.`
