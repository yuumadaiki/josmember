<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>English Course</title>
	<link rel="stylesheet" href="<?=base_url('asset/member/')?>css/css.css">
	<link rel="stylesheet" href="<?=base_url('asset/member/')?>css/font-awesome.css">
	<link rel="stylesheet" href="<?=base_url('asset/member/')?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url('asset/member/')?>css/bootstrap.css">
	<link rel="stylesheet" href="<?=base_url('asset/member/')?>css/bootstrap.min.css">

	<script src="<?=base_url('asset/member/')?>js\bootstrap.js"></script>
	<script src="<?=base_url('asset/member/')?>js\bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="navbar">
		<ul>
			<center>
			<div id="wrapper">
				<li class="image"><img src="img/fix.png" alt=" logo"></li>
				<!-- <div class="akun"> -->
					<li class="akun"><?=strtoupper($nama)?>
					<div style="float: right" class="akun_drop">
						<div class="icon">
							<div class="fa fa-user"></div>
							<div class="nama">
								<?=ucfirst($nama)?>
							</div>
							<div class="space_button">
								<div class="button_in_drop">
									<a href="">Edit Profil</a>
								</div>
								<div class="logout button_in_drop">
									<a href="<?=base_url('member/dashboard/logout')?>">Logout</a>
								</div>
							</div>
						</div>
					</div></li>
					<div class="level">
						<li class="button"><button class="class" type="">SMA</button>
						<li class="button"><button class="class" type="">SMP</button>
					</div>
					<li class="button"><a class="btn upgrade" type="" href="<?=base_url('member/dashboard/upgrade')?>">UPGRADE</a>
				<!-- </div> -->
			</div>
		</center>
		</ul>
	</div>
	<div id="space">
		
	</div>
