<?php

namespace App\Service;

use App\Model\Item;
use App\Repository\ItemRepository;

class ItemService
{
    private ItemRepository $repository;

    public function __construct()
    {
        $this->repository = new ItemRepository();
    }

    public function getItems(): void
    {
        $items = $this->repository->getAllItems();
        http_response_code(200);
        $response = [
            "message" => "Successful get request",
            "data" => $items
        ];
        echo json_encode($response);
    }

    public function getItem($id): void
    {
        $item = $this->repository->getItem($id);
        http_response_code(200);
        $response = [
            "message" => "Successful get request",
            "data" => $item
        ];
        echo json_encode($response);
    }

    public function createItem(): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->description)) {
            $item = new Item(null, $data->name, $data->description);

            if ($this->repository->createItem($item)) {
                http_response_code(201);
                echo json_encode(['message' => 'Item created']);

            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Item creation failed']);
            }

        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input']);
        }
    }

    public function updateItem($id): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) && !empty($data->name) && !empty($data->description)) {
            $item = new Item($data->id, $data->name, $data->description);

            if ($this->repository->updateItem($item, $id)) {
                http_response_code(200);
                echo json_encode(['message' => 'Item updated']);

            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Item update failed']);
            }

        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid input']);
        }
    }

    public function deleteItem($id): void
    {
        if (!empty($data->id)) {
            if ($this->repository->deleteItem($id)) {
                http_response_code(200);
                echo json_encode(['message' => 'Item deleted']);

            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Item deletion failed']);
            }

        } else {
            http_response_code(400);
            echo json_encode(['message' => 'ID required']);
        }
    }
}