	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper" class="fade-in">

				<!-- Intro -->
					<div id="intro">
						<h1>This is<br />
						AirSchedule</h1>
						<p>The best way to fly...</p>
						<ul class="actions">
							<li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
						</ul>
					</div>

				<!-- Header -->
					<header id="header">
						<a href="index.html" class="logo">AirSchedule</a>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul class="links">
							<li class="active"><a href="index.html">Расписание</a></li>
							<li><a href="generic.html">Маршруты</a></li>
							<li><a href="elements.html">Блог</a></li>
						</ul>
						<ul class="icons">
							<li><a href="//vk.com/airschedule" class="icon fa-vk"><span class="label">ВКонтакте</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Featured Post -->
							<article class="post featured">
								<form method="post" action="#" class="alt">
										<div class="row uniform">
											<div class="12u 12u$(xsmall)">
												<input type="text" name="query" id="demo-name" value="" placeholder="Выбор аэропорта" />
											</div>
											<div class="12u 12u(mobilep)">
												<h5 style="margin-left: 5px"><a>Сегодня</a> / <a>Завтра</a> / <a>Выбрать дату</a></h2>
											</div>
											<div class="9u 12u(mobilep)" align="left">
												<ul class="actions">
													<li><input id="departure" type="button" value="Вылет" class="alt"/></li>
													<li><input id="arrival" type="button" value="Прилет" class="alt"/></li>
												</ul>
											</div>
											
											<div class="3u 12u(mobilep)">
												<input type="submit" value="Поиск" class="fit" />
											</div>
										</div>
								</form>
								<header class="major">							
									<h3>Аэропорт Шереметьево</h3>

									<span class="date" id="type_flights">Вылеты <?=date("d-m-Y")?></span>
								</header>
								<div class="table-wrapper">
										<table>
											<thead>
												<tr>
													<th>Авиакомпания</th>
													<th>Номер рейса</th>
													<th>Пункт назначения</th>
													<th>Терминал</th>
													<th>Время</th>
													<th>Статус</th>
												</tr>
											</thead>
											<tbody id="data-schedule" style="font-family: Helvetica">
											<?php
												$Schedule = new Schedule (date("Y-m-d"), "DME", "departure");
												$response = $Schedule->getSchedule();
												foreach ($response as $row) : ?>
												<tr>
													<td><img width="64" src="../images/airlines/SU-iata.png"></td>
													<td><?=$row["number"]?></td>
													<td><?=$row["title"]?></td>
													<td><?=$row["terminal"]?></td>
													<td><?=date("H:i",strtotime( $row["departure"] ))?></td>
													<td>Вылетел</td>
												</tr>
											<?php endforeach;?>
											</tbody>
										</table>
										<center><?php
										$CopyrightYandex = new CopyrightYandex ();
										$copy = $CopyrightYandex->getCopyrightItem(CopyrightYandex::LogoHm);
										echo $copy;
												?></center>
								</div>	
							</article>

						<!-- Footer -->
							<footer>
								<div class="pagination">
									<!--<a href="#" class="previous">Prev</a>-->
									<a href="#" class="page active">1</a>
									<a href="#" class="page">2</a>
									<a href="#" class="page">3</a>
									<span class="extra">&hellip;</span>
									<a href="#" class="page">8</a>
									<a href="#" class="page">9</a>
									<a href="#" class="page">10</a>
									<a href="#" class="next">Next</a>
								</div>
							</footer>

					</div>