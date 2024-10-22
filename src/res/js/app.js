(function() {
	"use strict";

	function Toast(options) {
		var position;
		this.timeout_id = null;
		this.duration = 3000;
		this.content = '';
		this.position = 'bottom';

		if (!options || typeof options != 'object') {
			return false;
		}

		if (options.duration) {
			this.duration = parseFloat(options.duration);
		}
		if (options.content) {
			this.content = options.content;
		}

		if (options.position) {
			position = options.position.toLowerCase();
			if (position === 'top' || position === 'bottom') {
				this.position = position;
			} else {
				this.position = 'bottom';
			}
		}
		this.show();
	}


	Toast.prototype.show = function() {
		if (!this.content) {
			return false;
		}
		clearTimeout(this.timeout_id);

		var body = document.getElementsByTagName('body')[0];

		var previous_toast = document.getElementById('toast_container');
		if (previous_toast) {
			body.removeChild(previous_toast);
		}

		var classes = 'toast_fadein';
		if (this.position === 'top') {
			classes = 'toast_fadein toast_top';
		}

		var toast_container = document.createElement('div');
		toast_container.setAttribute('id', 'toast_container');
		toast_container.setAttribute('class', classes);
		body.appendChild(toast_container);

		var toast = document.createElement('div');
		toast.setAttribute('id', 'toast');
		toast.innerHTML = this.content;
		toast_container.appendChild(toast);

		this.timeout_id = setTimeout(this.hide, this.duration);
		return true;
	};

	Toast.prototype.hide = function() {
		var toast_container = document.getElementById('toast_container');

		if (!toast_container) {
			return false;
		}

		clearTimeout(this.timeout_id);

		toast_container.className += ' toast_fadeout';

		function remove_toast() {
			var toast_container = document.getElementById('toast_container');
			if (!toast_container) {
				return false;
			}
			toast_container.parentNode.removeChild(toast_container);
		}

		toast_container.addEventListener('webkitAnimationEnd', remove_toast);
		toast_container.addEventListener('animationEnd', remove_toast);
		toast_container.addEventListener('msAnimationEnd', remove_toast);
		toast_container.addEventListener('oAnimationEnd', remove_toast);

		return true;
	};

	window.Toast = Toast;

})();

var fetchBody = function( url ) {
	if (url.indexOf('#') > -1) {
		return;
	}
	fetch( url ).then(function (response) {
		return response.text();
	}).then(function (html) {
		var title = html.replace(/^.*?<title>(.*?)<\/title>.*?$/s,"$1");
		var body = html.replace(/^.*?<body>(.*?)<\/body>.*?$/s,"$1");
		document.title = title;
		document.body.innerHTML = body;
		history.pushState({page:url}, null, url);
		window.scrollTo({ top: 0, behavior: 'smooth' });
		running();
	}).catch(function (err) {
		new Toast({
			content: 'Tizimga ulanishda xatolik'
		});
	});
}

window.addEventListener('popstate', (event) => {
	fetchBody( location.href );
});

function running() {
	var Anchors = document.getElementsByTagName("a");
	for (var i = 0; i < Anchors.length ; i++) {
		let hostname = new URL(Anchors[i].href);
		if (hostname.host == window.location.host && Anchors[i].href.indexOf('#') < 0) {
			Anchors[i].addEventListener("click", function (event) {
				fetchBody(this.href);
				event.preventDefault();
			}, false);
		}
	}
	if (document.getElementById('searchform') != null) {
		document.getElementById('searchform').addEventListener('submit', function(event) {
			let term = document.getElementById('searchterm').value;
			let url = '/search?term=' + encodeURI(term);
			fetchBody( url );
			event.preventDefault();
		});
	}
	hljs.highlightAll();
}

running();