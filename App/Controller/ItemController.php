<?php

namespace App\Controller;

use App\Service\ItemService;

class ItemController
{
    private ItemService $service;
    private $id;

    public function __construct($id)
    {
        $this->service = new ItemService();
        $this->id = $id;
    }

    public function handleRequest(): void
    {
        $method = $_SERVER["REQUEST_METHOD"];

        switch ($method) {
            case 'GET':
                if ($this->id) {
                    $this->service->show($this->id);
                } else {
                    $this->service->index();
                }
                break;

            case 'POST':
                $this->service->store();
                break;

            case 'PUT':
                $this->service->update($this->id);
                break;

            case 'DELETE':
                $this->service->destroy($this->id);
                break;

            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                break;
        }
    }
}