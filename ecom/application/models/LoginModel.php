<?php
    class LoginModel extends CI_Model{
        public function RegisterAdmin($data){
            return $this->db->insert('user',$data);
        }
        public function checkLogin($email,$password){
           $query = $this->db->where("email",$email)->where("password",$password)->get("user");
           return $query->result();
        }
        public function checkLoginCustomer($email,$password){
            $query = $this->db->where("email",$email)->where("password",$password)->where('status',1)->get("customers");
            return $query->result();
        }
        public function NewCustomer($data){
            return $this->db->insert('customers',$data);
            
        }
        public function NewShipping($data){
            $this->db->insert('shipping',$data);
            return $ship_id=$this->db->insert_id();
        }
        public function insert_order($data_order){
            return $this->db->insert('orders',$data_order);
        }
        public function update_quantity($data_order_details){
            $id = $data_order_details['product_id'];
            $quantity = $data_order_details['quantity'];
        
            $sql = "
            UPDATE products
            SET quantity = quantity - $quantity
            WHERE id = $id;
            ";
      
            return $this->db->query($sql);
        
        }
        public function insert_order_details($data_order_details){
            return $this->db->insert('order_details',$data_order_details);
        }
    }
?>