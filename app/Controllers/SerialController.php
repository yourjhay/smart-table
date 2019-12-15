<?php
namespace App\Controllers;
    
Use Simple\Request;
Use App\Helper\PhpSerial;    

class SerialController extends Controller 
{
    
    public function index() 
    {
        return view('control');
    }

    public function send(Request $request)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        //$led = $request->post('');
        $serial = new PhpSerial;
        // First we must specify the device. This works on both linux and windows (if
        // your linux serial device is /dev/ttyS0 for COM1, etc)
        $serial->PhpSerial();
        $serial->deviceSet("COM1");

        // We can change the baud rate, parity, length, stop bits, flow control
        $serial->confBaudRate(9600);
        $serial->confParity("none");
        $serial->confCharacterLength(8);
        $serial->confStopBits(1);
        $serial->confFlowControl("none");

        // Then we need to open it
        $serial->deviceOpen();

        // To write into
        $serial->sendMessage(trim($data->led),1); 
            
        $read = $serial->readPort();
        $res = array(
            "response" => $read == "" ? "NO RESPONSE FROM DEVICE" : $read,
            "error" => $read == "" ? "NO RESPONSE FROM DEVICE: " . $read : false
        );

        return json_encode($res);
    }

    public function manual()
    {
        $serial = new PhpSerial;
        // First we must specify the device. This works on both linux and windows (if
        // your linux serial device is /dev/ttyS0 for COM1, etc)
        $serial->phpSerial();
        $serial->deviceSet("COM1");

        // We can change the baud rate, parity, length, stop bits, flow control
        $serial->confBaudRate(9600);
        $serial->confParity("none");
        $serial->confCharacterLength(8);
        $serial->confStopBits(1);

        // Then we need to open it
        $serial->deviceOpen();

        sleep(3);
        // To write into
        $serial->sendMessage(trim("G"),1); 
            
        echo "response: " . $serial->readPort();
    }

    function temp()
    {
        $gputemp = explode("=",shell_exec('vcgencmd measure_temp'));
        shell_exec('cpu=$(</sys/class/thermal/thermal_zone0/temp)');
        $r   = (int)shell_exec("cat /sys/class/thermal/thermal_zone0/temp");
        //$mem = shell_exec("free -m");
        //dd($mem);
        $data = array(
            'cpu' => number_format($r / 1000,'2', '.',''),
            'gpu' => trim($gputemp[1])
        );
        return json_encode($data);
    }
    
}