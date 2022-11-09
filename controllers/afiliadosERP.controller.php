<?php

require_once "../vendor/autoload.php";

use GuzzleHttp\Client;

class ControllerAfiliadosERP {

	/*=============================================
	MOSTRAR AUTORIDADES
	=============================================*/
	
	static public function ctrShowERP($fecha_nacimiento, $documento) {

		// $param = json_decode($request->param, true);
        
        try {
            $client = new Client();
            $response = $client->post(
                'https://auth-desarrollo.cns.gob.bo/connect/token',
                array(
                    'form_params' => [
                        "grant_type" => "password",
                        "username" => "regional-lpz-salud",
                        "password" => "Regional-lpz-2021",
                        "scope" => "afiliaciones",
                        "client_id" => "regional-lpz",
                        "client_secret" => "regional-lpz testing"
                    ]
                )
            );

            if($response->getStatusCode() == "200"){

                $data = json_decode($response->getBody(), true);
                $token = $data['access_token'];

                $url = 'https://api-desarrollo.cns.gob.bo/erp/v1/Afiliaciones/Asegurados?DocumentoIdentidad='.$documento.'&FechaNacimiento='.$fecha_nacimiento;
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer '.$token,        
                        'Accept'        => 'application/json',
                    ]
                    
                ]);

                echo json_encode([
                    'status' => 'success',
                    'response' => $response->getBody()->getContents()
                ]);

            } else {

                echo json_encode([
                    'status' => 'error',
                    'response' => 'No se pudo encontar la página! '
                ]);
            }
        } catch (\Exception $e) {

            echo json_encode([
                'status' => 'error',
                'response' => $e->getMessage()
            ]);

        }

	}

}