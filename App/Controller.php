<?php

namespace App;
use Ez\Database as DB;
use Ez\Request;
use Ez\View;

class Controller
{
  
    public function activPage($page)
    {
        View::share(compact('page'));
    }

	public function pushArray($query)
    {
        $data = [];

        $query = $this->db->query($query);

        while ($row = $this->db->assoc($query)) {
            array_push($data, $row);
        }

        return $data;
    }

    public function toArray($query)
    {
        return $this->db->assoc($this->db->query($query));
    }

}
