<?php

class order_model extends CI_Model {

    function getOrderList($txt_search = null, $acc = null) {
        $query = $this->db->query("SELECT * FROM orders a INNER JOIN orderdetails b ON a.order_id = 
			b.order_id WHERE CONCAT(a.order_id,a.orders_ownername)  
			LIKE '%$txt_search%' AND is_active = 1 And a.acc = '$acc' GROUP BY a.order_id Order By a.order_time desc");
        return $query->result();
    }

    function getOrder($order_id = null) {
        $query = $this->db->query("SELECT * FROM orders where order_id =" . $order_id);
        return $query->row();
    }

    function getOrderDetail($order_id = null) {
        $query = $this->db->query("SELECT a.price priceaff , a.*,b.* ,(a.qty * b.price) as subtotal
				FROM orderdetails a
				INNER JOIN items b ON a.product_id = b.id
				WHERE order_id = '$order_id'");
        return $query->result();
    }

    function get_new_orderList($txt_search = null, $acc = null) {
        $query = $this->db->query("SELECT * FROM orders a INNER JOIN orderdetails b ON a.order_id = 
			b.order_id WHERE CONCAT(a.order_id,a.orders_ownername)  
			LIKE '%$txt_search%' AND is_active = 1 And a.acc = '$acc' and a.is_shipping = 0 GROUP BY a.order_id Order By a.order_time desc");
        return $query->result();
    }

    function get_orderList_wait_shipping($txt_search = null, $acc = null) {
        $query = $this->db->query("SELECT * FROM orders a INNER JOIN orderdetails b ON a.order_id = 
			b.order_id WHERE CONCAT(a.order_id,a.orders_ownername)  
			LIKE '%$txt_search%' AND is_active = 1 And a.acc = '$acc' and a.is_shipping = 0 and is_payment = 1 GROUP BY a.order_id Order By a.order_time desc");
        return $query->result();
    }

    function get_payment($txt_search = null, $acc = null) {
        $query = $this->db->query("SELECT * FROM payment_detail");
        return $query->result();
    }

    function get_order_summary($txt_search = null, $acc = null) {
        $query = $this->db->query("SELECT *  FROM  orders where is_payment = 1 AND is_shipping = 0 AND is_active = 1 ORDER BY order_time DESC");
        return $query->result();
    }

    function get_order_summary_list($order_id) {
        $query = $this->db->query("SELECT * FROM orderdetails a inner join items b on a.product_id = b.id where order_id = '$order_id' ");
        return $query->result();
    }

    function get_order_summary_detail($order_id) {
        $query = $this->db->query("SELECT *  FROM  orderdetails a inner join items b on a.product_id = b.id where order_id = '$order_id' ");
        return $query->result();
    }

    function get_order_summary_total() {
        $query = $this->db->query("SELECT *  FROM  orders where is_payment = 1  AND is_active = 1 ");
        return $query->result();
    }

}
