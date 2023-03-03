<?php
/*
Template Name: Gis
*/
?> <?php get_header(); ?> <script type="module" src="https://unpkg.com/x-frame-bypass"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq9oFuUgh1LFguSvX7psEgk_XX8C2KIbo"></script>
<script type="text/javascript" src="
	<?php echo get_stylesheet_directory_uri(); ?>/ol-ext.js">
</script>
<link href="https://cdn.jsdelivr.net/npm/ol-contextmenu@latest/dist/ol-contextmenu.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/ol-contextmenu"></script>
<link href="https://cdn.jsdelivr.net/npm/ol-geocoder@latest/dist/ol-geocoder.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/ol-geocoder"></script>
<style>
    .hideOpacity .layerswitcher-opacity {
      display:none;
    }
    .hideOpacity .ol-layerswitcher .layerup {
      height: 1.5em;
    }
</style>
<div id="content">
	<section id="sidebar" class="active-cc">
		<div class="nav nav-sidebar container" id="tab1C" data-nav-type="accordion">
			<div class="top-sidebar-b">
				<span><i class="fa fa-bars" aria-hidden="true"></i> Menu</span>
				<div class="closing-x"><i class="fa fa-times" aria-hidden="true"></i></div>
			</div>


			<div class="show-panel" style="display: none;">
				<div class="arrow active">
					<i class="fa fa-plus-square-o" aria-hidden="true"></i> Tìm kiếm
				</div>
				<div class="content" style="display: block;">
					<div class="options">

						<h3>Thiết lập:</h3>
						<ul>
							<li><span>maxInputs:</span> <input type="number" onchange="search.set('maxItems', Number(this.value));" style="width:3em;" value="10" />
							</li>
							<li><span>Lớp tìm kiếm:</span> <select id="lopTimKiem" onchange="search.set('property',this.value); search.search();">
									<option value="phong">Phòng</option>
									<option value="Title">Tên phòng</option>
								</select>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="show-panel">
				<div class="arrow active">
					<i class="fa fa-plus-square-o" aria-hidden="true"></i> Ghi chú
				</div>
				<div class="content" style="display: block;">
					<div class="theme-item">Các ghi chú</div>
				</div>
			</div>
			<div class="show-panel">
				<div class="arrow active">
					<i class="fa fa-plus-square-o" aria-hidden="true"></i> About us
				</div>
				<div class="content" style="display: block;">
					<div class="theme-item">Đội ngũ phát triển</div>
					<div class="theme-item">gisteam@dut.udn.vn</div>
				</div>
			</div>
			<div class="show-panel" style="display: none;">
				<div class="arrow">
					<i class="fa fa-plus-square-o" aria-hidden="true"></i> Tìm đường
				</div>
				<div class="content bt-search-d">
					<input type="text" id="txtPoint1" />
					<br />
					<input type="text" id="txtPoint2" />
					<br />
					<button id="btnSolve">Tìm đường</button>
					<button id="btnReset">Xóa đường</button>
				</div>
			</div>
			<div class="show-panel" style="display: none;">
				<div class="arrow">
					<i class="fa fa-plus-square-o" aria-hidden="true"></i> Geolocation
				</div>
				<div class="content chckbt">
					<div id="info" style="display: none;"></div>
					<label for="track">
            <span>track position</span> <input id="track" type="checkbox" />
					</label>
          <label for="following">
            <span>following position</span> <input id="following" type="checkbox" />
					</label>
					<div class="bt-accuracy">
						<p><span>position accuracy :</span> <code id="accuracy"></code></p>
						<br>
						<p><span>altitude :</span> <code id="altitude"></code></p>
						<br>
						<p><span>altitude accuracy :</span> <code id="altitudeAccuracy"></code></p>
						<br>
						<p><span>heading :</span> <code id="heading"></code></p>
						<br>
					  <p><span>speed :</span> <code id="speed"></code></p>

					</div>

					<div class="options" >
						<ul><li>
							Filter:
							<select id="filter" onchange="setFilter()">
								<option value="crop">Crop</option>
								<option value="mask">Mask</option>
							</select>
						</li><li>
							<input id="inner" type="checkbox" onchange="setFilter()" /><label for="inner">inner</label>
						</li><li>
							Color of the mask:
							<select id="color" onchange="setFilter()">
								<option value="rgba(255,255,255,0.8)">White</option>
								<option value="rgba(255,0,0,1)">Red</option>
								<option value="rgba(0,255,0,0.2)">Green</option>
								<option value="rgba(0,0,255,0.2)">Blue</option>
								<option value="rgba(255,255,0,0.2)">Yellow</option>
							</select> (mask only)
						</li></ul>
					</div>

				</div>


			</div>
		</div>
		<!--
    <div class="container" id="tab2C"><form class="truyvan" action="#"><label for="loaict">Khu chức năng:</label><input type="text" id="loaict" name="loaict" value=""><label for="diachi">Toà nhà:</label><input type="text" id="diachi" name="diachi" value=""><label for="donvi">Phòng chức năng:</label><input type="text" id="donvi" name="donvi" value=""><input type="submit" value="Truy Vấn"></form></div>
    -->

	</section>
	<section id="main-content" class="active-cl">
		<div id="mySearch" style="z-index:999;position: relative;"></div>
		<div id="map" class="map hideOpacity">
			<div class="result-wrapper">
				<div class="x-bt-header">
					<span class="x-bt-header-text">Đo đạc</span>
					<div class="x-tool-close">
						<i class="fa fa-times" aria-hidden="true"></i>
					</div>
				</div>
				<samp id="js-result">Chọn trên bản đồ để bắt đầu đo.</samp>
			</div>
		</div>
		<script src="
								<?php echo get_stylesheet_directory_uri(); ?>/main.js">
		</script>
		<div class="aloha">
			<i aria-hidden="true"></i>
			<div id="myPopup" class="map-boxp">
				<div class="left">
					<h2> Hồ chứa nước Phú Ninh </h2>
					<span>Thuộc địa phận huyện núi thành và huyện phú ninh</span>
					<div class="contentcc">
						<div class="item">
							<h4>Mực nước hiện tại (m)</h4>
							<span> <?php the_field('muc_nuoc', 44); ?> </span>
						</div>
						<div class="item">
							<h4>Dung tích hiện tại (triệu m <sup>3</sup>) </h4>
							<span> <?php the_field('dung_tich', 44); ?> </span>
						</div>
						<form id="enquiry_email_form" action="#" method="POST" data-url="
												<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Mực nước hiện tại (m)</label>
								<input type="text" class="form-control" name="muc_nuoc" id="muc_nuoc" placeholder="
														<?php the_field('muc_nuoc', 44); ?>" />
							</div>
							<div class="form-group">
								<label for="">Dung tích hiện tại (triệu m <sup>3</sup>) </label>
								<input type="text" class="form-control" name="dung_tich" id="dung_tich" placeholder="
															<?php the_field('dung_tich', 44); ?>" />
							</div>
							<div class="form-group1">
								<button type="submit" class="btn btn-primary pj"> Cập nhật</button>
							</div>
						</form>
						<a id="trigger" href="#!">Thông tin chi tiết</a>
					</div>
				</div>
				<div class="right" style="background-image: url('/wp-content/uploads/Picture/Reservoir/Ho_PhuNinh.jpg');">
					<div class="closepi">✖</div>
				</div>
			</div>
			<div id="myPopup2" class="map-boxp">
				<div class="left">
					<h2>Đập bầu nít</h2>
					<span>Thuộc địa phận xã Điện hòa – Thị Xã Điện Bàn, là công trình thủy lợi thuộc hệ thống An Trạch.</span>
					<div class="contentcc">
						<div class="item">
							<h4>Mực nước hiện tại (m)</h4>
							<span> <?php the_field('muc_nuoc', 77); ?> </span>
						</div>
						<form id="enquiry_email_form" action="#" method="POST" data-url="
														<?php echo admin_url('admin-ajax.php'); ?>" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Mực nước hiện tại (m)</label>
								<input type="text" class="form-control" name="muc_nuoc" id="muc_nuoc" placeholder="
																<?php the_field('muc_nuoc', 77); ?>" />
							</div>
							<div class="form-group1">
								<button type="submit" class="btn btn-primary pj"> Cập nhật</button>
							</div>
						</form>
						<a id="trigger1" href="#!">Thông tin chi tiết</a>
					</div>
				</div>
				<div class="right" style="background-image: url('/wp-content/uploads/Picture/Weir/Dapdang_AnTrach.jpg');">
					<div id="closepi" class="closepi" onclick="closePopup();">✖</div>
				</div>
			</div>
		</div>
		<div id="copyright" class="copyright" style="
	    position: absolute;
	    left: 0;
	    bottom: 0;
	    font-size: 12px;
	    background: rgba(255,255,255,.8);
	    padding: 10px 20px;
			">Powered by <a href="mailto:gisteam@dut.udn.vn" target="_blank">DUT Gisteam</a>
		</div>
		<div id="overlay">
			<div id="popup">
				<h3 class="btitle">Hồ Phú Ninh</h3>
				<div id="close">✖</div>
				<div class="tab">
					<button class="tablinks active" onclick="openCity(event, 'ttchung')">Thông tin chung</button>
					<button class="tablinks" onclick="openCity(event, 'tskythuat')">Thông số kỹ thuật</button>
					<button class="tablinks" onclick="openCity(event, 'hsCongTrinh')">Hồ sơ công trình</button>
					<button class="tablinks" onclick="openCity(event, 'antoanct')">An toàn công trình</button>
					<button class="tablinks" onclick="openCity(event, 'quanTracCongTrinh')">Quan trắc công trình</button>
					<button class="tablinks" onclick="openCity(event, 'vanhanh')">Quy trình vận hành </button>
					<button class="tablinks" onclick="openCity(event, 'haduhochua')">Ngập lụt hạ du hồ chứa</button>
					<button class="tablinks" onclick="openCity(event, 'baotri')">Bảo trì, sửa chữa</button>
					<button class="tablinks" onclick="openCity(event, 'hinhanh')">Hình ảnh </button>
					<button class="tablinks" onclick="openCity(event, 'camera')">Camera </button>
				</div>
				<!-- Tab content -->
				<div id="ttchung" class="tabcontent"> <?php the_field('thong_tin_chung_text', 44); ?> </div>
				<div id="tskythuat" class="tabcontent"> <?php the_field('thong_so_ki_thuat_text', 44); ?> </div>
				<div id="hsCongTrinh" class="tabcontent"> <?php the_field('ho_so_cong_trinh_text', 44); ?> </div>
				<div id="antoanct" class="tabcontent"> <?php the_field('an_toan_cong_trinh_text', 44); ?> </div>
				<div id="quanTracCongTrinh" class="tabcontent"> <?php the_field('quan_trac_cong_trinh_text', 44); ?> </div>
				<div id="vanhanh" class="tabcontent"> <?php the_field('quy_trinh_van_hanh_text', 44); ?> </div>
				<div id="haduhochua" class="tabcontent"> <?php the_field('ngap_lut_ha_du_ho_chua_text', 44); ?> </div>
				<div id="baotri" class="tabcontent"> <?php the_field('bao_tri_sua_chua_text', 44); ?> </div>
				<div id="hinhanh" class="tabcontent">
					<img src="https://gisteamdut.com/wp-content/uploads/2022/03/Picture1.png" alt="Hồ Phú Ninh" style=" display: block; margin-left: auto; margin-right: auto;">
					<img src="https://gisteamdut.com/wp-content/uploads/2022/02/Picture2.jpg" alt="Hồ Phú Ninh" style=" display: block; margin-left: auto; margin-right: auto;">
					<img src="https://gisteamdut.com/wp-content/uploads/2022/02/Picture1.jpg" alt="Hồ Phú Ninh" style=" display: block; margin-right: auto;">
				</div>
				<div id="camera" class="tabcontent">
					<div class="pi-camera">
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 1</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 2</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 3</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 4</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="overlay1">
			<div id="popup1">
				<h3 class="btitle">Đập Bầu Nít</h3>
				<div id="close1">✖</div>
				<div class="tab">
					<button class="tablinks active" onclick="openCity(event, 'ttchung1')">Thông tin chung</button>
					<button class="tablinks" onclick="openCity(event, 'tskythuat1')">Thông số kỹ thuật</button>
					<button class="tablinks" onclick="openCity(event, 'hsCongTrinh1')">Hồ sơ công trình</button>
					<button class="tablinks" onclick="openCity(event, 'antoanct1')">An toàn công trình</button>
					<button class="tablinks" onclick="openCity(event, 'quanTracCongTrinh1')">Quan trắc công trình</button>
					<button class="tablinks" onclick="openCity(event, 'vanhanh1')">Quy trình vận hành </button>
					<button class="tablinks" onclick="openCity(event, 'baotri1')">Bảo trì, sửa chữa</button>
					<button class="tablinks" onclick="openCity(event, 'hinhanh1')">Hình ảnh </button>
					<button class="tablinks" onclick="openCity(event, 'camera1')">Camera </button>
				</div>
				<!-- Tab content -->
				<div id="ttchung1" class="tabcontent"> <?php the_field('thong_tin_chung_text', 77); ?> </div>
				<div id="tskythuat1" class="tabcontent"> <?php the_field('thong_so_ki_thuat_text', 77); ?> </div>
				<div id="hsCongTrinh1" class="tabcontent"> <?php the_field('ho_so_cong_trinh_text', 77); ?> </div>
				<div id="antoanct1" class="tabcontent"> <?php the_field('an_toan_cong_trinh_text', 77); ?> </div>
				<div id="quanTracCongTrinh1" class="tabcontent"> <?php the_field('quan_trac_cong_trinh_text', 77); ?> </div>
				<div id="vanhanh1" class="tabcontent"> <?php the_field('quy_trinh_van_hanh_text', 77); ?> </div>
				<div id="baotri1" class="tabcontent"> <?php the_field('bao_tri_sua_chua_text', 77); ?> </div>
				<div id="hinhanh1" class="tabcontent">
					<img src="https://gisteamdut.com/wp-content/uploads/2022/03/Picture1.png" alt="Đập Bầu Nít" style=" display: block; margin-left: auto; margin-right: auto;">
				</div>
				<div id="camera1" class="tabcontent">
					<div class="pi-camera">
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 1</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 2</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 3</span>
						</div>
						<div class="item-camera">
							<div class="camera-v"></div>
							<span>Camera 4</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>

			jQuery(document).ready(function($) {
				$(function(){
			    $(".floor-btn").on( "click", "button", function( event ) {
			        event.preventDefault();
			        console.log( $( this ).text() );
			    });
				}());


				$(".floor-select > button").click(function(){
					console.log('button found!');
					$(".floor-btn.active").not(this).toggleClass("active");
					$(this).toggleClass("active");
				});


				$("#btnSolve").click(function() {

				});
				$("#btnReset").click(function() {
					startPoint.setGeometry(null);
					destPoint.setGeometry(null);
					// Remove the result layer.
					map.removeLayer(vectorLayer_Route_Point);
					map.removeLayer(result);
					el('txtPoint1').value = '';
					el('txtPoint2').value = '';
				});


				$('#trigger').click(function() {
					$('#overlay').fadeIn(300);
				});
				$('#close').click(function() {
					$('#overlay').fadeOut(300);
				});
				$('#trigger1').click(function() {
					$('#overlay1').fadeIn(300);
				});
				$('#close1').click(function() {
					$('#overlay1').fadeOut(300);
				});
				$('.closepi').click(function() {
					$('.map-boxp').css("display", "none");
				});
			});

			function openCity(evt, cityName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
			}



			(function($) {
				$(document).ready(function() {
					$('.btn-primary.pj').click(function() {
						var muc_nuoc = $('#muc_nuoc').val();
						var dung_tich = $('#dung_tich').val();
						$.ajax({
							type: "post", //Phương thức truyền post hoặc get
							dataType: "json", //Dạng dữ liệu trả về xml, json, script, or html
							url: '<? php echo admin_url("admin-ajax.php"); ?>',
							data : {
								action: "thongbao", //Tên action
								muc_nuoc: muc_nuoc,
								dung_tich: dung_tich,
							},
							context: this,
							beforeSend: function() {
								//Làm gì đó trước khi gửi dữ liệu vào xử lý
							},
							success: function(response) {
								//Làm gì đó khi dữ liệu đã được xử lý
								if (response.success) {
									alert('Cập nhật thành công');
								} else {
									alert('Đã có lỗi xảy ra');
								}
							},
							error: function(jqXHR, textStatus, errorThrown) {
								//Làm gì đó khi có lỗi xảy ra
								console.log('The following error occured: ' + textStatus, errorThrown);
							}
						})
						return false;
					});
				})
			})(jQuery);




		</script>
	</section>
</div>
<script>


</script> <?php
get_footer();
