<?php

class Bowling_model extends CI_Model {
  var $total = 0;

  function __construct()
  {
    parent::__construct();
  }

  function final_score($frames)
  {
    // set the total to 0 to start the calculation, this will be incremented throughout
    $total = 0; 
    // let's loop through frames, which is the post variable after XSS Filtering
    foreach($frames as $key => $frame){
      // verify that the post variable starts with frame, other inputs will be ignored
      if(stripos($key, 'frame')===0 && !empty($frame)){ 
        // strip out the frame work in the post variable allowing us to numerically move 
        // around the array
        $framekey = str_replace("frame", "", $key);
        // see if the length of the frame is 2 or 3 throws
        // strikes are only 1 throw, spares are 2 throws
        // 10th frame with a spare or a turkey are 3 throws
        // anthing else is 2 throws 
        if(strlen($frame)==2 || (strlen($frame)==3 && $frame!="XXX")) {
          // if the 2nd throw is a spare
          if($frame[1]=='/'){
            // if we are on the 10th frame
            if($framekey=="10"){
              // then the nextThrow will be the 3rd throw in the frame
              $nextThrow = $frame[2];
            } else {
              // otherwise the nextThrow will be the next frame's first throw
              $nextThrow = $frames['frame'.($framekey+1)][0];
            }
            // check if the next frame's first throw is a strike
            if($nextThrow=="X"){
              // if so than the spare becomes 20 points
              $total = $total + 20;
            } else {
              // otherwise the spare becomes 10 points plus the nextThrow
              $total = $total + 10 + $nextThrow;
            }
          } else {
            // a regular frame, with no strikes and no spares is treated as simple addition
            $total = $total + $frame[0] + $frame[1]; // TODO should wrap these in intval()
          }
        } else {
          // now we are in strike territory

          // first let's check for that turkey
          if($frame=="XXX"){
            $total = $total + 30;
          } else {
            // double check the first throw of the frame was a strike
            if($frame[0]=="X"){
              // let's set nextThrow to be the next frame's first throw
              $nextThrow = $frames['frame'.($framekey+1)][0];
              
              // if the next throw is a strike
              if($nextThrow=="X"){
                // than set the value of next throw to 10
                $nextThrow = 10;
                // if our current frame is 9, then we don't skip ahead 2 frames because 
                // our next throw is a strike
                if($framekey=="9"){
                  // instead we only go to the 2nd throw of the next frame
                  $nextThrow2 = $frames['frame'.($framekey+1)][1];
                } else {
                  // otherwise we go to the first throw of the frame after the next frame
                  $nextThrow2 = $frames['frame'.($framekey+2)][0];
                }
              } else {
                // if the next throw is not a strike, than nextThrow2 should be the 2nd
                // throw of the next frame
                $nextThrow2 = $frames['frame'.($framekey+1)][1];
              }
              // now see if nextThrow2 is either a spare or a strike
              // either way the value of nextThrow2 will be 10
              if($nextThrow2=="/" || $nextThrow2=="X"){
                $nextThrow2 = 10;
              }
              $total = $total + 10 + $nextThrow + $nextThrow2;
            }
          }
        }
      }
    }
    return $total;
  }
}