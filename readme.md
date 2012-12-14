# SilverStripe 2.4 Asset Cleaner
Because we all need nice clean Assets
## What it does
This controller loops through File DataObject and check to see if the file is used in any Page Content. If its not used it deletes it.
## How to Use
Copy this file to your code page and add Director rule for it in your config. 

I've also added a search of a Product DataObject with $has_one relation of Image as an example of how to handle Images or Files that may be linked to DataObjects, you'll need to add this for any $has_one file relations you may have create. 
## Note:
* This will not parse $has_many relations
* The controller also may throw false negatives (think a file is used when its not) since it uses a MySQL LIKE search. If the file or folder name is common like "photo.jpg" it'll search the Content field for "photo".
* On shared hosting you may run into a timeout, you can either modify the code to take a limit and offset or just re-run. Since  non-deleted files take so little time it should easily skip over them and make it to actual files that need to be deleted before it times out.
* I wouldn't leave this class on live sites as it doesn't do permission check.