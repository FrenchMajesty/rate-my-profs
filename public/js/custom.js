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

		console.log(newType)
		console.log(active)
		console.log(formAssoc)


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

	function bindEvents(card) {
		const type = card.getAttribute('data-id')
		
		if(type == 'profs') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, type) }))
			card.querySelector('form[data-active="1"]').addEventListener('submit', submitSearchProf)

		}else if(type == 'school') {
			card.querySelectorAll('input[type="radio"]').forEach(btn => btn.addEventListener('click',(e) => { toggleSearch(e, type) }))
			card.querySelector('form[data-active="1"]').addEventListener('submit', submitSearchSchool)
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

$(document).ready(() => {

	new WOW().init()
	sideModule.init()
	$('.mdb-select').material_select()
})



