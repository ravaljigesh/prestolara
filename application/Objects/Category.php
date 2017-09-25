<?php
namespace App\Objects;

use App\Objects\IDB;

class Category extends IDB
{
    protected $table = 'category';

    protected $primaryKey = 'id_category';

    public function getAll()
    {
        $data = $this->leftJoin('category_lang', 'category_lang.id_category', '=', 'category.id_category')
        ->where('id_shop', 1)
        ->where('active', 1)
        ->get();

        $categories = array();
        foreach ($data as $key => $d) {
          if (isset($categories[$d->name]) && $categories[$d->name]) {
            $name = $key;
          } else {
            $name = $d->name;
          }
          $categories[$name] = $d->id_category;
        }

        return $categories;
    }
}
