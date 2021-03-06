<?php
    $filename = $_SERVER['argv'][1];
    
    if (!file_exists($filename)) {
        die("File not found.");
    }

    $res = bytekit_disassemble_file($filename);
    
    foreach ($res['functions'] as $functionname => &$function) {
                
        echo $functionname, ":\n";
        for ($i=0; $i<count($function['code']); $i++) {
            $c = &$function['code'][$i];
            
            $operands = "";
            for ($j=0; $j<count($c['operands']); $j++) {
                $operands .= ($j > 0 ? ", " : "") . $c['operands'][$j]['string'];
            }
            
            echo "   ", str_pad($c['mnemonic'], 32, " ", STR_PAD_RIGHT), $operands;
            echo "\n";
        }
        echo "\n";
    }
?>