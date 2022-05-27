<?php
class Mdistrict extends CI_Model {
        public function __construct()
        {
                parent::__construct();
                $this->table = $this->db->dbprefix('district');
        }

        public function district_provinceid($id)
        {
                $this->db->where('provinceid', $id);
                $this->db->order_by('name', 'asc');
                $query = $this->db->get($this->table);
                $output = '<option value="">--- Chọn quận huyện ---</option>';
                foreach($query->result() as $row)
                {
                 $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
                 
                }
                return $output;
        }

        public function district_name($districtid)
        {
                $this->db->where('id', $districtid);
                $this->db->order_by('name', 'asc');
                $this->db->limit(1);
                $query = $this->db->get($this->table);
                $row=$query->row_array();
                return $row['name'];
        }

        public function district_id($districtid)
        {
                $this->db->where('id', $districtid);

                $query = $this->db->get($this->table);
                $row=$query->row_array();
                return $row;
        }
         
}