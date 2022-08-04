<?php
declare(strict_types=1);

namespace app\models;

/**
 * Class User
 * @package app\models
 */
class Knowledge extends Table
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        $table = 'vs_fields';
        parent::__construct($table);
    }

    public function addKnowledge(string $data)
    {
        return $this->add([
            'name' => $data,
            'parent' => '1',
            'is_group' => '1',
            'org_id' => '1',
            'is_active' => '1',
            'created_at' => time(),
            'updated_at' => time(),
            'comment' => '',
        ]);
    }
}