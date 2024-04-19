<?php
    class IndexModel extends CI_Model{
    public function insertContact($data){
        return $this->db->insert('contact',$data);
    }
    public function insertMoMo($data_momo){
        return $this->db->insert('momo',$data_momo);
    }
    public function insertComment($data){
        return $this->db->insert('comments',$data);
    }
    public function getListComments($id){
        $query= $this->db->get_where('comments',['status'=>1]);
        return $query->result();
    }
    public function getCategoryHome(){
           $query= $this->db->get_where('categories',['status'=>1]);
           return $query->result();
    }
    public function getSliderHome(){
        $query= $this->db->get_where('sliders',['status'=>1]);
        return $query->result();
 }
    public function getBrandHome(){
        $query= $this->db->get_where('brands',['status'=>1]);
        return $query->result();
    }
    public function getAllProduct(){
        $query= $this->db->get_where('products',['status'=>1]);
        return $query->result();
    }
    public function getCategoryProduct($id){
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.category_id',$id)
           ->get();
           return $query->result();
    }
    public function itemsCategories(){
        $this->db->select('products.*,categories.title as titlecate,categories.id as cateid');
        $this->db->from('categories');
        $this->db->join('products','products.category_id=categories.id');
        $query = $this->db->get();
        $result =$query->result_array();
        // echo "<pre>";
        // print_r($result);
        $newArray = array();
        foreach ($result as $key=>$value){
            $newArray [ $value["titlecate"] ][]=$value;
        }
        return $newArray;
    }

    public function getBrandProduct($id){
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.brand_id',$id)
           ->get();
           return $query->result();

    }
    public function getProductDetails($id){
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.id')
            ->join('brands','brands.id=products.brand_id')
            ->where('products.id',$id)
            ->get();
            return $query->result();
    }
    public function getProductRelated($id,$category_id){
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
            ->from('categories')
            ->join('products','products.category_id=categories.id')
            ->join('brands','brands.id=products.brand_id')
            ->where('products.category_id',$category_id)
            ->where_not_in('products.id',$id)
            ->get();
            return $query->result();
    }
    public function getBrandTitle($id){
        $this->db->select('brands.*');
        $this->db->from('brands');
        $this->db->limit(1);
        $this->db->where('brands.id',$id);
        $this->db->where('brands.id',$id);
        $query=$this->db->get();
        $result= $query->row();
        return $title=$result->title;
    }
    public function getCategoryTitle($id){
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->limit(1);
        $this->db->where('categories.id',$id);
        $query=$this->db->get();
        $result= $query->row();
        return $title=$result->title;
        }
    
    public function getCategorySlug($id){
        $this->db->select('categories.*');
        $this->db->from('categories');
        $this->db->limit(1);
        $this->db->where('categories.id',$id);
        $query=$this->db->get();
        $result= $query->row();
        return $title=$result->slug;
    }
    public function getBrandSlug($id){
        $this->db->select('brands.*');
        $this->db->from('brands');
        $this->db->limit(1);
        $this->db->where('brands.id',$id);
        $this->db->where('brands.id',$id);
        $query=$this->db->get();
        $result= $query->row();
        return $title=$result->slug;
    }
    public function getProductTitle($id){
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->limit(1);
        $this->db->where('products.id',$id);
        $query=$this->db->get();
        $result= $query->row();
        return $title=$result->title;
    }
    public function getProductByKeyword($keyword){
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
        ->from('categories')
        ->join('products','products.category_id=categories.id')
        ->join('brands','brands.id=products.brand_id')
        ->like('products.title',$keyword)
        ->get();
        return $query->result();
    }
   
    public function countAllProduct(){
        return $this->db->count_all('products');
    }
    public function countAllProductByCate($id){
        $this->db->where('category_id',$id);
        $this->db->from('products');
        return $this->db->count_all_results();
    }
    // public function countAllProductByKeyword($keyword){
    //     $this->db->like('products.title',$keyword);
    //     $this->db->from('products');
    //     return $this->db->count_all_results();
    // }
    public function countAllProductByBrand($id){
        $this->db->where('brand_id',$id);
        $this->db->from('products');
        return $this->db->count_all_results();
    }
    public function getCatePagination($id,$limit, $start){
        $this->db->limit($limit, $start);
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.category_id',$id)
           ->get();
           return $query->result();
    }
    public function getCateKytuPagination($id,$kytu,$limit, $start){
        $this->db->limit($limit, $start);
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.category_id',$id)
           ->order_by('products.title',$kytu)
           ->get();
           return $query->result();
    }
    public function getCatePricePagination($id,$gia,$limit, $start){
        $this->db->limit($limit, $start);
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.category_id',$id)
           ->order_by('products.price',$gia)
           ->get();
           return $query->result();
    }
    public function getCatePriceRangePagination($id,$from_price,$to_price,$limit, $start){
        $this->db->limit($limit, $start);
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.category_id',$id)
           ->where('products.price >=',$from_price)
           ->where('products.price <=',$to_price)
           ->order_by('products.price','asc')
           ->get();
           return $query->result();
    }
    public function getMinProductPrice($id){
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->select_min('price');
        $this->db->where('products.category_id',$id);
        $this->db->limit(1);
        $query=$this->db->get();
        $result= $query->row();
        return $price=$result->price;
    }
    public function getMaxProductPrice($id){
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->select_max('price');
        $this->db->where('products.category_id',$id);
        $this->db->limit(1);
        $query=$this->db->get();
        $result= $query->row();
        return $price=$result->price;
    }
    public function getBrandProductPagination($id,$limit,$start){
        $this->db->limit($limit,$start);
        $query= $this->db->select('categories.title as tendanhmuc,products.*, brands.title as tenthuonghieu')
           ->from('categories')
           ->join('products','products.category_id=categories.id')
           ->join('brands','brands.id=products.brand_id')
           ->where('products.brand_id',$id)
           ->get();
           return $query->result();

    }
    public function getIndexPagination($limit, $start){
        $this->db->limit($limit, $start);
        $query=$this->db->get_where('products',['status'=>1]);
        return $query->result();
    }
    // public function getIndexPagination($limit, $start){
    //     $this->db->where('status', 1); // Thêm điều kiện status = 1 vào trước khi lấy dữ liệu
    //     $this->db->limit($limit, $start);
    //     $query = $this->db->get('products');
    //     return $query->result();
    // }
    public function getCustomersToken($email){
        $query= $this->db->get_where('customers',['email'=>$email]);
        return $query->result();
    }
    public function activeCustomersToken($email,$data_customer){
        return $this->db->update('customers',$data_customer,['email'=>$email]);
        
    }
}
?>