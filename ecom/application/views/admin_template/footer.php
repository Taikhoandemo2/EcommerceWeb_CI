
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script>
    $('.xulydonhang').change(function(){
      const value =$(this).val();
      const order_code=$(this).find(':selected').attr('id');
      if(value==0){
        alert('Please choose at least 1 method');
      }
      else{
        $.ajax({
          method:'POST',
          url:'/order/process',
          data:{value:value,order_code:order_code},
          success:function(){
            alert('Change method successfully');

          }
        })
      }
    })
</script>
<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }        
</script>
<script>
 	function validateInput(input) {
                var regex = /^[a-zA-Z0-9\s]*$/; // Thêm \s để cho phép nhập khoảng trắng
                var isValid = regex.test(input.value);
                var errorDiv = document.getElementById('nameError');
                
                if (!isValid) {
                    errorDiv.textContent = "You must enter characters or numbers not special characters!";
                    input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
                } else {
                    errorDiv.textContent = "";
                }
            }
</script>
<script>
  function validateNumberInput(input) {
      var value = input.value.trim(); // Loại bỏ các khoảng trắng ở đầu và cuối chuỗi
      var isValid = /^[0-9]*$/.test(value); // Sử dụng biểu thức chính quy để kiểm tra xem giá trị chỉ chứa số hay không
      var errorSpan = document.getElementById('priceError'); // Lấy đối tượng của thẻ span để hiển thị thông báo lỗi
      
      if (!isValid) {
          errorSpan.textContent = "Please only entered numbers!";
          input.value = value.replace(/[^0-9]/g, ''); // Loại bỏ bất kỳ ký tự nào không phải số khỏi giá trị nhập vào
      } else {
          errorSpan.textContent = ""; // Xóa thông báo lỗi nếu giá trị nhập vào hợp lệ
      }
  }
</script>
<script>
  function validateQuantityInput(input) {
      var value = input.value.trim(); // Loại bỏ các khoảng trắng ở đầu và cuối chuỗi
      var isValid = /^[0-9]*$/.test(value); // Sử dụng biểu thức chính quy để kiểm tra xem giá trị chỉ chứa số hay không
      var errorSpan = document.getElementById('quantityError'); // Lấy đối tượng của thẻ span để hiển thị thông báo lỗi
      if (!isValid) {
          errorSpan.textContent = "Please only entered numbers!";
          input.value = value.replace(/[^0-9]/g, ''); // Loại bỏ bất kỳ ký tự nào không phải số khỏi giá trị nhập vào
      } else {
          errorSpan.textContent = ""; // Xóa thông báo lỗi nếu giá trị nhập vào hợp lệ
      }
  }
</script>
</body>
</html>