<?php
namespace App\Database;

class QueryBuilder
{
    private static $pdo;
    private static $log;


    public static function make($pdo, $log = null)
    {
        self::$pdo = $pdo;
        self::$log = $log;
    }

    public static function get(string $table, $where=null)
    {
        $queryStr = "SELECT * FROM $table";
        if(is_array($where))
        {
            $queryStr .= " WHERE ".implode(' ', $where);
        }
        $query = self::execute($queryStr);

        return $query->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function insert($table, $data)
    {

        $fields = array_keys($data);
        $fieldStr = implode(',', $fields);
        $valuesStr = str_repeat('?,', count($fields) - 1) . '?';


        $query = "INSERT INTO $table ($fieldStr) VALUES ($valuesStr)";
        self::execute($query,array_values($data));

    }


    public static function update($table, $id, $data)
    {
        $fields = implode('= ? ,', array_keys($data)) . ' = ? ';
        $values = array_values($data);

        $query = "UPDATE $table SET $fields WHERE id = $id";
        self::execute($query, $values);

    }

    public static function delete($table, $id, $column = 'id', $operator = '=')
    {
        $query = "DELETE FROM {$table} WHERE {$column} {$operator} {$id}";
        self::execute($query);
    }


    private static function execute($query, $values = [])
    {
        if (self::$log)
        {
            self::$log->info($query);
        }
        $statement = self::$pdo->prepare($query);
        $statement->execute($values);
        return $statement;
    }
}