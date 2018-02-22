
	
	<center>
		<div id="wrapper">
			<div class="row">
				<div class="col-md-3">
					<div id="menu">
						<ul>
							<li><a href="" class="active">Home</a></li>
							<li><a onclick="myFunction()" class="btn">SMP</a></li>
							<div id="myDropdown" class="hide">
								<a href="#home">Video</a>
								<a href="#about">Modul</a>
								<a href="#contact">Contact</a>
							</div>
							<li><a href="">SMA</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-9">
					<div id="content">
						<div class="section">
							<?=$title?>
						</div>
						<?php  
							$this->load->view('member/content');
						?>
					</div>
				</div>
			</div>
		</div>
	</center>
	<div id="footer">
		<div class="text">
			<div class="fa fa-copyright" style="color: #5886a6"> Copyright</div>, All right is reserved by Immelman
		</div>
	</div>
</body>
	<script>
		function myFunction() {
    		document.getElementById("myDropdown").classList.add("dropdown");
    		document.getElementById("myDropdown").classList.remove("hide");
		}

		window.onclick = function(event) {
			if (!event.target.matches('.btn')) {

				document.getElementById("myDropdown").classList.add("hide");
				document.getElementById("myDropdown").classList.remove("dropdown");

				// var dropdowns = document.getElementsByClassName("dropdown");
				// var i;
				// for (i = 0; i < dropdowns.length; i++) {
				// 	var openDropdown = dropdowns[i];
				// 	if (openDropdown.classList.contains('show')) {
				// 		openDropdown.classList.remove('show');
				// 	}
				// }
			}
		}
	</script>
</html>