<?php
namespace App\Repositories\Contracts;
interface RepositoryInterface
{
    public function create(array $data);
    public function find(int $id,array $data);
    public function update(int $id, array $data);
    public function delete(array $where);
    public function all(array $where);
}