<?php
declare(strict_types=1);

namespace app\models;

/**
 * Class User
 * @package app\models
 */
class Relationship extends Table
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $table = 'vs_keywords_to_fields';
        parent::__construct($table);
    }

    public function addRelations(array $data)
    {
        $id = 0;
        if(!empty($data['id'])) {
            $id = $data['id'];
        }

        foreach($data['keywords'] as $keyword) {
            $this->add([
                'keyword_id' => $keyword,
                'field_id' => $id
            ]);
        }

        return true;
    }

    public function getAllRelations(array $datas)
    {
        $relationIds = [];
        foreach($datas as $data) {
            $relationIds[] = $data['id'];
        }

        return $this->getRelationsByIds($relationIds);
    }

    public function getRelationsByIds(array $datas)
    {
        $ids = implode(',', $datas);

        $keys = $this->db->rows("SELECT field_id, keyword_id FROM {$this->table} WHERE field_id IN({$ids})");

        $result = [];
        foreach($keys as $key) {
            $result[$key['field_id']][] = $key['keyword_id'];
        }

        return $result;
    }

    public function getRelationsById(int $id)
    {
        return $this->db->rows("SELECT field_id, keyword_id FROM {$this->table} WHERE field_id = :id", ['id' => $id]);
    }

    public function deleteRelations($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE field_id = :id", ['id' => $id]);

        return true;
    }

    public function checkKeys(array $array, $id)
    {
        $fieldRelations = $this->getRelationsById($id);
        $relationsKeys = [];

        // Get new keywords
        foreach ($fieldRelations as $relation) {
            $relationsKeys[] = $relation['keyword_id'];
            $relationsKeysSub[] = $relation['keyword_id'];
        }
        $result = array_diff($array, $relationsKeys);
        // Add new key
        $this->addRelations(['keywords' => $result, 'id' => $id]);

        // Get delete keywords
        foreach($relationsKeys as $key => $element) {
            if (in_array($element, $array)) {
                unset($relationsKeysSub[$key]);
            }
        }
        if(!empty($relationsKeysSub)) {
            $this->deleteRelationsByIds($relationsKeysSub);
        }

        return $result;
    }

    private function deleteRelationsByIds($data)
    {
        if (is_array($data)) {
            foreach($data as $row) {
                $this->db->row("DELETE FROM {$this->table} WHERE keyword_id = :id", ['id' => $row]);
            }
        } else {
            $this->db->row("DELETE FROM {$this->table} WHERE keyword_id = :id", ['id' => $data]);
        }
    }
}