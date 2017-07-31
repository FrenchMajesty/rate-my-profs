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

	function submitSearchSchool(e) {
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
		form: document.querySelectorAll('form'),
		signUpContainer: $('#signup-container'),
		switcher : document.querySelector('.switch'),
		defaultCard: $('.card[data-card="student"]')
	}

	function handleSubmit(e) {
		e.preventDefault()

		return false
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

	function replaceSignup(card) {
		m.settings.signUpContainer.children().first().remove()
		m.settings.signUpContainer.html(card)
		card.addClass('wow animated fadeInDown')

		// Hide all, show the one wanted
		document.querySelectorAll('ul[data-id]').forEach(list => $(list).css('display','none'))
		$(`ul[data-id="${card.attr('data-card')}"]`).css('display','')
	}

	function bindUIEvents() {
		m.settings.form.forEach(form => form.addEventListener('submit', handleSubmit))
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
		container: $('#card-container')
	}

	function handleLogin(e) {
		e.preventDefault()

		return false
	}

	function handlePwdReset(e) {
		e.preventDefault()

		return false
	}

	function setVue(name) {
		const container = m.settings.container,
			  template = document.querySelector(`#temp div[data-card="${name}"]`),
			  vue = $(template).clone(true),
			  animation = name == 'login' ? 'slideInLeft' : 'slideInRight'

		container.children().first().remove()
		container.html(vue)
		vue.addClass(`animated ${animation}`)
		bindEvents(vue[0])
	}

	function bindEvents(vue) {

		vue.querySelector('a[data-type="nav"]').addEventListener('click', (e) => { 
			setVue(e.target.getAttribute('data-id')) 
		})

		if(vue.getAttribute('data-card') == 'login')
			vue.querySelector('form').addEventListener('submit', handleLogin)
		else
			vue.querySelector('form').addEventListener('submit', handlePwdReset)
	}

	m.init = () => {
		setVue('login')
	}

	return m

}())


const addProfessor = (function() {
	const m = {}

	m.settings = {
		form: document.querySelector('form')
	}

	function handleSubmit(e) {
		e.preventDefault()
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
	}

	m.init = () => {
		bindUIEvents()
	}

	return m
}())


const addSchool = (function() {
	const m = {}

	m.settings = {
		form: document.querySelector('form')
	}

	function handleSubmit(e) {
		e.preventDefault()
	}

	function bindUIEvents() {
		m.settings.form.addEventListener('submit', handleSubmit)
	}

	m.init = () => {
		bindUIEvents()
	}

	return m
}())

$(document).ready(() => {

	new WOW().init()
})



