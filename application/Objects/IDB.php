<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IDB extends Model
{
    public $guarded = [];

    protected $rel;

    public $timestamps = false;

    public function __construct($id = null)
    {
        if ($id) {
            return $this->find($id);
        }
        parent::__construct();
    }

    public function fetch($key, $value)
    {
        $this->primaryKey = $key;
        return self::find($value);
    }

    public function findByURL($url)
    {
        $this->primaryKey = 'url';
        return self::find($url);
    }

    public function urlGenerator($text)
    {
        $text = $text;
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'na-' . time();
        }

        return $text;
    }

    public function delete()
    {
        $rel = $this->rel;
        if (count($rel)) {
          foreach ($rel as $table => $column) {
            if (is_array($column) && isset($column['local_key'])) {
              $local_key = $column['local_key'];
              $data = DB::table($table)->where($column['foreign_key'], '=', $this->$local_key)->delete();
            } else {
              $data = DB::table($table)->where($column, '=', $this->id)->delete();
            }
          }
        }
        parent::delete();
    }
}
