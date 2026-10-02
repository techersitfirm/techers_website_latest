<?php

namespace app\core;

class Controller
{
    protected function renderAdmin(
        string $view,
        array $data = [],
        string $layout = 'master'
    ): void {
        $this->render('admin', $view, $data, $layout);
    }

    protected function renderTeam(
        string $view,
        array $data = [],
        string $layout = 'master'
    ): void {
        $this->render('teams', $view, $data, $layout);
    }

    protected function renderCustomer(
        string $view,
        array $data = [],
        string $layout = 'master'
    ): void {
        $this->render('customer', $view, $data, $layout);
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    private function render(
        string $panel,
        string $view,
        array $data = [],
        string $layout = 'master'
    ): void {

        View::clearSections();

        $data = array_merge([
            'flash'   => Flash::get(),
            'baseUrl' => BASE_URL
        ], $data);

        extract($data);

        ob_start();

        require VIEW_PATH . '/' . $panel . '/' . $view . '.php';

        $content = ob_get_clean();

        require VIEW_PATH . '/' . $panel . '/layout/' . $layout . '.php';
    }
}