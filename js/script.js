function start(url){
	const cartWrapper = document.querySelector('.cart__wrapper'),
		cart = document.querySelector('.cart'),
		close = document.querySelector('.cart__close'),
		open = document.querySelector('#cart'),
		goodsBtn = document.querySelectorAll('.goods__btn'),
		products = document.querySelectorAll('.goods__item'),
		confirm = document.querySelector('.confirm'),
		badge = document.querySelector('.nav__badge'),
		totalCost = document.querySelector('.cart__total>span'),
		titles = document.querySelectorAll('.goods__title'),
		titlesText = document.querySelectorAll('.goods__item p'),
		inputPrice = document.querySelector('.inputPrice'),
		cartConfirm = document.querySelector('.cart__confirm'),
		empty = cartWrapper.querySelector('.empty');

	let inputGoods = document.querySelectorAll(".inputGoods");
	
	textInput();
	//Перевод текста в input	
	function textInput() {
		for (let i = 0; i < 8; i++) {
			inputGoods[i].value = titlesText[i].textContent;
		}
	}

	function openCart() {
		cart.style.display = 'block';
		document.body.style.overflow = 'hidden';
	}

	function closeCart() {
		cart.style.display = 'none';
		document.body.style.overflow = '';
	}

	open.addEventListener('click', openCart);
	close.addEventListener('click', closeCart);

	goodsBtn.forEach(function (btn, i) {
		btn.addEventListener('click', () => {
			let item = products[i].cloneNode(true),
				trigger = item.querySelector('button'),
				removeBtn = document.createElement('div');

			trigger.remove();
			showConfirm();

			removeBtn.classList.add('goods__item-remove');
			removeBtn.innerHTML = '&times';
			item.appendChild(removeBtn);

			cartWrapper.appendChild(item);
			if (empty) {
				empty.style.display = "none";
			}

			calcGoods();
			calcTotal();
			removeFromCart();
		});
	});

	//обрезание текста
	function sliceTitle() {
		titles.forEach(function (item) {
			if (item.textContent.length < 70) {
				return;
			} else {
				const str = item.textContent.slice(0, 71) + '...';
				item.textContent = str;
			}
		});
	}
	sliceTitle();
	//Анимация при клике на товар
	function showConfirm() {
		confirm.style.display = 'block';
		let counter = 100;
		const id = setInterval(frame, 10);

		function frame() {
			if (counter == 10) {
				clearInterval(id);
				confirm.style.display = 'none';
			} else {
				counter--;
				confirm.style.transform = `translateY(-${counter}px)`;
				confirm.style.opacity = '.' + counter;
			}
		}
	}

	function calcGoods(i) {
		const items = cartWrapper.querySelectorAll('.goods__item');
		badge.textContent = items.length;
		cartConfirm.style.display = "block";
		if (items.length == 0) {
			empty.style.display = "block";
			cartConfirm.style.display = "none";
		}
	}

	function calcTotal() {
		const prices = document.querySelectorAll('.cart__wrapper > .goods__item > .goods__price > span')
		let total = 0;
		prices.forEach(function (item) {
			total += +item.textContent;
		});
		totalCost.textContent = total;
		inputPrice.value = totalCost.textContent;
	}

	function removeFromCart() {
		const removeBtn = cartWrapper.querySelectorAll('.goods__item-remove');
		removeBtn.forEach(function (btn) {
			btn.addEventListener('click', () => {
				btn.parentElement.remove();
				calcGoods();
				calcTotal();
			});
		});
	}

}