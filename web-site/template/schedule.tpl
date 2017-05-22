<!-- Main -->
				<section id="main" class="container">
<div class="row">
						<div class="12u">

							<!-- Form -->
								<section class="box">
									<form method="post" action="#">
										<div class="row uniform 50%">
											<div class="12u 12u(mobilep)">
												<input type="text" name="query" id="airports-list" value="" placeholder="Выбор аэропорта" />
											</div>
										</div>
<div class="row uniform 50%">
											<div class="12u 12u(mobilep)">
												<h1 style="margin-left: 5px"><a>Сегодня</a> / <a>Завтра</a> / <a>Выбрать дату</a></h1>
											</div>
</div>
										<div class="row uniform 50%">
											<div class="9u 12u(mobilep)">
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
								</section>

						</div>
					</div>
					<div class="row">
						<div class="12u">

							<!-- Table -->
								<section class="box">
									<h3>Аэропорт Шереметьево</h3>

									<h4 id="type_flights">Вылеты <?=date("d-m-Y")?></h4>
									<hr>
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
											<tbody id="data-schedule">
											<?php
												$Schedule = new Schedule (date("Y-m-d"), "SVO", "departure");
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
								</section>

						</div>
					</div>
					
				</section>