<?php

function all($table, $fields = "*")
{
    try {
        $connect = connect();
        return $connect->query("SELECT " . $fields . " FROM " . $table)->fetchAll();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}

function findBy($table, $field, $value,  $fields = "*")
{
    try {
        $connect = connect();
        $prepare = $connect->prepare("SELECT {$fields} FROM {$table} WHERE {$field} = :{$field}");
        $prepare->execute([
            $field => $value
        ]);
        return $prepare->fetch();

    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}
