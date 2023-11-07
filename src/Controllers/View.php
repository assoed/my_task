<?php

namespace Controllers;

use Exceptions\AppException;

class View
{
    public function render(string $view, array $data = []): void
    {
        $response = array();
        $viewPath = '../src/Views/' . $view . '.php';


            if (!file_exists($viewPath)) {
                throw new AppException('View not found', 404);
            }

            http_response_code($data['status']);
            header('Content-Type: application/json');

            require_once $viewPath;
            extract($data);


    }
}