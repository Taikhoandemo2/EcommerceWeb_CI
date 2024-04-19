<style>
	.custom-alert {
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 3px;
    /* Thêm bất kỳ kiểu dáng hoặc thuộc tính CSS nào bạn muốn điều chỉnh */
}
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('IndexModel');
		$this->load->library('cart');
		$this->data['category']=$this->IndexModel->getCategoryHome();
		$this->data['brand']=$this->IndexModel->getBrandHome();
		$this->data['sliders']=$this->IndexModel->getSliderHome();

		$this->load->library("pagination");
		$this->load->library('email');
		$this->load->library('session');
		
	}

	public function contact(){
		$this->load->view('pages/template/header',$this->data);
		$this->load->view('pages/template/slider',$this->data);
		$this->load->view('pages/contact');
		$this->load->view('pages/template/footer');
	}	
	
	
	public function notfound(){
		$this->load->view('pages/template/header',$this->data);
		//$this->load->view('pages/template/slider');
		$this->load->view('pages/404');
		$this->load->view('pages/template/footer');
	}
	public function send_mail($to_email,$title,$message){
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'huy0.808203@gmail.com';
		$config['smtp_pass'] = 'grtmndqhekomvfdj'; //mat khau ung dung gmail: grtm ndqh ekom vfdj
		$config['smtp_port'] = 465;
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		//config mail
		$this->email->from('huy0.808203@gmail.com', 'Send email to client successfully!');
		$this->email->to($to_email);
		// $this->email->cc('another@another-example.com');//gui 1 ban copy cho nhieu nguoi 
		// $this->email->bcc('them@their-example.com');//gui 1 ban copy cho nhieu nguoi se khong thay thong tin nguoi gui  

		$this->email->subject($title);
		$this->email->message($message);

		$this->email->send();
	}
	public function send_contact(){
		$data=[
			'name'=>$this->input->post('name'),
			'email'=> $this->input->post('email'),
			'phone'=> $this->input->post('phone'),
			'address'=> $this->input->post('address'),
			'note'=> $this->input->post('note')
			
		];
		$result=$this->IndexModel->insertContact($data);
		if ($result){
			$to_email=$this->input->post('email');
			$title="Contact information of Customer: ".$this->input->post('name');
			$message="Contact Info here -> Note: ". $this->input->post('note');
			$this->send_mail($to_email,$title,$message);
		}
		$this->session->set_flashdata('success','Send Contact Successfully!');
		redirect(base_url('contact'));
	}
	public function confirm_checkout(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
			$email = $this->input->post('email');
			$shipping_method = $this->input->post('shipping_method');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$name = $this->input->post('name');
			$data=array(
				'name'=>$name,
				'email'=>$email,
				'method'=>$shipping_method,
				'phone'=>$phone,
				'address'=>$address
			);
			$this->load->model('LoginModel');				
			$result = $this->LoginModel->NewShipping($data);  
			
			if ($result)
			{
				//order
				// $order_code=rand(00,9999);
				// $data_order=array(
				// 	'order_code'=>$order_code,
				// 	'ship_id'=>$result,
				// 	'status'=>1
				// );
				// $insert_order = $this->LoginModel->insert_order($data_order); 
				// //order details
				// foreach($this->cart->contents() as $items){
				// 	$data_order_details=array(
				// 		'order_code'=>$order_code,
				// 		'product_id'=>$items['id'],
				// 		'quantity'=>$items['qty']
				// 	);
				// 	$insert_order_details = $this->LoginModel->insert_order_details($data_order_details); 
					
				// 	$update_product = $this->LoginModel->update_quantity($data_order_details);
				
				// }
				$order_code = rand(0, 9999); // Đảm bảo rằng bạn đã khai báo $order_code ở trước đó

// Tạo đơn hàng
$data_order = array(
    'order_code' => $order_code,
    'ship_id' => $result,
    'status' => 1
);
$insert_order = $this->LoginModel->insert_order($data_order);

// Thêm chi tiết đơn hàng
foreach ($this->cart->contents() as $items) {
    $product_id = $items['id'];
    $quantity = $items['qty'];

    // Thêm chi tiết đơn hàng cho từng sản phẩm
    $data_order_details = array(
        'order_code' => $order_code,
        'product_id' => $product_id,
        'quantity' => $quantity
    );
    $insert_order_details = $this->LoginModel->insert_order_details($data_order_details);

	

}

				

				
				$this->session->set_flashdata('success','Order Successfully, We call you to delivery soon!');
				$this->cart->destroy();
				//send mail
				$to_email= $email;
				$title="Confirm your order in Eshoper.com!";
				$message="Your order will be shipped immediately upon receipt of this email! ";
				//ham send mail
				$this->send_mail($to_email,$title,$message);
				redirect(base_url('/thanks'));
			}
			else{
				$this->session->set_flashdata('error','Failed to confirm your order!');
				redirect(base_url('/dang-nhap'));
			}
		}else{
			$this->checkout();
		}
	}
	public function index()
	{
		//custom config link
		$config = array();
        $config["base_url"] = base_url() .'/phan-trang'; 
		$config['total_rows'] = ceil($this->IndexModel->countAllProduct()); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		$config["per_page"] = 10; //từng trang 3 sản phẩn
        $config["uri_segment"] = 2; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; //current page active 
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		$this->data['allproduct_pagination'] = $this->IndexModel->getIndexPagination($config["per_page"], $this->page);
		//pagination
		// $this->data['allproduct']=$this->IndexModel->getAllProduct();
		$this->data['items_categories']=$this->IndexModel->itemsCategories();
		$this->load->view('pages/template/header',$this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/home',$this->data);
		$this->load->view('pages/template/footer');
	}
	public function category($id)
	{
		//custom config link
		$this->data['slug']=$this->IndexModel->getCategorySlug($id);
		$config = array();
        $config["base_url"] = base_url() .'/danh-muc'.'/'.$id.'/'.$this->data['slug']; 
		$config['total_rows'] = ceil($this->IndexModel->countAllProductByCate($id)); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		$config["per_page"] = 4; //từng trang 3 sản phẩn
        $config["uri_segment"] = 4; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //current page active 
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		//get min max price
		$this->data['min_price']=$this->IndexModel->getMinProductPrice($id);
		$this->data['max_price']=$this->IndexModel->getMaxProductPrice($id);
		//filter
		if(isset($_GET['kytu'])){
			$kytu=$_GET['kytu'];
			$this->data['allproductbycate_pagination']=$this->IndexModel->getCateKytuPagination($id,$kytu,$config["per_page"], $this->page);
		}elseif(isset($_GET['gia'])){
			$gia=$_GET['gia'];
			$this->data['allproductbycate_pagination']=$this->IndexModel->getCatePricePagination($id,$gia,$config["per_page"], $this->page);
		}elseif(isset($_GET['to']) && $_GET['from']){
			$from_price=$_GET['from'];
			$to_price=$_GET['to'];
			$this->data['allproductbycate_pagination']=$this->IndexModel->getCatePriceRangePagination($id,$from_price,$to_price,$config["per_page"], $this->page);
		}else{
			$this->data['allproductbycate_pagination'] = $this->IndexModel->getCatePagination($id,$config["per_page"], $this->page);
		}

		
		//pagination
		//$this->data['category_product']=$this->IndexModel->getCategoryProduct($id);
		$this->data['title']=$this->IndexModel->getCategoryTitle($id);
		$this->config->config["pageTitle"]=$this->data['title'];
		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/category',$this->data);
		$this->load->view('pages/template/footer');
	}
	public function brand($id)
	{
		//custom config link
		// $this->data['slug']=$this->IndexModel->getBrandSlug($id);
		// $config = array();
        // $config["base_url"] = base_url() .'/thuong-hieu'.'/'.$id.'/'.$this->data['slug']; 
		// $config['total_rows'] = ceil($this->IndexModel->countAllProductByBrand($id)); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		// $config["per_page"] = 2; //từng trang 3 sản phẩn
        // $config["uri_segment"] = 4; //lấy số trang hiện tại
		// $config['use_page_numbers'] = TRUE; //trang có số
		// $config['full_tag_open'] = '<ul class="pagination">';
		// $config['full_tag_close'] = '</ul>';
		// $config['first_link'] = 'First';
		// $config['first_tag_open'] = '<li>';
		// $config['first_tag_close'] = '</li>';
		// $config['last_link'] = 'Last';
		// $config['last_tag_open'] = '<li>';
		// $config['last_tag_close'] = '</li>';
		// $config['cur_tag_open'] = '<li class="active"><a>';
		// $config['cur_tag_close'] = '</a></li>';
		// $config['num_tag_open'] = '<li>';
		// $config['num_tag_close'] = '</li>';
		// $config['next_tag_open'] = '<li>';
		// $config['next_tag_close'] = '</li>';
		// $config['prev_tag_open'] = '<li>';
		// $config['prev_tag_close'] = '</li>';
		// //end custom config link
		// $this->pagination->initialize($config); //tự động tạo trang
		// $this->page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0; //current page active 
		// $this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		// $this->data['allproductbybrand_pagination'] = $this->IndexModel->getBrandProductPagination($id,$config["per_page"], $this->page);
		//pagination
		$this->data['brand_product']=$this->IndexModel->getBrandProduct($id);
		$this->data['title']=$this->IndexModel->getBrandTitle($id);
		$this->config->config["pageTitle"]=$this->data['title'];
		$this->load->view('pages/template/header');
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/brand',$this->data);
		$this->load->view('pages/template/footer');
	}
	public function cart()
	{
		$this->config->config["pageTitle"]='Cart';
		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/cart');
		$this->load->view('pages/template/footer');
	}
	public function checkout(){
		if($this->session->userdata('LoggedInCustomer') && $this->cart->contents()){
			$this->config->config["pageTitle"]='Checkout Pages';
			$this->load->view('pages/template/header',$this->data);
			// $this->load->view('pages/template/slider');
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		}else{
			redirect(base_url().'dang-nhap');
		}
	}
	// public function add_to_cart(){
	// 	$product_id=$this->input->post('product_id');
	// 	$quantity=$this->input->post('quantity');
	// 	$this->data['product_details']=$this->IndexModel->getProductDetails($product_id);
	// 	//dat hang
	// 	if ($this->cart->contents()>0){
	// 		foreach($this->cart->contents() as $items)
	// 		{
	// 			if ($items['id']==$product_id)
	// 			{
	// 				$this->session->set_flashdata('success','This product already exist in your cart, please update the quantity.');
	// 				redirect(base_url().'gio-hang','refresh');
	// 			}
	// 			else{
	// 				foreach($this->data['product_details'] as $key => $pro){
	// 					//ktra so luong con lai cua sp
	// 					if($pro->quantity>$quantity){
	// 						$cart = array(
	// 							'id'      => $pro->id,
	// 							'qty'     => $quantity,
	// 							'price'   => $pro->price,
	// 							'name'    => $pro->title,
	// 							'options' => array('image' => $pro->image,'in_stock'=>$pro->quantity)
	// 							);
	// 					}else{
	// 						$this->session->set_flashdata('error','Your order is bigger than remaining amount of this product!');
	// 						redirect($_SERVER['HTTP_REFERER']);
	// 					}
	// 				}
	// 			}
	// 		}
	// 		$this->session->set_flashdata('success','Add to Cart succesfully!');
	// 		$this->cart->insert($cart);
	// 		// redirect(base_url().'gio-hang','refresh');
	// 	}
	// }
	public function add_to_cart(){
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$this->data['product_details'] = $this->IndexModel->getProductDetails($product_id);
		
		// Kiểm tra nếu giỏ hàng có chứa sản phẩm
		$cart_has_contents = ($this->cart->contents() > 0);
		
		if (!$cart_has_contents || empty($this->cart->contents($product_id))) {
			foreach ($this->data['product_details'] as $key => $pro) {
				// Kiểm tra số lượng còn lại của sản phẩm
				if ($pro->quantity > $quantity) {
					$cart = array(
						'id'      => $pro->id,
						'qty'     => $quantity,
						'price'   => $pro->price,
						'name'    => $pro->title,
						'options' => array('image' => $pro->image, 'in_stock' => $pro->quantity)
					);
					
					// Thêm sản phẩm vào giỏ hàng
					$this->cart->insert($cart);
					
					// Đặt thông báo thành công
					$this->session->set_flashdata('success', 'Add to Cart successfully!');
					
					// Chuyển hướng đến trang giỏ hàng
					redirect(base_url() . 'gio-hang', 'refresh');
				} else {
					// Đặt thông báo lỗi
					$this->session->set_flashdata('error', 'Your order is bigger than the remaining amount of this product!');
					
					// Chuyển hướng trở lại trang trước đó
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} else {
			if ($this->cart->contents()>0){
						foreach($this->cart->contents() as $items)
						{
							if ($items['id']==$product_id)
							{
								$this->session->set_flashdata('success','This product already exist in your cart, please update the quantity.');
								redirect(base_url().'gio-hang','refresh');
							}
							else{
								foreach($this->data['product_details'] as $key => $pro){
									//ktra so luong con lai cua sp
									if($pro->quantity>=$quantity){
										$cart = array(
											'id'      => $pro->id,
											'qty'     => $quantity,
											'price'   => $pro->price,
											'name'    => $pro->title,
											'options' => array('image' => $pro->image,'in_stock'=>$pro->quantity)
											);
									}else{
										$this->session->set_flashdata('error','Your order is bigger than remaining amount of this product!');
										redirect($_SERVER['HTTP_REFERER']);
									}
								}
							}
						}
						$this->session->set_flashdata('success','Add to Cart succesfully!');
						$this->cart->insert($cart);
						redirect(base_url().'gio-hang','refresh');
					}
		}
	}


	// public function add_to_cart(){
	// 	$product_id=$this->input->post('product_id');
	// 	$quantity=$this->input->post('quantity');
	// 	$this->data['product_details']=$this->IndexModel->getProductDetails($product_id);
	// 	//dat hang
	// 	foreach($this->data['product_details'] as $key => $pro){
	// 		//ktra so luong con lai cua sp
	// 		if($pro->quantity > $quantity){
	// 			$cart = array(
	// 				'id'      => $pro->id,
	// 				'qty'     => $quantity,
	// 				'price'   => $pro->price,
	// 				'name'    => $pro->title,
	// 				'options' => array('image' => $pro->image,'in_stock'=>$pro->quantity)
	// 				);
	// 		}else{
	// 			$this->session->set_flashdata('error','Your order is bigger than remaining amount of this product!');
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 	}
	// 	$this->cart->insert($cart);
	// 	redirect(base_url().'gio-hang','refresh');
	// }
	public function delete_all_cart(){
		$this->cart->destroy();
		redirect(base_url().'gio-hang','refresh');
	}
	public function delete_item($rowid){
		$this->cart->remove($rowid);
		redirect(base_url().'gio-hang','refresh');
	}
	public function update_cart_item(){
		$rowid=$this->input->post('rowid');
		$quantity=$this->input->post('quantity');
		foreach($this->cart->contents() as $items ){
			if($rowid ==$items['rowid']){
				if($quantity<=$items['options']['in_stock']){
				$cart = array(		
					'rowid'   => $rowid,		
					'qty'     => $quantity,
					);
			}
			elseif($quantity>$items['options']['in_stock']){
				$cart = array(		
					'rowid'   => $rowid,		
					'qty'     => $items['options']['in_stock'],
					);
			};
			}
		}
		$this->cart->update($cart);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function product($id)
	{
		$this->data['product_details']=$this->IndexModel->getProductDetails($id);
		$this->data['list_comments']=$this->IndexModel->getListComments($id);
		
		foreach ($this->data['product_details'] as $key=>$val)
		{
			$category_id=$val->category_id;
		}
		$this->data['product_related']=$this->IndexModel->getProductRelated($id,$category_id);
		$this->data['title']=$this->IndexModel->getProductTitle($id);
		$this->config->config["pageTitle"]=$this->data['title'];
		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/product_details',$this->data);
		$this->load->view('pages/template/footer');
	}
	public function thanks()
	{
		$this->config->config["pageTitle"]='Tremendous gratitude for patronage';
		if(isset($_GET['partnerCode'])){
			$data_momo=[
				'partnerCode' => $_GET['partnerCode'],
				'orderId' => $_GET['orderId'],
				'requestId' => $_GET['requestId'],
				'amount' => $_GET['amount'],
				'orderInfo' => $_GET['orderInfo'],
				'orderType' => $_GET['orderType'],
				'transId' => $_GET['transId'],
				'payType' => $_GET['payType'],
				'signature' => $_GET['signature']
			];
			//luu data
			$result = $this->IndexModel->insertMoMo($data_momo);
		}
		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/thanks');
		$this->cart->destroy();
		$this->load->view('pages/template/footer');
	}
	public function login(){
		$this->config->config["pageTitle"]='Sign up | Sign in';
		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}
	public function login_customer(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('LoginModel');	
			$result = $this->LoginModel->checkLoginCustomer($email,$password);  
			
			if (count($result)>0)
			{
				// Xóa phiên đăng nhập của tài khoản trước đó
				$this->session->unset_userdata('LoggedInCustomer');
				$session_array=array(
					'id'=>$result[0]->id,
					'username'=>$result[0]->name,
					'email'=>$result[0]->email,
			);
				$this->session->set_userdata('LoggedInCustomer',$session_array);
				$this->session->set_flashdata('success','Login Successfully!');
				redirect(base_url('/gio-hang'));
			}
			else{
				$this->session->set_flashdata('error','Wrong Email, Password or Not Actived please login again!');
				redirect(base_url('dang-nhap'));
			}
		}
		else
		{
			$this->login();
		}
	}
	public function dang_ky(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('name', 'Name', 'trim|required',['required'=>'Bạn cần điền %s']);
		$this->form_validation->set_rules('address', 'Address', 'trim|required',['required'=>'Bạn cần điền %s']);
		if ($this->form_validation->run()==true)
		{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$name = $this->input->post('name');
			$token = rand(0000,9999);
			$date_created = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
			$data=array(
				'name'=>$name,
				'email'=>$email,
				'password'=>$password,
				'phone'=>$phone,
				'address'=>$address,
				'token'=>$token,
				'date_created'=>$date_created
			);
			$this->load->model('LoginModel');	
			$result = $this->LoginModel->NewCustomer($data);  
			
			if ($result)
			{
			// 	$session_array=array(
			// 		'username'=>$name,
			// 		'email'=>$email
			// );
			// 	$this->session->set_userdata('LoggedInCustomer',$session_array);
			// 	$this->session->set_flashdata('success','Login Successfully!');
				//send mail
				$fullurl=base_url().'xac-thuc-dang-ky/?token='.$token.'&email='.$email;
				$title="You have been created a new account in Eshoper.com with this email!";
				$message="Click to this link below to active your account: ".$fullurl;
				$to_email=$email;
				$this->send_mail($to_email,$title,$message);
				redirect(base_url('/checkout'));
			}
			else{
				$this->session->set_flashdata('error','Wrong Email or Password please login again!');
				redirect(base_url('/dang-nhap'));
			}
		}
		else
		{
			$this->login();
		}
	}
	public function xac_thuc_dang_ky(){
		if(isset($_GET['email']) && $_GET['token']){
			$token=$_GET['token'];
			$email=$_GET['email'];
		}
		$data['get_customer']=$this->IndexModel->getCustomersToken($email);
		//update customer
		$now=Carbon\Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(5);
		$token_rand=rand(0000,9999); //rand lai token moi de tranh khi user nhap lai vao duong link lai kich hoat lai tai khoan cu
		foreach($data['get_customer'] as $key => $val){
			if($token != $val->$token){
				$this->session->set_flashdata('success','Actived link failed!');
				redirect(base_url('/dang-nhap'));
			}
			$data_customer=[
				'status'=>1,
				'token'=>$token
			];
			if($val->date_created < $now){
				$active_customer=$this->IndexModel->activeCustomersToken($email,$data_customer);
				$this->session->set_flashdata('success','Your account actived, please login!');
				redirect(base_url('/dang-nhap'));
			}else{
				$this->session->set_flashdata('warning','Active failed, please try again!');
				redirect(base_url('/dang-nhap'));
			}
		}
	}
	
	public function dang_xuat(){
		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('error','Logout Successfully!');
		// $this->cart->destroy();
		redirect(base_url('/dang-nhap'));
	}
	public function tim_kiem(){
		if(isset($_GET['keyword']) && $_GET['keyword']!=''){
			$keyword=$_GET['keyword'];
			$this->data['product']=$this->IndexModel->getProductByKeyword($keyword);
			$this->data['title']=$keyword;
			$this->config->config["pageTitle"]='Search for: '.$keyword;
		}
		else {
			// Hiển thị thông báo nếu không có từ khóa tìm kiếm
			$this->session->set_flashdata('error', 'Please enter a keyword to search.');
			echo '<div class="alert alert-danger custom-alert">' . $this->session->flashdata('error') . '</div>';
			redirect(base_url('/')); // Chuyển hướng người dùng về trang chính hoặc trang tìm kiếm.
		}
		//custom config link
		// $config = array();
        // $config["base_url"] = base_url() .'/tim-kiem';
		// $config['reuse_query_string'] = TRUE;//tai su dung duong dan chua keyword
		// $config['total_rows'] = ceil($this->IndexModel->countAllProductByKeyword($keyword)); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		// $config["per_page"] = 1; //từng trang 3 sản phẩn
        // $config["uri_segment"] = 2; //lấy số trang hiện tại
		// $config['use_page_numbers'] = TRUE; //trang có số
		// $config['full_tag_open'] = '<ul class="pagination">';
		// $config['full_tag_close'] = '</ul>';
		// $config['first_link'] = 'First';
		// $config['first_tag_open'] = '<li>';
		// $config['first_tag_close'] = '</li>';
		// $config['last_link'] = 'Last';
		// $config['last_tag_open'] = '<li>';
		// $config['last_tag_close'] = '</li>';
		// $config['cur_tag_open'] = '<li class="active"><a>';
		// $config['cur_tag_close'] = '</a></li>';
		// $config['num_tag_open'] = '<li>';
		// $config['num_tag_close'] = '</li>';
		// $config['next_tag_open'] = '<li>';
		// $config['next_tag_close'] = '</li>';
		// $config['prev_tag_open'] = '<li>';
		// $config['prev_tag_close'] = '</li>';
		// //end custom config link
		// $this->pagination->initialize($config); //tự động tạo trang
		// $this->page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0; //current page active 
		// $this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		// $this->data['allproductbykeyword_pagination'] = $this->IndexModel->getSearchPagination($keyword,$config["per_page"], $this->page);
		//pagination

		$this->load->view('pages/template/header',$this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/timkiem',$this->data);
		$this->load->view('pages/template/footer');	
	}
	public function comment_send(){
		$data=[
			'name'=>$this->input->post('name_comment'),
			'product_id'=>$this->input->post('pro_id'),
			'email'=> $this->input->post('email_comment'),
			'comment'=> $this->input->post('comment'),
			'stars'=> $this->input->post('star_rating'),
			'status'=> 0,
			'dated' => Carbon\Carbon::now('Asia/Ho_Chi_Minh')
		];
		$result=$this->IndexModel->insertComment($data);
		if($result){
			echo 'ok';
		}else{
			echo 'fail';
		}
	}


}

