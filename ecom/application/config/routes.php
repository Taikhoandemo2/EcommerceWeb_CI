<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'IndexController';
$route['404_override'] = 'IndexController/notfound';
$route['translate_uri_dashes'] = FALSE;

//home
$route['danh-muc/(:any)/(:any)']['GET'] = 'IndexController/category/$1/$2';
$route['thuong-hieu/(:any)/(:any)']['GET'] = 'IndexController/brand/$1/$2';
$route['san-pham/(:any)/(:any)']['GET'] = 'IndexController/product/$1/$2';
$route['gio-hang']['GET'] = 'IndexController/cart';
$route['add-to-cart']['POST']='IndexController/add_to_cart';
$route['update-cart-item']['POST']='IndexController/update_cart_item';

$route['delete-all-cart']['GET'] = 'IndexController/delete_all_cart';
$route['delete-item/(:any)']['GET'] = 'IndexController/delete_item/$1';
$route['dang-nhap']['GET'] = 'IndexController/login';
$route['checkout']['GET'] = 'IndexController/checkout';
$route['confirm-checkout']['POST'] = 'IndexController/confirm_checkout';
$route['online-checkout']['POST'] = 'OnlineCheckoutController/online_checkout';

$route['dang-xuat']['GET'] = 'IndexController/dang_xuat';
$route['thanks']['GET'] = 'IndexController/thanks';
$route['tim-kiem']['GET'] = 'IndexController/tim_kiem';

//contact
$route['contact']['GET']='IndexController/contact';
$route['send-contact']['POST']='IndexController/send_contact';

//comment
$route['comment/send']['POST']='IndexController/comment_send';
//pagination
$route['phan-trang/(:num)'] = 'IndexController/index/$1';
$route['phan-trang'] = 'IndexController/index/';
$route['danh-muc/(:any)/(:any)/(:any)']['GET'] = 'IndexController/category/$1/$2';
$route['thuong-hieu/(:any)/(:any)/(:any)']['GET'] = 'IndexController/category/$1/$2';

//email
$route['test-mail']= 'IndexController/send_mail';

//register-admin
$route['register-admin']['GET'] = 'LoginController/register_admin';
$route['register-insert']['POST'] = 'LoginController/register_insert';
//login
$route['login']['GET'] = 'LoginController/index';
$route['login-user']['POST'] = 'LoginController/login';
$route['login-customer']['POST'] = 'IndexController/login_customer';
$route['dang-ky']['POST'] = 'IndexController/dang_ky';
$route['xac-thuc-dang-ky']['GET'] = 'IndexController/xac_thuc_dang_ky';

//dashboard
$route['dashboard']['GET'] = 'DashboardController/index';
$route['logout']['GET'] = 'DashboardController/logout';
//brand
$route['brand/create']['GET']='BrandController/create';
$route['brand/list']['GET']='BrandController/index';
$route['brand/delete/(:any)']['GET']='BrandController/delete/$1';
$route['brand/edit/(:any)']['GET']='BrandController/edit/$1';
$route['brand/update/(:any)']['POST']='BrandController/update/$1';
$route['brand/store']['POST']='BrandController/store';

//slider
$route['slider/create']['GET']='SliderController/create';
$route['slider/list']['GET']='SliderController/index';
$route['slider/delete/(:any)']['GET']='SliderController/delete/$1';
$route['slider/edit/(:any)']['GET']='SliderController/edit/$1';
$route['slider/update/(:any)']['POST']='SliderController/update/$1';
$route['slider/store']['POST']='SliderController/store';

//category
$route['category/create']['GET']='CategoryController/create';
$route['category/list']['GET']='CategoryController/index';
$route['category/delete/(:any)']['GET']='CategoryController/delete/$1';
$route['category/edit/(:any)']['GET']='CategoryController/edit/$1';
$route['category/update/(:any)']['POST']='CategoryController/update/$1';
$route['category/store']['POST']='CategoryController/store';

//product
$route['product/create']['GET']='ProductController/create';
$route['product/list']['GET']='ProductController/index';
$route['product/delete/(:any)']['GET']='ProductController/delete/$1';
$route['product/edit/(:any)']['GET']='ProductController/edit/$1';
$route['product/update/(:any)']['POST']='ProductController/update/$1';
$route['product/store']['POST']='ProductController/store';

//order
$route['order/list']['GET']='OrderController/index';
$route['order/process']['POST']='OrderController/process';
$route['order/view/(:any)']['GET']='OrderController/view/$1';
$route['order/delete/(:any)']['GET']='OrderController/delete_order/$1';
$route['order/print_order/(:any)']['GET']='OrderController/print_order/$1';

//revenue
$route['revenue/revenue_view']['GET'] = 'RevenueController/index';
$route['revenue/export_excel']['GET'] = 'RevenueController/export_excel';


