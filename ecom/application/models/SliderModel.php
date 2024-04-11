<?php
    class SliderModel extends CI_Model{
        public function insertSlider($data){
            return $this->db->insert('sliders',$data);
        }
        public function selectSlider(){
            $query= $this->db->get('sliders');
            return $query->result();
        }
        public function selectSliderById($id){
            $query= $this->db->get_where('sliders',['id'=>$id]);
            return $query->row();
        }

        public function updateSlider($id,$data){
            return $this->db->update('sliders',$data,['id'=>$id]);
        }
        public function deleteSlider($id){
            return $this->db->delete('sliders',['id'=>$id]);
        }

    }
?>