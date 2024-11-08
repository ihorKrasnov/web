<?php

namespace tests\unit\models;

use Yii;
use app\models\EntryForm;
use Codeception\Test\Unit;

class EntryFormTest extends Unit
{
    private $model;

    public function testEntryNoName()
    {
        $this->model = new EntryForm([
            'name' => '',
            'email' => 'email@mail.com',
        ]);

        verify($this->model->validate())->false();
        verify($this->model->hasErrors('name'))->true();
        verify($this->model->hasErrors('email'))->false();
    }

    public function testEntryNoEmail()
    {
        $this->model = new EntryForm([
            'name' => 'John Doe',
            'email' => '',
        ]);

        verify($this->model->validate())->false();
        verify($this->model->hasErrors('email'))->true();
        verify($this->model->hasErrors('name'))->false();
    }

    public function testEntryInvalidEmail()
    {
        $this->model = new EntryForm([
            'name' => 'John Doe',
            'email' => 'invalid-email',
        ]);

        verify($this->model->validate())->false();
        verify($this->model->hasErrors('email'))->true();
        verify($this->model->hasErrors('name'))->false();
    }

    public function testEntryValidData()
    {
        $this->model = new EntryForm([
            'name' => 'John Doe',
            'email' => 'email@mail.com',
        ]);

        verify($this->model->validate())->true();
        verify($this->model->hasErrors())->false();
    }
}
