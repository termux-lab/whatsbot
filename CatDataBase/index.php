<?php
//=============================================
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = @scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
           rrmdir($dir. DIRECTORY_SEPARATOR .$object);
         else
           unlink($dir. DIRECTORY_SEPARATOR .$object);
       }
     }
     rmdir($dir);
   }
 }
//=============================================
function cat_read($db_name, $table_name, $column_name, $akey){
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$column_name = urlencode( $column_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				if(file_exists(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name)){
					return(file_get_contents(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name));
				}else{
					return("column_0");
				}
			}else{
				return("table_0");
			}
		}else{
			return("db_0");
		}
	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_db($db_name, $akey){
	$db_name = urlencode( $db_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		mkdir(__DIR__."/../../cat_db/".$akey."/".$db_name);
		return(true);
	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_del_db($db_name, $akey){
	$db_name = urlencode( $db_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		rrmdir(__DIR__."/../../cat_db/".$akey."/".$db_name);
		return(true);
	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_edit_db($db_name, $db_new_name, $akey){
	$db_name = urlencode( $db_name);
	$db_new_name = urlencode( $db_new_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		rename(__DIR__."/../../cat_db/".$akey."/".$db_name, __DIR__."/../../cat_db/".$akey."/".$db_new_name);
		return(true);
	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_table($db_name, $table_name, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			mkdir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name);
			return(true);
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_del_table($db_name, $table_name, $akey){
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			rrmdir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name);
			return(true);
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_edit_table($db_name, $table_name, $table_new_name, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$table_new_name = urlencode( $table_new_name);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			rename(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name, __DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_new_name);
			return(true);
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_column($db_name, $table_name, $column_name, $content_f, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$column_name = urlencode( $column_name);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				$CREATE_COLUMN = fopen(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name, "w+");
				fwrite($CREATE_COLUMN, $content_f);
				fclose($CREATE_COLUMN);
				return(true);
			}else{
				return("table_0");
			}
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_edit_column($db_name, $table_name, $column_name, $column_new, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$column_name = urlencode( $column_name);
	$column_new = urlencode( $column_new);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				if(file_exists(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name)){
					rename(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name, __DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_new);
					return(true);
				}else{
					return("column_0");
				}
			}else{
				return("table_0");
			}
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_del_column($db_name, $table_name, $column_name, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$column_name = urlencode( $column_name);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				if(file_exists(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name)){
					unlink(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name);
					return(true);
				}else{
					return("column_0");
				}
			}else{
				return("table_0");
			}
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_db_list($akey){
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		$list = scandir(__DIR__."/../../cat_db/".$akey, 1);
		unset($list[count($list)-1], $list[count($list)-1]);
		return(array_reverse($list));
	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_table_list($db_name, $akey){
	$akey = md5($akey[0]).md5($akey[1]);
	$db_name = urlencode( $db_name);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			$list = scandir(__DIR__."/../../cat_db/".$akey."/".$db_name, 1);
			unset($list[count($list)-1], $list[count($list)-1]);
			return(array_reverse($list));
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_column_list($db_name, $table_name, $akey){
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				//if(file_exists(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name."/".$column_name)){
					$list = scandir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name, 1);
					unset($list[count($list)-1], $list[count($list)-1]);
					return(array_reverse($list));
				//}else{
					//return("column_0");
				//}
			}else{
				return("table_0");
			}
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}

function cat_check_table($db_name, $table_name, $akey){
	$db_name = urlencode( $db_name);
	$table_name = urlencode( $table_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name."/".$table_name)){
				return(true);
			}else{
				return(false);
			}
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
function cat_check_db($db_name, $akey){
	$db_name = urlencode( $db_name);
	$akey = md5($akey[0]).md5($akey[1]);
	if(is_dir(__DIR__."/../../cat_db/") and is_dir(__DIR__."/../../cat_db/".$akey)){
		if(is_dir(__DIR__."/../../cat_db/".$akey."/".$db_name)){
			return("true");
		}else{
			return("db_0");
		}

	}else{
		return("\"cat_db\" not installed. Open page \"/CatDataBase/install.php\" for install.");
	}
}
?>
