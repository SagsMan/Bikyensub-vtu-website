<?php
ini_set('max_execution_time', 1000);
include_once('functions_custom_fields.php');

///GENERAL////

function get_datetime_()
{
    return Date('Y/m/d H:i:s a');
}

function get_datetime12_()
{
    return Date('Y/m/d h:i:s a');
}

function get_date_()
{
    return Date('Y-m-d');
}

function getDate_()
{
    return Date('Y-m-d');
}

function putSpaceBetweenWords($string)
{

    $result = '';
    $string = trim($string);
    $string = str_split($string);
    for ($i = 0; $i < count($string); $i++) {
        $string[$i] = str_replace('_', '', $string[$i]);
        if ($string[$i] != strtoupper($string[$i])) {
            $result .= $string[$i];
        } else {
            $result .= ' ' . $string[$i];
        }
    }

    return strabbr($result);
}

function strabbr($string)
{

    $string = str_replace('Total', 'Tot.', $string);
    $string = str_replace('Number', 'No.', $string);
    //str_replace(search, replace, subject)

    return $string;
}

function sanitizeString_($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}

function sanitizeMySQL_($var)
{
    $str_stripped = str_replace("'", "`", $var);
    $var = $str_stripped;

    $connection = getMySqlLink_();
    $var = sanitizeString_($var);
    $var = $connection->real_escape_string($var);
    //$var = sanitizeString_($var);
    return $var;
}

function getMySqlLink_()
{
    $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if (!$link) {
        die('Connection failed: ' . $link->error());
        return null;
    } else {
        return $link;
    }

    return null;
}

function getMySQLPDOLink_($dsn = null, $options = null)
{
    if ($dsn == null) {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ";charset=" . DB_CHARSET;
    }
    if ($options == null) {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        return $pdo;
    } catch (\PDOException $e) {
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        return false;
    }
}

function validatePOSTS($varArray)
{
    $result = array();

    foreach ($varArray as $item) {
        if (!isset($_POST[$item]) || empty($_POST[$item])) {
            return false;
        }
    }
    return true;
}

function validateGETS($varArray)
{
    $result = array();

    foreach ($varArray as $item) {
        if (!isset($_GET[$item]) || empty($_GET[$item])) {
            return false;
        }
    }
    return true;
}

////APP SPECIFIC///

function getRow($pdo, $id, $sql)
{
    $row = null;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $rows = $stmt->fetchAll();
        if ($rows) {
            $row = $rows[0];
        }
    } catch (\PDOException $e) {
        //$errorMessage .= '<b>Database error</b><br>';
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $row;
}

function truncate($string, $length, $html = true)
{
    if (strlen($string) > $length) {
        if ($html) {
            // Grabs the original and escapes any quotes
            $original = str_replace('"', '\"', $string);
        }

        // Truncates the string
        $string = substr($string, 0, $length);

        // Appends ellipses and optionally wraps in a hoverable span
        if ($html) {
            $string = '<span title="' . $original . '">' . $string . '&hellip;</span>';
        } else {
            $string .= '...';
        }
    }

    return $string;
}


function encode_algocode($content, $contentType)
{

    if ($content == '' || $contentType == '') {
        return $content;
    }

    switch ($contentType) {
        case 'json':
        case 'object':
        case 'array':
            $content = str_replace('"', '$dblquote$', $content);
            $content = str_replace('"', '$doublequote$', $content);
            $content = str_replace('\'', '$singlequote$', $content);
            $content = str_replace(',', '$comma$', $content);
            $content = str_replace(':', '$fullcolon$', $content);
            $content = str_replace('{', '$lbrace$', $content);
            $content = str_replace('}', '$rbrace$', $content);
            $content = str_replace('.', '$fullstop$', $content);
            $content = str_replace('*', '$asterisk$', $content);
            $content = str_replace('/', '$fslash$', $content);
            $content = str_replace('\\', '$bslash$', $content);
            break;
        case 'php':
            $content = str_replace('<', '$gt$', $content);
            $content = str_replace('>', '$lt$', $content);
            $content = str_replace('&', '$amp$', $content);
            $content = str_replace('/', '$fslash$', $content);
            $content = str_replace('\\', '$bslash$', $content);
            $content = str_replace(';', '$semicolon$', $content);
            $content = str_replace('"', '$dblquote$', $content);
            $content = str_replace('"', '$doublequote$', $content);
            $content = str_replace('\'', '$singlequote$', $content);
            $content = str_replace(',', '$comma$', $content);
            $content = str_replace(' ', '$space$', $content);
            $content = str_replace('.', '$fullstop$', $content);
            $content = str_replace('*', '$asterisk$', $content);
            break;
        case 'sql':
            $content = str_replace(',', '$comma$', $content);
            $content = str_replace('.', '$fullstop$', $content);
            $content = str_replace('*', '$asterisk$', $content);
            $content = str_replace('/', '$fslash$', $content);
            $content = str_replace('\\', '$bslash$', $content);
            $content = str_replace('"', '$doublequote$', $content);
            break;
        case 'text':
            $content = $content;
            break;
        case 'mixed':
        case 'html':
            $content = str_replace('"', '$dblquote$', $content);
            $content = str_replace('"', '$doublequote$', $content);
            $content = str_replace('\'', '$singlequote$', $content);
            $content = str_replace(',', '$comma$', $content);
            $content = str_replace(':', '$fullcolon$', $content);
            $content = str_replace(';', '$semicolon$', $content);
            $content = str_replace('{', '$lbrace$', $content);
            $content = str_replace('}', '$rbrace$', $content);
            $content = str_replace('<', '$gt$', $content);
            $content = str_replace('>', '$lt$', $content);
            $content = str_replace('&', '$amp$', $content);
            $content = str_replace('/', '$fslash$', $content);
            $content = str_replace('\\', '$bslash$', $content);
            $content = str_replace(' ', '$space$', $content);
            $content = str_replace('.', '$fullstop$', $content);
            $content = str_replace('*', '$asterisk$', $content);

            break;
        default:
            break;
    }

    return $content;
}

function decode_algocode($content, $contentType)
{

    if ($content == '' || $contentType == '') {
        return $content;
    }

    switch ($contentType) {
        case 'json':
        case 'object':
        case 'array':
            $content = str_replace('$dblquote$', '"', $content);
            $content = str_replace('$doublequote$', '"', $content);
            $content = str_replace('$singlequote$', '\'', $content);
            $content = str_replace('$comma$', ',', $content);
            $content = str_replace('$fullcolon$', ':', $content);
            $content = str_replace('$lbrace$', '{', $content);
            $content = str_replace('$rbrace$', '}', $content);
            $content = str_replace('$fullstop$', '.', $content);
            $content = str_replace('$asterisk$', '*', $content);
            $content = str_replace('$fslash$', '/', $content);
            $content = str_replace('$bslash$', '\\', $content);
            break;
        case 'php':
            $content = str_replace('$gt$', '<', $content);
            $content = str_replace('$lt$', '>', $content);
            $content = str_replace('$amp$', '&', $content);
            $content = str_replace('$fslash$', '/', $content);
            $content = str_replace('$bslash$', '\\', $content);
            $content = str_replace('$semicolon$', ';', $content);
            $content = str_replace('$dblquote$', '"', $content);
            $content = str_replace('$doublequote$', '"', $content);
            $content = str_replace('$singlequote$', '\'', $content);
            $content = str_replace('$comma$', ',', $content);
            $content = str_replace('$space$', ' ', $content);
            $content = str_replace('$fullstop$', '.', $content);
            $content = str_replace('$asterisk$', '*', $content);
            break;
        case 'sql':
            $content = str_replace('$comma$', ",", $content);
            $content = str_replace('$fullstop$', '.', $content);
            $content = str_replace('$asterisk$', '*', $content);
            $content = str_replace('$fslash$', '/', $content);
            $content = str_replace('$bslash$', '\\', $content);
            $content = str_replace('$doublequote$', '"', $content);
            break;
        case 'text':
            $content = $content;
            break;
        case 'mixed':
        case 'html':
            $content = str_replace('$dblquote$', '"', $content);
            $content = str_replace('$doublequote$', '"', $content);
            $content = str_replace('$singlequote$', '\'', $content);
            $content = str_replace('$comma$', ',', $content);
            $content = str_replace('$fullcolon$', ':', $content);
            $content = str_replace('$semicolon$', ';', $content);
            $content = str_replace('$lbrace$', '{', $content);
            $content = str_replace('$rbrace$', '}', $content);
            $content = str_replace('$gt$', '<', $content);
            $content = str_replace('$lt$', '>', $content);
            $content = str_replace('$amp$', '&', $content);
            $content = str_replace('$fslash$', '/', $content);
            $content = str_replace('$bslash$', '\\', $content);
            $content = str_replace('$space$', " ", $content);
            $content = str_replace('$fullstop$', '.', $content);
            $content = str_replace('$asterisk$', '*', $content);

            break;
        default:
            break;
    }

    return $content;
}


function getFileContentsByLines($filename){
	$fn = fopen($filename,"r");$result=array();while(!feof($fn))  { $result[] = fgets($fn); }fclose($fn);return $result;
}
 

function handleExport_($payload, $payback)
{

    
    $states = array(
      "account","audit","fees","ministry","ministryusers","paid","paidx","pin","pins","schools","schoolusers","students","zones");
    if(in_array($payload, $states))
    {
     
    }else{
      return $payback;
    }

    $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if(!$link) {
        die('Connection failed: ' . $link->error());
            $payback["data"] = array();
            $payback["message"] = 'Database Connection Failure!';
    }else{

      $result  = $link->query("SELECT * FROM `$payload`");

      $fp = fopen('data/csv/'.$payload.'.csv', 'w');while($row = mysqli_fetch_assoc($result)){fputcsv($fp, $row);}fclose($fp);
      $payback["data"] = array();
      $payback["message"] = $payload;
    }

    return $payback;
}




function useObjectTemplate($pdo, $object_id, $selected_objecttemplate_id, $use_template_bool, $existing_fields,$existing_fieldsui)
{
    $template_definition ='';
    $template_definitionui ='';
    $existing_fieldsui=decode_algocode($existing_fieldsui , 'php');
    if ($object_id > 0 && $selected_objecttemplate_id > 0 && $use_template_bool == true) {
        //get tobject template
        $objecttemplate = array();
        try {
            $stmt = $pdo->prepare("SELECT * FROM `objecttemplates` WHERE `id`=?");
            $stmt->execute([$selected_objecttemplate_id]);
            $row = $stmt->fetchAll();
            if ($row) {
                //object template definition must not be empty
                if(!empty($row[0]['definition'])){
                    //update objects.fields and fieldsui
                    $row[0]['definition']= decode_algocode($row[0]['definition'] , 'php');
                    $row[0]['definitionlistui']= decode_algocode($row[0]['definitionlistui'] , 'php');

                    $stmt_object =  $pdo->prepare("UPDATE `objects` SET `fields`=?,`fieldsui`=? WHERE `id`=?");
                    $stmt_object->execute([$row[0]['definition'],$row[0]['definitionlistui'], $object_id]);

                    
                    $template_definition = $row[0]['definition'];
                    $template_definitionui = $row[0]['definitionlistui'];
                    
                   
                }
            }
        } catch (\PDOException $e) {
            //$errorMessage .= '<b>Database error</b><br>';
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    } else {
    }

    if(empty($template_definition)){
        $template_definition=$existing_fields;
    }elseif(!empty($existing_fields)){
        $template_definition=explode(',',$template_definition);
        $e=explode(',',$existing_fields);
        $found=false;
        for($i=0;$i < count($template_definition);$i++){
            for($ii=0;$ii < count($e);$ii++){
                if(trim($template_definition[$i])==trim($e[$ii])){
                    $found=true;break;
                }
            }
            if($found==false){
                $existing_fields .=','.$template_definition[$i];
            }else{$found=false;}   
        }
        $template_definition=$existing_fields;        
    }


  
    

/*
    if(empty($template_definitionui)){
        $template_definitionui=$existing_fieldsui;
    }elseif(!empty($existing_fieldsui)){
        $template_definitionui=explode(',',$template_definitionui);
 
        for($i=0;$i < count($template_definitionui);$i++){        
            
            if( strpos ($existing_fieldsui,trim($template_definitionui[$i])) > -1){
            }else{
               $existing_fieldsui .=','.$template_definitionui[$i];
            }
        }
        $template_definitionui=$existing_fieldsui;        
    }
*/
//$tt='';
if(empty($template_definitionui)){
    $template_definitionui=$existing_fieldsui;
}elseif(!empty($existing_fieldsui)){
    $template_definitionui=explode(',',$template_definitionui);
    $e=explode(',',$existing_fieldsui);
    $found=false;
    for($i=0;$i < count($template_definitionui);$i++){
        for($ii=0;$ii < count($e);$ii++){
            //$tt .= 'if('.trim($template_definitionui[$i]).'=='.trim($e[$ii]);
            if(trim($template_definitionui[$i])==trim($e[$ii])){
                $found=true;break;
            }
        }
        if($found==false){
            $existing_fieldsui .=','.$template_definitionui[$i];
        }else{$found=false;}   
    }
    $template_definitionui=$existing_fieldsui;        
}




    //file_put_contents('11111111111ddd', $tt);



    $r=array();
    $r["fields"]= $template_definition;
    $r["fieldsui"]= $template_definitionui;

    //return $template_definition;
    return $r;
}

function importObjectDefinitionFromCSV($pdo, $object_id, $import_csv_bool, $existing_fields,$existing_fieldsui,$import_csv_file)
{
    $template_definition ='';
    $template_definitionui ='';
    $existing_fieldsui=decode_algocode($existing_fieldsui , 'php');

    if( (isset($_FILES[$import_csv_file])) &&  $_FILES[$import_csv_file]['type']=='application/vnd.ms-excel'){
    
        if($object_id>0 && $import_csv_bool==true && empty($existing_fieldsui) && isset($_FILES[$import_csv_file]['name'][0]) ) {

             $fn = getFileContentsByLines($_FILES[$import_csv_file]['tmp_name']);

             if(isset($fn)){
                //lines returned
                $fields='';
                $fieldtypes='';
                if(isset($fn[0])){$fields=$fn[0];}
                if(isset($fn[1])){$fieldtypes=$fn[1];}

                if(!empty($fields)){$fields=explode(",", $fields);}
                if(!empty($fieldtypes)){$fieldtypes=explode(",", $fieldtypes);}

                for ($i=0; $i < count($fields) ; $i++) {
                    //convert spaces with _ because field name have no spaces
                    $fields[$i]=str_replace(' ', '_', trim($fields[$i]) );
                    //remove . because field name have no spaces
                    $fields[$i]=str_replace('.', '', trim($fields[$i]) );
                    //remove ' because field name have no spaces
                    $fields[$i]=str_replace("'", '', trim($fields[$i]) );
                    //remove . because field name have no spaces
                    $fields[$i]=str_replace('`', '', trim($fields[$i]) );
                    //convert - with _ because field name have no spaces
                    $fields[$i]=str_replace('-', '_', trim($fields[$i]) );

                    //convert & with _ because field name have no spaces
                    $fields[$i]=str_replace('&', '_', trim($fields[$i]) );


                    //convert to small caps
                    $fields[$i]=strtolower(trim($fields[$i]) );

                    
                    //handle fiel type
                    if( (isset($fieldtypes[$i])) &&  (!empty($fieldtypes[$i]))  ){
                        $template_definition .= $fields[$i].' as '.$fieldtypes[$i]; 
                        //$fieldtypes=$fn[1];
                    }else{
                        //set default as string
                        $template_definition .= $fields[$i].' as string '; 

                    }//if

                    //add , if not the last field
                    if(($i+1) < count($fields) ){ $template_definition = $template_definition.',';  }




                }//for

                //update objects
                $stmt_object =  $pdo->prepare("UPDATE `objects` SET `fields`=?,`fieldsui`=? WHERE `id`=?");
                $stmt_object->execute([$template_definition,$template_definitionui, $object_id]);



             }//if
             

        }else{
            //no import send back original definitions
            $template_definition=$existing_fields;
            $template_definitionui=$existing_fieldsui;

        }//else
    }else{
            //no import send back original definitions
            $template_definition=$existing_fields;
            $template_definitionui=$existing_fieldsui;

        }//else


    $r=array();
    $r["fields"]= $template_definition;
    $r["fieldsui"]= $template_definitionui;
    return $r;

}





function useComponentTypes($pdo, $object_id, $selected_objecttemplate_id, $use_template_bool, $existing_fields,$existing_fieldsui)
{
    $template_definition ='';
    $template_definitionui ='';
    $existing_fieldsui=decode_algocode($existing_fieldsui , 'php');
    if ($object_id > 0 && $selected_objecttemplate_id > 0 && $use_template_bool == true) {
        //get tobject template
        $objecttemplate = array();
        try {
            $stmt = $pdo->prepare("SELECT * FROM `componenttypes` WHERE `id`=?");
            $stmt->execute([$selected_objecttemplate_id]);
            $row = $stmt->fetchAll();
            if ($row) {
                //object template definition must not be empty
                if(!empty($row[0]['fields'])){
                    //update objects.fields and fieldsui
                    $row[0]['fields']= decode_algocode($row[0]['fields'] , 'php');
                    $row[0]['fieldsui']= decode_algocode($row[0]['fieldsui'] , 'php');

                    $stmt_object =  $pdo->prepare("UPDATE `objects` SET `fields`=?,`fieldsui`=? WHERE `id`=?");
                    $stmt_object->execute([$row[0]['fields'],$row[0]['fieldsui'], $object_id]);

                    
                    $template_definition = $row[0]['fields'];
                    $template_definitionui = $row[0]['fieldsui'];
                    
                   
                }
            }
        } catch (\PDOException $e) {
            //$errorMessage .= '<b>Database error</b><br>';
            //throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    } else {
    }

    if(empty($template_definition)){
        $template_definition=$existing_fields;
    }elseif(!empty($existing_fields)){
        $template_definition=explode(',',$template_definition);
        $e=explode(',',$existing_fields);
        $found=false;
        for($i=0;$i < count($template_definition);$i++){
            for($ii=0;$ii < count($e);$ii++){
                if(trim($template_definition[$i])==trim($e[$ii])){
                    $found=true;break;
                }
            }
            if($found==false){
                $existing_fields .=','.$template_definition[$i];
            }else{$found=false;}   
        }
        $template_definition=$existing_fields;        
    }


  
    

/*
    if(empty($template_definitionui)){
        $template_definitionui=$existing_fieldsui;
    }elseif(!empty($existing_fieldsui)){
        $template_definitionui=explode(',',$template_definitionui);
 
        for($i=0;$i < count($template_definitionui);$i++){        
            
            if( strpos ($existing_fieldsui,trim($template_definitionui[$i])) > -1){
            }else{
               $existing_fieldsui .=','.$template_definitionui[$i];
            }
        }
        $template_definitionui=$existing_fieldsui;        
    }
*/
//$tt='';
if(empty($template_definitionui)){
    $template_definitionui=$existing_fieldsui;
}elseif(!empty($existing_fieldsui)){
    $template_definitionui=explode(',',$template_definitionui);
    $e=explode(',',$existing_fieldsui);
    $found=false;
    for($i=0;$i < count($template_definitionui);$i++){
        for($ii=0;$ii < count($e);$ii++){
            //$tt .= 'if('.trim($template_definitionui[$i]).'=='.trim($e[$ii]);
            if(trim($template_definitionui[$i])==trim($e[$ii])){
                $found=true;break;
            }
        }
        if($found==false){
            $existing_fieldsui .=','.$template_definitionui[$i];
        }else{$found=false;}   
    }
    $template_definitionui=$existing_fieldsui;        
}




    //file_put_contents('11111111111ddd', $tt);



    $r=array();
    $r["fields"]= $template_definition;
    $r["fieldsui"]= $template_definitionui;

    //return $template_definition;
    return $r;
}



function getAppLogo(){
	$payback='';

		if(APP_STOREUPLOADPATHINDATABASE !==true){
			if(file_exists(APP_UPLOADS.APP_USERS."1-o-1-logo")){
				$payback = APP_UPLOADS.APP_USERS."1-o-1-logo";
			}else {
				$payback = APP_ROOT.APP_UI."/".'images'."/".APP_LOGO;
			}
		}else{
			if ( (isset($_SESSION[APP_SESSION_NAME]["logoPath"])) && empty($_SESSION[APP_SESSION_NAME]["logoPath"]) ) {
				$payback = APP_ROOT.APP_UI.'/'.'images'.'/'.APP_LOGO;
			}else{
				$payback = $_SESSION[APP_SESSION_NAME]["logoPath"];
			} 
		}

	return $payback;
}




function replaceNumberWithString($input) {
    $input = str_replace(' is_custom_size',' is_ custom_size',$input);
    $input = str_replace(' is custom_size',' is_ custom_size',$input);
    $input = str_replace('is_ custom_size',' is_ custom_size',$input);
    $pattern = '/string;(\d+),/';
    
    $output = preg_replace_callback($pattern, function($matches) {
        $number = (int)$matches[1];
        
        if ($number >= 1 && $number <= 10) {
            return 'string:col-12 col-md-1 col-lg-1 is_ custom_size,';
        } elseif ($number >= 11 && $number <= 20) {
            return 'string:col-12 col-md-2 col-lg-2 is_ custom_size,';
        } elseif ($number >= 21 && $number <= 30) {
            return 'string:col-12 col-md-3 col-lg-3 is_ custom_size,';
        } elseif ($number >= 31 && $number <= 40) {
            return 'string:col-12 col-md-4 col-lg-4 is_ custom_size,';
        } elseif ($number >= 41 && $number <= 50) {
            return 'string:col-12 col-md-5 col-lg-5 is_ custom_size,';
        } elseif ($number >= 51 && $number <= 60) {
            return 'string:col-12 col-md-6 col-lg-6 is_ custom_size,';
        } elseif ($number >= 61 && $number <= 70) {
            return 'string:col-12 col-md-7 col-lg-7 is_ custom_size,';
        } elseif ($number >= 71 && $number <= 80) {
            return 'string:col-12 col-md-8 col-lg-8 is_ custom_size,';
        } elseif ($number >= 81 && $number <= 90) {
            return 'string:col-12 col-md-9 col-lg-9 is_ custom_size,';
        } elseif ($number >= 91 && $number <= 100) {
            return 'string:col-12 col-md-10 col-lg-10 is_ custom_size,';
        } elseif ($number >= 101 && $number <= 110) {
            return 'string:col-12 col-md-11 col-lg-11 is_ custom_size,';
        } else {
            return 'string:col-12 col-md-12 col-lg-12 is_ custom_size,';
        }
    }, $input);
     
    return $output;
}

//$inputString = 'fullname as string;50,name as string;255,';
//$outputString = replaceNumberWithString($inputString);
//echo $outputString;


    
?>