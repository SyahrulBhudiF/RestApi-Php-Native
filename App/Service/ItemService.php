<?php

namespace App\Service;

use App\Interface\Service;
use App\Interface\Repository;
use App\Model\Item;
use App\Repository\ItemRepository;

class ItemService implements Repository
{
    private ItemRepository $repository;

    public function __construct()
    {
        $this->repository = new ItemRepository();
    }

    public function index(): void
    {
        $items = $this->repository->index();
        http_response_code(200);
        $response = [
            "message" => "Successful get request",
            "data" => $items
        ];
        echo json_encode($response);
    }

    public function show($id): void
    {
        $item = $this->repository->show($id);
        http_response_code(200);
        $response = [
            "message" => "Successful get request",
            "data" => $item
        ];
        echo json_encode($response);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->description)) {
            $item = new Item(null, $data->name, $data->description);

            if ($this->repository->store($item)) {
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

    public function update($id): void
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) && !empty($data->name) && !empty($data->description)) {
            $item = new Item($data->id, $data->name, $data->description);

            if ($this->repository->update($item, $id)) {
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

    public function destroy($id): void
    {
        if (!empty($data->id)) {
            if ($this->repository->destroy($id)) {
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