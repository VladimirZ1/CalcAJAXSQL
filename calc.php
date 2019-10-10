<?php 


function resultOut($data) {
	header('Content-Type: application/json');
    echo json_encode($data);
};


    $x1=$_POST['x1'];
    $x2=$_POST['x2'];
    $oper=$_POST['oper'];


    if (is_numeric($x1) &&  is_numeric($x2) ) {
    	$mysqli = new mysqli("localhost", "root", "", "calc");
    	if ($oper=="+") {
                $x3 = $x1+$x2;
                $data['x3'] = $x3;
                $mysqli->query("INSERT into oper (x1,x2,oper,result) VALUES ('$x1','$x2','$oper','$x3')");
                resultOut($data);
            } else
            {
            	if ($oper=="-") {
                	$x3 = $x1-$x2;
                	$data['x3'] = $x3;
                	$mysqli->query("INSERT into oper (x1,x2,oper,result) VALUES ('$x1','$x2','$oper','$x3')");
                	resultOut($data);
                } else
                {
                	if ($oper=="*") {
                		$x3 = $x1*$x2;
                		$data['x3'] = $x3;
                		$mysqli->query("INSERT into oper (x1,x2,oper,result) VALUES ('$x1','$x2','$oper','$x3')");
                		resultOut($data);
                	} else
                	{
                		if ($oper=="/") {
                			if ($x2 == 0)  {
                				 $data['x2Error'] = True;
   								 resultOut($data);

                			} else
                			{
                				$x3 = round($x1/$x2,3);
                				$data['x3'] = $x3;
                				$mysqli->query("INSERT into oper (x1,x2,oper,result) VALUES ('$x1','$x2','$oper','$x3')");
                				resultOut($data);
                		    }
                		} else
                		{
                			$data['operError'] = True;
							resultOut($data);
                		};

                	};

                };

            };
        $mysqli->close();
    } else
    {
        if (!is_numeric($x1))   {     
            $data['x1Error'] = True;
        };
        if (!is_numeric($x2))   {     
           $data['x2Error'] = True;
        };
        resultOut($data);
    };


?>