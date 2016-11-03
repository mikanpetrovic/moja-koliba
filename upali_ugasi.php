<?php
include 'api/database_connection.php';

	$group_arr = [];

	$sad    = date("H:i:s");
	$posle5 = date('H:i:s',time() + 5 * 60);
	$pre5   = date('H:i:s',time() - 5 * 60);

	$sql1 = "select * from lampa_tajmer as t join lampa_ulica as u on t.ulica = u.id
where lampa='sve' and tajmer=0 and aktivan=1 and t.vreme>'" . $pre5 . "' and t.vreme<'" . $posle5 . "'";

	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0){

    while ($row1 = $result1->fetch_assoc()){


		$url = "https://login.etherios.com/ws/sci";
		$username = $row['username'];
		$password = $row['password'];
		$gateway  = $row['gateway'] ;


		
		switch ($row['funkcija']) {
		    case 'ukljuci':
		    	// upali
		    print "grupno upali";
$message = <<< XML
  <sci_request version="1.0">
    <send_message>
      <targets>
        <device id="$gateway"/>
      </targets>
      <rci_request version="1.1">

        <do_command target="zigbee">
          <set_setting addr="00:00:00:00:00:00:FF:FF!">
             <radio index="1">
                <dio6_config>5</dio6_config>
       </radio>
          </set_setting>
        </do_command>
        
              
      </rci_request>
    </send_message>
  </sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);

		        break;
		    case 'iskljuci':
		    	// ugasi
		    print "grupno ugasi";

$message = <<< XML
    <sci_request version="1.0">
      <send_message>
        <targets>
          <device id="$gateway"/>
        </targets>
        <rci_request version="1.1">

          <do_command target="zigbee">
            <set_setting addr="00:00:00:00:00:00:FF:FF!">
               <radio index="1">
                  <dio6_config>4</dio6_config>
           </radio>
            </set_setting>
          </do_command>
          
                
        </rci_request>
      </send_message>
    </sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);

		        break;

		    case 'dimuj':

        print "grupno dimuj";


$message = <<< XML
<sci_request version="1.0">
  <send_message>
    <targets>
      <device id="$gateway"/>
    </targets>
    <rci_request version="1.1">

      <do_command target="zigbee">
        <set_setting addr="00:00:00:00:00:00:FF:FF!">
           <radio index="1">
              <dio5_config>5</dio5_config>
           </radio>
        </set_setting>
      </do_command>
      
            
    </rci_request>
  </send_message>
</sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);





		    	break;
		    case 'potpuno':

        print "grupno potpuno"; 

$message = <<< XML
<sci_request version="1.0">
  <send_message>
    <targets>
      <device id="$gateway"/>
    </targets>
    <rci_request version="1.1">

      <do_command target="zigbee">
        <set_setting addr="00:00:00:00:00:00:FF:FF!">
           <radio index="1">
              <dio5_config>4</dio5_config>
           </radio>
        </set_setting>
      </do_command>
      
            
    </rci_request>
  </send_message>
</sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);


		    	break;

		    default:
		        // dimuj procenat
		}

    

    }



	}


	$sql = "select * from lampa_scenario as s join lampa_ulica as u on s.ulica = u.id
			where u.tajmer=1 and s.aktivan=1 and s.vreme>'" . $pre5 . "' and s.vreme<'" . $posle5 . "'";

$result = $conn->query($sql);
	if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){


        $group_arr[] = $row;

		$url = "https://login.etherios.com/ws/sci";
		$username = $row['username'];
		$password = $row['password'];
		$gateway  = $row['gateway'] ;

		$lampa = strtoupper($row['lampa']);

		
		switch (true) {
		    case ($row['vrednost']<4):
		    print "ugasi i dimuj potpuno";
// poptuno

$message = <<< XML
<sci_request version="1.0">
  <send_message>
    <targets>
      <device id="$gateway"/>
    </targets>
    <rci_request version="1.1">

      <do_command target="zigbee">
        <set_setting addr="$lampa">
           <radio index="1">
              <dio5_config>4</dio5_config>
           </radio>
        </set_setting>
      </do_command>
      
            
    </rci_request>
  </send_message>
</sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);




// ugasi


$message = <<< XML
  <sci_request version="1.0">
    <send_message>
      <targets>
        <device id="$gateway"/>
      </targets>
      <rci_request version="1.1">

        <do_command target="zigbee">
          <set_setting addr="$lampa">
             <radio index="1">
                <dio6_config>4</dio6_config>
       </radio>
          </set_setting>
        </do_command>
        
              
      </rci_request>
    </send_message>
  </sci_request>
XML;




				$ch       = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);

				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

				$header = array();
				$header[] = 'Accept: application/xml';
				$header[] = 'Content-type: text/xml; charset="UTF-8"';
				$header[] = 'Content-length: ' . strlen($message);

				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

				$response = curl_exec($ch);
				if ($response === false) {
				    echo curl_error($ch);
				    curl_close($ch);
				    die;
				    die('Error: ' . var_export($info));
				}
				curl_close($ch);

		        break;





		    case ($row['vrednost']>5 && $row['vrednost']<95):

		    print "upali i dimuj";

// upali
$message = <<< XML
  <sci_request version="1.0">
    <send_message>
      <targets>
        <device id="$gateway"/>
      </targets>
      <rci_request version="1.1">

        <do_command target="zigbee">
          <set_setting addr="$lampa">
             <radio index="1">
                <dio6_config>5</dio6_config>
       </radio>
          </set_setting>
        </do_command>
        
              
      </rci_request>
    </send_message>
  </sci_request>
XML;

				$ch       = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);

				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

				$header = array();
				$header[] = 'Accept: application/xml';
				$header[] = 'Content-type: text/xml; charset="UTF-8"';
				$header[] = 'Content-length: ' . strlen($message);

				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

				$response = curl_exec($ch);
				if ($response === false) {
				    echo curl_error($ch);
				    curl_close($ch);
				    die;
				    die('Error: ' . var_export($info));
				}
				curl_close($ch);


// dimuj
$message = <<< XML
<sci_request version="1.0">
  <send_message>
    <targets>
      <device id="$gateway"/>
    </targets>
    <rci_request version="1.1">

      <do_command target="zigbee">
        <set_setting addr="$lampa">
           <radio index="1">
              <dio5_config>5</dio5_config>
           </radio>
        </set_setting>
      </do_command>
      
            
    </rci_request>
  </send_message>
</sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);

        break;


		    case ($row['vrednost']>94):

		    print "upali i potpuno";

// upali
$message = <<< XML
  <sci_request version="1.0">
    <send_message>
      <targets>
        <device id="$gateway"/>
      </targets>
      <rci_request version="1.1">

        <do_command target="zigbee">
          <set_setting addr="$lampa">
             <radio index="1">
                <dio6_config>5</dio6_config>
       </radio>
          </set_setting>
        </do_command>
        
              
      </rci_request>
    </send_message>
  </sci_request>
XML;

				$ch       = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);

				//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

				$header = array();
				$header[] = 'Accept: application/xml';
				$header[] = 'Content-type: text/xml; charset="UTF-8"';
				$header[] = 'Content-length: ' . strlen($message);

				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

				$response = curl_exec($ch);
				if ($response === false) {
				    echo curl_error($ch);
				    curl_close($ch);
				    die;
				    die('Error: ' . var_export($info));
				}
				curl_close($ch);


// poptuno

$message = <<< XML
<sci_request version="1.0">
  <send_message>
    <targets>
      <device id="$gateway"/>
    </targets>
    <rci_request version="1.1">

      <do_command target="zigbee">
        <set_setting addr="$lampa">
           <radio index="1">
              <dio5_config>4</dio5_config>
           </radio>
        </set_setting>
      </do_command>
      
            
    </rci_request>
  </send_message>
</sci_request>
XML;

$ch       = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_POSTFIELDS, 'message='.urlencode($message));
curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

$header = array();
$header[] = 'Accept: application/xml';
$header[] = 'Content-type: text/xml; charset="UTF-8"';
$header[] = 'Content-length: ' . strlen($message);

curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$response = curl_exec($ch);
if ($response === false) {
//    $info = curl_getinfo($ch);
    echo curl_error($ch);
    curl_close($ch);
    die;
    die('Error: ' . var_export($info));
}
curl_close($ch);






		        break;
		    default:
		        // dimuj procenat
		}

    }
}

$conn->close();

$json= $group_arr;

header('Content-type: application/json');
echo json_encode($json);

?>