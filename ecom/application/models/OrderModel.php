<?php
    class OrderModel extends CI_Model{
       
        public function selectOrder(){
            $query= $this->db->select('orders.*,shipping.*')
            ->from('orders')
            ->join('shipping','orders.ship_id=shipping.id')
            ->get();
            return $query->result();
        }
        public function selectOrderDetails($order_code){
            $query= $this->db->select('orders.order_code,orders.status as order_status,order_details.quantity as qty,order_details.order_code,order_details.product_id,products.*')
            ->from('order_details')
            ->join('products','order_details.product_id=products.id')
            ->join('orders','orders.order_code=order_details.order_code')
            ->where('order_details.order_code',$order_code)
            ->get();
            return $query->result();
        }
        public function printOrderDetails($order_code){
            $query= $this->db->select('orders.order_code,orders.status as order_status,order_details.quantity as qty,order_details.order_code,order_details.product_id,products.*')
            ->from('order_details')
            ->join('products','order_details.product_id=products.id')
            ->join('orders','orders.order_code=order_details.order_code')
            ->where('order_details.order_code',$order_code)
            ->get();
            return $query->result();
        }
        public function deleteOrder($order_code){
            return $this->db->delete('orders',['order_code'=>$order_code]);
        }
        public function deleteOrderDetails($order_code){
            $this->db->where_in('order_code',$order_code);
            return $this->db->delete('order_details');
        }
        public function updateOrder($data,$order_code){
            return $this->db->update('orders',$data,['order_code'=>$order_code]);
        }
     }
?>