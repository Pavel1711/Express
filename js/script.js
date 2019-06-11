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

	let inputGoods = document.querySelectorAll(".inputGoods"),
		auth_block = document.querySelectorAll('.auth_block p span'),
		authClose = document.querySelector('.auth__close'),
		authForm = document.querySelector('#authForm'),
		registerForm = document.querySelector('#registerForm'),
		name = document.querySelector('#name'),
		surname = document.querySelector('#surname'),
		eye = document.querySelectorAll('.eye');

	textInput();
	//Перевод текста в input	
	function textInput() {
		for (let i = 0; i < inputGoods.length; i++) {
			inputGoods[i].value = titlesText[i].textContent;
		}
	}

	eye[0].addEventListener('click',() => {
		showPassword(1,0);	
	})

	eye[1].addEventListener('click',() => {
		showPassword(0,1);	
	})

	function showPassword(auth=0,reg=0){
		let pass=document.querySelectorAll("input[name=\"password\"]");
		if(auth==1){
			if(pass[0].type == "password"){
				pass[0].type = "text";
				eye[0].setAttribute("src","img/eyeNone.png");
			}else if(pass[0].type == "text"){
				pass[0].type = "password";
				eye[0].setAttribute("src","img/eye.png");
			}
		}
		if(reg==1){
			if(pass[1].type == "password"){
				pass[1].type = "text";
				eye[1].setAttribute("src","img/eyeNone.png");
			}else if(pass[1].type == "text"){
				pass[1].type = "password";
				eye[1].setAttribute("src","img/eye.png");
			}
		}

	}


	authentication.addEventListener('click', (e) => {

		document.querySelector("#header-search").style.display = "none";
		document.querySelector(".search__input").style.borderBottomStyle = "solid";

		function visibleName() {
			name.style.display = "block";
			surname.style.display = "block";
		}

		function noVisibleName() {
			name.style.display = "none";
			surname.style.display = "none";
		}

		document.body.style.overflow = 'hidden';
		auth.style.display = "block";

		if (e.srcElement.id == "sign") {
			auth_block[0].style.borderBottom = "2px solid red";
			authForm.style.display = "flex";
			registerForm.style.display = "none";
			noVisibleName();
		} else if (e.srcElement.id == "register") {
			auth_block[1].style.borderBottom = "2px solid red";
			authForm.style.display = "none";
			registerForm.style.display = "flex";
			visibleName()
		}

		auth_block[0].addEventListener('click', () => {
			auth_block[0].style.borderBottom = "2px solid red";
			auth_block[1].style.borderBottom = "";
			authForm.style.display = "flex";
			registerForm.style.display = "none";
			noVisibleName();
		})

		auth_block[1].addEventListener('click', () => {
			auth_block[1].style.borderBottom = "2px solid red";
			auth_block[0].style.borderBottom = "";
			authForm.style.display = "none";
			registerForm.style.display = "flex";
			visibleName()
		})

		authClose.addEventListener('click', () => {
			authBlockCLose();
		})
	})

	authBlockCLose();
	
	function authBlockCLose() {
		auth.style.display = "none";
		auth_block[0].style.borderBottom = "";
		auth_block[1].style.borderBottom = "";
		document.body.style.overflow = '';
	}

	function openCart() {
		cart.style.display = 'block';
		document.body.style.overflow = 'hidden';
		document.querySelector("#header-search").style.display = "none";
		document.querySelector(".search__input").style.borderBottomStyle = "solid";
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

			document.querySelector("#header-search").style.display = "none";
			document.querySelector(".search__input").style.borderBottomStyle = "solid";

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