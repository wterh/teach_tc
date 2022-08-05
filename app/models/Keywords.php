<?php
declare(strict_types=1);

namespace app\models;

/**
 * Class User
 * @package app\models
 */
class Keywords extends Table
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $table = 'vs_keywords';
        parent::__construct($table);
    }

    public function getAllKeywords(array $datas)
    {
        $result = [];
        foreach($datas as $fieldId => $keywordIds) {
            foreach($keywordIds as $keywordId) {
                $result[$fieldId][] = $this->getKeywordsByIds((int)$keywordId);
            }
        }

        return $result;
    }

    public function getKeywordsByIds(int $id)
    {
        return $this->db->rows("SELECT id,name FROM {$this->table} WHERE id = :id", ['id' => $id]);
    }

    public function getIdsByParentId(array $datas)
    {
        $result = [];
        foreach($datas as $data) {
            $result[] = $data['keyword_id'];
        }
        $result = implode(',', $result);

        $request = $this->db->rows("SELECT id FROM {$this->table} WHERE id IN({$result})");
        $result = []; // clear
        foreach($request as $row) {
            $result[$row['id']] = $row['id'];
        }
        return $result;
    }
}