<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function __construct()
  {
      
  }

  function backup_tables($data) {

      if ($data != '') {
          if (!isset($data['tables']) || $data['tables'] == '') {
              $tables = '*';
          } else {
              $tables = $data['tables'];
          }

          if (isset($data['type']) && $data['type'] != '') {
              $type = '_'.strtoupper($data['type']);
          } else {
              $type = '';
          }

          $dbhost = env('DB_HOST'.$type, 'localhost');
          $dbuser = env('DB_USERNAME'.$type, 'mtsub');
          $dbpass = env('DB_PASSWORD'.$type, 'root');
          $dbname = env('DB_DATABASE'.$type, '');

          $link = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);

          // Check connection
          if (mysqli_connect_errno())
          {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              exit;
          }

          mysqli_query($link, "SET NAMES 'utf8'");

          //get all of the tables
          if($tables == '*')
          {
              $tables = array();
              $result = mysqli_query($link, 'SHOW TABLES');
              while($row = mysqli_fetch_row($result))
              {
                  $tables[] = $row[0];
              }
          } else {
              $tables = is_array($tables) ? $tables : explode(',',$tables);
          }

          $return = '';
          //cycle through
          foreach($tables as $table)
          {
              ini_set('memory_limit', '-1');
              $result = mysqli_query($link, 'SELECT * FROM '.$table);
              $num_fields = mysqli_num_fields($result);
              $num_rows = mysqli_num_rows($result);

              $return.= 'DROP TABLE IF EXISTS '.$table.';';
              $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
              $return.= "\n\n".$row2[1].";\n\n";
              $counter = 1;

              //Over tables
              for ($i = 0; $i < $num_fields; $i++) 
              {   //Over rows
                  while($row = mysqli_fetch_row($result))
                  {   
                      if($counter == 1){
                          $return.= 'INSERT INTO '.$table.' VALUES(';
                      } else{
                          $return.= '(';
                      }

                      //Over fields
                      for($j=0; $j<$num_fields; $j++) 
                      {
                          $row[$j] = addslashes($row[$j]);
                          $row[$j] = str_replace("\n","\\n",$row[$j]);
                          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                          if ($j<($num_fields-1)) { $return.= ','; }
                      }

                      if($num_rows == $counter){
                          $return.= ");\n";
                      } else{
                          $return.= "),\n";
                      }
                      ++$counter;
                  }
              }
              $return.="\n\n\n";
          }

          //save file
          $path = 'storage/backup/';
          if (!file_exists($path)) { mkdir($path, 0777, true);}

          $files = glob($path."*");
          $now   = time();

          foreach ($files as $file) {
              if (is_file($file)) {
                  if ($now - filemtime($file) >= 60 * 60 * 24 * 30) {
                      unlink($file);
                  }
              }
          }
          
          $fileName = $tables[0].'-'.time().'.sql';
          $fileZip = $path.$tables[0].'-'.time().'.zip';
          $handle = fopen($fileName,'w+');
          fwrite($handle,$return);
          if(fclose($handle)){
              $myzip = new ZipArchive;
   
              //New zip file is created and ready to add files in it
              if ($myzip->open($fileZip, ZipArchive::CREATE) === TRUE)
              {
                  // Add files to the zip file
                  $myzip->addFile($fileName);
                  // closing the zip file.
                  $myzip->close();

                  unlink($fileName);
              }

              echo "Done, the file name is: ".$fileZip;
              exit; 
          }
      }
  }
}
