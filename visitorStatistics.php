<?php
/*
Text Counter by http://www.free-php-counter.com
You are allowed to remove advertising after you purchased a licence
*/

// settings

// ip-protection in seconds
$counter_expire = 3600;
$counter_filename = "counter.txt";

// ignore agent list
$counter_ignore_agents = array('bot', 'bot1', 'bot3');

// ignore ip list
$counter_ignore_ips = array('127.0.0.1','127.0.0.2', '127.0.0.3');


// get basic information
$counter_agent = $_SERVER['HTTP_USER_AGENT'];
$counter_ip = $_SERVER['REMOTE_ADDR']; 
$counter_time = time();
   
   
if (file_exists($counter_filename)) 
{
   // check ignore lists
   $ignore = false;
   
   $length = sizeof($counter_ignore_agents);
   for ($i = 0; $i < $length; $i++)
   {
	  if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i])))
	  {
	     $ignore = true;
		 break;
	  }
   }
   
   $length = sizeof($counter_ignore_ips);
   for ($i = 0; $i < $length; $i++)
   {
	  if ($counter_ip == $counter_ignore_ips[$i])
	  {
	     $ignore = true;
		 break;
	  }
   }
   
   
   
   // get current counter state
   $c_file = array();
   $fp = fopen($counter_filename, "r");
   
   if ($fp)
   {
      //flock($fp, LOCK_EX);
	  $canWrite = false;
      while (!$canWrite)    
	     $canWrite = flock($fp, LOCK_EX);
			   
	  while (!feof($fp)) 
      {
         $line = trim(fgets($fp, 1024)); 
		 if ($line != "")
		    $c_file[] = $line;		  
      }
      flock($fp, LOCK_UN);
	  fclose ($fp);
   }
   else
   {
      $ignore = true;
   }
   
   {
      // get data for reading only
	  if (sizeof($c_file) > 0)
	     list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", $c_file[0]);
	  else
		 list($day_arr, $yesterday_arr, $week_arr, $month_arr, $year_arr, $all, $record, $record_time) = explode("||", date("z") . ":1||" . (date("z")-1) . ":0||" . date("W") . ":1||" . date("n") . ":1||" . date("Y") . ":1||1||1||" . $counter_time);
	  
	  // day
	  $day_data = explode(":", $day_arr);
      $day = $day_data[1];
	  
	  // yesterday
	  $yesterday_data = explode(":", $yesterday_arr);
      $yesterday = $yesterday_data[1];
	  
	  // week
	  $week_data = explode(":", $week_arr);
	  $week = $week_data[1];
	
	  // month
	  $month_data = explode(":", $month_arr);
	  $month = $month_data[1];
	  
	  // year
	  $year_data = explode(":", $year_arr);
	  $year = $year_data[1];
	  
	  $record_time = trim($record_time);
	  
	  $online = sizeof($c_file) - 1;
	  if ($online <= 0)
	     $online = 1;
   }
}

?>
<center>
<div style="width:150px;">
   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;font-weight:bold;">
      <img src="/php/counter/views.gif" width="16" height="16" border="0" /> Visitor Statistics
   </div>

   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;">
      &raquo; <?php echo $online; ?> Online<br />   
      &raquo; <?php echo $day; ?> Today<br />
      &raquo; <?php echo $yesterday; ?> Yesterday<br />
      &raquo; <?php echo $week; ?> Week<br />
      &raquo; <?php echo $month; ?> Month<br />
      &raquo; <?php echo $year; ?> Year<br />
      &raquo; <?php echo $all; ?> Total   
   </div>

   <div style="border:1px solid #000000;padding:2px;width:100%;font-size:80%;">
      Record: <?php echo $record; ?> (<?php echo date("d.m.Y", $record_time) ?>)

   </div>
</div>
</center>