$(document).ready(() => {
	new WOW().init()

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
})

/*
    |--------------------------------------------------------------------------
    |  Side Module Module
    |--------------------------------------------------------------------------
    |
    | This module contains all operations performed on the side module like
    | the animation and the search functions
    |
    */
const sideModule = (function(){
	const module = {}

	module.settings = {
		buttons: document.querySelectorAll('.category a.btn'),
		container: document.querySelector('#side-module'),
		defaultCard: 'profs'
	}

	/**
	 * Show and bind events to appropriate card based on button clicked
	 * @param  {String}	 card type
	 */
	function showSideCard(type) {
		const card = $(`[data-id="${type}"]`),
			  newCard = card.clone(true)

		newCard.addClass('wow animated fadeIn')

		$(module.settings.container).children().css('display','none').remove()
		setTimeout(() => { 
			module.settings.container.appendChild(newCard[0]) 
			updateButtons(type)
			bindEvents(newCard[0])
		}, 100)

	}

	/**
	 * Update color state of buttons
	 * @param  {String} current card
	 */
	function updateButtons(type) {
		module.settings.buttons.forEach(btn => {
			btn.classList.add('primary')
			btn.classList.remove('blue')
		})
		const active = document.querySelector(`.category a[data-type="${type}"]`)
			  active.classList.add('blue')
			  active.classList.remove('primary')
	}

	/**
	 * Toggle the search forms on the cards
	 * @param  {Event}
	 * @param {String} Card ID
	 */
	function toggleSearch(e, cardId) {
		const newType = e.target.value,
			  active = document.querySelector(`.card[data-id="${cardId}"] form[data-active="1"]`),
			  formAssoc = document.querySelector(`.card[data-id="${cardId}"] form[data-form="${newType}"]`)

		if(newType != active.getAttribute('data-form') && formAssoc) {
			$(active).css('display','none')
			active.setAttribute('data-active', 0)
			active.reset()

			formAssoc.setAttribute('data-active', 1)
			$(formAssoc).css('display','')
		}
	}

	function submitSearchProf(e) {
		e.preventDefault()

		return false
	}

	function submitSearchSchool(e) {
		e.preventDefault()

		return false
	}

	function submitSearchReview(e) {
		e.preventDefault()
		// figure out what we're searching for and submit
		return false
	}

	/**
	 * Bind events based on card ID
	 * @param  {Element} card
	 */
	function bindEvents(card) {
		const id = card.getAttribute('data-id')
		
		if(id == 'profs') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, id) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchProf))

		}else if(id == 'school') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, id) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchSchool))
		
		}else if(id == 'review') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, id) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchReview))	
		
		}else if(id == 'similar') {

		}
	}

	function bindUIEvents() {
		module.settings.buttons.forEach(btn => btn.addEventListener('click',(e) => {

		if(e.target.classList.contains('material-icons'))
			showSideCard(e.target.parentNode.getAttribute('data-type'))
		else 
			showSideCard(e.target.getAttribute('data-type'))
		}))
	}

	module.init = (card) => {
		bindUIEvents()

		if(card == 'none')
			return // No show 
		else if(card)
			showSideCard(card)
		else
			showSideCard(module.settings.defaultCard)
	}

	return module
}())


/*
    |--------------------------------------------------------------------------
    | Index Component Module
    |--------------------------------------------------------------------------
    |
    | This module is used for all operations performed on the main index page
    | container like the animation and search functions
    |
    */
const indexComponent = (function () {
	const m = {}

	m.settings = {
		buttons: document.querySelectorAll('#page-container .find-buttons button')
	}

	function findProfessor(e) {
		e.preventDefault()

		return false
	}

	function findSchool(e) {
		e.preventDefault()

		return false
	}

	/**
	 * Perform operations to change view
	 * @param  {String} new view's name
	 */
	function navigateView(name) {
		const container = $('#page-container'),
			  template = $(`div[data-view="${name}"]`),
			  view = template.clone(true)

		container.find('[data-view]').remove()
		container.html(view)

		const animation = name == 'index' ? 'slideInLeft' : 'slideInRight'
		view.addClass(`animated ${animation}`)
		bindEvents(view[0])
	}

	/**
	 * Toggle search mode based on Switcher
	 * @param  {MouseEvent} e
	 */
	function toggleSearchMode(e) {
		if(!e.target.name) return

		const card = $(e.target).parents('.card-block'),
	          check= e.target,
	          otherCheck = check.name == 'name' ? 'location' : 'name'

		document.querySelector(`input[name="${otherCheck}"]`).click()

		if($(check).is(':checked')) {
			card.find(`form[data-type="${otherCheck}"]`).css('display', 'none')[0].reset()
			card.find(`form[data-type="${check.name}"]`).attr('style','')
		}else {
			card.find(`form[data-type="${check.name}"]`).css('display', 'none')[0].reset()
			card.find(`form[data-type="${otherCheck}"]`).attr('style','')
		}
	}

	/**
	 * Bind events based on the view
	 * @param  {Element} view
	 */
	function bindEvents(view) {
		const type = view.getAttribute('data-view')

		if(type == 'schools') {
			view.querySelectorAll('.switch').forEach(lever => lever.addEventListener('click', toggleSearchMode))
			view.querySelectorAll('form').forEach(form => form.addEventListener('submit', findSchool))
			view.querySelector('.nav-back').addEventListener('click',() => { navigateView('index') })

		}else if (type == 'profs') {
			view.querySelector('.nav-back').addEventListener('click',() => { navigateView('index') })
			view.querySelector('form').addEventListener('submit', findProfessor)

		}else if(type == 'review') {
			view.querySelector('.nav-back').addEventListener('click',() => { navigateView('index') })
			view.querySelector('form').addEventListener('submit', findProfessor)

		}else if (type == 'index') {
			view.querySelectorAll('button').forEach(btn => btn.addEventListener('click', (e) => {
				navigateView(e.target.getAttribute('data-type'))
			}))
		}
	}

	function bindUIEvents() {
		m.settings.buttons.forEach(btn => btn.addEventListener('click', (e) => {
			navigateView(e.target.getAttribute('data-type'))
		}))
	}

	m.init = () => {
		bindUIEvents()
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Sign Up Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the registration page
    | like changing card and form handling
    |
    */
const signUp = (function () {
	const m = {}

	m.settings = {
		switcher : document.querySelector('.switch'),
		signUpContainer: $('#signup-container'),
		defaultCard: $('.card[data-card="student"]'),
		successRegisterRedirectUrl: './account'
	}

	function handleSubmit(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => window.location.replace(m.settings.successRegisterRedirectUrl))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	/**
	 * Display AJAX form errors in card
	 * @param  {Element} elem
	 * @param  {JSON} errors
	 */
	function displayErrors(elem, errors) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors in card
	 * @param  {Element} elem
	 */
	function clearErrors(elem) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function changeSignup(e) {
		if(!e.target.type) return
		let card = null

		if($(e.target).is(':checked'))
			card = $('.card[data-card="prof"]').clone(true)
		else
			card = $('.card[data-card="student"]').clone(true)

		replaceSignup(card)
	}

	/**
	 * Replace the current sign up card
	 * @param  {Element} new card
	 */
	function replaceSignup(card) {
		m.settings.signUpContainer.children().first().remove()
		m.settings.signUpContainer.html(card)
		card.addClass('wow animated fadeInDown')
		card.find('form').on('submit', handleSubmit)
		card.find('input').on('change keydown keypress',(e) => clearErrors(card[0]))

		// Hide all, show the one wanted
		document.querySelectorAll('ul[data-id]').forEach(list => $(list).css('display','none'))
		$(`ul[data-id="${card.attr('data-card')}"]`).css('display','')
	}

	function bindUIEvents() {
		m.settings.switcher.addEventListener('click', changeSignup)
	}

	m.init = () => {
		bindUIEvents()
		replaceSignup(m.settings.defaultCard.clone(true))
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Login Script Module
    |--------------------------------------------------------------------------
    |
    | This module is for all operations performed on the login page like the
    | form handling and the animation
    |
    */
const loginScript = (function() {
	const m = {}

	m.settings = {
		container: $('#card-container'),
		successLoginRedirectUrl: './account',
		successEmailLinkRedirectUrl : './login'
	}

	function handleLogin(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')
		
		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => window.location.replace(m.settings.successLoginRedirectUrl))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handlePwdReset(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')
		
		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => { 
			alert('A reset link associated with that email has been sent.')
			window.location.replace(m.settings.successEmailLinkRedirectUrl)
		})
		.fail(response => displayErrors(e.target, response))
	}

	/**
	 * Display AJAX form errors in vue
	 * @param  {Element} elem
	 * @param  {JSON} errors
	 */
	function displayErrors(elem, errors) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(msg => errorDiv.innerHTML += `<li>${msg}</li>`)	
		})
	}

	/**
	 * Clear the errors in vue
	 * @param  {Element} elem
	 */
	function clearErrors(elem) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	/**
	 * Change the current view
	 * @param {String} name
	 */
	function setVue(name) {
		const container = m.settings.container,
			  template = document.querySelector(`#temp div[data-card="${name}"]`),
			  vue = $(template).clone(true),
			  animation = name == 'login' ? 'fadeInDown' : 'fadeInDown'

		container.children().first().remove()
		container.html(vue)
		vue.addClass(`animated ${animation}`)
		bindEvents(vue[0])
	}

	/**
	 * Attach the events on a newly generated vue
	 * @param  {String} vue
	 */
	function bindEvents(vue) {

		vue.querySelector('a[data-type="nav"]').addEventListener('click', (e) => { 
			setVue(e.target.getAttribute('data-id')) 
		})

		if(vue.getAttribute('data-card') == 'login') {
			vue.querySelector('form').addEventListener('submit', handleLogin)
			$(vue).find('input').on('change keydown keypress',(e) => { clearErrors(vue) })
		}else {
			vue.querySelector('form').addEventListener('submit', handlePwdReset)
			$(vue).find('input').on('change keydown keypress',(e) => { clearErrors(vue) })
		}
	}

	m.init = (config) => {
		setVue('login')
	}

	return m

}())

/*
    |--------------------------------------------------------------------------
    | Reset Password Script Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the reset password page
    | like form handling
    |
    */
const resetPasswordScript = (function() {
	const m = {}

	m.settings = {
		form: document.querySelector('.card-block form'),
		successUpdatePasswordRedirectUrl: '../../login'
	}

	function handleSubmit(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => {
			alert('Your password was succesfully updated!')
			window.location.replace(m.settings.successUpdatePasswordRedirectUrl)
		})
		.fail(response => displayErrors(response.responseJSON))
	}

	/**
	 * Display AJAX form errors on page
	 * @param  {JSON} errors
	 */
	function displayErrors(errors) {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors on page
	 */
	function clearErrors() {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
		$(m.settings.form).find('input').on('change keypress keydown', clearErrors)
	}

	m.init = () => {
		bindUIEvents()
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Add Professor Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the page to add a
    | professor like pre loading data and form handling 
    |
    */
const addProfessor = (function() {
	const m = {
		settings: {
			form: document.querySelector('#add-prof'),
		},
		IDField: {
			school: document.querySelector('input[name="school_id"]'),
			dept: document.querySelector('input[name="department_id"]')
		},
		field: {
			school: $('.card-block input[name="school"]'),
			dept: $('.card-block input[name="department"]')
		},
		data: {
			school: null,
			dept: null
		},
		url: {
			fetchSchool: null,
			fetchDept: null
		},
		successAdd: {
			message: null
		}
	}

	function handleSubmit(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => alert(m.successAdd.message))
		.fail(response => displayErrors(response.responseJSON))		
	}

	function loadSchoolData() {
		if(m.data.school)
			activateTypeahead(m.field.school, m.data.school)
		else{
	 		$.ajax(m.url.fetchSchool)
			.then(response => activateTypeahead(m.field.school, response))
		}
	}

	function loadDepartmentsData() {
		if(m.data.dept)
			activateTypeahead(m.field.dept, m.data.dept)
		else{
	 		$.ajax(m.url.fetchDept)
			.then(response => activateTypeahead(m.field.dept, response))
		}
	}

	/**
	 * Activate type ahead and bind events
	 * @param {JQuery} input
	 * @param {Array} data
	 */
	function activateTypeahead(elem, data) {
		let IDField = null

		if(elem.attr('name') == 'school')
			IDField = m.IDField.school
		else
			IDField = m.IDField.dept

		elem.typeahead({
			source: data,
			minLength: 3,
			items: 5,
			afterSelect: function(item) {
				IDField.value = item.id
			}
		})

		// If entry does not exist
		elem.on('blur',(e) => {
			const isFound = data.filter(item => item.name == e.target.value)
			if(isFound.length > 0)
				IDField.value = isFound[0].id 
			else
				IDField.value = -1
		})
	}

	/**
	 * Display AJAX form errors on page
	 * @param  {JSON} errors
	 */
	function displayErrors(errors) {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors on page
	 */
	function clearErrors() {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
		$(m.settings.form).on('change keypress keydown', clearErrors)
	}

	m.init = (config) => {

		// Configs
		Object.keys(config).forEach(key => {
			if(m.hasOwnProperty(key)) Object.assign(m[key], config[key])
 		})

		loadSchoolData()
		loadDepartmentsData()
		bindUIEvents()
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Add School Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the page to add a 
    | school like form handling
    |
    */
const addSchool = (function() {
	const m = {
		settings: {
			form: document.querySelector('#add-school'),
		},
		successAdd: {
			redirectUrl: null,
			message: null
		}
	}

	function handleSubmit(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => {
			alert(m.successAdd.message)
			window.location.replace(m.successAdd.redirectUrl)
		})
		.fail(response => displayErrors(response.responseJSON))
	}

	/**
	 * Display AJAX form errors on page
	 * @param  {JSON} errors
	 */
	function displayErrors(errors) {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors on page
	 */
	function clearErrors() {
		const errorDiv = m.settings.form.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
		$(m.settings.form).find('input').on('change keydown keypress', clearErrors)
	}

	m.init = (config) => {
		bindUIEvents()

		// Configs
		Object.keys(config).forEach(key => {
			if(m[key]) Object.assign(m[key], config[key])
		})
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Professor View Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the viewing page of a
    | professor like form handling for ratings, reporting corrections and
    | interacting with other ratings
    */
const professorView = (function() {
	const m = {
		settings: {
			form: {
				rating: document.querySelector('#rateProfessor form'),
				correction: document.querySelector('#submitCorrection form'),
				report: document.querySelector('#reportRating form'),
				ratingsContainer: $('.student-reviews')
			},
			voteUrl: null,
			reportUrl : null
		},
		successRate: {
			redirectUrl: null,
			message: null
		},
		slider: document.querySelectorAll('input[type="range"]')
	}

	function handleSubmitRating(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => {
			alert(m.successRate.message)
			window.location.replace(m.successRate.redirectUrl)
		})
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleSubmitCorrection(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => $('#submitCorrection').modal('hide'))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleReportRating(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => $('#reportRating').modal('hide'))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleVote(e) {
		e.preventDefault()

		let parent = $(e.target).parents('.reviews-container'),
			value = e.target.classList.contains('vote-up') ? 1 : -1
			formData = new FormData()

		formData.append('prof_id', parent.data('prof'))
		formData.append('rating_id', parent.data('id'))
		formData.append('value', value)

		$.ajax(m.settings.voteUrl, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => e.target.classList.add(value > 0 ? 'green-text' : 'red-text'))
	}

	/**
	 * Update content of the modal
	 * @param  {MouseEvent} event
	 */
	function prepareReportModal(e) {
		const rating = $(e.target).parents('.reviews-container'),
			  modal = document.querySelector('#reportRating')

		modal.querySelector('.modal-body p').innerText = rating.find('div[data-id="comment"] span').text()
		modal.querySelector('input[name="rating_id"]').value = rating.data('id')
	}

	function updateSlider(e) {
		const text = document.querySelector(`span[data-id="${e.target.name}"]`)
		text.innerText = e.target.value
		e.target.setAttribute('value', e.target.value)
	}

	/**
	 * Display AJAX form errors on page
	 * @param {Element} elem
	 * @param  {JSON} errors
	 */
	function displayErrors(elem, errors) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors on form
	 * @param {Element} elem
	 */
	function clearErrors(elem) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function bindUIEvents() {
		m.settings.form.rating.addEventListener('submit', handleSubmitRating)
		m.settings.form.correction.addEventListener('submit', handleSubmitCorrection)
		m.settings.form.report.addEventListener('submit', handleReportRating)
		m.slider.forEach(ranger => ranger.addEventListener('input', updateSlider))
		document.querySelectorAll('a[data-id="report"]').forEach(link => link.addEventListener('click', prepareReportModal))
		$('.vote-up, .vote-down').on('click', handleVote)
		$(m.settings.form.correction).find('input, textarea')
				.on('change keydown keypress',() => { clearErrors(m.settings.form.correction) })
		$(m.settings.form.rating).find('input, textarea')
				.on('change keydown keypress input', () => { clearErrors(m.settings.form.rating) })
		$(m.settings.form.report).find('input, textarea')
				.on('change keydown keypress input', () => { clearErrors(m.settings.form.report) })
	}

	m.init = (config) => {
		bindUIEvents()

		// Configs
		Object.keys(config).forEach(key => {
			if(m[key]) Object.assign(m[key], config[key])
		})
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | School View Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the viewing page for
    | a school like form handling for rating, reporting and interacting with
    | other ratings
    */
const schoolView = (function() {
	const m = {
		settings: {
			form: {
				rating: document.querySelector('#rateSchool form'),
				correction: document.querySelector('#submitCorrection form'),
				report: document.querySelector('#reportRating form'),
				ratingsContainer: $('.student-reviews')
			},
		},
		url: {
			vote: null
		},
		successRate: {
			redirectUrl: null,
			message: null
		},
		slider: document.querySelectorAll('input[type="range"]')
	}

	function handleSubmitRating(e) {
		e.preventDefault()

		const url = e.target.getAttribute('action'),
			   formData = new FormData(e.target)

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(response => {
			alert(m.successRate.message)
			window.location.reload(true)
		})
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleSubmitCorrection(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => $('#submitCorrection').modal('hide'))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleReportRating(e) {
		e.preventDefault()

		const formData = new FormData(e.target),
			  url = e.target.getAttribute('action')

		$.ajax(url, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => $('#reportRating').modal('hide'))
		.fail(response => displayErrors(e.target, response.responseJSON))
	}

	function handleVote(e) {
		e.preventDefault()

		let parent = $(e.target).parents('rating'),
			value = e.target.classList.contains('vote-up') ? 1 : -1
			formData = new FormData()

		formData.append('school_id', parent.data('school'))
		formData.append('rating_id', parent.data('id'))
		formData.append('value', value)

		$.ajax(m.url.vote, {
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false
		})
		.then(_ => e.target.classList.add(value > 0 ? 'green-text' : 'red-text'))
	}

	/**
	 * Update content of the reporting modal
	 * @param  {MouseEvent} event
	 */
	function prepareReportModal(e) {
		const rating = $(e.target).parents('rating'),
			  modal = document.querySelector('#reportRating')

		modal.querySelector('.modal-body p').innerText = rating.find('div.comment span').text()
		modal.querySelector('input[name="rating_id"]').value = rating.data('id')
	}

	function updateSlider(e) {
		const text = document.querySelector(`span[data-id="${e.target.name}"]`)
			  text.innerText = e.target.value
		e.target.setAttribute('value', e.target.value)
	}

	/**
	 * Display AJAX form errors on page
	 * @param {Element} elem
	 * @param  {JSON} errors
	 */
	function displayErrors(elem, errors) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.removeAttribute('style')

		Object.keys(errors).forEach(err => {
			errors[err].forEach(err => errorDiv.innerHTML += `<li>${err}</li>`)
		})
	}

	/**
	 * Clear the errors on form
	 * @param {Element} elem
	 */
	function clearErrors(elem) {
		const errorDiv = elem.querySelector('.alert-danger')
			  errorDiv.setAttribute('style', 'display: none')
			  errorDiv.innerHTML = ''
	}

	function bindUIEvents() {
		m.settings.form.rating.addEventListener('submit', handleSubmitRating)
		m.settings.form.correction.addEventListener('submit', handleSubmitCorrection)
		m.settings.form.report.addEventListener('submit', handleReportRating)
		m.slider.forEach(ranger => ranger.addEventListener('input', updateSlider))
		document.querySelectorAll('a[data-id="report"]').forEach(link => link.addEventListener('click', prepareReportModal))
		$('.vote-up, .vote-down').on('click', handleVote)
		$(m.settings.form.correction).find('input, textarea')
				.on('change keydown keypress',() => { clearErrors(m.settings.form.correction) })
		$(m.settings.form.rating).find('input, textarea')
				.on('change keydown keypress input', () => { clearErrors(m.settings.form.rating) })
		$(m.settings.form.report).find('input, textarea')
				.on('change keydown keypress input', () => { clearErrors(m.settings.form.report) })
	}

	m.init = (config) => {
		bindUIEvents()

		if(config) {
			Object.keys(config).forEach(key => {
				if(m[key]) Object.assign(m[key], config[key])
			})
		}
	}

	return m
}())


/*
    |--------------------------------------------------------------------------
    | Search Results Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the search list page
    | like the pagination
    |
    */
   
const searchResults = (function () {
	const m = {
		settings: { shiftSize: 2, pageLength: null, maxPagination: null },
		page: 1,
		count: null
	}

	/**
	 * Show and hide the appropriate results on the page
	 */
	function formatResults() {
		const results = document.querySelectorAll('a[data-pos]')
		if(results.length == 0) return

		$(results).css('display','none')
		results.forEach(item => {
			const pos = item.getAttribute('data-pos')

			if(m.page == 1 && pos <= m.settings.pageLength)
				item.removeAttribute('style')
			else if(pos > (m.page - 1) * m.settings.pageLength && pos <= m.page * m.settings.pageLength)
				item.removeAttribute('style')
		})
	}

	/**
	 * Initialize pagination
	 */
	function setPaginator() {
		const pageBtns = Array.from(document.querySelectorAll('.pagination .page-item')),
		      pageCount = Math.ceil(m.count / m.settings.pageLength)

		if(pageCount == 0) {
			$('.pagination').parents('nav').remove()
		}else if(pageCount > 1) {

			for(i = 2; i <= pageCount; i++) {
				newButton = $(pageBtns[1]).clone(true)
				newButton.find('b').text(i)
				if(i >= 2 + m.settings.maxPagination) newButton.css('display','none')
				document.querySelector('.pagination').insertBefore(newButton[0], pageBtns[pageBtns.length-1])
			}		
		}
	}

	/**
	 * Animate and update the pagination
	 * @param  {Event} e
	 */
	function updatePagination(e) {
		if(!e.target.classList.contains('page-item') && !e.target.classList.contains('page-link')) return
		if(e.target.classList.contains('disabled')) return

		const pageBtns = Array.from(document.querySelectorAll('.pagination .page-item')),
			  visibleBtns = $('.pagination .page-item:visible'),
			  maxPage = Math.ceil(m.count / m.settings.pageLength),
			  btn = $(e.target)

		// Update page number
		if(btn.data('type') == 'next'){
			m.page = maxPage
			shiftPagination(m.page-1, 'right')
		}else if(btn.data('type') == 'previous'){
			m.page = 1
			shiftPagination(m.page+1, 'left')
		}else
			m.page = btn.find('b').text()
		
		// Update disabled state
		if(m.page != 1)
			pageBtns[0].classList.remove('disabled')
		else
			pageBtns[0].classList.add('disabled')

		if(m.page != maxPage)
			pageBtns[pageBtns.length-1].classList.remove('disabled')
		else
			pageBtns[pageBtns.length-1].classList.add('disabled')

		// Handle shifts of page buttons
		if(m.settings.shiftSize < m.settings.maxPagination) {
			btns = {
				first: visibleBtns[1].querySelector('b').innerText,
				last: visibleBtns[visibleBtns.length-2].querySelector('b').innerText,
				current: btn.find('b').text()
			}

			if(btns.current > btns.last - m.settings.shiftSize && btns.current < maxPage)
				shiftPagination(btn.find('b').text(), 'right')
			else if(btns.current <= btns.first + m.settings.shiftSize)
				shiftPagination(btn.find('b').text(), 'left')
		}

		// update results
		formatResults()		 

		// Set active class
		pageBtns.map(pageButton => {
			const num = pageButton.querySelector('b').innerText
			if(m.page == num)
				pageButton.classList.add('active')
			else
				pageButton.classList.remove('active')
		})
	}

	/**
	 * Shift the 'visible spectrum' of the pagination
	 * @param  {String} from      from page number
	 * @param  {String} direction direction shifted toward
	 * @param  {Number} step      shift size
	 */
	function shiftPagination(from, direction, step = 2) {
		const pageBtns = Array.from(document.querySelectorAll('.pagination .page-item')),
			  visibleBtns = $('.pagination .page-item:visible'),
			  maxPage = Math.ceil(m.count / m.settings.pageLength),
			  btns = {
				first: visibleBtns[1].querySelector('b').innerText,
				last: visibleBtns[visibleBtns.length-2].querySelector('b').innerText,
				current: from //.find('b').text()
			}

		if(direction == 'right') {
			// Hide first buttons
			visibleBtns.each((i,btn) => {
				const val = btn.querySelector('b').innerText
				if(i > 0 && maxPage - val > 1+step && i <= step)
					btn.setAttribute('style','display: none')
			})
			// Show next buttons
			pageBtns.some(btn => {
				const val = btn.querySelector('b').innerText
				if(!isNaN(val) && val > btns.last && val <= Number(btns.last) + step)
					btn.removeAttribute('style')
			})
		}else if(direction == 'left') {
			// Hide last buttons
			visibleBtns.each((i, btn) => {
				const val = btn.querySelector('b').innerText
				if(i < visibleBtns.length-1 && i > visibleBtns.length - (2+step)
					&& val > 2+step)
					btn.setAttribute('style','display: none')
			})
			// Show first buttons				
			pageBtns.some(btn => {
				const val = btn.querySelector('b').innerText
				if(!isNaN(val) && val < btns.first && val >= btns.first - step)
					btn.removeAttribute('style')
			})
		}
	}

	function bindUIEvents() {
		document.querySelector('.pagination').addEventListener('click', updatePagination)
	}

	m.init = (config) => {
		if(config) {
			Object.keys(config).forEach(key => {
				if(m[key]) Object.assign(m[key], config[key])
			})
		}

		const lastItem = document.querySelector('a[data-pos]:last-of-type')
		m.count = lastItem ? lastItem.getAttribute('data-pos') : 0

		bindUIEvents()
		formatResults()
		setPaginator()
		document.querySelectorAll('.pagination .page-item')[1].classList.add('active')
	}
	return m
}())


