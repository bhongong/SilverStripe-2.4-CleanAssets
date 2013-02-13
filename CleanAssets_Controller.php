<?php

class CleanAssets_Controller extends Controller {

	public function AssetWipe() {
		echo "go for wipe<br>\n";
		$fileList = DataObject::get('File', "Name != 'Uploads'");
		if ($fileList) {
			echo "files<br>\n";
			foreach ($fileList as $file) {
				echo("Checking if ".$file->FileName." is used in content<br>\n");
				$needle = substr($file->Name, 0 , -4);
				
				$haystack = DataObject::get('SiteTree', "Content LIKE '%".$needle."%'");
				$haystack2 = DataObject::get('Product', "ImageID = ".$file->ID);
				if($haystack2) {
					if($haystack) {
						$haystack->merge($haystack2);
					} else {
						$haystack = $haystack2;
					}
					
				}
				
				if($haystack) {
					echo $needle." is used <br>\n";
				} else {
					echo $needle." is NOT used <br>\n";
					if ($file->ClassName == "Image") {
						$resized = $file->deleteFormattedImages();
						echo "Deleted ".$resized." formatted images <br>\n";
					}
					echo "Deleting ".$file->FileName."<br>\n"; 
					$file->delete();
				}
				
			}
			
			
		} else {
			echo "no files <br>\n";
		}
		
		return false;
	
	}

}
