<?php

class IndexController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function index() {
        // You can include any logic here that needs to be executed for the main page
        // For example, fetching data from the model
        $data = $this->model->getData();

        // Pass the data to the view for rendering
        $this->view->render($data);
    }
}
?>
