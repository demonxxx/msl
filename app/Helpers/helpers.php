<?php // Code within app\Helpers\Helper.php

   function flash_message($message, $level = "success"){
        session()->flash("flash_message",$message);
        session()->flash("flash_level",$level);
   }