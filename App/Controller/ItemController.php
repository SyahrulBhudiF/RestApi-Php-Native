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
                    $this->service->getItem($this->id);
                } else {
                    $this->service->getItems();
                }
                break;

            case 'POST':
                $this->service->createItem();
                break;

            case 'PUT':
                $this->service->updateItem($this->id);
                break;

            case 'DELETE':
                $this->service->deleteItem($this->id);
                break;

            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                break;
        }
    }
}