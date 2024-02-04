<?php

namespace VOST\models\database;

use PDOStatement;
use VOST\models\Utils;

include_once __DIR__ . '/DatabaseUtils.php';

class QueryUtils
{
    /**
     * generateInsertQuery
     *
     * @param  mixed $item
     * @return string
     */
    public static function generateInsertQuery($item): string
    {
        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];
        $tableFields = array_splice($tableInfo['tableFields'], 1);

        array_splice($tableFields, -1, 1);

        $baseQuery = "INSERT INTO $tableName (" . implode(',', $tableFields) . ") VALUES (:" . implode(',:', $tableFields) . ");";

        return $baseQuery;
    }

    /**
     * generateIntermediaryInsertQuery
     *
     * @param  mixed $item
     * @return string
     */
    public static function generateIntermediaryInsertQuery($item): string
    {
        $tableInfo = $item->tableInfo;
        $tableName = $tableInfo['tableName'];
        $tableFields = $tableInfo['tableFields'];

        array_splice($tableFields, -1, 1);

        $baseQuery = "INSERT INTO $tableName (" . implode(',', $tableFields) . ") VALUES (:" . implode(',:', $tableFields) . ");";

        return $baseQuery;
    }

    /**
     * generateUpdateQuery
     *
     * @param  mixed $item
     * @return string
     */
    public static function generateUpdateQuery($item): string
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

        return ($baseQuery . implode(', ', $updateFields) . " WHERE $idField=:$idField");
    }

    /**
     * statementValueBinder
     *
     * @param  mixed $stmt
     * @param  mixed $item
     * @return PDOStatement
     */
    public static function statementValueBinder($stmt, $item): PDOStatement
    {
        $tableInfo = $item->tableInfo;
        $tableValues = $tableInfo['tableValues'];
        $tableFields = $tableInfo['tableFields'];


        array_splice($tableValues, -1, 1);

        foreach ($tableFields as $field) {
            if (isset($tableValues[$field])) {

                $curatedValue = Utils::validateData($tableValues[$field]);
                $stmt->bindValue(":$field", $curatedValue);
            }
        }

        return $stmt;
    }
}
