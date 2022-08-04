<?php
declare(strict_types=1);

namespace app\models;

use app\core\Model;

/**
 * Class Table
 * @package app\models
 */
abstract class Table extends Model
{
    protected $table;

    /**
     * Table constructor.
     * @param $table
     */
    public function __construct($table)
    {
        parent::__construct();
        $this->table = $table;
    }

    /**
     * @param array $data
     * @return string
     */
    public function add(array $data)
    {
        $params = [];
        foreach ($data as $key => $value) {
            $params[$key] = $value;
        }

        $keys = implode(', ', array_keys($params));
        $values = ':' . implode(', :', array_keys($params));

        $sql = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";
        $this->db->query($sql, $params);

        return $this->db->lastInsertId();
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function edit(array $data, $id)
    {
        $params = [];
        foreach ($data as $key => $value) {
            $params[$key] = $value;
        }

        $values = '';
        foreach ($params as $key => $value) {
            $values .= "{$key} = :{$key},";
        }
        $values = trim($values, ',');

        $params['id'] = $id;

        $this->db->query("UPDATE {$this->table} SET {$values} WHERE id = :id", $params);

        return true;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $params = ['id' => $id];

        return $this->db->row("SELECT * FROM {$this->table} WHERE id = :id", $params);
    }

    /**
     * @param bool $asc
     * @param array $data
     * @return array
     */
    public function getAll($asc = false, $data = [])
    {

        $selector = '*';
        if (isset($data['selector'])) {
            $selector = '';
            foreach($data['selector'] as $column) {
                $selector .= "`{$column}`";
            }
            unset($data['selector']);
        }

        if ($asc === 'not') {
            return $this->db->rows("SELECT {$selector} FROM {$this->table}");
        } else if ($asc === 'true') {
            return $this->db->rows("SELECT {$selector} FROM {$this->table} ORDER BY id ASC ");
        }

        return $this->db->rows("SELECT {$selector} FROM {$this->table} ORDER BY id DESC");
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $params = ['id' => $id];

        $this->db->query("DELETE FROM {$this->table} WHERE id = :id", $params);

        return true;
    }

    /**
     * Выборка по произвольному запросу
     * @param $query
     * @return mixed
     */
    public function getQuery($query)
    {
        return $this->db->query($query);
    }

    /**
     * @return bool|\PDOStatement
     */
    public function truncate()
    {
        return $this->db->query("TRUNCATE {$this->table}");
    }
}