<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mailgun\Mailgun;

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
        $this->sendMessage($message);
    }

    private function sendMessage($message)
    {
        try {
            $mg = Mailgun::create(env('MAILGUN_SECRET'));
            $domain = "idealconsig.com";
            $result = $mg->messages()->send($domain, array(
            	'from'	=> 'Simulação de Empréstimo <no-reply@idealconsig.com>',
            	'to'	=> 'fles94@hotmail.com',
             	'subject' => 'Simulação de Empréstimo',
              	'text'	=> $message
            ));
            return redirect()->back()->with('success', 'Solicitação enviada com sucesso! Em breve um dos nossos consultores entrará em contato.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Houve um erro ao enviar a solicitação. Por favor, tente novamente.');
        }
    }
}
