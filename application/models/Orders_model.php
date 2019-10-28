<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model
{

    protected $table = "orders";

    public function get_all()
    {
        log_message('debug', 'Executing Orders_model::get_all().');

        $this->db->order_by('date', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function add($input)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Orders_model',
            "method" => "add");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Orders_model::add().", $log_data);

        $this->db->insert($this->table, $input);
        return true;
    }

    public function get_details($key)
    {
        log_message('debug', "Executing Orders_model::get_details({$key}).");

        $query = $this->db->get_where($this->table, array('id' => $key), 1);
        return $query->row();
    }

    public function update($input, $id)
    {
        $log_array = array(
            "input" => $input,
            "user" => $this->session->user,
            "class" => 'Order_model',
            "method" => "update");
        $log_data = json_encode($log_array);

        log_message('debug', "Executing Pages_model::update().", $log_data);

        $this->db->update($this->table, $input, array('id' => $id));
        return true;
    }

}