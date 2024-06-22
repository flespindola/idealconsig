<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class SimulationController extends Controller
{
    public function handleSimulation(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'CPF' => 'required|string|max:14',
            'type' => ['required', Rule::in(['Conta de Luz', 'Cartão de Crédito', 'FGTS'])],
            'hasLightAccount' => 'nullable|boolean',
            'hasWorked' => 'nullable|boolean',
            'amountForCredit' => 'nullable|numeric|min:0',
            'installmentsForCredit' => 'nullable|integer|min:1'
        ]);

        switch($validatedData['type']) {
            case 'Conta de Luz':
                $result = $this->simulateLightAccount($validatedData);
                break;
            case 'Cartão de Crédito':
                $result = $this->simulateCreditCard($validatedData);
                break;
            case 'FGTS':
                $result = $this->simulateFGTS($validatedData);
                break;
        }
    }

    private function simulateLightAccount($data)
    {
        // Simulate light account
        $message = "Empréstimo na conta de luz \n";
        $message .= "Nome: " . $data["name"] . "\n";
        $message .= "Telefone: " . $data["phone"] . "\n";
        $message .= "CPF: " . $data["CPF"] . "\n";
        $message .= $data["hasLightAccount"] ? "A conta está no meu nome." : "A conta de luz não está no meu nome.";
        // dd($message);
        $this->sendMessage($message);
    }

    private function simulateCreditCard($data)
    {
        // Simulate credit card
        $message = "Empréstimo no cartão de crédito \n";
        $message .= "Nome: " . $data["name"] . "\n";
        $message .= "Telefone: " . $data["phone"] . "\n";
        $message .= "CPF: " . $data["CPF"] . "\n";
        $message .= "Valor desejado: " . $data['amountForCredit'] . "\n";
        $message .= "Parcelas: " . $data['installmentsForCredit'] . "\n";
        // dd($message);
        $this->sendMessage($message);
    }

    private function simulateFGTS($data)
    {
        // Simulate FGTS        
        $message = "Empréstimo no cartão de crédito \n";
        $message .= "Nome: " . $data["name"] . "\n";
        $message .= "Telefone: " . $data["phone"] . "\n";
        $message .= "CPF: " . $data["CPF"] . "\n";
        $message .= $data["hasWorked"] ? "Já trabalhei de carteira assinada" : "Nunca trabalhei de carteira assinada";
        // dd($message, $data["hasWorked"]);
        $this->sendMessage($message);
    }

    private function sendMessage($message)
    {
        dd("A ser enviado: ", $message);
        // Send message
        $sid    = "AC2352cf754d9e88164bdbd915ec88e575";
        $token  = "4323c2c66dae556443be10741a6b1b54";
        // $twilio = new Client($sid, $token);

        $oneris = "+5574988376872";
        // $response = $twilio->messages
        // ->create($oneris, // to
        //   array(
        //     "from" => "+19787235664",
        //     "body" => $message
        //   )
        // );
    
        // $response = $twilio->messages
        //   ->create("whatsapp:+5574988376872", // to
        //     [
        //       "from" => "whatsapp:+19787235664",
        //       "body" => $message
        //     ]
        // );

        // dd($response);
    }
}
