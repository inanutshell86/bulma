<?php

namespace App\Models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class Database
{
    private $pdo;
    private $queryFactory;

    public function __construct(PDO $PDO, QueryFactory $queryFactory)
    {
         $this->pdo = $PDO;
         $this->queryFactory = $queryFactory;
    }

    public function getAll($table, $limit = null)
    {
         $select = $this->queryFactory->newSelect();
         $select->cols(['*'])
             ->from($table)
             ->limit($limit);

         $stmt = $this->pdo->prepare($select->getStatement());
         $stmt->execute($select->getBindValues());

         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($table, $id)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*'])
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

        $stmt = $this->pdo->prepare($select->getStatement());
        $stmt->execute($select->getBindValues());

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($table, $data)
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)
            ->cols($data);

        $stmt = $this->pdo->prepare($insert->getStatement());
        $stmt->execute($insert->getBindValues());
    }

    public function update($table, $id, $data)
    {
        $update = $this->queryFactory->newUpdate();
        $update
            ->table($table)
            ->cols($data)
            ->where('id = :id')
            ->bindValue('id', $id);

        $stmt = $this->pdo->prepare($update->getStatement());
        $stmt->execute($update->getBindValues());
    }

    public function delete($table, $id)
    {
        $delete = $this->queryFactory->newDelete();
        $delete
            ->from($table)
            ->where('id = :id')
            ->bindValue('id', $id);

         $stmt = $this->pdo->prepare($delete->getStatement());
         $stmt->execute($delete->getBindValues());
    }

















}