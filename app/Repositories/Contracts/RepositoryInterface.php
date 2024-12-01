<?php
namespace App\Repositories\Contracts;
interface RepositoryInterface
{
    public function create(array $data);
    public function find(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function deleteBy(array $where);
    public function paginate(string $search = null , int $page, int $pagesize=20);
    public function all(array $where);
}