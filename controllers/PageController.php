<?php
class PageController
{
    private $view;

    public function __construct()
    {
        $this->view = new PageView();
    }

    public function homePage()
    {
        $this->view->render('home');
    }

    public function products()
    {
        $this->view->render('products');
    }

    public function cart()
    {
        $this->view->render('cart');
    }
}
