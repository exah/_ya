<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Arrivals / Departures</title>

	<link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
	<div class="targets" id="board-arrival"></div>
	<div class="targets" id="board-departure"></div>
	<nav class="tabs">
		<ul>
			<li class="tabs-item"><a href="#board-all">Все</a></li>
			<li class="tabs-item"><a href="#board-arrival">Прилёт</a></li>
			<li class="tabs-item"><a href="#board-departure">Вылет</a></li>
		</ul>
	</nav>
	<div class="board_overflow">
		
		<table class="board">
			<thead class="board-head" id="stick">
				<tr>
					<th class="board-head-item icon"></th>
					<th class="board-head-item status">Статус</th>
					<th class="board-head-item schedule">
						<span class="schedule-date">Плановое</span> 
						<span class="schedule-time">время</span>
					</th>
					<th class="board-head-item terminal">Терм.</th>
					<th class="board-head-item aeroport">Аэропорт</th>
					<th class="board-head-item avia">
						<span class="avia-name">Авиакомпания </span>
						<span class="avia-code">Рейс </span>
					</th>
					<th class="board-head-item plane">Самолет</th>
					<th class="board-head-item info">Примечания</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$database = array(
						array(
							'icon' 	=> 'ok',
							'status' => 'В&nbsp;полёте',
							'time'	=> '00:00',
							'date'	=>	'16.08.2015',
							'term'	=> 'D',
							'city'	=>	'Верона',
							'aeroport'=>'Виллафранка',
							'company'=> 'S7',
							'code'	=>	'S7698',
							'logo'	=> 's7.png',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Без задержек',
							'type'	=>	'arrival'
						),
						array(
							'icon' 	=> 'ok',
							'status' => 'В&nbsp;полёте',
							'time'	=> '00:05',
							'date'	=>	'16.08.2015',
							'term'	=> 'D',
							'city'	=>	'Лондон',
							'aeroport'=>'Хитроу',
							'company'=> 'Virgin Atlantic',
							'code'	=>	'VS7104',
							'logo'	=> 'va.jpg',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Прилетел в 00:14. Закончена выд. багажа на А11',
							'type'	=>	'arrival'
						),
						array(
							'icon' 	=> 'ok',
							'status' => 'Вылетел',
							'time'	=> '00:10',
							'date'	=>	'16.08.2015',
							'term'	=> 'A',
							'city'	=>	'Екатеринбург ',
							'aeroport'=>'Кольцово',
							'company'=> 'Победа',
							'code'	=>	'ДР272',
							'logo'	=> 'victory.jpg',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Вылетел в 00:13.',
							'type'	=>	'departure'
						),
						array(
							'icon' 	=> 'warning',
							'status' => 'Вылетел',
							'time'	=> '01:40',
							'date'	=>	'16.08.2015',
							'term'	=> 'A',
							'city'	=>	'Хургада ',
							'aeroport'=>'',
							'company'=> 'Utair',
							'code'	=>	'UT9018',
							'logo'	=> 'ut.jpg',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Задержался, прилетел в 03:52. Закончена выд. багажа на В01',
							'type'	=>	'arrival'
						),
						array(
							'icon' 	=> 'danger',
							'status' => 'Отменён',
							'time'	=> '02:00',
							'date'	=>	'16.08.2015',
							'term'	=> 'B',
							'city'	=>	'Стамбул  ',
							'aeroport'=>'Ататюрк',
							'company'=> 'Turkish Airlines',
							'code'	=>	'TK419',
							'logo'	=> 'ta.jpeg',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Рейс отменён',
							'type'	=>	'departure'
						),
						array(
							'icon' 	=> 'ok',
							'status' => 'Приземлился',
							'time'	=> '05:00',
							'date'	=>	'16.08.2015',
							'term'	=> 'B',
							'city'	=>	'Тель-Авив',
							'aeroport'=>'Бен Гурион интерн.',
							'company'=> 'Transaero',
							'code'	=>	'UN312',
							'logo'	=> 'transaero.png',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Совершил посадку в 06:00',
							'type'	=>	'arrival'
						),
						array(
							'icon' 	=> 'ok',
							'status' => 'Вылетел',
							'time'	=> '05:40',
							'date'	=>	'16.08.2015',
							'term'	=> 'B',
							'city'	=>	'Барселона',
							'aeroport'=>'',
							'company'=> 'Transaero',
							'code'	=>	'UN340',
							'logo'	=> 'transaero.png',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Нет информации',
							'type'	=>	'departure'
						),
						array(
							'icon' 	=> 'ok',
							'status' => 'Вылетел',
							'time'	=> '10:05',
							'date'	=>	'16.08.2015',
							'term'	=> 'B',
							'city'	=>	'Будапешт ',
							'aeroport'=>'Ферихедь',
							'company'=> 'Transaero',
							'logo'	=> 'transaero.png',
							'code'	=>	'W62490',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Совершил посадку 12:46',
							'type'	=>	'departure'
						),
						array(
							'icon' 	=> 'warning',
							'status' => 'Вылетел',
							'time'	=> '15:45',
							'date'	=>	'16.08.2015',
							'term'	=> 'A',
							'city'	=>	'Хургада ',
							'aeroport'=>'',
							'company'=> 'iFly',
							'logo'	=> 'ifly.jpg',
							'code'	=>	'I49215',
							'plane'	=> array('Boeing 737-700', 'B737'),
							'info'	=> 'Вылетел в 15:48',
							'type'	=>	'departure'
						),
					);
					
					shuffle($database);
					foreach($database as $f): ?><tr class="board-row board-row--<?= $f['type'] ?> board-row--<?= $f['icon'] ?>">
					<td class="board-col icon">
						<svg viewBox="0 0 28 28" class="icons" width="28" height="28">
							<use xlink:href="assets/images/icons.svg#<?= $f['type'] ?>"></use>
						</svg>
					</td>
					<td class="board-col status"><?= $f['status'] ?></td>
					<td class="board-col schedule">
						<time>
							<p class="schedule-time"><?= $f['time'] ?></p>
							<p class="schedule-date"><?= $f['date'] ?></p>
						</time>
					</td>
					<td class="board-col terminal"><?= $f['term'] ?></td>
					<td class="board-col aeroport">
						<p class="aeroport-city"><?= $f['city'] ?></p> 
						<p class="aeroport-name"><?= $f['aeroport'] ?></p>
					</td>
					<td class="board-col avia">
						<img class="avia-logo" src="avia-images/<?= $f['logo'] ?>" />
						<span class="avia-name"><?= $f['company'] ?> </span>
						<span class="avia-code"><?= $f['code'] ?></span>
					</td>
					<td class="board-col plane">
						<span class="plane-name plane-name--full"><?= $f['plane'][0] ?> </span>
						<span class="plane-name plane-name--short"><?= $f['plane'][1] ?> </span>
					</td>
					<td class="board-col info">
						<p><?= $f['info'] ?></p>
						<p><a href="#<?= $f['code'] ?>"> Подробнее </a></p>
					</td>
				</tr><?php endforeach; ?>
			</tbody>
		</table>
	</div>
	

	<?php foreach($database as $i => $f): ?><div class="modal <?= ($i == 1) ? 'active' : '' ?>" id="<?= $f['code'] ?>" >
		<a class="modal-overlay" href="#"></a>
		<div class="modal-content">
			<h3 class="modal-heading"> Информация о рейсе </h3>
			<div class="modal-table board_overflow">
				<table class="board">
					<thead class="board-head" id="stick">
						<tr>
							<th class="board-head-item icon"></th>
							<th class="board-head-item status">Статус</th>
							<th class="board-head-item schedule">
								<span class="schedule-date">Плановое</span> 
								<span class="schedule-time">время</span>
							</th>
							<th class="board-head-item terminal">Терм.</th>
							<th class="board-head-item aeroport">Аэропорт</th>
							<th class="board-head-item avia">
								<span class="avia-name">Авиакомпания </span>
								<span class="avia-code">Рейс </span>
							</th>
							<th class="board-head-item plane">Самолет</th>
						</tr>
					</thead>
					<tbody>
						<tr class="board-row board-row--<?= $f['type'] ?> board-row--<?= $f['icon'] ?>">
							<td class="board-col icon">
								<svg viewBox="0 0 28 28" class="icons" width="28" height="28">
									<use xlink:href="assets/images/icons.svg#<?= $f['type'] ?>"></use>
								</svg>
							</td>
							<td class="board-col status"><?= $f['status'] ?></td>
							<td class="board-col schedule">
								<time>
									<p class="schedule-time"><?= $f['time'] ?></p>
									<p class="schedule-date"><?= $f['date'] ?></p>
								</time>
							</td>
							<td class="board-col terminal"><?= $f['term'] ?></td>
							<td class="board-col aeroport">
								<p class="aeroport-city"><?= $f['city'] ?></p> 
								<p class="aeroport-name"><?= $f['aeroport'] ?></p>
							</td>
							<td class="board-col avia">
								<img class="avia-logo" src="avia-images/<?= $f['logo'] ?>" />
								<span class="avia-name"><?= $f['company'] ?> </span>
								<span class="avia-code"><?= $f['code'] ?></span>
							</td>
							<td class="board-col plane">
								<span class="plane-name plane-name--full"><?= $f['plane'][0] ?> </span>
								<span class="plane-name plane-name--short"><?= $f['plane'][1] ?> </span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr />
			<article class="modal-article">
				<p><?= $f['info'] ?></p>
			</article>
		</div>
	</div><?php endforeach; ?>
</body>
</html>