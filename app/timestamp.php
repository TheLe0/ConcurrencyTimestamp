<?php

$transactions = $_POST['t'];

$list = normalize($transactions);

echo'<pre>';

$h = generate_story($list);
echo '<br>HSTORIA<br>';
print_r($h);


$x = array('r' => 0, 'w' => 0);

$y = array('r' => 0, 'w' => 0);

$z = array('r' => 0, 'w' => 0);

$h = stagger($h);

print_r($h);

function stagger($h) 
{
    global $x, $y, $z;
    
    $i = 0;
    
    while ($i <= lastIndex($h))
    {    
      if (isset($h[$i]))
      {
        $element = $h[$i];
            
        $rw = $element[0];
        
        switch ($element[1]) 
        {
          case 'x':
            if ($element[0] == 'r') 
            {
              echo 'Reading: ';
              $ts = $x['w'];
                        
              if ($element['timestamp'] < $ts)
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              
              } 
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];

                $x["$rw"] = $element['timestamp'];
              }
            } 
            else if($element[0] == 'w') 
            {
              echo 'Writing: ';
                        
              $ts = $x['r'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$elemento[0] .' - '.$elemento[1].' ts: '. $elemento['timestamp'];
                            
                $h = abort_transaction($h, $element['timestamp']);
                
                echo '<br>';
                continue;
              }
                        
              $ts = $x['w'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              } 
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];

                $x["$rw"] = $element['timestamp'];
              }
            }
            
            echo '<br>';
          break;
          case 'y':
                    
            if ($element[0] == 'r') {
                        
              echo 'Reading: ';
                        
              $ts = $y['w'];
                        
              if ($element['timestamp'] < $ts){
                            
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              }
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $elemento['timestamp'];

                $y["$rw"] = $element['timestamp'];
              }
            } 
            else if($element[0] == 'w') 
            {
              echo 'Writting: ';
                        
              $ts = $y['r'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
                
                echo '<br>';
                continue;
              }
                        
              $ts = $y['w'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$elemento[0] .' - '.$elemento[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              } 
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];

                $y["$rw"] = $element['timestamp'];
              }
            }
            
            echo '<br>';
          break;
          case 'z':
            
            if ($element[0] == 'r') 
            {
              
              echo 'Writting: ';
                        
              $ts = $z['w'];
                        
              if ($element['timestamp'] < $ts)
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              }
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];

                $z["$rw"] = $element['timestamp'];
              }
            } 
            else if ($element[0] == 'w') 
            {
              echo 'Writing: ';
                        
              $ts = $z['r'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                            
                $h = abort_transaction($h, $element['timestamp']);
                
                echo '<br>';
                continue;
              }
                        
              $ts = $z['w'];
                        
              if ($element['timestamp'] < $ts) 
              {
                echo 'Reject '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];
                
                $h = abort_transaction($h, $element['timestamp']);
              } 
              else 
              {
                echo 'Accept '.$element[0] .' - '.$element[1].' ts: '. $element['timestamp'];

                $z["$rw"] = $element['timestamp'];
              }
            }
            
            echo '<br>';
          break;
        }
      }
      $i++;
    }
    
  return $h;
}

function normalize($list) {
    // shirink the array
    foreach ($list as $key => $value) {
        if (empty($value)){
          unset($list[$key]);
        }
    }
    
    foreach ($list as $key => $value){
      $list[$key] = trim($list[$key]);
    }
    
    $i=0;
    foreach ($list as $node) {
        $elements = explode(' ', $node);
        $part = array();
        $timestamp = microtime(true);
        foreach ($elements as $element) {
            $part[] = array_merge(array('timestamp' => $timestamp),  explode('-', $element));
        }
        $final[$i]['transaction'] = $part;
        sleep(1);
        $i++;
    }
    
    return $final;
}

function generate_story($t) 
{
    
  $qtd = count($t);
    
  while 
  (
    !empty($t[0]['transaction']) || 
    !empty($t[1]['transaction']) || 
    !empty($t[2]['transaction']) ||
    !empty($t[3]['transaction']) || 
    !empty($t[4]['transaction'])
  ) 
  {
       
    $i = rand(0, $qtd-1);
        
    if (!empty($t[$i]['transaction'][0]))
    {
      $atual = $t[$i]['transaction'][0];
            
      array_shift($t[$i]['transaction']);
            
      $h[] = $atual;
    }
  }
    
  return $h;
}

function abort_transaction($h, $ts) 
{
    foreach ($h as $key => $value) {
        if($value['timestamp'] == $ts) 
        {
          $final[] = $h[$key];
          unset($h[$key]);
        }
    }
    
    $times = microtime(true);
    
    foreach ($final as $f) 
    {
      $f['timestamp'] = $times;
      $h[] = $f;
    }

    sleep(1);
    
    return $h;
}

function lastIndex($h) 
{
    
  foreach ($h as $key => $value) {
    $k = $key;
  }
    
  return $k;
}
