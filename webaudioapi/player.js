// $ != jQuery, $ = синоним querySelector для удобства
var $ = document.querySelector.bind(document);

/**
 *	Dropzone @exah
 */
function DropZone(dropTarget, input, callback) {
 	this.dropTarget = dropTarget;
 	this.input = input;
 	this.callback = callback;
 	
 	this.dropTarget.addEventListener("dragover", this.onHover.bind(this), false);
	this.dropTarget.addEventListener("dragleave", this.onHover.bind(this), false);
	this.dropTarget.addEventListener("drop", this.onDrop.bind(this));
	this.input.addEventListener("change", this.onChange.bind(this), false);
}
	
DropZone.prototype.onHover = function(e) {
	e.stopPropagation();
	e.preventDefault();
	
	(e.type == "dragover") 
			? this.dropTarget.classList.add("hover")
			: this.dropTarget.classList.remove("hover");
}

DropZone.prototype.onDrop = function(e) {
	this.onHover(e);
	
	this.files = e.target.files || e.dataTransfer.files;
	this.callback && this.callback();
}

DropZone.prototype.onChange = function(e) {
	this.files = e.target.files || e.dataTransfer.files;
	this.callback && this.callback();
}

/**
 *	Shim for requestAnimFrame
 */
window.requestAnimFrame = (function(){
	return  window.requestAnimationFrame	|| 
		window.webkitRequestAnimationFrame	|| 
		window.mozRequestAnimationFrame		|| 
		window.oRequestAnimationFrame			|| 
		window.msRequestAnimationFrame		|| 

		function( callback ){
			window.setTimeout(callback, 1000 / 60);
		};
})();
							
/**
 *	Player @exah
 */

function Player(file, callback) {
	this.context = new (window.AudioContext || window.webkitAudioContext)();
	
//	Анализатор аудиозаписи
	this.analyser = this.context.createAnalyser();
	this.analyser.connect(this.context.destination);
	this.analyser.minDecibels = -140;
	this.analyser.maxDecibels = 0;
	this.freqs = new Uint8Array(this.analyser.frequencyBinCount);
	
	this.canvas = $('canvas');
	this.drawContext = this.canvas.getContext('2d');
	
	this.isPlaying = false;
	this.startTime = 0;
	this.startOffset = 0;
	this.metadata = { 'title': 'Unknown', 'artist': '', 'album': ''};
	
	this.width = window.innerWidth;
	this.height = window.innerHeight;
	
	this.file = file;
}

// Загрузка и обработка буфера
Player.prototype.load = function(file, callback) {
	var self = this;
	self.callback = callback;
	
	var request = new XMLHttpRequest();
	request.open("GET", file, true);
	request.responseType = "arraybuffer";
	
	request.onload = function() {
		self.arraybuffer = request.response;
		
		// Получние метаданных из аудиозаписи
		self.dv = new jDataView(player.arraybuffer);
		
		if (self.dv.getString(3, self.dv.byteLength - 128) == 'TAG') {
			self.metadata.title = self.dv.getString(30, self.dv.tell());
			self.metadata.artist = self.dv.getString(30, self.dv.tell());
			self.metadata.album = self.dv.getString(30, self.dv.tell());
		} else {
			self.metadata.title = self.file_input.name;
		}
		
	// Декодирование аудио для вопроизведения
		self.context.decodeAudioData(self.arraybuffer, function(buffer) {
			if (!buffer) {
				alert('Ошибка в декодировании файла, попробуйте снова или другой файл: ' + file);
				return;
			}
			
			self.buffer = buffer;
			self.callback && self.callback();
		}, function(error) {
			console.error('contet.decodeAudioData: error', error);
		});
	}
	request.onerror = function() {
		alert('Player.load: XHR error');
	}
	request.send();
}

// Переключатель плеера
Player.prototype.toggle = function() {
	self = this;

	if (self.isPlaying) {
		// Остановка вопроизведения
		self.source.stop(0);
		// Сохранение текущей позиции
		self.startOffset += self.context.currentTime - self.startTime;
	} else {
		self.startTime = self.context.currentTime;
		self.source = self.context.createBufferSource();
		
		// Подключение анализатора к текущей песни
		self.source.connect(self.analyser);
		self.source.buffer = self.buffer;
		
		// Начало проигрывания
		self.source.start(0, self.startOffset % self.buffer.duration);
		
		// Старт визуализатора
		requestAnimFrame(self.draw.bind(self));
	}

//	Переключаем статус проигрывания 
	self.isPlaying = !self.isPlaying;
}

/*
 * Визуализатор
 */

Player.prototype.draw = function() {
	var self = this;
	
// Получение частот из текущей песни
	self.analyser.getByteFrequencyData(this.freqs);
	
//	Отрисовка визуализатора
	self.canvas.width = self.width;
	self.canvas.height = self.height;
	
	for (var i = 0; i < this.analyser.frequencyBinCount; i++) {
		var barWidth = Math.ceil(self.width / self.analyser.frequencyBinCount);
		var height = self.height * (self.freqs[i] / 256);
		var offset = self.height / 2 - height / 2;
		
		self.drawContext.fillStyle = 'rgba(227, 71, 71, 1)';
		self.drawContext.fillRect(i * barWidth, offset, barWidth, height);
	}

//	Если проигрывается, то продолжать отрисовывать визуализатор
	self.isPlaying && requestAnimFrame(self.draw.bind(self));
}

// Перерисовка визуализатора, используется при ресайзинге окна
Player.prototype.redraw = function() {
	var self = this;
	
	self.width = window.innerWidth;
	self.height = window.innerHeight;
	
	!self.isPlaying && self.draw();
}