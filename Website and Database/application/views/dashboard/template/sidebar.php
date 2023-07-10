	<body data-background-color="bg1">
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="<?= base_url()?>user/" class="logo" align="center">
					<img src="<?= base_url()?>public/assets/img/dashboard-logo.png" style="width:79%;margin-left: -72px" alt="navbar brand" class="navbar-brand">
                    <!-- <h3 class="navbar-brand card-title mt-3" style="font-size: 18px;"><span class="text-white"> 
					THINKWOLI </span> -->
					<!-- </h3> -->
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div> 
			</div> 
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<h3 class="navbar-brand card-title text-uppercase" style="font-size: 18px;"><span class="text-white"> 
							Procurely </span>
						</h3>
						<!-- <form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form> -->
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<!-- <li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li> -->
						<li class="nav-item dropdown hidden-caret">
							<?php
							$notif = $this->customlib->notif(5);
					
							?>
							<a class="nav-link dropdown-toggle notifDropdown" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification"><?= count($notif) ?></span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">Notifications</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<?php
											foreach($notif as $row){
											?>
											<a href="#">
												<!-- <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div> -->
												<div class="notif-content pl-3">
													<span class="block">
														<?= $row->notif?>
													</span>
													<span class="time"><?= date("F j, Y H:i A",strtotime($row->created_at)) ?></span> 
												</div>
											</a>
											<?php
											}
											?>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="<?= base_url() ?>notif">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li hidden class="nav-item">
							<a href="#" class="nav-link quick-sidebar-toggler">
								<i class="fa fa-th"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<?php
									$profile_picture = "default_pic.png";
									if($_SESSION['picture']){
										$profile_picture = $_SESSION['picture'];
									}
									?>
									<img src="<?= base_url()?>public/uploads/dp/<?= $profile_picture ?>" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="scroll-wrapper dropdown-user-scroll scrollbar-outer" style="position: relative;"><div class="dropdown-user-scroll scrollbar-outer scroll-content" style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 0px;">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?= base_url()?>public/uploads/dp/<?= $profile_picture ?>" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?= ucwords($_SESSION['last_name']) ?>, <?= ucwords($_SESSION['first_name']) ?>  </h4>
												<p class="text-muted"><?= ucwords(str_replace("_"," ",$_SESSION['role']))?></p>

												<!-- <a href="<?= base_url()?>user/profile/" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
											</div>
										</div>
									</li>
									<li>
										<!-- <div class="dropdown-divider"></div> -->
										<!-- <a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">My Balance</a>
										<a class="dropdown-item" href="#">Inbox</a> -->
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url()?>user/profile/">Account Setting</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url()?>login/logout/">Logout</a>
									</li>
								</div><div class="scroll-element scroll-x" style=""><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div><div class="scroll-element scroll-y" style=""><div class="scroll-element_outer"><div class="scroll-element_size"></div><div class="scroll-element_track"></div><div class="scroll-bar ui-draggable ui-draggable-handle"></div></div></div></div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>


		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" data-background-color="white">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?= base_url()?>public/uploads/dp/<?= $profile_picture ?>" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
										<span>
										<?= ucwords($_SESSION['last_name']) ?>, <?= ucwords($_SESSION['first_name']) ?>

										<span class="user-level"><?= ucwords(str_replace("_"," ",$_SESSION['role']))?></span>

										<?php if($_SESSION['id_user_role'] == 8){ // SECTOR HEAD ?>
											<span class="user-level">(<?= ucwords($_SESSION['sector_name']) ?>)</span>
										<?php } ?>

										<?php if($_SESSION['id_user_role'] == 11){ // COLLEGE ?>
											<span class="user-level">(<?= ucwords($_SESSION['college_name']) ?>)</span>
										<?php } ?>
										
										<?php
										// if($_SESSION['type'] == 0){
										// 		echo '<span class="user-level">Administrator</span>';
										// }
										?>
									
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
			
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>

						<li class="nav-item <?= $this->customlib->sidebar_active('dashboard',$sidebar_active) ?>">
							<a href="<?= base_url()?>user">
								<i class="fas fa-chalkboard"></i>
								<p>My Dashboard</p>
							</a>
						</li>

						<?php if($_SESSION['id_user_role'] == 3){ // DEPARTMENT HEAD ?>
							<!-- DEPARTMENT BUDGET -->
								<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_college_budget',$sidebar_active) ?>">
									<a href="<?= base_url()?>college_budget">
										<i class="fas fa-coins"></i>
										<p>Department Budget</p>
									</a>
								</li> -->

							<!-- BUDGET PROPOSAL -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_budget_proposal',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_budget_proposal" class="collapsed" aria-expanded="false">
									<i class="fas fa-chalkboard-teacher"></i>
									<p>Budget Proposal</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_budget_proposal',$sidebar_active) ?>" id="side_budget_proposal" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('0',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/0">
												<span class="sub-item"> Pending Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('1',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/1">
												<span class="sub-item"> Approved Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('2',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/2">
												<span class="sub-item"> Rejected Proposals</span>
											</a>
										</li>
									</ul>
								</div>
							</li> -->
							<!-- PPMP -->
							<li class="nav-item <?= $this->customlib->sidebar_active('side_ppmp',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_ppmp" class="collapsed" aria-expanded="false">
									<i class="fas fa-hand-holding-heart"></i>
									<p>PPMP</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_ppmp',$sidebar_active) ?>" id="side_ppmp" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('create_pr',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>ppmp/create_ppmp">
												<span class="sub-item"> Create PPMP</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('create_pr',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>ppmp/index/14/0">
												<span class="sub-item"> CSE Items</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('create_pr',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>ppmp/index/15/0">
												<span class="sub-item"> NON-CSE</span>
											</a>
										</li>
										<!-- <li>
											<a data-toggle="collapse" href="#side_2nd_PPMP">
												<span class="sub-item">PPMP</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PPMP">
												<ul class="nav nav-collapse subnav">
													<li>
														<a href="<?= base_url()?>ppmp/index/0">
															<span class="sub-item">Pending PPMP</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>ppmp/index/1">
															<span class="sub-item">Approved PPMP</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>ppmp/index/2">
															<span class="sub-item">Rejected PPMP</span>
														</a>
													</li>
												</ul>
											</div>
										</li> -->
										<li  class="<?= $this->customlib->sidebar_submenu_active('years',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/years/">
												<span class="sub-item"> Year</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('ppmp_status',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/ppmp_status/">
												<span class="sub-item"> PPMP Status</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('mode_of_procurements',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/mode_of_procurements/">
												<span class="sub-item"> Mode of Procurements</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- PURCHASE REQUEST -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_pr',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_pr" class="collapsed" aria-expanded="false">
									<i class="fas fa-hands-helping"></i>
									<p>Purchase Request</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_pr',$sidebar_active) ?>" id="side_pr" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('create_pr',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>purchase_requests/create_pr">
												<span class="sub-item"> Create PR</span>
											</a>
										</li>
										<li>
											<a data-toggle="collapse" href="#side_2nd_PR">
												<span class="sub-item">Purchase Requests</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PR">
												<ul class="nav nav-collapse subnav">
													<li>
														<a href="<?= base_url()?>purchase_requests/index/0">
															<span class="sub-item">Pending PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/1">
															<span class="sub-item">Approved PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/2">
															<span class="sub-item">Rejected PR</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li> -->
						<?php } ?>

						<?php if($_SESSION['id_user_role'] == 8){ // SECTOR HEAD ?>
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('college_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>departments/budget">
									<i class="fas fa-coins"></i>
									<p>Department Budget</p>
								</a>
							</li> -->
							<li class="nav-item <?= $this->customlib->sidebar_active('side_college_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>college_budget">
									<i class="fas fa-coins"></i>
									<p>College Budget</p>
								</a>
							</li>
							<!-- PPMP -->
							<li class="nav-item <?= $this->customlib->sidebar_active('side_ppmp',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_ppmp" class="collapsed" aria-expanded="false">
									<i class="fas fa-hand-holding-heart"></i>
									<p>PPMP</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_ppmp',$sidebar_active) ?>" id="side_ppmp" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PPMP">
												<span class="sub-item">PPMP</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PPMP">
												<ul class="nav nav-collapse subnav">
													<?php 
													$side_get_ppmp_categories = $this->customlib->get_ppmp_categories();
												 	foreach($side_get_ppmp_categories as $row){
														?>
														<li>
															<a data-toggle="collapse" href="#side_get_ppmp_categories<?= $row->id?>">
																<span class="sub-item"><?= $row->category ?></span>
																<span class="caret"></span>
															</a>
															<div class="collapse" id="side_get_ppmp_categories<?= $row->id?>">
																<ul class="nav nav-collapse subnav">
																	<li>
																		<a href="<?= base_url()?>ppmp/index/<?= $row->id ?>/0">
																			<span class="sub-item">Pending PPMP</span>
																		</a>
																	</li>
																</ul>
															</div>
														</li>
														<?php
													}
													?>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<!-- PURCHASE REQUEST -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_pr',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_pr" class="collapsed" aria-expanded="false">
									<i class="fas fa-hands-helping"></i>
									<p>Purchase Request</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_pr',$sidebar_active) ?>" id="side_pr" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PR">
												<span class="sub-item">Purchase Requests</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PR">
												<ul class="nav nav-collapse subnav">
													<li>
														<a href="<?= base_url()?>purchase_requests/index/0">
															<span class="sub-item">Pending PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/1">
															<span class="sub-item">Approved PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/2">
															<span class="sub-item">Rejected PR</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li> -->
						<?php } ?>

						<?php if($_SESSION['id_user_role'] == 10 || $_SESSION['id_user_role'] == 11){ // BAC SECRETARIAT & COLLEGE ?>
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('college_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>departments/budget">
									<i class="fas fa-coins"></i>
									<p>Department Budget</p>
								</a>
							</li> -->
							<li class="nav-item <?= $this->customlib->sidebar_active('side_ppmp',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_ppmp" class="collapsed" aria-expanded="false">
									<i class="fas fa-hand-holding-heart"></i>
									<p>PPMP</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_ppmp',$sidebar_active) ?>" id="side_ppmp" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PPMP">
												<span class="sub-item">PPMP</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PPMP">
												<ul class="nav nav-collapse subnav">
													<?php 
													if($_SESSION['id_user_role'] == 11){ // college
														$side_get_ppmp_categories = $this->customlib->get_ppmp_categories();
														foreach($side_get_ppmp_categories as $row){
															?>
															<li>
																<a data-toggle="collapse" href="#side_get_ppmp_categories<?= $row->id?>">
																	<span class="sub-item"><?= $row->category ?></span>
																	<span class="caret"></span>
																</a>
																<div class="collapse" id="side_get_ppmp_categories<?= $row->id?>">
																	<ul class="nav nav-collapse subnav">
																		<li>
																			<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/0">
																				<span class="sub-item">Pending PPMP</span>
																			</a>
																		</li>
																		<?php if( $_SESSION['id_user_role'] != 11){ ?>
																		<!-- <li>
																			<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/1">
																				<span class="sub-item">Approved PPMP</span>
																			</a>
																		</li>
																		<li>
																			<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/2">
																				<span class="sub-item">Rejected PPMP</span>
																			</a>
																		</li> -->
																		<?php } ?>
																	</ul>
																</div>
															</li>
															<?php
														}
													}else if($_SESSION['id_user_role'] == 10){ // bac sec
														$side_get_years = $this->customlib->get_years();
														foreach($side_get_years as $row){
														?>
															<li class="<?= $this->customlib->sidebar_submenu_active('side_get_years'.$row->id,$sidebar_submenu_active) ?>">
																<a href="<?= base_url()?>ppmp/year/<?= $row->id?>">
																	<span class="sub-item"><?= $row->category?></span>
																</a>
															</li>
														<?php
														}
													}
													?>
													
													
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<!-- BUDGET PROPOSAL -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_budget_proposal',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_budget_proposal" class="collapsed" aria-expanded="false">
									<i class="fas fa-chalkboard-teacher"></i>
									<p>Budget Proposal</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_budget_proposal',$sidebar_active) ?>" id="side_budget_proposal" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('0',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/0">
												<span class="sub-item"> Pending Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('1',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/1">
												<span class="sub-item"> Approved Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('2',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/2">
												<span class="sub-item"> Rejected Proposals</span>
											</a>
										</li>
									</ul>
								</div>
							</li> -->
							<!-- PURCHASE REQ -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_pr',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_pr" class="collapsed" aria-expanded="false">
									<i class="fas fa-hands-helping"></i>
									<p>Purchase Request</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_pr',$sidebar_active) ?>" id="side_pr" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PR">
												<span class="sub-item">Purchase Requests</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PR">
												<ul class="nav nav-collapse subnav">
													<li>
														<a href="<?= base_url()?>purchase_requests/index/0">
															<span class="sub-item">Pending PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/1">
															<span class="sub-item">Approved PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/2">
															<span class="sub-item">Rejected PR</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li> -->
						<?php } ?>

						<?php if($_SESSION['id_user_role'] == 9){ // BUDGET OFFICER ?>
							<li class="nav-item <?= $this->customlib->sidebar_active('side_annual_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>annual_budget">
									<i class="fas fa-coins"></i>
									<p>Annual Budget</p>
								</a>
							</li>
							<li class="nav-item <?= $this->customlib->sidebar_active('side_sector_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>sector_budget">
									<i class="fas fa-coins"></i>
									<p>Sector Budget</p>
								</a>
							</li>
							<li class="nav-item <?= $this->customlib->sidebar_active('side_ppmp',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_ppmp" class="collapsed" aria-expanded="false">
									<i class="fas fa-hand-holding-heart"></i>
									<p>PPMP</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_ppmp',$sidebar_active) ?>" id="side_ppmp" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PPMP">
												<span class="sub-item">PPMP</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PPMP">
												<ul class="nav nav-collapse subnav">
													<?php 
													$side_get_ppmp_categories = $this->customlib->get_ppmp_categories();
												 	foreach($side_get_ppmp_categories as $row){
														?>
														<li>
															<a data-toggle="collapse" href="#side_get_ppmp_categories<?= $row->id?>">
																<span class="sub-item"><?= $row->category ?></span>
																<span class="caret"></span>
															</a>
															<div class="collapse" id="side_get_ppmp_categories<?= $row->id?>">
																<ul class="nav nav-collapse subnav">
																	<li>
																		<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/0">
																			<span class="sub-item">Pending PPMP Items</span>
																		</a>
																	</li>
																	<?php if( $_SESSION['id_user_role'] != 11){ ?>
																	<li>
																		<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/1">
																			<span class="sub-item">Approved PPMP Items</span>
																		</a>
																	</li>
																	<li>
																		<a href="<?= base_url()?>ppmp/index/<?= $row->id?>/2">
																			<span class="sub-item">Rejected PPMP Items</span>
																		</a>
																	</li>
																	<?php } ?>
																</ul>
															</div>
														</li>
														<?php
													}
													?>
													
													
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_department_budget',$sidebar_active) ?>">
								<a href="<?= base_url()?>department_budget">
									<i class="fas fa-coins"></i>
									<p>Department Budget</p>
								</a>
							</li> -->
							<!-- BUDGET PROPOSAL -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_budget_proposal',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_budget_proposal" class="collapsed" aria-expanded="false">
									<i class="fas fa-chalkboard-teacher"></i>
									<p>Budget Proposal</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_budget_proposal',$sidebar_active) ?>" id="side_budget_proposal" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('0',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/0">
												<span class="sub-item"> Pending Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('1',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/1">
												<span class="sub-item"> Approved Proposals</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('2',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>budget_proposals/index/2">
												<span class="sub-item"> Rejected Proposals</span>
											</a>
										</li>
									</ul>
								</div>
							</li> -->
							<!-- PURCHASE REQ -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('side_pr',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_pr" class="collapsed" aria-expanded="false">
									<i class="fas fa-hands-helping"></i>
									<p>Purchase Request</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_pr',$sidebar_active) ?>" id="side_pr" style="">
									<ul class="nav nav-collapse">
										<li>
											<a data-toggle="collapse" href="#side_2nd_PR">
												<span class="sub-item">Purchase Requests</span>
												<span class="caret"></span>
											</a>
											<div class="collapse" id="side_2nd_PR">
												<ul class="nav nav-collapse subnav">
													<li>
														<a href="<?= base_url()?>purchase_requests/index/0">
															<span class="sub-item">Pending PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/1">
															<span class="sub-item">Approved PR</span>
														</a>
													</li>
													<li>
														<a href="<?= base_url()?>purchase_requests/index/2">
															<span class="sub-item">Rejected PR</span>
														</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li> -->
						<?php } ?>

						<?php if($_SESSION['id_user_role'] == 1){ // ADMIN ?>
							<!-- ITEMS -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('sb_sys_item',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#sb_sys_item" class="collapsed" aria-expanded="false">
									<i class="fas fa-boxes"></i>
									<p>Items</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('sb_sys_item',$sidebar_active) ?>" id="sb_sys_item" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('items',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>items">
												<span class="sub-item">Items</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('item_categories',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/item_categories/">
												<span class="sub-item"> Item Category</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('item_type',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/item_type/">
												<span class="sub-item"> Item Type</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('units',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/units/">
												<span class="sub-item"> Item Units</span>
											</a>
										</li>
									</ul>
								</div>
							</li> -->

							<li class="nav-item <?= $this->customlib->sidebar_active('sectors',$sidebar_active) ?>">
								<a href="<?= base_url()?>sectors">
									<i class="fas fa-share-alt"></i>
									<p>Sectors Management</p>
								</a>
							</li>
							<!-- College Management -->
							<li class="nav-item <?= $this->customlib->sidebar_active('colleges',$sidebar_active) ?>">
								<a href="<?= base_url()?>colleges">
									<i class="fas fa-hotel"></i>
									<p>College Management</p>
								</a>
							</li>
							<!-- DEPARTMENT -->
							<li class="nav-item <?= $this->customlib->sidebar_active('departments',$sidebar_active) ?>">
								<a href="<?= base_url()?>departments">
									<i class="fas fa-layer-group"></i>
									<p>Departments Management</p>
								</a>
							</li>
							<!-- PROJECT MASTERLIST -->
							<li class="nav-item <?= $this->customlib->sidebar_active('side_projects',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#side_projects" class="collapsed" aria-expanded="false">
									<i class="fas fa-hands-helping"></i>
									<p>Projects Masterlist</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('side_projects',$sidebar_active) ?>" id="side_projects" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('projects',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>projects">
												<span class="sub-item"> Projects</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('items',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>items">
												<span class="sub-item">Project Items</span>
											</a>
										</li>
										<!-- <li  class="<?= $this->customlib->sidebar_submenu_active('item_categories',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/item_categories/">
												<span class="sub-item">Project Item Category</span>
											</a>
										</li> -->
										<li  class="<?= $this->customlib->sidebar_submenu_active('item_type',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/item_type/">
												<span class="sub-item">Project Item Type</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('units',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/units/">
												<span class="sub-item">Project Item Units</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- SYSTEM USERS -->
							<li class="nav-item <?= $this->customlib->sidebar_active('sb_sys_user',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#sb_sys_user" class="collapsed" aria-expanded="false">
									<i class="fas fa-users"></i>
									<p>System Users</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('sb_sys_user',$sidebar_active) ?>" id="sb_sys_user" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('administrator',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/administrator">
												<span class="sub-item">Administrator</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('department_head',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/department_head">
												<span class="sub-item"> Department Head</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('sector_head',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/sector_head">
												<span class="sub-item"> Sector Head</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('budget_officer',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/budget_officer">
												<span class="sub-item"> Budget Officer</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('bac_secretariat',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/bac_secretariat">
												<span class="sub-item">BAC Secretariat</span>
											</a>
										</li>
										<li  class="<?= $this->customlib->sidebar_submenu_active('college',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>user/user_mngt/college">
												<span class="sub-item">College</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
							<!-- USER TYPE -->
							<!-- <li class="nav-item <?= $this->customlib->sidebar_active('sb_user_types',$sidebar_active) ?>">
								<a href="<?= base_url()?>user/user_types">
									<i class="fas fa-user"></i>
									<p>User Type</p>
								</a>
							</li> -->
							<li class="nav-item <?= $this->customlib->sidebar_active('general_settings',$sidebar_active) ?>">
								<a data-toggle="collapse" href="#sb_general_settings" class="collapsed" aria-expanded="false">
									<i class="fas fa-cogs"></i>
									<p>General Settings</p>
									<span class="caret"></span>
								</a>
								<div class="collapse <?= $this->customlib->sidebar_show('general_settings',$sidebar_active) ?>" id="sb_general_settings" style="">
									<ul class="nav nav-collapse">
										<li  class="<?= $this->customlib->sidebar_submenu_active('funds_type',$sidebar_submenu_active) ?>">
											<a href="<?= base_url()?>categories/index/funds_type/">
												<span class="sub-item"> Funds Type</span>
											</a>
										</li>
									</ul>
								</div>
							</li>

						<?php } ?>


						<li class="nav-item <?= $this->customlib->sidebar_active('logout',$sidebar_active) ?>">
							<a href="<?= base_url()?>login/logout">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
							</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->