<?php

class update_data extends CI_Model {

    function update_cart_add($input) {
        $value = array(
            'id' => $input['id'],
            'count' => $input['count'],
            'ip_addr' => $input['ip_addr']
        );


        if ($this->db->insert('cart_history', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_viewed($input) {

        $value = array(
            'id' => $input['id'],
            'count' => $input['count'],
            'ip_addr' => $input['ip_addr']
        );

        $query = $this->db->query("select ip_addr  from view_history where ip_addr = '" . $value['ip_addr'] . "' and  TO_DAYS(time_stamp) = TO_DAYS(now()) ");

        if ($query->num_rows() == 0) {
            if ($this->db->insert('view_history', $value)):
                return true;
            else:
                return false;
            endif;
        }
    }

    function update_message_read() {
        $value = array('is_read' => '1');
        if ($this->db->update('contact_detail', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_membereditprofile($username, $input) {

        $value = array(
            'fullname' => $input['fullname'],
            'email' => $input['email'],
            'birthday' => $input['birthday'],
            'address' => $input['address'],
            'province' => $input['province'],
            'zipcode' => $input['zipcode'],
            'tel' => $input['tel'],
            'sex' => $input['sex'],
            'bankname' => $input['bankname'],
            'bankbranch' => $input['bankbranch'],
            'bankno' => $input['bankno'],
            'bankowner' => $input['bankowner'],
            'banktype' => $input['banktype'],
            'website' => $input['website']
        );
        $this->db->where('username', $username);

        if ($this->db->update('user', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_membereditprofilePW($username, $input) {

        $value = array(
            'password' => md5($input['password'])
        );
        $this->db->where('username', $username);

        if ($this->db->update('user', $value)):
            return true;
        else:
            return false;
        endif;
    }

    function update_Product($id, $input) {

        $this->db->where('id', $id);

        if ($this->db->update('items', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function delete_Product($id) {

        $this->db->where('id', $id);

        if ($this->db->delete('items')):
            return true;
        else:
            return false;
        endif;
    }

    function update_category($id, $input) {

        $this->db->where('categories_id', $id);

        if ($this->db->update('categories', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function delete_category($id) {

        $this->db->where('categories_id', $id);

        if ($this->db->delete('categories')):
            return true;
        else:
            return false;
        endif;
    }

    function update_Order($id, $input) {

        $this->db->where('order_id', $id);

        if ($this->db->update('orders', $input)):
            return true;
        else:
            return false;
        endif;
    }

}

?>