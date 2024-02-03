<?php

namespace VOST\models\database;

include_once __DIR__ . '/DatabaseUtils.php';

class QueryUtils
{
    public static function generateInsertQuery($item)
    {
        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];
        $tableFields = array_splice($tableInfo['tableFields'], 1);

        array_splice($tableFields, -1, 1);

        $baseQuery = "INSERT INTO $tableName (" . implode(',', $tableFields) . ") VALUES (:" . implode(',:', $tableFields) . ");";

        return $baseQuery;
    }

    public static function generateUpdateQuery($item)
    {

        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];

        $tableFields = array_splice($tableInfo['tableFields'], 1);
        $tableValues = $tableInfo['tableValues'];
        $idField = $tableInfo['tableFields'][0];

        $baseQuery = "UPDATE $tableName SET ";
        $updateFields = [];

        foreach ($tableFields as $field) {
            if (isset($tableValues[$field]))
                $updateFields[] = "$field=:$field";
        }
        echo "hello";



        return ($baseQuery . implode(', ', $updateFields) . " WHERE $idField=:$idField");
    }

    public static function statementValueBinder($stmt, $item)
    {
        $tableInfo = $item->tableInfo;
        $tableValues = $tableInfo['tableValues'];
        $tableFields = $tableInfo['tableFields'];


        array_splice($tableValues, -1, 1);

        foreach ($tableFields as $field) {
            if (isset($tableValues[$field])) {
                var_dump($tableValues[$field]);
                $stmt->bindValue(":$field", $tableValues[$field] ?? 0);
            }
        }

        return $stmt;
    }
}
