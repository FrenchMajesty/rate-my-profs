const sideModule = (function(){
	const module = {}

	module.settings = {
		buttons: document.querySelectorAll('.category a.btn'),
		container: document.querySelector('#side-module')
	}

	/**
	 * Show and bind events to appropriate card based on button clicked
	 * @param  {MouseEvent}
	 */
	function showSideCard(e) {
		let type = ''
		if(e.target.classList.contains('material-icons'))
			type = e.target.parentNode.getAttribute('data-type')
		else 
			type = e.target.getAttribute('data-type')

		const card = $(`[data-id="${type}"]`),
			  newCard = card.clone(true)

		newCard.addClass('wow animated slideInLeft')
		newCard.removeAttr('style')

		$(module.settings.container).find('.card:first').remove()
		module.settings.container.appendChild(newCard[0])

		bindEvents(newCard[0])
	}

	/**
	 * Toggle the forms on the cards
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
	 * Bind events based on type of card
	 * @param  {Element} card
	 */
	function bindEvents(card) {
		const type = card.getAttribute('data-id')
		
		if(type == 'profs') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, type) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchProf))

		}else if(type == 'school') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, type) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchSchool))
		
		}else if(type == 'review') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, type) }))
			card.querySelectorAll('form').forEach(form => form.addEventListener('submit', submitSearchReview))	
		}
		
	}

	function bindUIEvents() {
		module.settings.buttons.forEach(btn => btn.addEventListener('click', showSideCard))
	}

	module.init = () => {
		bindUIEvents()
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

$(document).ready(() => {

	new WOW().init()
})



