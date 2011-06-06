<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sbtm
 *
 * @author bgh24318
 */
class sbtm {
    //put your code here
    
    static public function slugify($text)
  {
    // replace all non letters or digits by -
    $text = preg_replace('/\s+/', '-', $text);
 
    // trim and lowercase
    //$text = strtolower(trim($text, '-'));
 
    return $text;
  }

}

?>
