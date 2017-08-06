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

		newCard.addClass('wow animated slideInLeft')

		$(module.settings.container).children().first().remove()
		module.settings.container.appendChild(newCard[0])

		bindEvents(newCard[0])
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
			console.log(response)
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


const addProfessor = (function() {
	const m = {}

	m.settings = {
		form: document.querySelector('.card-block form'),
		schoolIDField: document.querySelector('input[name="school-id"]'),
		schoolField: $('.card-block input[name="school"]'),
		schoolData: []
	}

	function handleSubmit(e) {
		e.preventDefault()
	}

	function loadSchoolData() {
		m.settings.schoolData = [
			{ id: 1, name: 'item1' },
			{ id: 2, name: 'item2' },
			{ id: 3, name: 'item3' }
		]		
	}

	/**
	 * Activate type ahead and bind events
	 */
	function activateTypeahead() {
		
		m.settings.schoolField.typeahead({
			source: m.settings.schoolData,
			minLength: 3,
			items: 5,
			afterSelect: function(item) {
				m.settings.schoolIDField.value = item.id
			}
		})

		// If school does not exist
		m.settings.schoolField.on('blur',(e) => {
			const isFound = m.settings.schoolData.some(item => e.target.value == item.name)
			if(!isFound) m.settings.schoolIDField.value = -1
		})
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
		loadSchoolData()
		activateTypeahead()
	}

	m.init = () => {
		bindUIEvents()
	}

	return m
}())


const addSchool = (function() {
	const m = {}

	m.settings = {
		form: document.querySelector('#add-school'),
		successCreateRedirectUrl: '.././school'
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
		.then(response => window.location.replace(m.settings.successCreateRedirectUrl))
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

	m.init = () => {
		bindUIEvents()
	}

	return m
}())

$(document).ready(() => {
	new WOW().init()

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	})
})



