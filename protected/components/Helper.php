<?php
/**
 * Custom HELPER Class.
 * All helper classes for this application should extend from this base class.
 */
class Helper extends CComponent
{
	/**
	 * truncates a text if it is longer than the specified length, and appends '...' 
	 * at the end of the string if it has been truncated.
	 */
	public static function TruncateText($text, $max_len){
		$len = mb_strlen($text, 'UTF-8');
		if ($len <= $max_len)
		return $text;
        else
		return mb_substr($text, 0, $max_len - 1, 'UTF-8') . '<font color="red" title="click to read more"> ...</font>';
	}
	
	/**
	 * converts digit to 3-letter month name.
	 */
	public static function DigitToMonth($int){
		$months = array(
			'01'=>'Jan',
			'02'=>'Feb',
			'03'=>'Mar',
			'04'=>'Apr',
			'05'=>'May',
			'06'=>'Jun',
			'07'=>'Jul',
			'08'=>'Aug',
			'09'=>'Sep',
			'10'=>'Oct',
			'11'=>'Nov',
			'12'=>'Dec',
		);
		$month=$months[$int];
		return $month;
	}
	
	/**
	 * Directory path for saving uploaded files
	 * using document code and create folder for saving
	 * $id = uniqueid of current controller using this function
	 * $dcode = document code where to generate this directory path
 	* $loc = location of the document (e.g. RO,ZDS,ZDN,ZSib,ISA)
	 */	
 	public function DirectoryPath($id, $dcode, $loc){
		$dpath=explode("-",$dcode);
		$dpath_year=$dpath[0];
		$dpath_month=Helper::DigitToMonth($dpath[1]);;
		
		//create directory for saving if not exist
		$uploadfolder='uploads';
		$dir = '\\'.$loc.'\\'.$id.'\\'.$dpath_year.'\\'.$dpath_month.'\\'; // windows format
		$uploaddir=$uploadfolder.$dir;
			if (!file_exists($uploaddir)) {
				mkdir($uploaddir, 0777, true);
				chmod($uploaddir, 0777);
			}
		$dpath = str_replace('\\', '/', $dir);
		$folderPath=array('folder'=>$uploadfolder, 'path'=>$dpath);
		return $folderPath;
	}
	
	/*
	 * Post slug generator, for creating clean urls from titles.
	 * It works with many languages.
	 * useful for filenames during uploads, in case filenames has special characters (non-alphanumeric)  
	*/
	public static function RemoveAccent($str){
		
	  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 
	  'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 
	  'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 
	  'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 
	  'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 
	  'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 
	  'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 
	  'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 
	  'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 
	  'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 
	  'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 
	  'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
	  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 
	  'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 
	  'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 
	  'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 
	  'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 
	  'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 
	  'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 
	  'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 
	  'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 
	  'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 
	  'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 
	  'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
	  return str_replace($a, $b, $str);
	} 
	
	/**
	 * slugify str converts to lowercase, converts non-alphanumerics to hyphens. 
	 * 
	 */
	public static function Slugify($str) { 
		$str = preg_replace('/[^A-Za-z0-9]/', ' ', $str); 
		//$str = preg_replace('/[^a-z0-9\\040\\.\\-\\_\\\\]/i', ' ', $str); 
		//$str = preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), ' ', $str); 
		$str = preg_replace('/\s+/', ' ', $str); 
		$str = str_replace(' ', '-', trim($str)); 
		return mb_strtolower($str); 
		//return Helper::RemoveAccent($str);
	}
		
	public static function checkRemoteFile($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		// don't download content
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(curl_exec($ch)!==FALSE)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
	public static function tableSchema($dbName, $tableName){
		$tableSchema = Yii::app()->information_schema->createCommand()
				->select('table_name, round(((data_length + index_length) / 1024 ), 2) size')
				->from('TABLES')
				//->join('tbl_profile p', 'u.id=p.user_id')
				->where('table_schema=:tableSchema AND table_name=:tableName', array(
								':tableSchema'=>$dbName, ':tableName'=>$tableName)
						)
				->queryRow();
		return (object) $tableSchema;
	}	
		
}