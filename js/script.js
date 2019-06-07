function start(url) {
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
		empty = cartWrapper.querySelector('.empty'),
		authentication = document.querySelector('#authentication'),
		auth = document.querySelector('.auth');

	let inputGoods = document.querySelectorAll(".inputGoods");
	textInput();
	//Перевод текста в input	
	function textInput() {
		for (let i = 0; i < inputGoods.length; i++) {
			inputGoods[i].value = titlesText[i].textContent;
		}
	}

	authentication.addEventListener('click', (e) => {
		let auth_block = document.querySelectorAll('.auth_block p span'),
			authClose = document.querySelector('.auth__close'),
			btnSign = document.querySelector('.btnSign'),
			btnRegister = document.querySelector('.btnRegister'),
			name = document.querySelector('#name'),
			surname = document.querySelector('#surname');
			
		function visibleName(){
			name.style.display = "block";
			surname.style.display = "block";
		}
		
		function noVisibleName(){
			name.style.display = "none";
			surname.style.display = "none";
		}
			
		document.body.style.overflow = 'hidden';
		auth.style.display = "block";

		if(e.srcElement.id == "sign"){
			auth_block[0].style.borderBottom = "2px solid red";
			btnSign.style.display = "block";
			btnRegister.style.display = "none";
			noVisibleName();
		}else if(e.srcElement.id == "register"){
			auth_block[1].style.borderBottom = "2px solid red";
			btnSign.style.display = "none";
			btnRegister.style.display = "block";
			visibleName()
		}

		auth_block[0].addEventListener('click',()=>{
			auth_block[0].style.borderBottom = "2px solid red";
			auth_block[1].style.borderBottom = "";
			btnSign.style.display = "block";
			btnRegister.style.display = "none";
			noVisibleName();
		})

		auth_block[1].addEventListener('click',()=>{
			auth_block[1].style.borderBottom = "2px solid red";
			auth_block[0].style.borderBottom = "";
			btnSign.style.display = "none";
			btnRegister.style.display = "block";
			visibleName()
		})

		authClose.addEventListener('click',()=>{
			auth.style.display = "none";
			auth_block[0].style.borderBottom = "";
			auth_block[1].style.borderBottom = "";
			document.body.style.overflow = '';
		})
	})

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