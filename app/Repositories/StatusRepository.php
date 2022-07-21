<?php
namespace App\Repositories;

use App\Models\Status;

trait StatusRepository {

    public function getIdStatus($name) {
        return Status::whereName($name)->first()->id;
    }
}