<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telerivet_API;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller{

    public function getIndex()
    {
        return view('messages.index');
    }

    public function postIndex(Request $request)
    {
//        dd($request->all());
        $API_KEY = 'Iuc72U33x6YI9kbzlROFOXxMWQtUgINy';           // from https://telerivet.com/api/keys
        $PROJECT_ID = 'PJd07d5e436ec8ce89';

        $telerivet = new Telerivet_API($API_KEY);

        $project = $telerivet->initProjectById($PROJECT_ID);

        // Send a SMS message
        $project->sendMessage(array(
            'to_number' => $request->get('number'),
            'content' => $request->get('message')
        ));

        return redirect('messages');
    }

    // Get all messages
    public function getMessages()
    {
        $API_KEY = 'Iuc72U33x6YI9kbzlROFOXxMWQtUgINy';           // from https://telerivet.com/api/keys
        $PROJECT_ID = 'PJd07d5e436ec8ce89';

        $tr = new Telerivet_API($API_KEY);
        $project = $tr->initProjectById($PROJECT_ID);

        $cursor = $project->queryMessages(array(
            'direction' => "incoming",
            'message_type' => "sms"
        ));

        $messages = [];
        while ($cursor->hasNext()) {
            $messages[] = $cursor->next();
            // do something with $message
        }

        dd($messages);
    }

    // Get post response from reply SMS
    public function postMessages(Request $request)
    {
        $webhook_secret = '37GMXGMNPAL62K6DDQ3AW6PD932F33C4';

        if ($_POST['secret'] !== $webhook_secret)
        {
            header('HTTP/1.1 403 Forbidden');
            echo "Invalid webhook secret";
        }
        else
        {
            if ($_POST['event'] == 'incoming_message')
            {
                $content = $_POST['content'];
                $from_number = $_POST['from_number'];
                $phone_id = $_POST['phone_id'];

                $data = array('content' => $content, 'from_number' => $from_number, 'phone_id' => $phone_id);
                Log::info('Showing message information: '. implode( ',', $data));

                // do something with the message, e.g. send an autoreply
                header("Content-Type: application/json");
                echo json_encode(array(
                    'messages' => array(
                        array('content' => "Thanks for your message!")
                    )
                ));
            }
        }
    }
}