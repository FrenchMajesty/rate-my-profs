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
    const module = {
        settings: {
            buttons: document.querySelectorAll('.category a.btn'),
            container: document.querySelector('#side-module'),
            defaultCard: 'profs'
        },
        url: {
            fetchAll: null,
            departments: null,
            search: null 
        }
    }

    /**
     * Show and bind events to appropriate card based on button clicked
     * @param  {String}  card type
     */
    function showSideCard(type) {
        const card = $(`[data-id="${type}"]`),
              newCard = card.clone(true)

        newCard.addClass('wow animated fadeIn')

        $(module.settings.container).children().css('display','none').remove()
        $('input').typeahead('destroy')

        module.settings.container.appendChild(newCard[0]) 
        updateButtons(type)
        bindEvents(newCard[0])
        activateTypeahead(newCard)
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
              card = $(`.card[data-id="${cardId}"]`)
              active = card[0].querySelector('form[data-active="1"]'),
              formAssoc = card[0].querySelector(`form[data-form="${newType}"]`)

        if(newType != active.getAttribute('data-form') && formAssoc) {
            $(active).css('display','none')
            active.setAttribute('data-active', 0)
            active.reset()

            formAssoc.setAttribute('data-active', 1)
            $(formAssoc).css('display','')
            activateTypeahead(card)
        }
    }

    function submitSearchProf(e) {
        $(e.target).append(`<input type="hidden" name="search" value="${e.target.prof.value}">`)
    }

    function submitSearchSchool(e) {
        e.preventDefault()

    }

    function loadData() {
        return new Promise((resolve, reject) => {
                $.ajax(module.url.fetchAll).then(response => {
                module.settings.searchData = response

                loadDepartmentsData()
                loadLocations()
                resolve()
            })
            .fail(_ => reject())
        })
    }

    function loadDepartmentsData() {
        $.ajax(module.url.departments).then(response => {
            const select = $('.card[data-id="profs"] select[name="dept"]')

            response.forEach(dept => {
                select.append(`<option value="${dept.id}">${dept.name}</option>`)
            })
        })
    }

    function loadLocations() {
        let locations = module.settings.searchData.filter(item => item.location),
              dropdown = $('[data-form="location"] .dropdown-menu')
        locations = Array.from(new Set(locations))
        
        if(locations.length > 0) dropdown.html('')
        locations.forEach(itm => {
            dropdown.append(`<a class="dropdown-item" href="${module.url.search}?search=${itm.location}">
                                ${itm.location}</a>`)
        })
    }
    
    /**
     * Pass data to typeahead inputs
     * @param  {String} card current card
     */
    function activateTypeahead(card) {
        const profs = module.settings.searchData.filter(item => item.lastname),
              schools = module.settings.searchData.filter(item => item.location),
              cardName = card.data('id')

        card.find('input[name="school"]:visible').typeahead(TypeaheadSettings(cardName, 'school', schools))
        card.find('input[name="prof"]:visible').typeahead(TypeaheadSettings(cardName, 'prof', profs))
    }

    /**
     * Generate typeahead settings
     * @param {String} card  Current card
     * @param {String} input Name of the input the settings are for
     * @param {Array} data  Data to preload onto input
     */
    function TypeaheadSettings(card, input, data) {
        const profID = $(`.card[data-id="${card}"] input[name="pID"]`),
              schoolID = $(`.card[data-id="${card}"] input[name="sID"]`)

        if(input == 'prof') {
            return {
                source: data, minLength: 3,items: 4,
                displayText: function(item) {
                    return `${item.name} ${item.lastname}`
                },
                afterSelect: function (item) {
                    profID.val(item.id)
                }
            }
        }else if(input == 'school') {
            return {
                source: data, minLength: 3, items: 4,
                displayText: function(item) {
                    return `${item.name} (${item.nickname}), ${item.location}`
                },
                afterSelect: function (item) {
                    schoolID.val(item.id)
                    if(card == 'profs') filterProfessorData(item.id)
                }
            }   
        }
    }

    /**
     * Filter professor data on input by school ID
     * @param  {Int} schoolID 
     */
    function filterProfessorData(schoolID) {
        const profInput = $('.card[data-id="profs"]').find('input[name="prof"]'),
              profs = module.settings.searchData.filter(item => item.school_id == schoolID)

        profInput.typeahead('destroy')
        profInput.typeahead(TypeaheadSettings('profs', 'prof', profs))
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

    module.init = (card, config) => {
        if(config) {
            Object.keys(config).forEach(key => {
                if(module[key]) Object.assign(module[key], config[key])
            })
        }

        bindUIEvents()
        loadData()
        .then(() => {
            if(card.length > 0 && card != 'none')
                showSideCard(card)
            else
                showSideCard(module.settings.defaultCard)
        })
    }

    return module
}())

/*
    |--------------------------------------------------------------------------
    | Search Bar Module
    |--------------------------------------------------------------------------
    |
    | This module is for all the operations performed on the search list page
    | like the pagination
    |
    */
   
const searchBar = (function () {
    const m = {
        search: { data: null, fetchUrl: null }
    }

    function handleSearch(e) {
        // If no valid value ID
        if ((e.target.pID && e.target.pID != -1) || (e.target.sID && e.target.sID != -1))
            e.target.search.value = ''
    }

    /**
     * Load data for the search bar
     * @return {Void} 
     * @async
     */
    function loadData() {
        if(m.search.data)
            activateTypeahead(m.search.data)
        else
            $.ajax(m.search.fetchUrl).then(response => {
                activateTypeahead(response)
                m.search.data = response
            })
    }

    /**
     * Activate typeahead on search bar
     * @param  {Array} data
     * @return {Void}      
     */
    function activateTypeahead(data) {
        let template = `<a href="school/{{id}}">{{name}} - {{id}}</a>`,
            hidden = document.querySelector('.navbar-collapse input[type="hidden"]'),
            full = ''

        $('input[name="search"]').typeahead({
            source: data,
            minLength: 3,
            items: 7,
            displayText: function(item) {
                const full = item.lastname ? `${item.lastname} - ${item.school}`
                            : `(${item.nickname}), ${item.location}` 

                return item.name + ' ' + full
            },
            afterSelect: function(item) {
                if(item.lastname) {
                    full = `${item.lastname} - ${item.school}`
                    hidden.name = 'pID'
                }else {
                    full = `(${item.nickname}), ${item.location}` 
                    hidden.name = 'sID'
                }
                document.querySelector('.search-bar').setAttribute('data-name', item.name)
                hidden.value = item.id
            }
        })
    }

    /**
     * Remove Search ID when value is not pre-selected
     * @param  {Event} e event 
     * @return {Void}   
     */
    function removeSearchID(e) {
        console.log(e.target.getAttribute('data-name'))
        const isFound = m.search.data.filter(item => item.name == e.target.getAttribute('data-name'))
        if(isFound.length == 0)
            document.querySelector('.navbar-collapse input[type="hidden"]').value = '-1'   
    }

    function bindUIEvents() {
        document.querySelector('.navbar-collapse form').addEventListener('submit', handleSearch)
        $('.search-bar').on('blur', removeSearchID)
    }

    m.init = (config) => {
        if(config) {
            Object.keys(config).forEach(key => {
                if(m[key]) Object.assign(m[key], config[key])
            })
        }

        // Resize suggestions dropdown
        document.documentElement.style.setProperty('--searchBarTypeAheadWidth', $('.search-bar').width()+'px')
        loadData()
        bindUIEvents()
    }
    return m
}())