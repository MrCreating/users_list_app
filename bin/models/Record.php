<?php

namespace App\Models;

/**
 * Модель для работы с БД
 * В нашем случае это просто JSON-файл (тестовая, не более).
 */
class Record extends Base
{
    private bool $isNew;

    protected static string $dbPath = __DIR__ . '/../../db,json';

    private array $db;
    private string $primaryColumn;

    /**
     * То, что пойдет в БД
     */
    protected array $finalObject = [];

    public function __construct(bool $isNew = true, string $primaryColumn = '')
    {
        parent::__construct();

        $this->isNew = $isNew;
        $this->primaryColumn = $primaryColumn;
        $this->db = json_decode(file_get_contents(self::$dbPath), true);
    }

    public function __set (string $key, string $value): void
    {
        if ($key === $this->primaryColumn) {
            foreach ($this->db as $id => $object) {
                if ((string)$id === (string)$value) {
                    $this->finalObject = $object;
                    $this->isNew = false;
                }
            }
        }

        $this->finalObject[$key] = $value;
    }

    public function __get (string $key): ?string
    {
        return $this->finalObject[$key];
    }

    ////////////////////////////////////////////
    public function insert (): static
    {
        $last_id = 0;
        foreach ($this->db as $key => $value)
        {
            $last_id = (int) $key;
        }

        $last_id += 1;

        $this->finalObject[$this->primaryColumn] = $last_id;

        $this->db[$last_id] = $this->finalObject;
        $this->write();

        return $this;
    }

    public function update (): static
    {
        $this->db[$this->finalObject[$this->primaryColumn]] = $this->finalObject;
        $this->write();

        return $this;
    }

    public function save (): static
    {
        return $this->isNew ? $this->insert() : $this->update();
    }

    public function delete (): void
    {
        unset($this->db[$this->finalObject[$this->primaryColumn]]);
        $this->write();
    }

    private function write (): void
    {
        file_put_contents(self::$dbPath, json_encode($this->db, JSON_PRETTY_PRINT));
    }
    ////////////////////////////////////////////

    public function __serialize(): array
    {
        return $this->finalObject;
    }

    /**
     * @param int $id
     * @return Record|null
     */
    public static function find (int $id): ?static
    {
        $object = new static();

        $object->{$object->primaryColumn} = $id;
        if ($object->isNew) {
            return NULL;
        }

        return $object;
    }
}