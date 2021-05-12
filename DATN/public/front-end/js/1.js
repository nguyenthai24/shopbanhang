$(document).ready(function(){
		//--
		$("#img2").click(function(){
			//lấy giá trị của thuộc tính src id=img2
			var strSrc = $("#img2").attr("src");
			//thay dổi ảnh chính
			$("#place-img").fadeOut(function(){
				$("#place-img").attr("src",strSrc);
				$("#place-img").fadeIn();
			});
			// xác lập đường viền quanh ảnh
			$("#img2").attr("style","border:1px solid red;");
			//reset đường viền của các ảnh khác
			$("#img1").attr("style","border:1px solid white;");
			$("#img3").attr("style","border:1px solid white;");
			$("#img4").attr("style","border:1px solid white;");
		});
		//--
		$("#img1").click(function(){
			//lấy giá trị của thuộc tính src id=img2
			var strSrc = $("#img1").attr("src");
			//thay dổi ảnh chính
			$("#place-img").fadeOut(function(){
				$("#place-img").attr("src",strSrc);
				$("#place-img").fadeIn();
			});
			// xác lập đường viền quanh ảnh
			$("#img1").attr("style","border:1px solid red;");
			//reset đường viền của các ảnh khác
			$("#img2").attr("style","border:1px solid white;");
			$("#img3").attr("style","border:1px solid white;");
			$("#img4").attr("style","border:1px solid white;");
		});
		//--
		$("#img3").click(function(){
			//lấy giá trị của thuộc tính src id=img2
			var strSrc = $("#img3").attr("src");
			//thay dổi ảnh chính
			$("#place-img").fadeOut(function(){
				$("#place-img").attr("src",strSrc);
				$("#place-img").fadeIn();
			});
			// xác lập đường viền quanh ảnh
			$("#img3").attr("style","border:1px solid red;");
			//reset đường viền của các ảnh khác
			$("#img1").attr("style","border:1px solid white;");
			$("#img2").attr("style","border:1px solid white;");
			$("#img4").attr("style","border:1px solid white;");
		});
		//--
		$("#img4").click(function(){
			//lấy giá trị của thuộc tính src id=img2
			var strSrc = $("#img4").attr("src");
			//thay dổi ảnh chính
			$("#place-img").fadeOut(function(){
				$("#place-img").attr("src",strSrc);
				$("#place-img").fadeIn();
			});
			// xác lập đường viền quanh ảnh
			$("#img4").attr("style","border:1px solid red;");
			//reset đường viền của các ảnh khác
			$("#img1").attr("style","border:1px solid white;");
			$("#img2").attr("style","border:1px solid white;");
			$("#img3").attr("style","border:1px solid white;");
		});
		//--
	});